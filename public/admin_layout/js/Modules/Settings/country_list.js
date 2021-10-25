 $('document').ready(function(){
                "use strict";
     var table = $('#myTable').DataTable({       
        processing: true,
        serverSide: true,
        ajax: baseUrl+"settings/country_list",
        dom: 'Bfrtip',
        order: [ [0, 'desc'] ],
        columns: [
            
            {data:'name'},
            {data:'iso'},
            {data:'country_code'}, 
            {data:'min_digits'},
            {data:'max_digits'},
            {data:'action'},

        ],
         columnDefs: [
                { "orderable": false, "targets": 0 }
                    ]

    });


               
           $('.group-add').on('click', '#add_new_country', function(){
           
              var url= baseUrl+"settings/country_modal";
           getAjaxModal(url);
             });

             $('.table').on('click', '.edit-tr', function(){
        var rowid  = this.id.replace('edit-tr-', '');
        var url= baseUrl+"settings/country_modal/"+rowid;
           getAjaxModal(url);
        
        
    });
            });

          