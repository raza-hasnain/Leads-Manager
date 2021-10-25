        $('.more').on('click', '.edit-tr', function(){
            "use strict";
            var estimateID  = this.id.replace('edit-tr-', '');
            var url= baseUrl+'sales/edit/'+estimateID;
            getAjaxView(url,data=null,'ajaxview',false,'get');
        });