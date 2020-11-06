jQuery(document).ready(function($) { 'use strict';
    // Perform AJAX login on form submit
    $('form#login').on('submit', function(e){ 'use strict';
        $('form#login p.status').show().text(ajax_objects.loadingmessage);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_objects.ajaxurl,
            data: { 
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#login #username').val(), 
                'password': $('form#login #password').val(), 
                'security': $('form#login #security').val() },
            success: function(data){
                $('form#login div.login-error').text(data.message);
                if (data.loggedin == true){
                    document.location.href = ajax_objects.redirecturl;
                }
                if($('.login-error').text() == ''){
                    $('form#login div.login-error').hide();
                }else{
                    $('form#login div.login-error').show();
                }
            }
        });
        e.preventDefault();
    });
    
    if($('.login-error').text() == ''){
        $('form#login div.login-error').hide();
    }else{
        $('form#login div.login-error').show();
    }
});