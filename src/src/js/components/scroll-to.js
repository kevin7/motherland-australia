/* 
** Scroll goto
*/
(function ($) {

  
    $('[data-scroll-to]').on('click', function () {
        var hash = $(this).data('scroll-to');

        $('html, body').animate({
            scrollTop: $('#' + hash).offset().top
        }, 800);     
        return false;
    });

})(jQuery);