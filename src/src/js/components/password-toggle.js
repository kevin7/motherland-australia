(function ($) {

    $('.c-pwd-toggle').each(function () {

        var $parent = $(this);
        var $field = $parent.find('input[type="password"]');

        $parent.append('<div class="c-pwd-toggle__button"></div>');

        $parent.find('.c-pwd-toggle__button').on('click', function () {
            if ($parent.hasClass('active')) {
                $parent.removeClass('active');
                $field.prop('type', 'password');
            } else {
                $parent.addClass('active');
                $field.prop('type', 'text');
            }
        });

    });

})(jQuery);