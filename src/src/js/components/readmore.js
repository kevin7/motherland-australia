(function ($) {
    
    $('.c-readmore__toggle .c-link').on('click', function () {
        
        var $elm = $(this);
        var $parent = $elm.closest('.c-readmore');

        if ($parent.hasClass('c-readmore--active')) {
            $parent.removeClass('c-readmore--active');
            $elm.text($elm.data('default'));
        } else {
            $parent.addClass('c-readmore--active');
            $elm.text($elm.data('expanded'));
        }

    });

})(jQuery);