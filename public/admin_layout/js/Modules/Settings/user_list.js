 $('document').ready(function(){
                "use strict";
     var table = $('#myTable').DataTable({       
        processing: true,
        serverSide: true,
        ajax: baseUrl+"settings/user_list",
        dom: 'Bfrtip',
        order: [ [0, 'desc'] ],
        columns: [
            
            {data:'name'},
            {data:'email'},
            {data:'role.name'},
            {data:'status'}, 
             
            {data:'action'},

        ],
         columnDefs: [
                { "orderable": false, "targets": 0 }
                    ]

    });

      /*View Customer Data*/
    $('.table').on('click', '.edit-tr', function(){
        "use strict";
        var id  = this.id.replace('edit-tr-', '');
        var url= baseUrl+"settings/edit_user/"+id;
        getAjaxView(url,data=null,'tab_setting',false,'get');
    });
    
    /*Update status*/
    $('.table').on('click', '.update-tr', function(){
        "use strict";
		var userID  = this.id.replace('update-tr-', '');
        var url= baseUrl+"settings/user/status_update/"+userID;
    	var currentRow=$(this).closest("tr");
    	var name= currentRow.find("td:eq(0)").text();
        /*edit after js lang check*/
    	var content = i18n.msg.are_you_update_it+' '+name+'?';
    	var confirmtext = i18n.msg.update_status; 
        var confirmCallback=function(){
        	var successcallback = function(a){
            	if (a.status == 'success') {
                     toastr.success(i18n.msg.update_successfully,  i18n.layout.success,{ closeButton: true });
                	table.ajax.reload( null, false );
            	}else{
                    /*edit after js lang check*/
                 	toastr.error(i18n.msg.update_error, i18n.layout.warning,{ closeButton: true });
            	}  
        	}
        	ajaxGetRequest(url,successcallback);
        }
        confirmAlert(confirmCallback,content,confirmtext)
    });
    
    /*delete user*/

$('.table').on('click', '.delete-tr', function(){
    "use strict";
		var userID  = this.id.replace('delete-tr-', '');
        var url= baseUrl+"settings/user/delete_update/"+userID;
    	var currentRow=$(this).closest("tr");
    	var name= currentRow.find("td:eq(0)").text();
        /*edit after js lang check*/
    	var content = i18n.msg.are_you_delete_it+' '+name+'?';
    	var confirmtext = i18n.msg.delete_status; 
        var confirmCallback=function(){
        	var successcallback = function(a){
            	if (a.status == 'success') {
                     toastr.success(' ',i18n.layout.success,{ closeButton: true });
                	table.ajax.reload( null, false );
            	}else{
                    /*edit after js lang check*/
                 	toastr.error(i18n.msg.delete_error, i18n.layout.warning,{ closeButton: true });
            	}  
        	}
        	ajaxGetRequest(url,successcallback);
        }
        confirmAlert(confirmCallback,content,confirmtext)
    });
});


