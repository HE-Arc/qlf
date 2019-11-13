
// Fetch API not available
if (!window.fetch)
{
    alert('The Fetch API is not available on this browser version...');
}

// TEST
var url = 'gamesheet';
element = '';
get(url, element);

function get(url, element, replace=true)
{
    fetch(url)
        .then((response) =>
        {
            //console.log(response);
            return response.json();
        })
        .then((json) =>
        {
            console.log(json);
        })
        .catch((error) =>
        {
            console.log(error);
        });
}
