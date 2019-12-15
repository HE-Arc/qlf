
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

    // Inits form create
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems, {});

    // Inits form select
    var elems = document.querySelectorAll('select');
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

function parseJsonMarketTemplate(json){
    gamesheets = json.data;
    
    stringGamesheets = '<div class="row">';

    for (let index in gamesheets){
        let gamesheet = gamesheets[index]
        
        let name = gamesheet.name;
        let downloads = gamesheet.downloads;
        let created_at = gamesheet.created_at;
        let updated_at = gamesheet.updated_at;
        let creator = gamesheet.created_by.name;
        
        stringGamesheets += '<div class="col s12 m3">';
        stringGamesheets += '<div class="card deep-orange lighten-4">';
        stringGamesheets += '<div class="card-image waves-effect waves-block waves-light" style="padding:10px; ">';
        stringGamesheets += '<img class="activator" src="img/games.png">';
        stringGamesheets += '</div>';
        stringGamesheets += '<div class="card-content">';
        stringGamesheets += '<span class="card-title activator red-text text-darken-3" style="font-weight: bold">' + String(name) + '<i class="material-icons right">more_vert</i></span>';
        stringGamesheets += '</div>';
        stringGamesheets += '<div class="card-reveal grey-text text-darken-4 deep-orange lighten-4" style="font-style: italic;">';
        stringGamesheets += '<span class="card-title red-text text-darken-3" style="font-weight: bold; font-style: normal;">' + String(name) + '<i class="material-icons right">close</i></span>';
        stringGamesheets += '<p>Simple description.</p>';
        stringGamesheets += '<p>Downloaded more than ' + String(downloads) + ' times on mobile devices!</p>';
        stringGamesheets += '<p>Game created ' + String(timeSince(new Date(created_at))) + ' ago, by ' + String(creator) + '.</p>';
        stringGamesheets += '<p></p>';
        stringGamesheets += '</div>';
        stringGamesheets += '</div>';
        stringGamesheets += '</div>';
    }

    stringGamesheets += '</div>';

    return stringGamesheets;
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
    let gamesheetCreator = gamesheetObject.created_by;
    
    let template = JSON.parse(gamesheetObject.template);
    let columns = template.attributes.column_header;
    let rows = template.attributes.row_header;

    let table = '<table class="responsive-table highlight"><thead><tr><th></th>';
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
            table += '<td id="cell' + row + col + '" onClick="clickCell(this.id)">' + scores[row][col] + '</td>';
        }
        table += '</tr>';
    }

    table += '</table>';

    if (qlf){
        infoObject = {
            "gamesheetName": gamesheetName,
            "gamesheetCreator": gamesheetCreator,
            "downloads": downloads,
            "gameName": gameName,
            "gameCreator": gameCreator,
            "gameCreationDate": gameCreationDate,
        }
        displayInfos(infoObject);
    }

    return table;
}

/**
 * Will display infos on live tab, like game name, created by who, etc... 
 * Called if it's the first time that we load a live game. 
 * 
 * @param {object} infoObject 
 */
function displayInfos(infoObject){
    document.querySelector('#gamesheet-name').innerHTML = infoObject.gamesheetName;
    
    strGamesheetInfo = "This game's template was created by " + String(infoObject.gamesheetCreator.name) + " and was downloaded more than " + String(infoObject.downloads) + " times!";
    document.querySelector('#gamesheet-info').innerHTML = strGamesheetInfo;

    document.querySelector('#game-name').innerHTML = infoObject.gameName;
    
    strGameInfo = "Game created by " + String(infoObject.gameCreator.name) + ", " + timeSince(infoObject.gameCreationDate) + " ago.";
    document.querySelector('#game-info').innerHTML = strGameInfo;
}


/**
 * 
 * Fetch the gamesheets (templates) to put in modal for the creation of a game
 * 
 * @param {string} json data, JSON of the gamesheet
 * @param {bool} qlf false for generic function, true for qlf web app
 */
function getTemplates(data, qlf)
{
    var allTemplates = [];
    data.forEach(element => {
        allTemplates.push([element['id'],element['name']]);
    });
    return allTemplates;
}

function clickCell(id){
    console.log(id)
}

document.getElementById('showModal').onclick = function triggerModal() {
    var Modalelem = document.querySelector('.modal');
    var instance = M.Modal.init(Modalelem);
    instance.open();
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