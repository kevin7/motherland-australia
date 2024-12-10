import Flickity from 'flickity';
/*
** Carousel toggle - Turn standard layout to carousel
*/


const carouselsToggle = document.querySelectorAll('[data-carousel-toggle]');

carouselsToggle.forEach(carousel => init(carousel));

function init(carousel) {

    let carouselOptions = JSON.parse(carousel.dataset.carouselToggleOptions);
    let carouselResponsive = carousel.dataset.carouselToggle;
    let carouselInstance = false;

    if (window.outerWidth <= carouselResponsive) {
        carouselInstance = new Flickity(carousel, carouselOptions);
    }
    

    window.addEventListener('resize', () => {
        if (window.outerWidth <= carouselResponsive) {
            carouselInstance = new Flickity(carousel, carouselOptions);
        } else {
            if (carouselInstance !== false) carouselInstance.destroy();
        }

    }); 


    let prevNav = document.querySelectorAll(carousel.dataset.prev);
    let nextNav = document.querySelectorAll(carousel.dataset.next);

    if (prevNav) {
        prevNav.forEach(p => {
            p.addEventListener('click', () => {
                carouselInstance.previous( true );
            });
        });
        
    }

    if (nextNav) {
        nextNav.forEach(n => {
            n.addEventListener('click', () => {
                carouselInstance.next( true );
            });
        });
    }

}