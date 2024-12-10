export default class ExpandableBlock {
    element;
    contentBlock;
    initialHeight;
    readMoreBtn;

    /**
     * Constructor
     * @param DOMElement element
     */
    constructor(element) {
        this.element = element;

        if (this.element.children.length === 0) {
            return;
        }

        this.contentBlock = this.element.children[0];
        this.initialHeight = this.element.clientHeight;
        this.sectionHeight = 0;

        if (this.element.classList.contains('c-expandable-block--menu')) {
            this.contentSections = this.element.querySelectorAll('.c-text-block-title');

            if (this.contentSections.length > 6 && this.contentSections.length < 8) {
                this.contentSections.forEach(section => {
                    this.sectionHeight = section.clientHeight;
                });
                this.maxHeight = this.sectionHeight * 5;
            } else if (this.contentSections.length >= 8) {
                this.contentSections.forEach(section => {
                    this.sectionHeight = section.clientHeight;
                });
                this.maxHeight = this.sectionHeight * 6;
            } else {
                this.maxHeight = this.element.clientHeight;
            }
        } else {
            this.maxHeight = '325';
        }

        this.createElements();
        this.bindEvents();
        this.checkElement();
    }

    /**
     * Bind our Events
     */
    bindEvents() {
        window.addEventListener('resize', () => {
            this.checkElement();
        });
    }

    /**
     * Create the Read More Button
     */
    createElements() {
        var readMoreEl = document.createElement('span');
        readMoreEl.classList.add('c-expandable-block__read-more');
        readMoreEl.innerHTML = '<span>Show all</span>';

        readMoreEl.addEventListener('click', e => {
            this.toggle(e.currentTarget);
        });

        this.readMoreBtn = readMoreEl;
        this.element.parentNode.appendChild(readMoreEl);
    }

    /**
     * Slide Toggle
     * @param DOMElement link
     */
    toggle(link) {
        this.element.classList.toggle('opened');

        if (this.element.classList.contains('opened')) {
            this.initialHeight = this.element.clientHeight;
            this.element.style.maxHeight = this.contentBlock.clientHeight + 'px';

            link.innerHTML = '<span>Show less</span>';
        } else {
            this.element.style.maxHeight = this.initialHeight + 'px';
            link.innerHTML = '<span>Show all</span>';
        }
    }

    /**
     * Do we show / hide the Read More button?
     */
    checkElement() {
        const contentSize = this.contentBlock.getBoundingClientRect();

        if (contentSize.height > this.maxHeight) {
            this.element.style.maxHeight = this.maxHeight + 'px';
            this.readMoreBtn.style.display = 'block';
        } else {
            this.readMoreBtn.style.display = 'none';
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.c-expandable-block').forEach(element => {
        if (element.getAttribute('data-expandable-manual')) {
            return;
        }
        new ExpandableBlock(element);
    });
});
