@extends('layouts.master')
@section('content')
@include('purchases.header')

    <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                   <div class="card" data-background-color="white">
                        <div class="card-title text-center" >
                        <span class='h3 text-danger'>کڕینی مەواد</span>
                        </div>
                    <div class="card-body text-right">
                          <form action='/purchase/create' class='form-inline' id="purchaseFormValidation" novalidate="" method='post' role="form">
                             {{csrf_field()}}
                              <div class="alert bg-inverse">
                                     
                                    <div class="form-group input-group col-md-3 col-sm-3 col-xs-3 ">
                                            
                                    <input type="date" name="created_at" class="form-control text-right border-input">
                                                <span class="input-group-addon">بەروار</span>

                                    </div>
                                    
                                    <div class="form-group input-group col-md-2 col-sm-3 col-xs-3 ">
                                        <input type="text" name="invoice_no" class="form-control text-right border-input">
                                             <span class="input-group-addon">کۆدی کڕین</span>
                                    </div>
                                    
                                    <div class="form-group input-group col-md-3 col-sm-4 col-xs-3">         
                                             <input readonly="readonly" required="true" aria-required="true" type="text"  name="total" id="total" class="form-control text-right border-input">
                                             <span class="input-group-addon">نرخی گشتی</span>                                           
                                    </div>

                                    <div class="form-group input-group col-md-3 col-sm-4 col-xs-3">      
                                        <select required="required" type="text" name="supplier_id" class="form-control text-right border-input">
                                        @foreach ($suppliers as $supplier)
                                            <option value='{{$supplier->id}}'>{{$supplier->name}}</option>
                                        @endforeach
                                        </select>
                                             <span class="input-group-addon">فرۆشیار</span>
                                    </div>
                                    <input type="hidden" id="discount" value="0">
                                     <select id="allItems" class="hidden">
                                      <option value="0"></option>
                                          @foreach ($items as $item)
                                              <option value="{{$item->id}}">{{$item->id}} -- {{$item->name}}</option>
                                          @endforeach
                                      </select>
                               </div>  

                                <div class="alert bg-inverse">
                                    <div class="form-group input-group col-md-2 col-sm-6 col-xs-6 ">    
                                            <input type="text" id="extra"  value="0" onblur="getSaleTotalPrice();" onkeyup="getSaleTotalPrice();" name="extra" class="form-control text-right border-input" required>
                                             <span class="input-group-addon">تێچووی زیادە</span>
                                    </div>

                                    <div class="form-group input-group col-md-4 col-sm-6 col-xs-6">    
                                             <input  type="text" name="description" class="form-control text-right border-input">
                                             <span class="input-group-addon">زانیاری</span>
                                    </div>

                                    <div class="form-group input-group col-md-2 col-sm-6 col-xs-6">                
                                             <input value="0" required="true" aria-required="true" type="text" name="discount" class="form-control text-right border-input">
                                             <span class="input-group-addon">داشکاندن</span>
                                    </div>

                                    <div class="form-group input-group col-md-3 col-sm-6 col-xs-6">                
                                             <input required="true" aria-required="true" type="text" name="paid" class="form-control  text-right border-input" required>
                                             <span class="input-group-addon">پارەی دراو</span>
                                    </div>
                                    
                               </div>  

                                   <hr/>
                                <div  class="row col-md-12" id="repeatedSale">

                                <div class="form-group input-group col-md-1 col-sm-1 col-xs-2"> 
                                         <button class="btn btn-danger  btn3d" type="button">
                                          <i caption="سڕینەوە" class="fa fa-minus-circle fa-1x"></i></button>
                               </div>
                               
                                    <div class="form-group input-group col-md-6 col-sm-6 col-xs-6">
                                         <input type="text" onblur="getSaleTotalPrice();" id="quantity0" value="1" name="quantity0" class="form-control text-right">
                                         <span class="input-group-addon">ژمارە</span>
                                    
                                         <input type="text" onblur="getSaleTotalPrice();" name="sppi0" id="sppi0" class="form-control text-right">
                                         <span class="input-group-addon">ن.فرۆشتن</span>
                                        
                                         <input type="text" onblur="getSaleTotalPrice();" name="ppi0" id="ppi0" class="form-control text-right">
                                         <span class="input-group-addon">ن.کڕین</span>
                                    </div>

                                    <div class="form-group input-group col-md-4 col-sm-4 col-xs-4">     

                                    <select id="barcode0" name="barcode0"
                                    onchange="getItemPurchasePrice(this.value,this.id);" class="form-control slct2" style="min-width: 250px;text-align:center">
                                        <option></option>
                                        @foreach ($items as $item)
                                            <option value="{{$item->id}}">{{$item->id}} -- {{$item->name}}</option>
                                        @endforeach

                                    </select>

                                        {{--  <input type="text" readonly="readonly" id="name0" name="name0"  class="form-control text-right" >
                                         <span class="input-group-addon">ناوی مەواد</span>
                                   
                                         <input type="text" id="barcode0" name="barcode0" onblur="getItemPurchasePrice(this.value,this.id)" class="form-control text-right">
                                         <span class="input-group-addon">کۆد</span> --}}
                                    </div>     

                                </div>
                                <br>
                                   <div class="text- no-print text-center">
                                        <input type="hidden" value="0" id="howManyItems" name="howManyItems"/>
                                       <button class="btn btn-success btn-circle btn3d" type="button" onclick="addItem()">
                                       <i caption="زیادکردن"class="fa fa-plus-circle fa-2x"></i></button>
                                    </div>
                                   <hr/>
                                   
                                <div class="text-center no-print">
                                   <input type="submit" name="submit" value="تۆمارکردن" class="btn-danger text-center btn-lg btn3d"/>
                                </div> 
                                
                            </form>
                    </div>
                </div>                                  
            </div>
        </div>

@endsection
@section('afterFooter')
 <script type="text/javascript">
        $().ready(function(){
          $.validator.messages.required = '';
          $('#purchaseFormValidation').validate();
        });

         $(document).ready(function () {
         $('.slct2').select2();
  });
    </script>
 @endsection