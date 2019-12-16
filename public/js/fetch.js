
// Initialize the var intervall so we can start and stop it
var interval = null;

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

            // Overrides the target content
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
            interval = setInterval(async function(){
                updateContent(url, target, parser, replace, inselect, false);
            }, 5000);
        }

        // "go-to-live" define the list of games of a user. When we click on it,
        // we need to stop the interval if exists, start a new one and go to live
        if (evt.target.classList.contains('go-to-live'))
        {
            if (typeof interval !== 'undefined') 
            {
                window.clearInterval(interval);
            }
            interval = setInterval(async function(){
                updateContent(url, target, parser, replace, inselect, false);
            }, 5000);
            const tabsSwipe = document.querySelector('#app-tabs-swipe');
            var instance = M.Tabs.getInstance(tabsSwipe);
            instance.select('tab-live');
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

        // Submits the form data and then displays the result in a toast
        submitForm(url, method, data, (json) =>
        {
            toastResult(json);
        });
    }
});


// On load, fetch data for market tab, user tab, ...
document.addEventListener('DOMContentLoaded', () =>
{
    let urlGames = 'api/getGamesUser'; 
    let targetGames = document.querySelector('#listGames');
    let parserGames = displayGamesUser;
    let replaceGames = 'true';
    updateContent(urlGames, targetGames, parserGames, replaceGames);

    let urlMarket = 'api/gamesheets';
    let target = document.querySelector('#market-gamesheets');
    let parser = parseJsonMarketTemplate;
    let replace = 'true';
    updateContent(urlMarket, target, parser, replace);
});