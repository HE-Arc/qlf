
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
    fetch(url)
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
function updateContent(url, target, parser, replace = true, inselect = false)
{
    // Fetches the data
    get(url, (data) =>
    {
        if (data)
        {
            // Parses the received data
            let parsedData = parser(data);

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

        updateContent(url, target, parser, replace, inselect);
    }
});
