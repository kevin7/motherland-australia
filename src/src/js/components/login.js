import { ajax } from "jquery";

(function ($) {

    $('#loginform').on('submit', function(e) {
        e.preventDefault();

        var data = {
            'action': 'custom_ajax_login', // Custom action name for AJAX
            'username': $('#username').val(),
            'password': $('#password').val(),
            'security': $('#security').val(),
            'redirect_to': $('#redirect_to').val()
        };

        console.log(data);

        $.ajax({
            type: "post",
            url: "/wp-admin/admin-ajax.php",
            data: data,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    window.location.href = response.data.redirect_url; // Redirect on successful login
                } else {
                    $('#login-message').addClass('active').html('Invalid credential. Please try again.'); // Display error message
                }
            }
        });

    });

})(jQuery);