function readURL(input,i) {
    
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah-'+i+'').attr('src', e.target.result);
                $('#uploaded-'+i+'').attr('src', e.target.result);
                $('#img_source-'+i+'').val(e.target.result);
            }  
            reader.readAsDataURL(input.files[0]);
          
        }
    }
    
    
    var imgsrc = 0;
    $(document).on('change','#file-upload',function(){
   
        "use strict";
        var itemcount = get_id();
        $('.image_uploaded').append($('<div class="item" id="itemnum-'+itemcount+'"><img id="uploaded-'+imgsrc+'" class="rounded-circle" src="" alt=""><span class="ricon v_image-'+imgsrc+'" id="remove-'+itemcount+'">x</span><input type="hidden" name="img_source[]" id="img_source-'+imgsrc+'"></div>'));
        
        if (itemcount<6) {
            $('.fb_media').append($('<img data-lity id="blah-'+imgsrc+'" class="img-fluid" src="" alt="">'));
            $('.fb_media').removeClass('media-'+(itemcount-1)+'');
            $('.fb_media').addClass('media-'+itemcount+''); 
        }else{
            var c= itemcount-4;
            $('.fb_media').append($('<img data-lity id="blah-'+imgsrc+'" class="img-fluid d-none" src="" alt="">'));
            $('.count').remove();
            $('.media-5').append($('<span  class="count">+'+c+'</span>')); 
        }
        readURL(this,imgsrc);
        imgsrc++;
        
    });

    function get_id(){
        
        var i = $('.item').length+1;
        return i;
    }
    
    var fields = $('.item');
    var count = 1;
    $.each(fields, function() {
    $(this).attr('id','itemnum-' + count);
    count++;
    });

$('.image_uploaded').on('click', '.ricon', function(){
    "use strict";
        var imageID  = this.id.replace('remove-', '');
        var v_imageID = this.className.replace('ricon v_image-','');
        $('#itemnum-'+imageID).remove(); 
        $('#blah-'+v_imageID).remove();
        var fields = $('.item');
        var fiel = $('.ricon');
        var count = 1;
        var coun = 1;
        $.each(fiel, function() {
            $(this).attr('id','remove-' + coun);
            coun++;
        });
        $.each(fields, function() {
            $(this).attr('id','itemnum-' + count);
            count++;
        });
        var itemcount = get_id()-1;
        if (itemcount>=5) {
            $(".img-fluid:nth-child(5)").removeClass('d-none');
            $('.count').text('+'+(itemcount-4));
        }else{
            $('.fb_media').removeClass('media-'+(itemcount+1)+'');
            $('.fb_media').addClass('media-'+itemcount+'');
            $('.count').remove();
        }
    });

$(document).on('keyup','#post_text',function(){

    "use strict";
        var data = $("#post_text").val();
        $("#preview_text").text(data); 
    });
    
$('.shedule_check').on('change', '#check_input', function(){
        "use strict";
        if($(this).prop("checked") == true){
            $('.shedule_time').removeClass('d-none');
            $('.shedule_time').addClass('d-block');
        }else{
            $('.shedule_time').removeClass('d-block');
            $('.shedule_time').addClass('d-none');
        }       
    });
    
$('.post_area').on('click', '#post', function(){
    "use strict";
        var form=$('#post-add-form');
        var successcallback=function(a){
            /*edit after js lang check*/
            if(a.status == 'success'){
          
           window.location.replace(baseUrl+"/facebookpost/fb_timeline/"); 
           
            }
            else{
                toastr.error(a.msg, 'error!',{ closeButton: true });
               
            } 
        }
        ajaxValidationFormSubmit(form.attr('action'),form.serialize(),'',successcallback);
    });