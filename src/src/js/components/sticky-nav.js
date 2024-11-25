import Sticky from 'sticky-js';


document.addEventListener('DOMContentLoaded', () => {
    let sticky = new Sticky('[data-sticky-sidebar]');
    sticky.update();
});