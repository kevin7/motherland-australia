(function ($) {
    /*
    ** Event equalheight
    */
    
    $('.equalheight').each(function() {
        var $elm = $(this);
        equalHeight($elm.data('equalheight'), $elm.data('equalheight-width'), $elm.data('equalheight-target'));
    });


    function equalHeight(elm, mobileWidth, target) {
        setHeight(elm, mobileWidth, target);

        var resizeTimer;
        $(window).on('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                setHeight(elm, mobileWidth, target);
            }, 500);
        });   
    }

    function setHeight(elm, mobileWidth, target) {

        var tallest = 0;
        var $block = $(elm);
        $(target).css('min-height', 0);

        if ($(window).width() > mobileWidth) {

            $block.each(function (x) {
                if ($(this).outerHeight() > tallest) {
                    tallest = $(this).outerHeight(); 
                }
            });   
            $(target).css('min-height', tallest);
        }
    }

})(jQuery);