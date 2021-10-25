function readURL(input) {
    
     if (input.files && input.files[0]) {
     var reader = new FileReader(); 
     reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
      $('#uploaded').attr('src', e.target.result);
      $('#img_source').val(e.target.result);
     }
    reader.readAsDataURL(input.files[0]);
  }
}

 $(document).on('change','#file-upload',function(){
    "use strict";
    $('#blah').remove();
    $('.image_uploaded').empty();
    $('.image_uploaded').append($('<div class="link_item"><img id="uploaded" class="rounded" src="" alt=""><span class="ricon">x</span><input type="hidden" name="img_source"id="img_source" ></div>'));
    $('.fb_media').append($('<img data-lity id="blah" class="img-fluid" src="" alt="">'));
  readURL(this);
});

$('.image_uploaded').on('click', '.ricon', function(){
    "use strict";
    $('#blah').remove();
    $('.link_item').remove();
});

$(document).on('keyup','#post_text',function(){
    "use strict";
		var data = $("#post_text").val();
 		$("#preview_text").text(data); 
 	});

$(document).on('keyup','#post_link',function(){
    "use strict";
        var link = $("#post_link").val();
        var res = link.split("/")[0]+'//'+link.split("/")[2];
        $("#plink").text(res); 
    });
  
  $(document).on('keyup','#titleofpage',function(){  

    "use strict";
        var title = $("#titleofpage").val();
        var len= title.length;
        if (len>25) {
            $("#link_title").text(title.substring(0,25)+'...'); 
        }else{
          $("#link_title").text(title);    
        }
        
    });
  $(document).on('keyup','#link_desc',function(){   

     "use strict";
        var desc = $("#link_desc").val();
        var len= desc.length;
        if (len>30) {
           $("#url_desc").text(desc.substring(0,30)+'...');  
        }else{
          $("#url_desc").text(desc);  
        }
        
    });
$(document).on('change','#ebutton_select',function(){

    "use strict";
        var selectedVal = $("#button_select option:selected").val();
        var selectedtextVal = $("#button_select option:selected").text();
        if (selectedVal!=0) {
            $('#button_link').remove();
            $('#link_button').append($('<button type="submit" class="btn btn-base" id="button_link">'+selectedtextVal+'</button>'));       }
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
            toastr.success('Post Success', 'success!',{ closeButton: true });
            window.location.replace(baseUrl+"/facebookpost/fb_timeline/"); 
           
            }
            else{
                toastr.error(a.msg, 'error!',{ closeButton: true });
                location.reload();
            } 
        }
        ajaxValidationFormSubmit(form.attr('action'),form.serialize(),'',successcallback);
    });