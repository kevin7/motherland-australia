class CopyToClipboard {
    constructor(el) {
        this.element = el;
        this.urlCopy = this.element.dataset.copyUrl;

        this.bindEvents();
    }

    bindEvents() {
        this.tempInputElement = document.createElement('input');
        this.tempInputElement.type = 'text';
        this.tempInputElement.value = this.urlCopy;

        document.body.appendChild(this.tempInputElement);

        this.tempInputElement.select();
        document.execCommand('copy');

        this.element.querySelector('.c-share-links-copy__message').classList.add('is-active');
        setTimeout(() => {
            this.element
                .querySelector('.c-share-links-copy__message')
                .classList.remove('is-active');
        }, 3000);

        document.body.removeChild(this.tempInputElement);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const elements = document.querySelectorAll('[data-copy-url]');
    if (elements) {
        elements.forEach(element => {
            element.addEventListener('click', e => {
                e.preventDefault();
                new CopyToClipboard(element);
            });
        });
    }
});
