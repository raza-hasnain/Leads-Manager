$('.view_estimate').on('click', '.view-tr', function(){
    "use strict";
    var estimateID  = this.id.replace('view-tr-', '');
    var url= baseUrl+"sales/view_estimate"+"/"+estimateID;
    getAjaxView(url,data=null,'ajaxview',false,'get');
});
$('.view_estimate').on('click', '.copy-link', function(){
    "use strict";
    var estimateID  = this.id.replace('copy-tr-', '');

    copyToClipboard($('#link-tr-'+estimateID).attr('href'));
});

