  $('document').ready(function(){
                "use strict";
               $('.country_submit').on('click', '#add_country', function(){
        var form=$('#country-update-form');
        var successcallback=function(a){
            toastr.success(a.msg, 'success!',{ closeButton: true });
            $('#ajax-modal').modal('hide');
            if(a.active_id !== undefined){
                var url_id = baseUrl+a.modules+"/setting";
        getAjaxView(url_id,data=null,'module-setting',false,'get');
               $('#module-setting').find('a').removeClass('active');
               $("a[href*='/#"+a.active_id+"/']").trigger( "click" );
              
            }
            else{
              $( ".active" ).trigger( "click" );
            }
        }
        ajaxValidationFormSubmit(form.attr('action'),form.serialize(),'',successcallback);
      
            });

               $('#iconpicker').iconpicker({
                arrowClass: 'btn-base',
                cols: 8,
                arrowPrevIconClass: 'fas fa-angle-left',
                arrowNextIconClass: 'fas fa-angle-right',
                footer: true,
                header: true,
                iconset: 'fontawesome5',
                labelHeader: '{0} of {1} pages',
                labelFooter: '{0} - {1} of {2} icons',
                placement: 'bottom', // Only in button tag
                rows: 5,
                search: true,
                searchText: 'Search',
                selectedClass: 'btn-base',
                unselectedClass: ''
                });

                $("#iconpicker").find('input[type="hidden"]').attr("name",'icon_class');

               $('#iconpicker').on('click', function(e) {
                var value = $('input[name="icon_class"]').val();
                  
                  $('.hvr-buzz-out').removeClass().addClass('hvr-buzz-out '+value);
              });
            });