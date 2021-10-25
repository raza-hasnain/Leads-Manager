  $('document').ready(function(){
      "use strict";
      var url= baseUrl+"sales/categoriestable";
      getAjaxView(url,data=null,'categories',false,'get');
  });
    $('.itemcategory').on('click', '.addcategory', function(){
        "use strict";
      var url=baseUrl+"sales/createcategory";
      getAjaxModal(url);
    });