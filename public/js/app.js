
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
