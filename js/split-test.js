(function($){
    var $urls = $("#urls");
    var $header = $("#header");
    var $footer = $("#footer");
    var $counter = $("#counter");

    var index = $("#url-count").val();
    var show = false;

    $("#add-url").on("click", function(){
        var aux = $("#url-to-add").val();
        debugger;
        if(aux.length == 0){
            $("#url-to-add").focus();
            return;
        }
        $("#url-to-add").val('');
        var indexcharp = parseInt(index)+1;
        var tpl = '<div class="col-md-12 m-t-10 url">' +
            '<div class="col-md-10">' +
                '<label for="split_rotator_url-'+indexcharp+'" class="col-sm-3 control-label">Url a Incrustar #'+indexcharp+'</label>' +
                '<div class="col-sm-8">' +
                    '<input type="url" required="required" name="split_rotator_url[]" class="form-control" value="'+aux+'" />' +
                '</div>' +
                '<div class="col-sm-1 form-inline">' +
                    '<button type="button" class="btn remove-url">x</button>' +
                '</div>' +
            '</div>' +
            '<div class="col-md-2">' +
                '<div class="col-md-4 col-md-offset-2">0</div>' +
                '<div class="col-md-4 col-md-offset-2">0</div>' +
            '</div>' +
        '</div>';
        $urls.append(tpl);
        index++;

        toogleUrls();
    });

    function toogleUrls(){
        if(index > 0){
            $header.removeClass('hide');
            $footer.removeClass('hide');
            $counter.removeClass('hide');
        }else{
            $header.addClass('hide');
            $footer.addClass('hide');
            $counter.addClass('hide');
        }
    }

    if(index>0 && !show){
        show = true;
        toogleUrls();
    }

    $("#urls").on("click", ".remove-url", function(){
        $(this).closest('div.url').remove();
        index--;
        toogleUrls();
    });

})(jQuery);