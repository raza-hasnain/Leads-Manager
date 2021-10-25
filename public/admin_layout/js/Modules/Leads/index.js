    $('document').ready(function(){
       "use strict";
        var url= baseUrl+"leads/statist";
        getAjaxView(url,data=null,'statistics',false,'get');
    });
    var table = $('#myTable').DataTable({       
        processing: true,
        serverSide: true,
        ajax: baseUrl+"leads/index",
        dom: 'Bfrtip',
        order: [ [0, 'desc'] ],
        columns: [
            {data: 'input',
                searchable: false,
                orderable: false,},
            {data:'name'},
            {data:'email'},
            {data:'phone'}, 
            {data:'company'}, 
            {data:'assigned.name'}, 
            {data:'source.name'}, 
            {data:'status.name'}, 
            {data:'action'},

        ],
         columnDefs: [
                { "orderable": false, "targets": 0 }
                    ]

    });
    

    $('.table').on('click', '.view-tr', function(){
        "use strict";
        var leadID  = this.id.replace('view-tr-', '');
        var url= baseUrl+"leads/view/"+leadID;
        getAjaxView(url,data=null,'ajaxview',false,'get');
    });
    
    $('.table').on('click', '.edit-tr', function(){
        "use strict";
        var leadID  = this.id.replace('edit-tr-', '');
        var url= baseUrl+"leads/edit/"+leadID;
        getAjaxModal(url,1);
    });
    

    $('.card_buttons').on('click', '.add_lead', function(){
        "use strict";
        var url= baseUrl+"leads/new_lead";
        getAjaxModal(url);
    });
    


    function editleadStatus(id,statusid){
        
        var data={"_token": XCSRFTOKEN,lead_status_id:statusid};
        var leadID = id;
        var url= baseUrl+"leads/editstatus/"+leadID;
        var successcallback = function(a){
            if (a.status == 'success') {
                // js lang Change
               toastr.success(i18n.menu.Leads+" "+i18n.msg.update_successfully, i18n.layout.success,{ closeButton: true });
                table.ajax.reload( null, false );
                var url= baseUrl+"leads/statist";
                getAjaxView(url,data=null,'statistics',false,'get');
            }else{
                // js lang Change
                toastr.error(i18n.msg.update_error, i18n.layout.warning,{ closeButton: true });
            }
            
        }
        ajaxFormSubmit(url,data,id='',successcallback);    
    }

    $('.lead_import_data').on('click', '.lead_import_file', function(){
        "use strict";
        var formate  = this.id.replace('file-id-', '');
        var url= baseUrl+"leads/import_file/"+formate;
        getAjaxModal(url);
    });

    $('.table').on('click', '.delete-tr', function(){
        "use strict";
        var leadID  = this.id.replace('delete-tr-', '');
        var currentRow=$(this).closest("tr");
        var name= currentRow.find("td:eq(1)").text();
        /*Lang Change*/
        var content = i18n.layout.delete+" "+i18n.menu.Leads+" "+name+'?';
        var confirmtext = i18n.msg.are_you_delete_it+'?';
        var confirmCallback=function(){
        var requestCallback=function(response){
            if(response.status == 'success') {
                /*Lang change*/
                 toastr.success(' ',i18n.layout.success,{ closeButton: true });
                table.ajax.reload( null, false );
                var url= baseUrl+"leads/statistics";
                getAjaxView(url,data=null,'statistics',false,'get');  
                }else{
                /*Lang Change*/
              toastr.error(i18n.msg.delete_failed, i18n.layout.error,{ closeButton: true });
                }
            }
            var url= baseUrl+"leads/delete/"+leadID;
            ajaxGetRequest(url,requestCallback);
        }
        confirmAlert(confirmCallback,content,confirmtext)
    });