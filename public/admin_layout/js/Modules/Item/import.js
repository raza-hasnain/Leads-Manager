

     $(document).on('change', '#file-upload',function(e){
        "use strict";
        var name = $(this).val().split('\\').pop();
        $('#filename').text(name);
        
    });
    $('.import_submit').on('click', '#import_file', function(){
        "use strict";
        var thisBtn = $('#import_file');
        var thisForm = thisBtn.closest("form");
        var formData = new FormData(thisForm[0]);
        var successcallback=function(a){
             toastr.success(i18n.menu.Items+" "+i18n.msg.imported_successfully, i18n.layout.success,{ closeButton: true });
            $('#ajax-modal').modal('hide');
            location.reload(); };
        var url = baseUrl+'sales/import_file';
    $.ajax({
        type: "POST",
        url: url,
        data: formData,
        processData: false,
        contentType: false,
        success:function(data){

            if(data.status=='success')
            {
                successcallback(); 
            }
        },
        error:function(json){
            var error='';
             var errors = json.responseJSON;                
            $.each(json.responseJSON.errors, function (key, value) {
                error+=value+'<br>';
               
            });
             toastr.error(error, 'Import failed' + '!');
        }
    });
    });