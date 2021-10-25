$('document').ready(function(){
    "use strict";
    var url= baseUrl+"customer/statistics";
    	getAjaxView(url,data=null,'statistics',false,'get');
});


    /*DataTable Calling*/
    var table = $('#myTable').DataTable({
       
        processing: true,
        serverSide: true,
        ajax: baseUrl+"customer/index",
        dom: 'Bfrtip',
        order: [ [0, 'desc'] ],
        columns: [
            {data: 'input',
                searchable: false,
                orderable: false,},
            {data: 'name'},
            {data:'email'},
            {data:'country.name',"defaultContent": ""}, 
            {data:'phone'}, 
            {data:'status'}, 
            {data:'action'},

        ],
         columnDefs: [
                { "orderable": false, "targets": 0 }
                    ]

    });

    /*Add Customer data*/
	$('.card_buttons').on('click', '.add_customer', function(){
	    "use strict";
        var url= baseUrl+"customer/add_customer";
		getAjaxModal(url);
	});

    /*View Customer Data*/
    $('.table').on('click', '.view-tr', function(){
        "use strict";
        var customerID  = this.id.replace('view-tr-', '');
  		var url= baseUrl+"customer/view/"+customerID;
        	
        getAjaxView(url,data=null,'ajaxview',false,'get');
	});

    /*Edit customer data */
    $('.table').on('click', '.edit-tr', function(){
        "use strict";
        var userID  = this.id.replace('edit-tr-', '');
        var url= baseUrl+"customer/edit/"+userID;
        getAjaxModal(url,1);
    });


    /*Update status*/
    $('.table').on('click', '.update-tr', function(){
        "use strict";
		var customerID  = this.id.replace('update-tr-', '');
		
        var url= baseUrl+"customer/status_update/"+customerID;
			
    	var currentRow=$(this).closest("tr");
    	var name= currentRow.find("td:eq(1)").text();
        /*edit after js lang check*/
    	var content = i18n.msg.change_status+' '+name +' !';
    	var confirmtext = i18n.msg.update_status; 
        var confirmCallback=function(){
        	var successcallback = function(a){
            	if (a.status == 'success') {
                     toastr.success(i18n.customers.customer+" "+i18n.msg.update_successfully,  i18n.layout.success,{ closeButton: true });
                	table.ajax.reload( null, false );
                	var url= baseUrl+"customer/statistics";
    				getAjaxView(url,data=null,'statistics',false,'get');
            	}else{
                    /*edit after js lang check*/
                 	toastr.error(i18n.msg.update_error, i18n.layout.warning,{ closeButton: true });
            	}  
        	}
        	ajaxGetRequest(url,successcallback);
        }
        confirmAlert(confirmCallback,content,confirmtext)
    });

    $('.table').on('click', '.delete-tr', function(){
        "use strict";
        var userID  = this.id.replace('delete-tr-', '');
        var currentRow=$(this).closest("tr");
    	var name= currentRow.find("td:eq(1)").text();
        /*edit after js lang check*/
    	var content = i18n.msg.are_you_delete_it+name+'?';
    	var confirmtext = i18n.msg.delete_success;
        var confirmCallback=function(){
        var requestCallback=function(response){
            if(response.status == 'success') {
                /*edit after js lang check*/
                toastr.success(' ',i18n.layout.success,{ closeButton: true });
                table.ajax.reload( null, false );
                var url= baseUrl+"customer/statistics";
    			getAjaxView(url,data=null,'statistics',false,'get');  
                }else{
                    /*edit after js lang check*/
                toastr.error(i18n.msg.delete_failed, i18n.layout.error,{ closeButton: true });
                }
            }

            var url= baseUrl+"customer/delete/"+userID;
		
            ajaxGetRequest(url,requestCallback);

        }
        confirmAlert(confirmCallback,content,confirmtext)
    });

	$('.import_data').on('click', '.import_file', function(){
	    "use strict";
		var formate  = this.id.replace('file-id-', '');
        var url= baseUrl+"customer/import_file/"+formate;
		
		getAjaxModal(url);
	});