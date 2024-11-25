(function ($) {

    $(window).on('load', function () {

        var $menu = $('#js-menu-access');
        var pid = $menu.data('pid'); 
        $.ajax({
            type: "post",
            url: "/wp-admin/admin-ajax.php",
            data: {action: 'get_program_menu', id: pid},
            success: function (response) {
                $menu.empty().append(response);
            }
        });
    });

    
})(jQuery);