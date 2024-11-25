(function ($) {



    $(document).on('gform_confirmation_loaded', function(event, formId){
        if (formId === $('#sub-popup').data('form-id')) {
            createCookie('subbed', 1, 365);
            $('.sub-popup').addClass('done');
            setTimeout(function () {
                $('.sub-popup').removeClass('active');
            }, 3000);
        }
    });

    if (!readCookie('subbed')) {
        $(window).load(function () {
            $('.sub-popup').addClass('active');
        });
    }

    $('.sub-popup__close').on('click', function () {
        $('.sub-popup').removeClass('active');
        createCookie('subbed', -1, 7);
        return false;
    });


    function createCookie(name,value,days) {
        if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
        }
        else var expires = "";
        document.cookie = name+"="+value+expires+"; path=/";
    }
    
    function readCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0) ===' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }


})(jQuery);