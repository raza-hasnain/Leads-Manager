
 Array.prototype.sample = function()
      {
        return this[Math.floor(Math.random()*this.length)];
        }
    var data =  document. getElementById("baseurl").textContent;
    var baseUrl = data.trim();
    var XCSRFTOKEN = $('meta[name=csrf-token]').attr('content');
    var pusherapikey = document. getElementById("puserkey").textContent;
    var pusherapitype = document. getElementById("ap2").textContent;
    var _color = ['#10595F','#678588','#89A0A2','#EDEDED','#ABBBBD','#2A2E59','#546174','#465b56','#b8eded','#52b2f2','#068246'];
    var _option = ['rgba(87, 120, 123 , 0.9)','rgba(87, 120, 123 , 0.5)','rgba(87, 120, 123 , 0.4)','rgba(87, 120, 123 , 0.6)','rgba(87, 120, 123 , 0.3)','rgba(0,0,0,0.07)','rgba(0,0,0,0.05)'];
    Pusher.logToConsole = true;

    var pusher = new Pusher(pusherapikey, {
      cluster: pusherapitype  ,
      forceTLS: true,
    
        });

    /*set datetime picker*/
    $('.datetimepick').datetimepicker({ footer: true, modal: false,format: 'yyyy    -mm-dd HH:MM',uiLibrary: 'bootstrap' });
    $('.enddate').datetimepicker({ footer: true, modal: false,format: 'yyyy-mm-dd HH:MM',uiLibrary: 'bootstrap' });
     $('.input-group').on('click','.is-invalid',function(){
    

      $('#email').val(' ');
     });
    

        function discountMethodChanged(value,text=null)
        {
            
            $('.discount_method_btn').text(text);
            $('#discount_method_id').val(value);
        }


        function justment(arg)
        {
            
              var id = arg.getAttribute('id');
             calcPerc = $('#'+id).val();
            $('#adjustment').text(parseFloat($('#'+id).val()).toFixed(2));

             $('#adjustment-input').val(parseFloat($('#'+id).val()).toFixed(2));
             
            var total = $('#sub_total').val();
            var discount = $('#discount-total').val();
            
              $('#total').text(parseFloat((total-discount)-calcPerc).toFixed(2));
              $('#total-input').val(parseFloat((total-discount)-calcPerc).toFixed(2));
              
        }
    function calculatesub(arg){
            
        var item_total = '';
        var quantity = $("#quantity").val();
        ($("#rate").val()=== null) ? $("#rate").val()=== 0 : $("#rate").val();
        var rate = $("#rate").val();
        item_total = quantity*rate;
        $(".show_item_val").text(item_total);
        $("#item_value_val").val(item_total);

        var sub = $("#sub_total").val() + item_total;
       
  
    }

      function itemcal()
      {
          
        var total = 0;
        $('.item_value_val').each(function(){ 
            total  += parseFloat($(this).val());
            $('#sub_total').val(total.toFixed(2));
            $('#total').text(total);
            $('#total-input').val(total);
            $(".su_total").text(total);
        });
         changeDiscount(1,'discount_rate');
     }


    function changeDiscount(arg,id_data=null)
    {
       if(id_data === null){
        var id = arg.getAttribute('id');
       }
       else{
           var id = id_data;
       }
        var total = $('#sub_total').val();
      
        if($('#discount_method_id').val() === '0')
        {
            var calcPerc =  (total * $('#'+id).val()) / 100;
            $('#discount-total-text').text(parseFloat(calcPerc).toFixed(2));
             $('#discount-total').val(parseFloat(calcPerc).toFixed(2));
             
             $('#total').text(parseFloat(total-calcPerc).toFixed(2));
          
              $('#total-input').val(parseFloat(total-calcPerc).toFixed(2));
            $('#adjustment-data').val("");
             $('#adjustment-input').val("");
              $('#adjustment').text("0.00");

            

        }
        else{
            calcPerc = $('#'+id).val();
            $('#discount-total-text').text(parseFloat($('#'+id).val()).toFixed(2));
             $('#discount-total').val(parseFloat(calcPerc).toFixed(2));
            
              $('#total').text(parseFloat(total-calcPerc).toFixed(2));
              $('#total-input').val(parseFloat(total-calcPerc).toFixed(2));
              $('#adjustment-data').val("");
              $('#adjustment-input').val("");
               $('#adjustment').text("0.00");
        }
    }
    //Phone Number Code Change
       
    function changeNumberCode(country_code)
    {
       
        var callback=function(data)
        {
           
            $('#phone_code').val(data.country_code);
        }
        if(country_code){
            let url = baseUrl+"/country-code/"+country_code;
           
            ajaxGetRequest(url,callback);
        }else{
            $('#phone_code').val('---');
        }
    }


     /*random color*/   
    function random_rgba() 
    {
       
        var o = Math.round, r = Math.random, s = 255;
        return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')';
    }

   function read_URL(input,i) 
   {
       
        if (input.files && input.files[0]) 
        {
            id = input.id;
            var reader = new FileReader();
            reader.onload = function (e) 
            {
               $('#'+id+'-img').attr('src', e.target.result);
                $('#'+id+'-value').val(e.target.result);
            }  
            reader.readAsDataURL(input.files[0]);
          
        }
    }
    
    function copyToClipboard(element) 
    {
 
      var $temp = $("<input>");
      $("body").append($temp);
      $temp.val(element).select();
      document.execCommand("copy");
      $temp.remove();
    }


    
