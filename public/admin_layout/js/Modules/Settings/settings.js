 $('document').ready(function(){
      "use strict";
       var next ="";
       var previous ="";
       var add_user = baseUrl+"settings/add_user";
       var user_list = baseUrl+"settings/showuser_list";
       var role_permission = baseUrl+"settings/role_config";
       var role_list = baseUrl+"settings/roleList";
       var assign_user_role = baseUrl+"settings/role_assign";
       var add_language = baseUrl+"settings/lang_list";
       var translation_language =  baseUrl+"settings/translation/en";
       var country_setting = baseUrl+"settings/country_list_show"; 
       var pusher_settings= baseUrl+"settings/pusher_settings";
       var email_config = baseUrl+"settings/email_config";
       var app_setting = baseUrl+"settings/app_setting";
       var time_zone_setting = baseUrl+"settings/time_zone";
        var module_setting = baseUrl+"settings/modulesetting";
        $( "#add_user" ).trigger( "click" );
    


      getAjaxView(add_user,data=null,'tab_setting',false,'get');


     
       $('.nav-tabs').on('click','#add_user',function(){
       
      getAjaxView(add_user,data=null,'tab_setting',false,'get');
      });
         $('.nav-tabs').on('click','#user_list',function(){
           
            
      getAjaxView(user_list,data=null,'tab_setting',false,'get');
      });

         $('.nav-tabs').on('click','#role_permission',function(){
            
      getAjaxView(role_permission,data=null,'tab_setting',false,'get');
      });

      $('.nav-tabs').on('click','#role_list',function(){
            
      getAjaxView(role_list,data=null,'tab_setting',false,'get');
      });
      
       $('.nav-tabs').on('click','#module_setting',function(){
            
      getAjaxView(module_setting,data=null,'tab_setting',false,'get');
      });
     $('.nav-tabs').on('click','#assign_user_role',function(){
            
      getAjaxView(assign_user_role,data=null,'tab_setting',false,'get');
      });
           $('.nav-tabs').on('click','#app_setting',function(){
            
      getAjaxView(app_setting,data=null,'tab_setting',false,'get');
      });


      $('.nav-tabs').on('click','#add_language',function(){
            
      getAjaxView(add_language,data=null,'tab_setting',false,'get');
      });
      $('.nav-tabs').on('click','#translation_language',function(){
            
      getAjaxView(translation_language,data=null,'tab_setting',false,'get');
      });
       
       $('.nav-tabs').on('click','#country_setting',function(){
            
      getAjaxView(country_setting,data=null,'tab_setting',false,'get');
      });

      $('.nav-tabs').on('click','#pusher_settings',function(){
      getAjaxView(pusher_settings,data=null,'tab_setting',false,'get');
      });

        
           $('.nav-tabs').on('click','#email_config',function(){
            
      getAjaxView(email_config,data=null,'tab_setting',false,'get');
      });

      $('.nav-tabs').on('click','#app_setting',function(){
            
      getAjaxView(app_setting,data=null,'tab_setting',false,'get');
      });
    $('.nav-tabs').on('click','#time_zone_setting',function(){
            
      getAjaxView(time_zone_setting,data=null,'tab_setting',false,'get');
      });
      
     });

      $(document).on('click','.btnnext',function(){
        var rowid  = this.id.replace('next-', '');

        $( "#"+rowid ).trigger( "click" );
        
      });
      $(document).on('click','.btnprv',function(){
        var rowid  = this.id.replace('prv-', '');

        $( "#"+rowid ).trigger( "click" );
        
      });
       $(document).on('click','#add_role',function(){
        var url = baseUrl+"settings/role_add";
         getAjaxModal(url);
        
      });

