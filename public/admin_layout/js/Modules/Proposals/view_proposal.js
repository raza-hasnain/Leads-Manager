        $('.more').on('click', '.edit-tr', function(){
            "use strict";
            var proposalID  = this.id.replace('edit-tr-', '');
            var url= baseUrl+'sales/edit_proposal/'+proposalID;
            getAjaxView(url,data=null,'ajaxview',false,'get');
        });