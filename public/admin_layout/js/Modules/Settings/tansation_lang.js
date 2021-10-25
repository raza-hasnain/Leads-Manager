        $(document).ready(function () {
    "use strict"; // Start of use strict

    var table = $('#dataTableExample1').DataTable({
        sDom: 'lrtip',
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       
    });
     

     $('.group-dropdown').on('change','#language',function(){
     	var language = $('#language').val();

     	var group = $('#group').val();
       
        if(group == ""){
        	
        var translation_language =  baseUrl+"settings/translation/"+language;
         getAjaxView(translation_language,data=null,'tab_setting',false,'get');  
        }
        else{
        
        	 var translation_language =  baseUrl+"settings/translation/"+language;
           var data = {"_token": XCSRFTOKEN,'group':$('#group').val() };
   getAjaxView(translation_language,data,'tab_setting',false,'post');
        }     
     

      });
        $('#search-inp').on('keyup',function(){
      table.search($(this).val()).draw() ;
       

      });

 $('.group-add').on('click', '#add_new_language', function(){
           
              var url= baseUrl+"settings/translation_add";
           getAjaxModal(url);
             });


 //edit 

  /*View Customer Data*/
    $('.table').on('click', '.view-tr', function(){
        var rowid  = this.id.replace('value-', '');
        $('#show-'+rowid).addClass('d-none');
        $('#datashow-'+rowid).removeClass('d-none');
  		
  		
	});

	  $('.table').on('click', '.minus-tr', function(){
        var rowid  = this.id.replace('minus-', '');
        $('#show-'+rowid).removeClass('d-none');
        $('#datashow-'+rowid).addClass('d-none');
  		
  		
	});
	    $('.table').on('click', '.add-tr', function(){
        var rowid  = this.id.replace('add-', '');
        
        var language = $(this).attr('data-id');
        var key = $('#key-'+rowid).text();
        var group = $('#group-'+rowid).text();
        var value = $('#data-'+rowid).val();
        var link = baseUrl+"/settings/translation_update/"+language;
        var successCallback= function(a){
        	toastr.success(a.msg, 'success!',{ closeButton: true });
        	$('#datashow-'+rowid).text(value);
        	$('#data-'+rowid).val(value);
        	$('#show-'+rowid).removeClass('d-none');
       		 $('#datashow-'+rowid).addClass('d-none');

        }

        var data = {"_token": XCSRFTOKEN,'group':group,'key':key,'value':value };
          
        ajaxFormSubmit(link,data,null,successCallback);
  		
  		
	});


});