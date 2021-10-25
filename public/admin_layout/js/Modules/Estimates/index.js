	$(document).ready(function(){
	    "use strict";
  		var url= baseUrl+"sales/estimates/statistics";
    	getAjaxView(url,data=null,'statistics',false,'get'); 
	});
    var table = $('#myTable').DataTable({                
        processing: true,
        serverSide: true,
        ajax: baseUrl+"sales/estimates",
        dom: 'Bfrtip',
        order: [ [0, 'desc'] ],
        columns: [
            {data: 'input',
                searchable: false,
                orderable: false,},
            {data:'title'},
            {data:'total'},
            {data:'send_to'}, 
            {data:'open_date'}, 
            {data:'expiry_date'}, 
            {data:'status.name'},
            {data:'action'},
        ],
         columnDefs: [
                { "orderable": false, "targets": 0 }
                    ]
    });
    $('.card_buttons').on('click', '.add_estimate', function(){
        "use strict";
  		var url= baseUrl+"sales/new_estimate";
        getAjaxView(url,data=null,'ajaxview',false,'get');
    });
    function editEstimateStatus(id,statusid){
       
        var data={"_token": XCSRFTOKEN,status_id:statusid};
        var estimateID = id;
  		var url= baseUrl+"sales/editstatus/"+estimateID;
        var successcallback = function(a){
            if (a.status == 'success') {
                toastr.success(i18n.msg.update_successfully,  i18n.layout.success,{ closeButton: true });
                table.ajax.reload( null, false );
                var url= baseUrl+"sales/estimates/statistics";
    			getAjaxView(url,data=null,'statistics',false,'get');
            }else{
                toastr.error(i18n.msg.update_error, i18n.layout.warning,{ closeButton: true });
            }
            
        }
        ajaxFormSubmit(url,data,id='',successcallback);    
    }
    $('.table').on('click', '.view-tr', function(){
        var estimateID  = this.id.replace('view-tr-', '');
  		var url= baseUrl+"sales/view_estimate/"+estimateID;
        getAjaxView(url,data=null,'ajaxview',false,'get');
    });
    $('.table').on('click', '.edit-tr', function(){
        var estimateID  = this.id.replace('edit-tr-', '');
        var url= baseUrl+"sales/edit/"+estimateID;
        getAjaxView(url,data=null,'ajaxview',false,'get');
    });

    $('.table').on('click', '.delete-tr', function(){
        "use strict";
        var leadID  = this.id.replace('delete-tr-', '');
        var currentRow=$(this).closest("tr");
        
        var name= currentRow.find("td:eq(1)").text();
        var content = i18n.layout.delete+" "+i18n.menu.Estimate+" "+name+'?';
        var confirmtext = i18n.msg.are_you_delete_it+'?';
        var confirmCallback=function(){
        var requestCallback=function(response){
            if(response.status == 'success') {
                 toastr.success(' ',i18n.layout.success,{ closeButton: true });
                table.ajax.reload( null, false );
                var url= baseUrl+"sales/estimates/statistics";
                getAjaxView(url,data=null,'statistics',false,'get');  
                }else{
                toastr.error(i18n.msg.delete_failed, i18n.layout.error,{ closeButton: true });
                }
            }
            var url= baseUrl+"sales/delete/"+leadID;
            ajaxGetRequest(url,requestCallback);
        }
        confirmAlert(confirmCallback,content,confirmtext)
    });