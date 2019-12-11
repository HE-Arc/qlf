
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
 * Parse a game's JSON and create a table (html) with content, then to be returned to 'updateContent', which will display it
 * 
 * @param {string} json data, JSON of the game
 */
function parseJsonGameTemplate(json)
{
    let gameObject = json.data;

    let idGamesheet = gameObject.gamesheet_id;
    let nameGame = gameObject.name;
    let scores = JSON.parse(gameObject.scores);

    // TODO: for now, the created_by column in games table is not linked to a user (not foreign key).
    // that's why idCreator is a simple string.
    let idCreator = gameObject.created_by;

    
    get('api/gamesheets/'+idGamesheet, (gamesheetData) =>
    {
        if (gamesheetData)
        {
            let gamesheetObject = parseAndGetGamesheetObject(gamesheetData);

            let nameGamesheet = gamesheetObject.nameGamesheet;
            let downloads = gamesheetObject.downloads;
            let columns = gamesheetObject.columns;
            let rows = gamesheetObject.rows;

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
                    table += '<td>' + scores[row][col] + '</td>';
                }
                table += '</tr>';
            }

            table += '</table>';

            // For now, idk why but it's not returning the parsedData to updateContent, even if the 'table' is correctly formed. gonna ask qtipee
            console.log(table);
            return table;
        }
        else
        {
            return 'Error: Could not get gamesheet related to this game.';
        }
    });
}

/**
 * Parse and returns an gamesheet object (dictionary), with:
 * - (key): (description of value)
 * - nameGamesheet: name of the game
 * - downloads: number of downloads of this game
 * - columns: columns header of this template
 * - rows: rows header of this template
 * 
 * @param {string} gamesheetJSON json of the gamesheet
 */
function parseAndGetGamesheetObject(gamesheetJSON){
    let gamesheetData = gamesheetJSON.data;

    let nameGamesheet = gamesheetData.name;
    let downloads = gamesheetData.downloads;

    let attributesGamesheet = JSON.parse(gamesheetData.template).attributes;

    let columns = attributesGamesheet.column_header;
    let rows = attributesGamesheet.row_header;

    let gamesheetObject = {
        "nameGamesheet" : nameGamesheet,
        "downloads" : downloads,
        "columns" : columns,
        "rows" : rows,
    }

    return gamesheetObject;
}