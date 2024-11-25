  
/*
** Accordion
*/
import 'accordionjs';

(function ($) {
  
    $(".accordion").accordionjs({
        activeIndex : false
    });
  
})(jQuery);

const accordions = document.querySelectorAll('[data-accordion]');

accordions.forEach(accordion => {
    const activeClass = accordion.dataset.accordionActiveClass || 'is-active';
    const toggle = accordion.querySelector('[data-accordion-toggle]');
    const content = accordion.querySelector('[data-accordion-content]');
    content.style.height = 0 + 'px';

    function toggleAccordionItem() {
        const contentHeight = content.scrollHeight;

        if (content.style.height == 0 + 'px') {
            content.style.height = contentHeight + 'px';
        } else {
            content.style.height = 0 + 'px';
        }
    }

    toggle.addEventListener('click', e => {
        e.preventDefault();
        accordion.classList.toggle(activeClass);
        toggleAccordionItem();
    });
});


