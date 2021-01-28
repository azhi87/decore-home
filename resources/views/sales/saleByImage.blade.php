
@extends('layouts.master')
@section('links')
@endsection
@section('content')
 
 <div class="row">
<section style="background:#efefe9;">
        <div class="container">
            <div class="row">
                <div class="board">

                  <div class="board-inner">
                      <ul class="nav nav-tabs" id="myTab">
                      <div class="liner"></div>
                        <?php $i=0;?>
                        @foreach ($cats as $cat)
                            <li>
                              <a href="#{{$cat->id}}" data-toggle="tab" title="{{$cat->name}}">
                                  <span  class="round-tabs c{{($i%5)+1}}">{{$cat->nameText()}}</span> 
                              </a>
                            </li>
                            <?php $i++;?>
                       @endforeach
                     </ul>
                 </div>

                     

      <div class="tab-content">
              @foreach ($cats as $cat)
                <div class="tab-pane fade in" id="{{$cat->id}}">
                @foreach ($cat->items->where('status','1') as $item)
                @if(Auth::user()->group=='dwkan')
                 <?php  $item->min=0;?>
                @endif
                    <div class="col-md-4 col-sm-4 text-center">
                      <div class="panel panel-warning">
                        <img width="150" height="150" style="margin-top:10px;" src="{{asset('/storage/'.$item->image_url)}}" alt="image">
                          <div class="caption">
                            <h5 class="">{{$item->name}}</h5>
                            <p class="card-text text-gray-dark">  <strong>{{$item->sale_price}}</strong></p>
                <button class="btn btn-sm btn-primary btn3d" 
                onclick='showDiscountDetails("{{$item->formattedDescription()}}","{{$item->name}}","{{$item->items_per_box}}","{{$item->stock()}}")'><span class="fa fa-info-circle fa-2x"></span>
                </button>
                </div>

                

                @if(Auth::user()->group=='zahi')

                <button class="btn btn-danger my-cart-btn btn3d" data-id="{{$item->id}}" data-stock="{{$item->stock()}}" data-name="{{$item->name}}" data-summary="summary 1" data-price={{$item->sale_price}} data-quantity="1" data-image="{{asset('/storage/'.$item->image_url)}}" data-box={{$item->items_per_box}} data-singles="0" data-min={{$item->min}}><bd>ماڵان - {{$item->sale_price}}<bd></button>

                 <button class="btn btn-danger my-cart-btn btn3d" data-id="{{$item->id}}" data-stock="{{$item->stock()}}" data-name="{{$item->name}}" data-summary="summary 1" data-price={{$item->min}} data-quantity="1" data-image="{{asset('/storage/'.$item->image_url)}}" data-box={{$item->items_per_box}} data-singles="0" data-min={{$item->min}}><bd>دوکان - {{$item->min}}</bd></button>
                      
                @else
                <button class="btn btn-danger my-cart-btn btn3d btn-block" data-id="{{$item->id}}" data-stock="{{$item->stock()}}" data-name="{{$item->name}}" data-summary="summary 1" data-price={{$item->sale_price}} data-quantity="1" data-image="{{asset('/storage/'.$item->image_url)}}" data-box={{$item->items_per_box}} data-singles="0" data-min={{$item->min}}><bd>زیادکردن<bd></button>
                @endif


                </div>
                      </div>
                @endforeach
                </div>
                
  @endforeach
                      
        </div>              
<div class="clearfix"></div>
</div>
</div>
</div>
</section></section>
</div>
</div>
</div>


 </div>

  <div class="row text-center" style="margin:0 auto;">

  
<form id='checkout_form' method="POST" action="/sale/createFromImage">
{{csrf_field()}}
<input type="hidden" name='total' id='total'/>
<input type="hidden" name='barcode' id='barcode'/>
<input type="hidden" name='tel' id='tel'/>
<input type="hidden" name='type' id='type'/>
<input type="hidden" name='calculatedPaid' id='calculatedPaid'/>
<input type="hidden" name='mandwb_id' id='mandwb_id'/>
<input type="hidden" name='installments' id='ins'/>
<input type="hidden" name='garak_id' id='garak_id'/>
<input type="hidden" name='new' value="yes"/>
<input type="hidden" name='name' id='name'/>
<input type="hidden" name='ppi' id='ppi'/>
<input type="hidden" name='quantity' id="quantity"/>
<input type="hidden" name='singles' id="singles"/>
<input type="hidden" id="rateInDiscount" name='rate' value="{{$rate->rate}}"/>
</form>
  </div>

@endsection

@section('afterFooter')
 <script type="text/javascript">
    $(document).ready(function () {
  $("#menu-top li a").removeClass("menu-top-active");              
  $('#sale').addClass('menu-top-active');
  $('#logout').hide();
  $('#cartt').show();
  });
function updatePaid()
{
  total=ProductManager.getTotalPrice();
  alert(total);
  //$("#paid").val($("#paid")/($("#installments").val()));
}

$(function () {
    var goToCartIcon = function($addTocartBtn){
      var $cartIcon = $(".my-cart-icon");
      var $image = $('<img width="30px" height="30px" src="' + $addTocartBtn.data("image") + '"/>').css({"position": "fixed", "z-index": "999"});
      $addTocartBtn.prepend($image);
      var position = $cartIcon.position();
      $image.animate({
        top: position.top,
        left: position.left
      }, 500 , "linear", function() {
        $image.remove();
      });
    }

    $('.my-cart-btn').myCart({
      currencySymbol: '$',
      classCartIcon: 'my-cart-icon',
      classCartBadge: 'my-cart-badge',
      classProductQuantity: 'my-product-quantity',
      classProductRemove: 'my-product-remove',
      classCheckoutCart: 'my-cart-checkout',
      affixCartIcon: true,
      showCheckoutModal: true,
      cartItems: [
        
      ],
      clickOnAddToCart: function($addTocart){
        goToCartIcon($addTocart);
      },
      afterAddOnCart: function(products, totalPrice, totalQuantity) {
        console.log("afterAddOnCart", products, totalPrice, totalQuantity);
      },
      clickOnCartIcon: function($cartIcon, products, totalPrice, totalQuantity) {
        console.log("cart icon clicked", $cartIcon, products, totalPrice, totalQuantity);
      },
      checkoutCart: function(products, totalPrice, totalQuantity) {
          
          var barcode= []; 
          var quantity = [];
          var ppi=[];
          var singles=[];
          var items_per_box=[];
          var form = $("#checkout_form");
          
         
        
         var total=0;
        //for all the products put the values in respective arrays
        $.each(products, function(){
          
          barcode.push(this.id);
          quantity.push(this.quantity);
          ppi.push(this.price);
          singles.push(this.singles);
          items_per_box.push(this.box)
          total+=this.price * (this.quantity+(this.singles/this.box));

        });
        //bind the arrays to inputs in the hidden form named checkout form
        $('#customer_id').val($('#customerId').val());
        $('#total').val(total);
        $('#tel').val($('#tels').val());
        $('#calculatedPaid').val($('#paid').val());
        $('#type').val($('#types').val());
        $('#garak_id').val($('#garaks').val());
        $('#mandwb_id').val($('#mandwbs').val());
        $('#ins').val($('#installments').val());
        $('#name').val($('#customerName').val());
        $('#barcode').val(barcode);
        $('#quantity').val(quantity);
        $('#ppi').val(ppi);
        $('#singles').val(singles);

       form.submit();
    
      },

      getDiscountPrice: function(products, totalPrice, totalQuantity) {
        console.log("calculating discount", products, totalPrice, totalQuantity);
        return totalPrice * 0.5;
      }
    });

  });

 </script>


 @endsection
<div class="hidden">
<select id="garaks_page" class="form-control" name="garak_id">
        <option value='0'>گەڕان بەپێی گەڕەک</option>
          @foreach ($garaks as $garak)
            <option value={{$garak->id}}>{{$garak->city->city}}-{{$garak->garak}}</option>
          @endforeach
</select>
</div>
<div class="hidden">
<input type="hidden" id="usrgrp" value="{{Auth::user()->group}}">
<?php $user=new \App\User();$mandwbs=$user->Mandwbs();?>

<select id="mandwbs_page" class="form-control" name="garak_id">
        <option value='0'>-----</option>
          @foreach ($mandwbs as $mandwb)
            <option value={{$mandwb->id}}>{{$mandwb->name}}</option>
          @endforeach
</select>
</div>
     <div class="modal fade" id="discountDetailsModal">
       <div class="modal-dialog" role="document">
         <div class="modal-content">
           <div class="modal-header text-center" style="background-color: #45B39D;color:white;">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               <span class="sr-only">داخستن</span>
             </button>
             <span class="modal-title h3">زانیاری مەواد</span>
           </div>
           <div class="modal-body">
             <table class="table table-text-center">
               <thead>
                 <tr>
                   <td id="discountDetailsItemName"></td>
                   <td><b>ناوی مەواد</b></th>
                 </tr>
                 <tr>
                   <td id="discountDetailsStock"></td>
                   <td><b>ژمارەی مەخزەن</b></td>
                 </tr>
                 <tr>
                   <td id="discountDetailsItemsPerBox"></td>
                   <td><b>ژمارەی ناو کارتۆن</b></td>
                 </tr>
                 <tr>
                   <td id="discountDetails"></td>
                   <td><b>زانیاری خەصم</b></td>
                 </tr>
               </thead>
               
             </table>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           </div>
         </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
     </div><!-- /.modal -->