(function($){
    var $ = jQuery;
    jQuery(document).on('ready', function($) {
        setTimeout(function(){
            jQuery("#modal").modal({
                fadeDuration: 1000,
                fadeDelay: 0.30
            });
        }, 3000);
    });
})(jQuery);