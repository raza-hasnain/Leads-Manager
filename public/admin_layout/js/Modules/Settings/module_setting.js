$('document').ready(function(){
                "use strict";
               
              
              $('.modules-setting-tab').on('click', function(){
            var url = $(this).attr("data-url");
                var url_id = baseUrl+url+"/setting";
        getAjaxView(url_id,data=null,'module-setting',false,'get');
        $('li.modules-setting-tab').find('a').removeClass('active');
        $( this ).find( 'a' ).addClass('active');
                     
        });
                $("li.modules-setting-tab").first().trigger("click" );
                $("li.modules-setting-tab a").first().addClass('active');

      });