https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"

jQuery(document).ready(function ($) {

    $("#btn_blockChain").click(function () {
        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
        return false;
    });
    
    window.send_to_editor = function (html){
        var fileurl;
        fileurl = $('img', html).attr('src');

        $("img.img_blockChain").attr('src', fileurl);
        $("input#hiddenInput").val(fileurl);
        tb_remove();
    };
    $("div#taxonomy-blockChain img").click(function(){
        var term_slug = $(this).data('term-slug');
        $(this).closest('div').find('img').removeClass('selected');
        $(this).addClass('selected');
        $("#hmic_software_select_input").val(term_slug);
    });
    

});


// requires jquery library
jQuery(document).ready(function() {
    jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');   
   });
