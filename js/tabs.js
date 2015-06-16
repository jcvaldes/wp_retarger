jQuery(document).ready( function($) {

    jQuery( '.nav-tab' ).click(function(){
        switch_tabs( $(this) );
    });

    /* BTN */

    var $btn = jQuery("#example-btn");

    jQuery('#button-text').on("keyup", function(){
        var val = $(this).val();
        $btn.text(val);
    })

    $('#button-background').colpick({
        layout:'hex',
        submit:0,
        colorScheme:'dark',
        onChange:function(hsb,hex,rgb,el,bySetColor) {
            $(el).css('border-color','#'+hex);
            // Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
            if(!bySetColor) $(el).val('#'+hex);

            $btn.css('background-color', '#'+hex);
        }
    }).keyup(function(){
        $(this).colpickSetColor(this.value);
    });

    $('#button-color').colpick({
        layout:'hex',
        submit:0,
        colorScheme:'dark',
        onChange:function(hsb,hex,rgb,el,bySetColor) {
            $(el).css('border-color','#'+hex);
            // Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
            if(!bySetColor) $(el).val('#'+hex);

            $btn.css('color', '#'+hex);
        }
    }).keyup(function(){
        $(this).colpickSetColor(this.value);
    });

    /* POPUP */

    jQuery(".popup-type").click(function(){
        var index = jQuery(this).val();
        if(index == 1){
            $(".for-type-2").hide();
            $(".for-type-3").hide();
        }else if(index == 2){
            $(".for-type-2").show();
            $(".for-type-3").hide();
        }else if(index == 3){
            $(".for-type-2").hide();
            $(".for-type-3").show();
        }
    });

    jQuery(".popup-show").click(function(){
        var index = jQuery(this).val();
        if(index == 'url'){
            $(".for-html").hide();
            $(".for-url").show();
        }else if(index == 'html'){
            $(".for-url").hide();
            $(".for-html").show();
        }
    });


    jQuery(".image-click").click(function(){

        var index = jQuery(this).val();
        if(index == 1){
            $(".for-click-true").show();
        }else if(index == 0){
            $(".for-click-true").hide();
        }
    });



    if($("#type").val() == 2){
        $(".two").trigger('click');
    }else if($("#type").val() == 3){
        $(".tres").trigger('click');
    }

    if($("#type-show").val() == 'html'){
        $(".html").trigger('click');
    }




});

function switch_tabs(obj)
{
    //  Test to see if the menu tab is already active
    //  Only process the click if the tab is inactive
    if ( ! obj.hasClass( 'nav-tab-active' ) )
    {
        //  Hide the active menu tab and all the contents panels
        jQuery( '.nav-tab-active' ).removeClass( 'nav-tab-active' );
        jQuery( '.nav-tab-contents' ).hide( );

        //  Get the value of the 'rel' attribute of the selected element object
        //  Translate the value into the id reference of the target panel
        var id = '#' + obj.attr( 'rel' );

        //  Set the selected menu tab to active
        //  Show the associated contents panel with the ID
        //  that matches the object 'rel' identifier
        obj.addClass( 'nav-tab-active' );
        jQuery( id ).show( );
    }
};