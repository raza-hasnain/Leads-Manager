$(document).ready(function () {
    "use strict";
    var counter = 0;
    $("#addrow").on("click", function () {
        var newRow = $('<tr class="single_item">');
        var cols = "";
        cols += '<td><textarea name="description[]" rows="3"  placeholder="Item name" aria-invalid="false" class="form-control form-control-sm description" autocomplete="off"></textarea><input type="hidden" class="item_id" name="item_id[]"></td>';
        cols += '<td><textarea name="long_description[]" rows="3" placeholder="Description" aria-invalid="false" class="form-control form-control-sm long_description" autocomplete="off"></textarea></td>';
        cols += '<td width="10%"><input type="number" min="1" name="quantity[]" placeholder="Quantity" class="form-control form-control-sm text-center calculate_sub quantity" autocomplete="off"></td>';
        cols += '<td width="10%"><input type="number" min="1" name="rate[]" placeholder="Rate" aria-invalid="false" class="form-control form-control-sm text-center calculate_sub rate" autocomplete="off"></td>';
        cols += '<td><span class="ibtnDel btn-danger btn-sm float-left"><i class="far fa-trash-alt"></i></span> <span class="float-right d-inline show_item_val" ></span><input type="hidden" name="sub_total[]" class="item_value_val"></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);
        counter++;
    });

    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();
        itemcal();       
        counter -= 1
    });
    $("table.order-list").on('keyup', '.calculate_sub ', function(event){
        var item_total = '';
        var tr = $(this).closest("tr");
        var quantity = tr.find('.quantity').val();
        var rate = tr.find('.rate').val();
        item_total = quantity*rate;
        tr.find(".show_item_val").text(parseFloat(item_total).toFixed(2));
        tr.find(".item_value_val").val(parseFloat(item_total).toFixed(2));
        itemcal();
    });


      $('.item_data').select2({
        placeholder: 'Select an item',
         minimumInputLength: 2,
        ajax: {
          url: 'get_item',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.name,
                        id: item.id
                    }
                })
            };
          },
          cache: true
        }
      });
       $(document).on('change','#item_details', function(){
    
        $('#addrow').trigger('click');
        var id = $(this).children("option:selected").val();
        var url= baseUrl+'sales/get_item_details'+'/'+id;
      
        var callback=function(data){
            var data = data;
             var exiting=  $('.item_id').each(function(){
             if($(this).val() == data.id){
                return true;
            }
        });
    
        if(exiting != true){
            var tr = $('#item tr:last');
            tr.find('.item_id').val(data.id);
            tr.find('.description').val(data.name);
            tr.find('.long_description').val(data.description);
            tr.find('.rate').val(data.rate);
           
            itemcal();
        }
        }
        ajaxGetRequest(url,callback);
        
    });
    
  
});
