(function ($) {

    $('.c-member-popup__close, .c-member-popup__overlay').on('click', function () {
        $('body').removeClass('no-scroll');
        $('.c-member-popup').removeClass('c-member-popup--active');
    });

    $('.c-member').on('click', function () {
        var $elm = $(this);
        var content = $elm.find('.c-member-popup__markup').html();
        $('.c-member-popup__dump').empty().append(content);
        $('body').addClass('no-scroll');
        $('.c-member-popup').addClass('c-member-popup--active');
    });

})(jQuery);