import Flickity from 'flickity';

const carousels = document.querySelectorAll('[data-carousel]');
const cellSelector = '[data-carousel-slide]';


const defaultOptions = {
    cellSelector: cellSelector,
    cellAlign: 'left',
    imagesLoaded: true,
    wrapAround: true
};

carousels.forEach(carousel => init(carousel));

function init(carousel) {
    
    if (carousel.querySelectorAll(cellSelector).length < 2) return;

    const mediaQuery = window.matchMedia('(min-width: 560px)');
    const options = getExtraOptions(carousel);
    const carouselCount = carousel.querySelector('[data-carousel-count]');

    let flickityInstance;

    window.addEventListener('load', () => {
        mediaQueryUpdate(mediaQuery, options);
        flickityInstance = new Flickity(carousel, options);
        flickityInstance.resize();
        if (carouselCount) {
            updateStatus(flickityInstance, carouselCount);
            flickityInstance.on('select', function(index) {
                carouselCount.innerText = index + 1 + '/' + flickityInstance.slides.length;
            });
        }
    }); 

    window.addEventListener('resize', () => {
        mediaQueryUpdate(mediaQuery, options);
        flickityInstance = new Flickity(carousel, options);
        flickityInstance.resize();
    });

    let prevNav = document.getElementById(carousel.dataset.prev);
    let nextNav = document.getElementById(carousel.dataset.next);

    if (prevNav) {
        prevNav.addEventListener('click', () => {
            flickityInstance.previous( true );
        });
    }

    if (nextNav) {
        nextNav.addEventListener('click', () => {
            flickityInstance.next( true );
        });
    }
    

}


function updateStatus(flickityInstance, carouselCount) {
    let cellNumber = flickityInstance.selectedIndex + 1;
    carouselCount.innerText = cellNumber + '/' + flickityInstance.slides.length;
}

function mediaQueryUpdate(mediaQuery, options) {
    if (typeof options.groupCells !== 'undefined' && options.groupCells) {
        if (options.groupCells <= 2) {
            if (mediaQuery.matches) {
                options.groupCells = 2;
            } else {
                options.groupCells = 1;
            }
        }
    }
}

function getExtraOptions(carousel) {
    
    if (carousel.dataset && carousel.dataset.carousel) {
        let extraOptions = JSON.parse(carousel.dataset.carousel);
        return Object.assign({}, defaultOptions, extraOptions);
    }

    return defaultOptions;
}

