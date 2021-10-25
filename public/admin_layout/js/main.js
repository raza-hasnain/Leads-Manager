  // previous page should be reloaded when user navigate through browser navigation
    // for mozilla
    window.onunload = function(){};
    // for chrome
    if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {
        location.reload();
    }

$(window).on("load", function(){
    		$(".preloader").fadeOut();
    	});
$(document).ready(function(){
	"use strict";
	//preloader
    $(".preloader").fadeOut();
    	//back to top
        $('body').append('<div id="toTop" class="btn back-top"><span class="ti-arrow-up"></span></div>');
        $(window).on("scroll", function () {
            if ($(this).scrollTop() !== 0) {
                $('#toTop').fadeIn();
            } else {
                $('#toTop').fadeOut();
            }
        });
        $('.input-group').on('keypress', '.datetimepick',function(e){
             return false;
            });

        $('#toTop').on("click", function () {
            $("html, body").animate({scrollTop: 0}, 600);
            return false;
        }); 
        
    		 
    	// Creat tooltip
    	$('[data-toggle="tooltip"]').tooltip();

    
     	/* didebar toggler */
     	$('.main_header').on('click', '.sidebar-toggler',function(){
    
    		$('.sidebar-navbar').toggleClass('sidebar-navbar-active');
    	})
    	$('.main_header').on('click', '.sidebar-toggler',function(){
    		$('.content-wrapper').toggleClass('content-wrapper-ml');
    	})
    	$('.main_header').on('click', '.sidebar-toggler',function(){
    		$('.sidebar-wrapper').toggleClass('sidebar-wrapper-active');
    	})
    
    	// index threee
    	$('.main_header').on('click', '.sidebar-toggler',function(){
    		$('.index3-footer').toggleClass('index3-footer-active');
    	})
    
    
    	$(document).on('click', '.sidebar-toggler-btn',function(){
    		$('.index3-nav-wrapper').toggleClass('index3-sidbar');
    
    	})
    
    	 $(document).on('click', '.sidebar-toggler-btn',function(){
    		$('.single-nav-wrapper').toggleClass('single-nav-wrapper-active');
    	})
    
     $(document).on('click', '.sidebar-toggler-btn',function(){
    		$('.content-wrapper').toggleClass('content-wrapper-active');
    	})
    	
    	$(document).on('click', '.sidebar-toggler-btn',function(){
    		$('.index3-footer').toggleClass('index3-footer-active');
    	})
    
    $(document).on('click', '.sidebar-toggler-btn',function(){
    		$('.logo1').toggleClass('logo1-active');
    	})
    	
    $(document).on('click', '.sidebar-toggler-btn',function(){
    		$('.logo2').toggleClass('logo2-active');
    	});

var validImage = ['image/gif','image/jpeg','image/png'];

$(document).on('change','#file-upload-lo', function(){
       
            var file = this.files[0];
        var fietype = file['type'];
       

    if($.inArray(fietype,validImage) < 0){
            toastr.error(i18n.msg.file_type_error, i18n.layout.error,{ closeButton: true });
        }
        else{
        read_URL(this,0);
        }
      });
      
      $(document).on('change','#file-upload-sm', function(){
       
       
               var file2 = this.files[0];
        var fietype2 = file2['type'];
      

    if($.inArray(fietype2,validImage) < 0){
            toastr.error(i18n.msg.file_type_error, i18n.layout.error,{ closeButton: true });
        }
        else{
        read_URL(this,0);
        }
      });
      
    $(document).on('change','#file-upload-fa', function(){
      
       
               var file1 = this.files[0];
        var fietype1 = file1['type'];
     

    if($.inArray(fietype1,validImage) < 0){
            toastr.error(i18n.msg.file_type_error, i18n.layout.error,{ closeButton: true });
        }
        else{
        read_URL(this,0);
        }
      });
    $(document).on('change','#file-upload-bg', function(){
      
       
               var file1 = this.files[0];
        var fietype1 = file1['type'];
     

    if($.inArray(fietype1,validImage) < 0){
            toastr.error(i18n.msg.file_type_error, i18n.layout.error,{ closeButton: true });
        }
        else{
        read_URL(this,0);
        }
      });
      
   
	
});

     $('#messages').on('click','#notic-id',function(e){
            e.preventDefault();
            
        var userid = $(this).attr("data-id");
        var name = 'no name';
        var url= baseUrl+"/facebookpost/showMessagelead/"+userid+"/"+name;
        getAjaxView(url,data=null,'chatbox',false,'get');
    });


