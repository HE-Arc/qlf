
const $$ = {
    header: document.querySelector('.header'),
    main: document.querySelector('.main'),
    footer: document.querySelector('.footer'),
}

// Updates the main height (based on the window height)
function appContainerHeight()
{
    let height = window.innerHeight - $$.header.offsetHeight - $$.footer.offsetHeight;
    $$.main.style.height = height + 'px';
}

// On resize event
window.addEventListener('resize', appContainerHeight);

// On DOM load event
document.addEventListener('DOMContentLoaded', () =>
{
    // Inits carousel
    const carousel = document.querySelector('#app-container');
    let mCarousel = M.Carousel.init(carousel, {
        fullWidth: true,
    });

    // Inits tabs swipe
    const tabsSwipe = document.querySelector('#app-tabs-swipe');
    let mTabsSwipe = M.Tabs.init(tabsSwipe, {
        swipeable: true,
    });

    // Inits header dropdown
    const headerDropdown = document.querySelector('.dropdown-trigger');
    let mHeaderDropdown = M.Dropdown.init(headerDropdown, {
        constrainWidth: false,
        coverTrigger: false,
    });

    // Inits main height
    appContainerHeight();

    // Inits tabs width
    let tabs = document.getElementsByClassName('tab');
    let tabWidth = (100 / tabs.length) + '%';
    for (let i = 0; i < tabs.length; i++)
    {
        tabs[i].style.width = tabWidth;
    }
});

function parseJsonGame(json)
{
    let game = JSON.parse(json);

    let attributes = game.data.attributes;
    let name = attributes.name;
    let rows = attributes.row_header;
    let columns = attributes.column_header;

    let table = '<table><thead><tr><th></th>';
    for (let col in columns)
    {
        table += '<th>' + columns[col].text + '</th>';
    }
    table += '</tr></thead>';

    for (let row in rows)
    {
        table += '<tr><th>' + rows[row].text + '</th>';
        for (let tmp in columns)
        {
            table += '<td>Empty</td>';
        }
        table += '</tr>';
    }

    table += '</table>';

    document.querySelector('#json-test').innerHTML = table;
}

//parseJsonGame(json);

// Fetch example parser function
function test(data)
{
    let name = data['data']['0']['attributes']['name'];
    return '<p>' + name + '</p>';
};

/**
 * Returns a random between min and max (inclusive)
 * source: https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/random
 * 
 * @param {int} min inclusive
 * @param {int} max inclusive
 */
function getRandomIntInclusive(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min; //The maximum is inclusive and the minimum is inclusive 
}

function parseJsonGameTemplate(json)
{
    let gameObject = json.data;

    let name = gameObject.name;
    let downloads = gameObject.downloads;

    let templateObject = JSON.parse(gameObject.template).attributes;

    let columns = templateObject.column_header;
    let rows = templateObject.row_header;
    let content = templateObject.content;

    let table = '<table><thead><tr><th></th>';
    for (let col in columns)
    {
        // TODO: player's id shouldnt be fetched from "gamesheets" but from "games". To change.
        table += '<th> player\'s ID is: ' + columns[col].player_id + '</th>';
    }
    table += '</tr></thead>';

    for (let row in rows)
    {
        table += '<tr><th>' + rows[row].text + '</th>';
        for (let col in columns)
        {
            // TODO: players' scores shouldn't be fetched from "gamesheets" but from "games". To change.
            table += '<td>' + content[row][col] + '</td>';
        }
        table += '</tr>';
    }

    table += '</table>';

    return table;
}