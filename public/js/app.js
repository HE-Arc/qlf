
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

/**
 * Parse a game's JSON and create a table (html) with content.
 * Then, will be returned to 'updateContent', which will display it.
 * 
 * It is a generic function, but with's 'qlf' param, it will call a function to "populate" qlf website.
 * 
 * @param {string} json data, JSON of the game
 * @param {bool} qlf false for generic function, true for qlf web app
 */
function parseJsonGameTemplate(json, qlf)
{
    let gameObject = json.data;

    let gameName = gameObject.name;
    let scores = JSON.parse(gameObject.scores);
    let players = gameObject.players;
    let gameCreationDate = new Date(gameObject.created_at);
    let gameCreator = gameObject.created_by;

    gamesheetObject = gameObject.gamesheet;

    let gamesheetName = gamesheetObject.name;
    let downloads = gamesheetObject.downloads;
    let idGamesheetCreator = gamesheetObject.user_id;
    
    let template = JSON.parse(gamesheetObject.template);
    let columns = template.attributes.column_header;
    let rows = template.attributes.row_header;

    let table = '<table><thead><tr><th></th>';
    for (let col in columns)
    {
        table += '<th>' + players[col].name + '</th>';
    }
    table += '</tr></thead>';

    for (let row in rows)
    {
        table += '<tr><th>' + rows[row].text + '</th>';
        for (let col in columns)
        {
            table += '<td>' + scores[row][col] + '</td>';
        }
        table += '</tr>';
    }

    table += '</table>';

    if (qlf){
        infoObject = {
            "gamesheetName": gamesheetName,
            "idGamesheetCreator": idGamesheetCreator,
            "downloads": downloads,
            "gameName": gameName,
            "gameCreator": gameCreator,
            "gameCreationDate": gameCreationDate,
        }
        displayInfos(infoObject);
    }

    return table;
}

function displayInfos(infoObject){
    document.querySelector('#gamesheet-name').innerHTML = infoObject.gamesheetName;
    
    strGamesheetInfo = "This game's template was created by " + String(infoObject.idGamesheetCreator) + " and was downloaded more than " + String(infoObject.downloads) + " times!";
    document.querySelector('#gamesheet-info').innerHTML = strGamesheetInfo;

    document.querySelector('#game-name').innerHTML = infoObject.gameName;
    
    strGameInfo = "Game created by " + String(infoObject.gameCreator.name) + ", " + timeSince(infoObject.gameCreationDate) + " ago.";
    document.querySelector('#game-info').innerHTML = strGameInfo;
}

/**
 * Returns time elapsed since a date (param)
 * e.g.:
 * 1 minute ago, 1 month ago, ...
 *
 * credit and source: https://stackoverflow.com/a/3177838
 * 
 * @param {date} date
 */
function timeSince(date) {

    var seconds = Math.floor((new Date() - date) / 1000);

    var interval = Math.floor(seconds / 31536000);

    if (interval > 1) {
        return interval + " years";
    }
    interval = Math.floor(seconds / 2592000);
    if (interval > 1) {
        return interval + " months";
    }
    interval = Math.floor(seconds / 86400);
    if (interval > 1) {
        return interval + " days";
    }
    interval = Math.floor(seconds / 3600);
    if (interval > 1) {
        return interval + " hours";
    }
    interval = Math.floor(seconds / 60);
    if (interval > 1) {
        return interval + " minutes";
    }
    return Math.floor(seconds) + " seconds";
}