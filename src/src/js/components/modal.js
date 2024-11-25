import VanillaModal from 'vanilla-modal';

(function ($) {

    
    let body = document.body;
    let intElemScrollTop;


    $('.js-show-waitlist').on('click', function () {
        var $cur = $(this);
        var $parent = $cur.closest('.b-groups__item');
        var $content = $parent.find('.b-groups__modal-content');

        $('#js-waitlist-content').empty().append($content.html());
        $('.js-segment-field input').val($cur.data('segment'));
        $('.js-group-field input').val($cur.data('group'));
        $('.js-groupname-field input').val($cur.data('groupname'));

    });

    if ($('.modal').length > 0) {

        let modal = new VanillaModal({
            modalInner: '.modal__inner',
            clickOutside: true,
            modalContent: '.modal__content',
            onOpen: function() {
                intElemScrollTop = document.documentElement.scrollTop || document.body.scrollTop;
                body.style.top = -intElemScrollTop + 'px';
                document.documentElement.classList.add('vanilla-modal--open');
            },
            onBeforeOpen: function () {

            },
            onBeforeClose: function() {
                document.documentElement.classList.remove('vanilla-modal--open');
                document.body.style.top = '';
                document.body.scrollTop = intElemScrollTop;
                document.documentElement.scrollTop = intElemScrollTop;
            },
            onClose: function() {
                
            }
        });

    }


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