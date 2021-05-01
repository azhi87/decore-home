@extends('layouts.master')
@section('content')
<style type="text/css">.input-group-addon{font-weight:bold; padding:4px;}</style>
@include('sales.header')

                    <div class="col-lg-12 col-md-12 ">
                        <div class="card" >
                            <div class="card-header text-center text-danger"><span class='h3'><b>زیادکردنی فرۆشتن</b></span> </div>
                            @include('layouts.errorMessages')

                            <hr/>
                            
                            <div class="card-content">
                        <form action='/sale/create'  method='post' id="saleFormValidation" role="form">
                            
                            <div class="row text-right color-black well">
                            <div class="row text-right color-black  ">
                                <div class="form-group col-md-6 col-sm-12 col-md-offset-3 ">     
                                        <select class="form-control slct2 js-example-rtl" id="customer_id" name="customer_id" onchange="getCustomerDetails();">
                                            <option value="0">هەڵبژزاردنی ناوی کڕیار</option>
                                            @foreach ($customers as $customer)
                                                    <option value="{{$customer->id}}">{{$customer->name}} - {{$customer->tel}}</option>
                                            @endforeach
                                        </select>  
                                   
                                    </div>
                                    <span class="col-md-2">ناوی کڕیار</span>  
                                </div>
                                  


                                <div class="col-md-4">
                                            <div class="form-group">
                                                <label>شار</label>
                                                <input type="text"  name="city" value="سلێمانی" id="city" class="form-control border-input" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>ژمارەی مۆبایل ٢</label>
                                                <input type="text" name="tel2" id="tel2" class="form-control border-input">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>ژمارەی مۆبایل</label>
                                                <input type="text"  name="tel"  id="tel"  class="form-control border-input" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>ناوی کڕیار</label>
                                                <input type="text" name="name" id="customerName" class="form-control border-input" required>
                                            </div>
                                        </div>
                               
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label> ماڵ</label>
                                                <input type="text" name="mal" id="mal" class="form-control border-input" required>
                                            </div>
                                    </div>
                               
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label> کۆڵان</label>
                                                <input type="text" name="kolan" id="kolan" class="form-control border-input">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label> گەڕەك</label>
                                                <input type="text"  name="garak"  id="garak" class="form-control border-input" required>
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label> تێبینی</label>
                                                <textarea type="text"  name="description" class="form-control border-input"> </textarea>
                                            </div>
                                        </div>
                                        
                                       
                               
                               <div class="col-md-1"></div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label>نقد &nbsp;&nbsp;&nbsp;</label>
                                                <input type="checkbox" class="form-control"  name="naqd" id="naqd" >
                                            </div>
                                        </div>

                                        <div class="col-md-1 hidden">
                                            <div class="form-group">
                                                <label>گواستنەوە</label>
                                                <input type="checkbox" class="form-control"  name="status" value='1'>
                                            </div>
                                        </div>
                                        <div class="col-md-1 hidden">
                                            <div class="form-group">
                                                <label>پشگیری</label>
                                                <input type="checkbox" class="form-control"  name="support" value='1' id="support">
                                            </div>
                                        </div>
                            </div>
                            
                                    <div class="row text-right color-black well">

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>ناوی کارمەند</label>
                                                <select  name="mandwb_id" class="form-control">
                                                    <option value="0">-----</option>
                                                    @foreach ($mandwbs as $mandwb)
                                                        <option value="{{$mandwb->id}}">{{$mandwb->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    <div class="col-md-2">
                                            <div class="form-group">
                                            <label>  پارەی ماوە </label>
                                                <input type="text" id="remained" disabled="disabled" 
                                                onchange="getSaleTotalPrice();" onkeyup="getSaleTotalPrice();" class="form-control border-input" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <div class="form-group">
                                            <label> پارەی دراو</label>
                                                <input type="text" value="0" readonly="readonly" name="paid" id="calculatedPaid"
                                                onchange="getSaleTotalPrice();" onkeyup="getSaleTotalPrice();"
                                                class="form-control border-input" required>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                            <label>کۆی پسوڵە دۆلار</label>
                                                <input type="text" id="total" readonly="readonly" name="total" class="form-control border-input" required> 
                                        </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                            <label>کۆی پسوڵە دینار </label>
                                                <input type="text" id="totalDinars" readonly="readonly" name="totalDinars" class="form-control border-input" required>
                                            
                                            </div>
                                        </div>                                            
                                                 
                                    <div class="col-md-4 hidden">
                                            <div class="form-inline">
                                                <input type="text"  name="id" class="form-control border-input" required>
                                                 <span>ژمارەی وەسڵ</span>
                                            </div>
                                            
                                    </div>  
                                    </div>
                                    
                                   <div class="row text-right color-black well">
                                        
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label> داشکاندن - دۆلار  </label>
            <input type="text" value="0" name="discount" id="discount" onchange="getSaleTotalPrice();" onkeyup="getSaleTotalPrice();" class="form-control border-input" required>
                                            </div>
                                        </div>


                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label> پارەی دراو دۆلار</label>
            <input type="text" value="0" name="dollars" id="dollars" onchange="getSaleTotalPrice();" onkeyup="getSaleTotalPrice();" class="form-control border-input" required>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>پارەی دراو دینار</label>
                                                <div class="input-group">
            <input type="text" value="0" name="dinars" id="dinars" onchange="getSaleTotalPrice();" onkeyup="getSaleTotalPrice();" class="form-control border-input" required>
                                            </div>
                                        </div>
                                        </div>


                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>ماوەی قیست</label>
                                                   <input min="0" max="12" value="10" type="text" class="form-control" name="installments" id="installments" required>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>بەرواری یەکەم قیست</label>
                                                <input type="date" name="first_installment" id="first_installment" class="form-control border-input" required>
                                            </div>
                                        </div>
                                        
                                                                                
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label> پارەی پێشەکی  </label>
                                                <input type="text" name="initial_amount"  onchange="getSaleTotalPrice();"
                                                onkeyup="getSaleTotalPrice();" class="form-control border-input" required>
                                            </div>
                                        </div>
                                        
                                      </div>
                                      
                                        {{-- Form header third row                                     --}}

                            
                                 <select id="allItems" class="hidden">
                                      <option value="0"></option>
                                          @foreach ($items as $item)
                                              <option value="{{$item->id}}">{{$item->id}} -- {{$item->name}}</option>
                                          @endforeach
                                      </select>
                                      <input type="hidden" name="rate" id="rate" value="{{$rate->rate}}">



  {{-- end of header table                                --}}
                        <hr/>

    <div class="col-md-12 well" id="repeatedSale">
       <div class="row "> 
            <div class="form-group col-md-1 col-sm-1"> 
             <button class="btn btn-danger btn-circle btn3d" type="button" >
              <i caption="زانیاری" class="fa fa-minus-circle fa-1x"></i></button>
            </div>


        <div class="form-group col-md-2 col-sm-2">
         <span class="input-group-addon">ژمارە</span>
         <input type="text" onkeyup="getSaleTotalPrice();" onblur="getSaleTotalPrice();" id="quantity0"  name="quantity0" class="form-control text-right border-input" required>
        </div>

        <div class="form-group col-md-3 col-sm-3">    
         <span class="input-group-addon">نرخ</span>
         <input type="text" onkeyup="getSaleTotalPrice();" onblur="getSaleTotalPrice();" name="ppi0" id="ppi0" class="form-control text-right border-input" required>
        </div>
                                          
        <div class="form-group col-md-6 col-sm-6">     
            <span class="input-group-addon">کۆدی کاڵا</span>

            <select id="barcode0" name="barcode0" onchange="getSaleItemPrice(this.value,this.id);" class="form-control slct2" >
                                        <option></option>
                                        @foreach ($items as $item)
                                            <option value="{{$item->id}}">{{$item->id}} -- {{$item->name}}</option>
                                        @endforeach

            </select>
        </div>

        </div>
{{-- end repeated sale --}}
</div>

   <div class="no-print text-center">
        <input type="hidden" value="0" id="howManyItems" name="howManyItems"/>
       <button class="btn btn-success btn-circle btn3d " type="button" onclick="addSaleItem()">
       <i caption="زیادکردن" class="fa fa-plus-circle fa-2x"></i></button>
    </div>
                            <br>
                                <div class="text-center no-print">
                                   <input type="submit" name="submit" value="تۆمارکردن" class="btn-danger text-center btn-lg btn3d"/>
                                  
                                </div> 

                         
                                </form>
                                </div>
                            </div>
                        </div>
                    

                                    
                       
       <div id="gridSystemModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridModalLabel">تێچووی هەر مەوادێک</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row text-center">
                            <div><span id="dinarsBeforeDiscount"></span>:تێچووی هەر مەوادێک پێش داشکاندن</div>
                        </div>
                        <div class="row text-center">
                            <div><span id="dinarsAfterDiscount"></span>:تێچووی هەر مەوادێک دوای داشکاندن</div>
                        </div>
                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
      


@endsection

@section('afterFooter')
 <script type="text/javascript">
  $("#naqd").change(function() {
    if(this.checked) {
       $('#installments').prop('readonly',true);
       $('#first_installment').prop('readonly',true);
       $('#first_installment').prop('required',false);
       $('#installments').val('0');
       $('#support').prop('checked',true);
       $('#support').prop('readonly',true);
    }
    else
    {
        $('#installments').prop('readonly',false);
       $('#first_installment').prop('readonly',false);
        $('#first_installment').prop('required',true);
         $('#support').prop('checked',false);
       $('#support').prop('readonly',false);

    }
});

  $("#menu-top li a").removeClass("menu-top-active");              
  $('#sale').addClass('menu-top-active');
  
 
        $().ready(function(){
          $.validator.messages.required = '';
          $('#saleFormValidation').validate();
        });

        $(document).ready(function () {
         $('.slct2').select2();
         $(".js-example-rtl").select2({
         dir: "rtl"
});
  });


    </script>
 @endsection