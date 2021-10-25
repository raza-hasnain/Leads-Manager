$('.view_proposal').on('click', '.view-tr', function(){
    "use strict";
    var proposalID  = this.id.replace('view-tr-', '');
    var url= baseUrl+"sales/view_proposal"+"/"+proposalID;
    getAjaxView(url,data=null,'ajaxview',false,'get');
});

$('.view_proposal').on('click', '.copy-link', function(){
    "use strict";
    var estimateID  = this.id.replace('copy-tr-', '');

    copyToClipboard($('#link-tr-'+estimateID).attr('href'));
});