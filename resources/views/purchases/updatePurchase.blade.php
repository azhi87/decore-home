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
                          <form action='/purchase/update/{{$purchase->id}}' class='form-inline' id="purchaseFormValidation" novalidate="" method='post' role="form">
                             {{csrf_field()}}
                              <div class="alert bg-inverse">
                                     

                                    <div class="form-group input-group col-md-3 col-sm-3 col-xs-3 ">
                                        <input type="text" value="{{$purchase->id}}" name="invoice_no" class="form-control text-right border-input">
                                             <span class="input-group-addon">کۆدی کڕین</span>
                                    </div>
                                    <div class="form-group input-group col-md-3 col-sm-4 col-xs-3">         
                                             <input required="true" aria-required="true" type="text" id="total" name="total" value="{{$purchase->total}}" class="form-control text-right border-input">
                                             <span class="input-group-addon">نرخی گشتی</span>                                           
                                    </div>

                                    <div class="form-group input-group col-md-4 col-sm-4 col-xs-3">      
                                        <select required="required" type="text" name="supplier_id" class="form-control text-right border-input">
                                        @foreach ($suppliers as $supplier)
                                            @if($supplier->id==$purchase->supplier->id)
                                            <option selected="selected" value='{{$supplier->id}}'>{{$supplier->name}}
                                            @else
                                            <option  value='{{$supplier->id}}'>{{$supplier->name}}
                                            @endif
                                        </option>
                                        @endforeach
                                        </select>
                                             <span class="input-group-addon">فرۆشیار</span>
                                    </div>



                               </div>  

                                <div class="alert bg-inverse">
                                    <div class="form-group input-group col-md-4 col-sm-6 col-xs-6 ">
                                        
                                        <input type="text" id="extra" onblue="getSaleTotalPrice();" onkeyup="getSaleTotalPrice();" value="{{$purchase->extra}}"  name="extra" class="form-control text-right border-input">
                                             <span class="input-group-addon">تێچووی زیادە</span>
                                    </div>
                                    <div class="form-group input-group col-md-3 col-sm-6 col-xs-6">    
                                                
                                             <input required="true" aria-required="true" type="text" name="discount" class="form-control  text-right border-input" value="{{$purchase->discount}}">
                                             <span class="input-group-addon">داشکاندن</span>
                                    </div>
                                    <div class="form-group input-group col-md-3 col-sm-6 col-xs-6">    
                                                
                                             <input required="true" aria-required="true" type="text" name="paid" class="form-control  text-right border-input" value="{{$purchase->paid}}">
                                             <span class="input-group-addon">پارەی دراو</span>
                                    </div>
                               </div>  

                                   <hr/>
                                <div  class="row col-md-12" id="repeatedSale">
                                    <?php $i=0;?>
                                    @foreach($purchase->items as $item)
                                    <div id='{{$i}}'>
                                <div class="form-group input-group col-md-1 col-sm-1 col-xs-2"> 
                                         <button class="btn btn-danger  btn3d" type="button" onclick="removeItem({{$i}})">
                                          <i caption="سڕینەوە" class="fa fa-minus-circle fa-1x"></i></button>
                               </div>
                                    <div class="form-group input-group col-md-2 col-sm-2 col-xs-2">
                                         <input type="text" onblur="getSaleTotalPrice();" id="quantity{{$i}}" value="{{$item->pivot->quantity}}" name="quantity{{$i}}" class="form-control text-right">
                                         <span class="input-group-addon">ژمارە</span>
                                    </div>
                                    <div class="form-group input-group col-md-2 col-sm-2 col-xs-2">    
                                         <input type="text" onblur="getSaleTotalPrice();" name="ppi{{$i}}" id="ppi{{$i}}" class="form-control text-right" value="{{$item->pivot->ppi}}">
                                         <span class="input-group-addon">نرخ</span>
                                    </div>
                                    <div class="form-group input-group col-md-4 col-sm-4 col-xs-4">     
                                         <input type="text" readonly="readonly" id="name{{$i}}" name="name{{$i}}"  class="form-control text-right" value="{{$item->name}}">
                                         <span class="input-group-addon">ناوی مەواد</span>
                                    </div>
                                    <div class="form-group input-group col-md-2 col-sm-2 col-xs-2">     
                                         <input type="text" id="barcode{{$i}}" name="barcode{{$i}}" onblur="getItemPurchasePrice(this.value,this.id)" class="form-control text-right" value="{{$item->id}}">
                                         <span class="input-group-addon">کۆد</span>
                                    </div>     
                                </div>
                                <?php $i++;?>
                                <br/>
                                    @endforeach
                                </div>
                                
                                       
                                       
                                   

                                <div class="text-center no-print" style="margin-top:150px;">
                                    <button class="btn btn-success btn-circle btn3d" type="button" onclick="addUpdateItem()">
                                       <i caption="زیادکردن"class="fa fa-plus-circle fa-2x"></i></button>
                                     <input type="hidden" value="{{$i}}" id="howManyItems" name="howManyItems"/>
                                                                         <input type="hidden" id="discount" value="0">

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
    </script>


 @endsection