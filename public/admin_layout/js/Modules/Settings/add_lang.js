  $('document').ready(function(){
                "use strict";
               
           $('.group-add').on('click', '#add_new_language', function(){
       
              var url= baseUrl+"settings/add_lang";
           getAjaxModal(url);
             });
             
             $('.group-lang').on('change','#lang',function(){
                 var url= baseUrl+"settings/add_lang/active/"+$(this).val();
              
                 var successcallback=function(a){
              toastr.success(a.msg, 'success!',{ closeButton: true });
                     $( "#add_language" ).trigger( "click" );
                 }
                 getAjaxdata(url,successcallback );
                 
             });
            });