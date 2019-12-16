
// Fetch API not available
if (!window.fetch)
{
    alert('The Fetch API is not available on this browser version...');
}

/**
 * Fetches data at the given url (GET) and then call the
 * given callback with the received data.
 * @param  {[String]}   url      [description]
 * @param  {Function} callback [description]
 */
function get(url, callback)
{
    let options = {
        creditentials: 'same-origin',
        headers:
        {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken(),
        },
    };

    fetch(url, options)
        .then((response) =>
        {
            return response.json();
        })
        .then((json) =>
        {
            callback(json);
        })
        .catch((error) =>
        {
            console.log('[Fetch Error]', error);
        });
}

/**
 * Submits a form data to an URL with a REST action (POST, PUT, DELETE)
 * and then calls the callback
 * @param  {[String]}   url      [description]
 * @param  {[String]}   method   [description]
 * @param  {[String]}   data     [description]
 * @param  {Function} callback [description]
 */
function submitForm(url, method, data, callback)
{
    let options = {
        method: method,
        credentials: 'same-origin',
        body: data,
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken(),
        },
    };

    fetch(url, options)
        .then((response) =>
        {
            return response.json();
        })
        .then((json) =>
        {
            callback(json);
        })
        .catch((error) =>
        {
            console.log('[Fetch Error]', error);
        });
}

/**
 * Fetches data at the given url and then updates the given DOM element.
 *
 * The parser is a function which transforms the received data (JSON)
 * into HTML.
 *
 * If replace is true, the target content is overriden ; otherwise, the
 * data is appended to the current target content.
 * @param  {[String]}  url            [description]
 * @param  {[DOM Object]}  target         [description]
 * @param  {[Function]}  parser         [description]
 * @param  {Boolean} [replace=true] [description]
 * @param  {Boolean} [inselect=false] [description]
 */
function updateContent(url, target, parser, replace = true, inselect = false, qlf=false)
{
    // Fetches the data
    get(url, (data) =>
    {
        if (data)
        {
            // Parses the received data
            let parsedData = parser(data, qlf);

            if(inselect === 'true')
            {
                $("form input").val("");
                parsedData.forEach(element => {
                    var $newOpt = $("<option>").attr("value",element[0]).text(element[1])
                    $(target).append($newOpt);
                  });
                // fire custom event anytime you've updated select
                $(target).trigger('contentChanged');

                $(target).formSelect();
            }
            // Overrides the target content
            else if (replace === 'true')
            {
                target.innerHTML = parsedData;
            }
            // Appends to the target content
            else
            {
                target.innerHTML += parsedData;
            }
        }
    });
}

/**
 * Returns the CSRF Token content
 * @return {[String]} [description]
 */
function getCsrfToken()
{
    let csrfToken = document.querySelector('meta[name="csrf-token"]');

    if (! csrfToken)
    {
        alert('The CSRF Token is not set !');

        return '';
    }

    return csrfToken.getAttribute('content');;
}

/**
 * Parses the form and returns its content as a String
 * @param  {[HTML Form]} form [description]
 * @return {[String]}      [description]
 */
function stringifyForm(form)
{
    let formData = new FormData(form);
    let parsedData = {};

    // Iterates over each input
    for (let name of formData)
    {
        // [input name, input value]
        parsedData[name[0]] = name[1];
    }

    return JSON.stringify(parsedData);
}

/**
 * Clears the form inputs value
 * @param  {[type]} form [description]
 */
function clearForm(form)
{
    let inputs = form.querySelectorAll('input, textarea');

    for (let input of inputs)
    {
        let tagName = input.tagName;

        if (tagName === 'INPUT')
        {
            input.value = '';
        }
        else if (tagName === 'TEXTAREA')
        {
            input.innerHTML = '';
        }
    }
}

/**
 * Displays the request status with a message in a Toast
 * @param  {[JSON]} json [description]
 */
function toastResult(json)
{
    let status = json.status;
    let message = json.message ? json.message : 'No message set !';

    toast(message, TOAST[status]);
}

// Click on an element with the fetch-update class
document.addEventListener('click', (evt) =>
{
    if (evt.target && evt.target.classList.contains('fetch-update'))
    {
        evt.preventDefault();

        let url = evt.target.getAttribute('href');
        let target = document.querySelector(evt.target.getAttribute('data-target'));
        let parser = window[evt.target.getAttribute('data-parser')];
        let replace = evt.target.getAttribute('data-replace');
        let inselect = evt.target.getAttribute('data-inselect');

        updateContent(url, target, parser, replace, inselect, true);

        if (evt.target.classList.contains('fetch-sync'))
        {
            setInterval(async function(){
                updateContent(url, target, parser, replace, inselect, false);
            }, 5000);
        }
    }
});

// Submit on an element with the fetch-submit class
document.addEventListener('submit', (evt) =>
{
    if (evt.target && evt.target.classList.contains('fetch-submit'))
    {
        evt.preventDefault();

        let form = evt.target;
        let url = form.getAttribute('action');
        let method = form.getAttribute('method');
        let data = stringifyForm(form);
        let callback = window[form.getAttribute('data-callback')];

        // Submits the form data, displays the result in a toast and calls the callback
        submitForm(url, method, data, (json) =>
        {
            toastResult(json);

            // Calls the callback if set
            if (callback !== undefined)
            {
                callback(json);
            }

            // Clears the form inputs if data-clear is true
            if (form.getAttribute('data-clear') === 'true')
            {
                clearForm(form);
            }
        });
    }
});

// On load, fetch data for market tab, user tab, ...
document.addEventListener('DOMContentLoaded', () =>
{
    let urlMarket = 'api/gamesheets';
    let target = document.querySelector('#market-gamesheets');
    let parser = parseJsonMarketTemplate;
    let replace = 'true';

    updateContent(urlMarket, target, parser, replace);
});
