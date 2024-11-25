<div class="modal">
    <div class="modal__inner">
    <a data-modal-close>
        <span class="close-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"/>
            </svg>
        </span>
        <span class="close-text">Close</span>
    </a>
        <div class="modal__content"></div>
    </div>
</div>

<?php if (get_field('sub_popup', 'option')) : $formID = get_field('sub_popup', 'option'); ?>
<div class="sub-popup" id="sub-popup" data-form-id="<?=$formID?>">
    <div class="sub-popup__wrapper">
        <span class="sub-popup__close"><i class="icon-times"></i></span>
        <?=do_shortcode('[gravityform id="' . $formID . '" ajax="true" title="false"]')?>
    </div>
</div>
<?php endif; ?>