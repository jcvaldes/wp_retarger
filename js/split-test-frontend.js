(function($){
    var $ = jQuery;

    jQuery(document).on('ready', function($) {
        if(jQuery("#split-test").val() == 'true'){

            var data = {
                'action': 'splittest',
                'router_id': jQuery('#router_id').val()
            };

            // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
            jQuery.post(jQuery('#siteurl').val() + '/wp-admin/admin-ajax.php', data, function(response) {
                console.log(response);
                jQuery('body').append(response.iframe);
            }, 'json');
        }
  });

})(jQuery);