var i=0;
        function removeItem(id)
        {
              $('div').remove('#'+id);
              getSaleTotalPrice();
           
        }

        function removeDistributionItem(id)
        {
            $('div').remove('#'+id);
            getTotalQuantity();
        }
       
        function addItem()
        {

            i=document.getElementById('howManyItems').value;
                                       ++i;
        var item="<div style='margin-top:20px;margin-right:0px;' id='"+i+"'>";
            item+="<div class='form-group input-group col-md-1 col-sm-1 col-xs-2'>";
            item+="<button class='btn btn-danger btn3d btn-circle' type='button' onclick='removeItem("+i+")'>";
            item+="<i caption='سڕینەوە' class='fa fa-minus-circle fa-1x'></i></button></div> ";

            item+="<div class='form-group input-group col-md-6 col-sm-6 col-xs-12'>";
            item+="<input type='text' onblur='getSaleTotalPrice();' onkeyup='getSaleTotalPrice();'  value='1' id='quantity"+i+"' name='quantity"+i+"' class='form-control text-right'>";
            item+="<span class='input-group-addon'>ژمارە</span> ";

            item+="<input type='text' onblur='getSaleTotalPrice();' onkeyup='getSaleTotalPrice();' value='1' id='sppi"+i+"' name='sppi"+i+"' class='form-control text-right'>";
            item+="<span class='input-group-addon'>ن/فرۆشتن</span>";

            item+="<input type='text' onblur='getSaleTotalPrice();' onkeyup='getSaleTotalPrice();' value='1' id='ppi"+i+"' name='ppi"+i+"' class='form-control text-right'>";
            item+="<span class='input-group-addon'>ن/کڕین</span></div> ";

             item+="<div class='form-group input-group col-md-4 col-sm-4 col-xs-4'>";

            item+="<select id='barcode"+i+"' name='barcode"+i+"' onchange='getItemPurchasePrice(this.value,this.id)' onblur='getItemPurchasePrice(this.value,this.id)' class='form-control slc"+i+"'>";
            item+=document.getElementById('allItems').innerHTML;
            item+="</div>";

              $('#repeatedSale').append(item);
             document.getElementById('howManyItems').value=i;
            $('.slc'+i).select2({
              theme: "classic"
              });
       
             
               
        }
        function addUpdateItem()
        {
             i=document.getElementById('howManyItems').value;
                   var item="<div class='row' style='margin-top:20px;padding-bottom:10px;' id='"+i+"'>";
            item+="<div class='form-group col-md-1 col-sm-1'>";
            item+="<button class='btn btn-danger btn-circle btn3d' type='button' onclick='removeItem("+i+")'>";
            item+="<i class='fa fa-minus-circle fa-1x'></i></button></div>";
            item+="<div class='form-group col-md-2 col-sm-2'>";
            item+="<input type='text' onkeyup='getSaleTotalPrice();' onblur='getSaleTotalPrice();' id='quantity"+i+"' name='quantity"+i+"' class='form-control text-right'required>";
            item+="</div> ";
            item+="<div class='form-group col-md-3 col-sm-3'>";
            item+="<input type='text' onkeyup='getSaleTotalPrice();' onblur='getSaleTotalPrice();' name='ppi"+i+"' id='ppi"+i+"' class='form-control text-right' required>";
            item+="</div>";
            item+="<div class='form-group col-md-6 col-sm-6'>";
            item+="<select id='barcode"+i+"' name='barcode"+i+"' onchange='getSaleItemPrice(this.value,this.id)' onblur='getSaleItemPrice(this.value,this.id)' class='form-control slc"+i+"'>";
            item+=document.getElementById('allItems').innerHTML;
            item+="</div>";
            
            $('#repeatedSale').append(item);
            document.getElementById('howManyItems').value=i;
            $('.slc'+i).select2({
            theme: "classic"
            });
         
        }
        function addSaleItem()
        {

         
         i=i+1;
var item="<div class='row' style='margin-top:20px;padding-bottom:10px;' id='"+i+"'>";
item+="<div class='form-group col-md-1 col-sm-1'>";
item+="<button class='btn btn-danger btn-circle btn3d' type='button' onclick='removeItem("+i+")'>";
item+="<i class='fa fa-minus-circle fa-1x'></i></button></div>";
item+="<div class='form-group col-md-2 col-sm-2'>";
item+="<input type='text' onkeyup='getSaleTotalPrice();' onblur='getSaleTotalPrice();' id='quantity"+i+"' name='quantity"+i+"' class='form-control text-right'required>";
item+="</div> ";
item+="<div class='form-group col-md-3 col-sm-3'>";
item+="<input type='text' onkeyup='getSaleTotalPrice();' onblur='getSaleTotalPrice();' name='ppi"+i+"' id='ppi"+i+"' class='form-control text-right' required>";
item+="</div>";
item+="<div class='form-group col-md-6 col-sm-6'>";
item+="<select id='barcode"+i+"' name='barcode"+i+"' onchange='getSaleItemPrice(this.value,this.id)' onblur='getSaleItemPrice(this.value,this.id)' class='form-control slc"+i+"'>";
item+=document.getElementById('allItems').innerHTML;
item+="</div>";

              $('#repeatedSale').append(item);
             document.getElementById('howManyItems').value=i;
            $('.slc'+i).select2({
              theme: "classic"
});

        }
    function getItemPrice(barcode,id)
    {
        var index=id.match(/\d+$/),number;
        index=index[0];        
            $.ajax({
                       type: "GET",
                       dataType: "json",
                       url: "/purchases/ItemPrice",
                       data: "barcode=" + barcode,
                       success: function(data){
                         $("#ppi"+index).val(data.price);
                       
                         $("#name"+index).val(data.name);

                         getSaleTotalPrice();
                       },
                       error:function(){
                        $("#ppi"+index).attr('value',0);
                        $("#name"+index).attr('value','کۆدەکە هەڵەیە');
                       }
                     });
                     
    }
    function getItemPurchasePrice(barcode,id)
    {
        var index=id.match(/\d+$/),number;
        index=index[0];

       
            $.ajax({
                       type: "GET",
                       dataType: "json",
                       url: "/purchases/ItemPurchasePrice",
                       data: "barcode=" + barcode,
                       success: function(data){
                         $("#name"+index).attr('value',data.name);
                        $("#ppi"+index).attr('value',data.price);
                         $("#sppi"+index).val(data.sprice);
                       
                       
                       getSaleTotalPrice();
                       },
                       error:function(){
                        $("#ppi"+index).attr('value',0);
                        $("#name"+index).attr('value','کۆدەکە هەڵەیە');
                       }
                     });
                     
    }
    function getItemName(barcode,id)
    {
        var index=id.match(/\d+$/),number;
        index=index[0];

       
            $.ajax({
                       type: "GET",
                       dataType: "json",
                       url: "/purchases/ItemPrice",
                       data: "barcode=" + barcode,
                       success: function(data){
                         $("#name"+index).attr('value',data.name);
                        },
                       error:function(){
                        $("#name"+index).attr('value','کۆدەکە هەڵەیە');
                       }
                     });
                     
    }


  function  distributeExtraPrice()
  {
     i=parseInt($('#howManyItems').val());
     extra=parseFloat($('#extra').val());
     if(isNaN(extra))
     {
      swal({
              text:'تکایە نرخی تێچووی زیادە داخڵ بکە',
              type:'warning',
              title:'هەڵە',
               confirmButtonClass: 'btn btn-danger btn-fill',
               buttonsStyling: false
            });
     }
     else
     {
     total=0;
     for(j=0; j<=i; j++)
     {
        total+=parseInt($("#quantity"+j).val());
     }
    extraPrice=parseFloat(extra/total);
   swal({
                    title: ' دڵنیایت ؟',
                    text: "بڕی ("+extraPrice.toFixed(2)+" $) بۆ هەر مەوادێک زیاد دەکرێت",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success btn-fill',
                    cancelButtonClass: 'btn btn-danger btn-fill',
                    confirmButtonText: 'بەڵێ, زیادیکە!',
                    cancelButtonText: 'نەخێر',
                    buttonsStyling: false
                }).then(function() {
                  swal({
                    title: 'سەرکەوتووبوو!',
                    text: 'گۆڕانکاری کرا بەسەر نرخی مەوادەکاندا بەسەرکەووتوویی',
                    type: 'success',
                    confirmButtonClass: "btn btn-success btn-fill",
                    buttonsStyling: false
                    });
                   
                  for(j=0;j<=i;j++)
                      {
                        $("#ppi"+j).val(parseFloat($("#ppi"+j).val())+extraPrice);
                      }
                });
    }
   
  }
  function getSaleTotalPrice()
 {
     var total=0;
     var ppi=0;
     var quantity=0;
     var installments=1;
     i=parseInt($('#howManyItems').val());
     installments=parseInt($('#installments').val());
     for(j=0; j<=i; j++)
     {
        if(($("#ppi"+j).val()) && ($("#quantity"+j).val()))
        {
         ppi=$("#ppi"+j).val();
         quantity=$("#quantity"+j).val();
         total=total+(+ppi * (+quantity));
        }
     }
     total-=$('#discount').val();
    //  if($('#extra').val())
    //  {
    //     var extra=$("#extra").val();
    //     $("#total").attr('value',total-extra);
    //  }
    //  else
    //  {
        $("#total").attr('value',total.toFixed(2));
        var paid=$("#calculatedPaid").val();
        $("#remained").val((total-paid).toFixed(2));
        $("#totalDinars").val(number_format(total*$('#rate').val()),2,0,'.');
     //}
    calculateTotalPaid(0);
 }
// function getSaleTotalPrice()
//  {
//      var total=0;
//      var ppi=0;
//      var quantity=0;
//      var installments=1;
//      i=parseInt($('#howManyItems').val());
//      installments=parseInt($('#installments').val());
//      for(j=0; j<=i; j++)
//      {
//         if(($("#ppi"+j).val()) && ($("#quantity"+j).val()))
//         {
//          ppi=$("#ppi"+j).val();
//          quantity=$("#quantity"+j).val();
//          total=total+(+ppi * (+quantity));
//         }
//      }
//      $("#total").attr('value',total);
//      $("#paid").val((total/installments).toFixed(2));
//  }


function getTotalQuantity()
 {
     var total=0;
     var quantity=0;
     i=parseInt($('#howManyItems').val());
     
     for(j=0; j<=i; j++)
     {
        if($("#quantity"+j).val())
        {
         quantity=parseFloat($("#quantity"+j).val());
         total=total+quantity;
        }
     }

     $("#totalQuantity").attr('value',total);
 }
 function getSaleItemPrice(barcode,id)
    {
         var index=id.match(/\d+$/),number;
        index=index[0];
       
            $.ajax({
                       type: "GET",
                       dataType: "json",
                       url: "/purchases/ItemPrice",
                       data: "barcode=" + barcode,
                       success: function(data){
                         
                        $("#ppi"+index).attr('value',data.price);
 
                        $("#name"+index).val(data.name);
                        $("#quantity"+index).val(1);
                         if(data.stock<=0)
                         {
                          alert('ئەم مەوادە لە مەخزەن نەماوە');

                         }
                       getSaleTotalPrice();
                       },
                       error:function(){
                        $("#ppi"+index).attr('value',0);
                        $("#name"+index).attr('value','کۆدەکە هەڵەیە');
                       }
                     });
                     
    }
function getItemDiscountInDinars(id)
{
    rate=1250;
    discount=parseInt($('#discount'+id).val());
    items_per_box=parseInt($('#items_per_box'+id).text());
    ppi=parseInt($('#ppi'+id).val());
    quantity=parseInt($('#quantity'+id).val());
   
    singlePrice=(ppi/items_per_box);
    beforeDiscount=((ppi/items_per_box)*rate);
    afterDiscount=((ppi*quantity)/((quantity*items_per_box)+discount))*rate;
    afterDiscount=Math.round(afterDiscount);
    beforeDiscount=Math.round(beforeDiscount);
    $('#beforeDiscount'+id).text(beforeDiscount);
    $('#afterDiscount'+id).text(afterDiscount);
}

function getCustomerDetails()
    {
        var id= $("#customer_id").val();
            $.ajax({
                       type: "GET",
                       dataType: "json",
                       url: "/customers/customerNameById",
                       data: "id=" + id,
                       success: function(data){
                        debt=parseFloat(data.debt);
                        $("#customerName").val(data.customerName);
                        $("#tel2").val(data.tel2);
                        $("#tel").val(data.tel);
                        $("#city").val(data.city);
                        $("#garak").val(data.garak);
                        $("#kolan").val(data.kolan);
                        $("#mal").val(data.mal);
                        getSaleTotalPrice();
                       
                       }
                     });
                     
    }

 function calculateTotalPaid(rate)
{
    if(rate==0)
    {
      rate=parseFloat($('#rate').val());
    }
    var dinars=parseFloat($('#dinars').val())*1000;
    var dollars=parseFloat($('#dollars').val());
    if(isNaN(dinars))
    {
      dinars=0;
    }
    if(isNaN(dollars))
    {
      dollars=0;
    }
    var totalPaid=((dinars/rate)+dollars).toFixed(2);
    $('#calculatedPaid').val(totalPaid);
}
function printExternal(url) {
   
    var printWindow = window.open( url, 'Print', 'left=200, top=200, width=950, height=500, toolbar=0, resizable=0');
    printWindow.addEventListener('load', function(){
        printWindow.print();
        printWindow.close();
    }, true);
}

function UpdateSaleItem()
        {
             i=document.getElementById('howManyItems').value;
       
                   var item="<div class='row' style='margin-top:20px;padding-bottom:10px;' id='"+i+"'>";
            item+="<div class='form-group col-md-1 col-sm-1'>";
            item+="<button class='btn btn-danger btn-circle btn3d' type='button' onclick='removeItem("+i+")'>";
            item+="<i class='fa fa-minus-circle fa-1x'></i></button></div>";
            item+="<div class='form-group col-md-2 col-sm-2'>";
            item+="<input type='text' onkeyup='getSaleTotalPrice();' onblur='getSaleTotalPrice();' id='quantity"+i+"' name='quantity"+i+"' class='form-control text-right'required>";
            item+="</div> ";
            item+="<div class='form-group col-md-3 col-sm-3'>";
            item+="<input type='text' onkeyup='getSaleTotalPrice();' onblur='getSaleTotalPrice();' name='ppi"+i+"' id='ppi"+i+"' class='form-control text-right' required>";
            item+="</div>";
            item+="<div class='form-group col-md-6 col-sm-6'>";
            item+="<select id='barcode"+i+"' name='barcode"+i+"' onchange='getSaleItemPrice(this.value,this.id)' onblur='getSaleItemPrice(this.value,this.id)' class='form-control slc"+i+"'>";
            item+=document.getElementById('allItems').innerHTML;
            item+="</div>";
            
            $('#repeatedSale').append(item);
            document.getElementById('howManyItems').value=i;
            $('.slc'+i).select2({
            theme: "classic"
            });               
        }

function confirmDelete(id)
{
  $("#delete").attr('href', "/purchase/delete/"+id);
  $('#myModal').modal('show');
}
function confirmFilterDelete(id)
{
  $("#delete").attr('href', "/filters/dl/"+id);
  $('#myModal').modal('show');
}
function confirmInstallmentDelete(id)
{
  $("#delete").attr('href', "/installments/dl/"+id);
  $('#myModal').modal('show');
}
function confirmDeleteSale(id)
{
  $("#delete").attr('href', "/sale/delete/"+id);
  $('#myModal').modal('show');
}

function showDiscountDetails(desc,name,ipx,stock)
{
  $("#discountDetails").text(desc);
  $("#discountDetailsItemName").text(name);
  $('#discountDetailsItemsPerBox').text(ipx)
  $('#discountDetailsStock').text(stock);
  $('#discountDetailsModal').modal('show');
}
 function calculateDollars()
  {
    dinars=$('#dinars').val()*1000;
    rate=$('#rate').val();
    dollars=$('#dollars').val();
    $('#calculatedPaid').val(+dollars+(dinars/rate));
  }

  function number_format (number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}