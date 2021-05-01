@extends('layouts.master')
@section('content')

    <style type="text/css">.input-group-addon{font-weight:bold; padding:4px;}</style>
@include('sales.header')

  <br/>
                    <!-- Form Elements -->
                    <div class="col-lg-12 col-md-12 ">
                        <div class="card">
                            <div class="card-header text-center text-danger"><span class='h3'><b>گۆڕانکاری فرۆشتن</b></span> </div>
                            <hr/>
                            
                            <div class="card-content">
                        <form action='/sale/update/{{$sale->id}}'  method='post' id="saleFormValidation" role="form">
                             {{csrf_field()}}
                        <input type="hidden" name="rate" value="{{$sale->rate}}" id="rate">
                        <input type="hidden" name="customer_id" value="{{$sale->customer_id}}">

                                    <div class="row text-right color-black">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>ناونیشان</label>
                                                <input readonly type="text" value="{{$sale->customer->city}}--{{$sale->customer->garak}}--{{$sale->customer->kolan}}--{{$sale->customer->mal}}" readonly="readonly" class="form-control border-input" >
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>ژمارەی مۆبایل ٢</label>
                                                <input type="text" value="{{$sale->customer->tel2}}" readonly id="tel2" name="tel2" class="form-control border-input">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>ژمارەی مۆبایل</label>
                  <input type="text" name="tel" value="{{$sale->customer->tel}}" readonly  id="tel" onblur="getCustomerName();" class="form-control border-input" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>ناوی کڕیار</label>
                                                <input type="text" readonly name="name" id="customerName" value="{{$sale->customer->name}}" class="form-control border-input" required>
                                            </div>
                                        </div>
                                    </div>
                            {{-- Form header second row                                     --}}

                                   <div class="row text-right color-black">

                                        <div class="col-md-1 col-md-offset-1">
                                            <div class="form-group ">
                                                <label>گواستنەوە</label>
                                                @if($sale->status=='1')
                                                <input type="checkbox" class="form-control  checkbox-primary" checked="" name="status" value='1'>
                                                @else
                                                <input type="checkbox" class="form-control  checkbox-primary"  name="status" value='1'>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <div class="form-group ">
                                                <label>پشتگیری</label>
                                                @if($sale->support=='1')
                                                <input type="checkbox" class="form-control  checkbox-primary" checked="" name="support" value='1'>
                                                @else
                                                <input type="checkbox" class="form-control  checkbox-primary"  name="support" value='1'>
                                                @endif
                                            </div>
                                        </div>

                                       
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>جۆری قیست</label>
                                                <select name="installments" onchange="getSaleTotalPrice();" id="installments" class="form-control border-input">
                                                    @for($i=0;$i<=12;$i++)
                                                    @if($i==$sale->installments)
                                                    <option selected="selected" value={{$i}}>{{$i}}</option>
                                                    @else
                                                    <option value="{{$i}}">{{$i}}</option>
                                                    @endif
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <!--<div class="col-md-2 ">-->
                                        <!--    <div class="form-group">-->
                                        <!--        <label> بەروار</label>-->
                                        <!--        <input type="date"  value="{{$sale->created_at->format('Y-m-d')}}" name="created_at" class="form-control border-input " >-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        

                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label> تێبینی</label>
                                                <textarea type="text" name="description"  class="form-control border-input" >{{$sale->description}} </textarea>
                                            </div>
                                        </div>
                                        
                                         
                                              <div class="col-md-3 hidden">
                                            <div class="form-group">
                                                 <label> ژمارەی وەسڵ</label>
                                                <input type="text"  name="id" value="{{$sale->id}}" class="form-control border-input" required >
                                               
                                            </div>
                                            </div>
                                        
                                    </div>
                                    
                                    
                                     <div class="row text-right color-black well">

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>ناوی کارمەند</label>
                                                <select  name="mandwb_id" class="form-control" readonly>
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
                                                onchange="getSaleTotalPrice();" onkeyup="getSaleTotalPrice();"
                                                value="{{$sale->total-$sale->calculatedPaid}}" class="form-control border-input" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <div class="form-group">
                                            <label> پارەی دراو</label>
                                                <input type="text" name="paid" id="calculatedPaid" value="{{$sale->calculatedPaid}}" readonly="readonly" 
                                                onchange="getSaleTotalPrice();" onkeyup="getSaleTotalPrice();"
                                                class="form-control border-input" required>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                            <label>کۆی پسوڵە دۆلار</label>
                                                <input type="text" value="{{$sale->total}}" readonly="readonly" id="total" 
                                                readonly="readonly" name="total" class="form-control border-input" required> 
                                        </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                            <label>کۆی پسوڵە دینار </label>
                                                <input type="text" id="totalDinars" readonly="readonly" name="totalDinars" 
                                                value="{{$sale->total*$sale->rate}}" class="form-control border-input" required>
                                            
                                            </div>
                                        </div>                                            
                                                 

                                    </div>
                                    
                                   <div class="row text-right color-black well">
                                        
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label> داشکاندن - دۆلار  </label>
            <input type="text"  name="discount" id="discount"  value="{{$sale->discount}}"
            onchange="getSaleTotalPrice();" onkeyup="getSaleTotalPrice();" class="form-control border-input" required>
                                            </div>
                                        </div>


                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label> پارەی دراو دۆلار</label>
            <input type="text" name="dollars" id="dollars" value="{{$sale->dollars}}" onchange="getSaleTotalPrice();" 
                    onkeyup="getSaleTotalPrice();" class="form-control border-input" required>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>پارەی دراو دینار</label>
                                                <div class="input-group">
            <input type="text" name="dinars" id="dinars" onchange="getSaleTotalPrice();" value="{{$sale->dinars}}"
                    onkeyup="getSaleTotalPrice();" class="form-control border-input" required>
                                            </div>
                                        </div>
                                        </div>

        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>بەرواری یەکەم قیست</label> 
                                                @if($sale->ins->count()>1)
                                                <input type="date" name="first_installment" value="{{$sale->ins->first()->created_at->format('Y-m-d')}}" id="first_installment" class="form-control border-input" required>
                                                @else
                                                <input type="date" name="first_installment" id="first_installment" class="form-control border-input" required>
                                                @endif
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label> پارەی پێشەکی  </label>
            <input type="text" name="initial_amount" value="{{$sale->initial_amount}}" onchange="getSaleTotalPrice();" onkeyup="getSaleTotalPrice();" class="form-control border-input" required>
                                            </div>
                                        </div>
                                        
                                      </div>
                                   
                                    <select id="allItems" class="hidden">
                                      <option value="0"></option>
                                          @foreach ($items as $item)
                                              <option value="{{$item->id}}">{{$item->id}} - {{$item->name}}</option>
                                          @endforeach
                                      </select>

  {{-- end of header table                                --}}
                        <hr/>

    <div class="row col-md-12" id="repeatedSale">
        <?php $i=0;?>
                        @foreach ($sale->items as $item)
        

             <div id="{{$i}}">

            <div class="form-group col-md-1 col-sm-1"> 
              <button class="btn btn-danger btn-circle btn3d" type="button" onclick="removeItem({{$i}})">
              <i caption="زانیاری" class="fa fa-minus-circle fa-1x"></i></button>
            </div>


        <div class="form-group col-md-2 col-sm-2">
         <span class="input-group-addon">ژمارە</span>
          <input type="text" onkeyup="getSaleTotalPrice();" onblur="getSaleTotalPrice();" id="quantity{{$i}}" value={{$item->pivot->quantity}} name="quantity{{$i}}" class="form-control text-right" required>
        </div>

        <div class="form-group col-md-3 col-sm-3">    
         <span class="input-group-addon">نرخ</span>
         <input type="text" onkeyup="getSaleTotalPrice();" onblur="getSaleTotalPrice();" value={{$item->pivot->ppi}} name="ppi{{$i}}" id="ppi{{$i}}" class="form-control text-right" required>
        </div>
                                        
           <div class="form-group col-md-6 col-sm-6">     
            <span class="input-group-addon">کۆد</span>

            <select id="barcode{{$i}}" name="barcode{{$i}}" onchange="getSaleItemPrice(this.value,this.id);" class="form-control slct2" >
                                        <option  value="{{$item->id}}">{{$item->name}}</option>
                                        @foreach ($items as $item)
                                            <option value="{{$item->id}}">{{$item->code}} - {{$item->name}}</option>
                                        @endforeach

                                    </select>
        </div>                                 
       

        </div>
   <?php $i++;?>
   @endforeach
{{-- end repeated sale --}}
</div>

        <div class="text- no-print text-center">
            <input type="hidden" value="{{$i}}" id="howManyItems" name="howManyItems"/>
           <button class="btn btn-success btn-circle btn3d" type="button" onclick="UpdateSaleItem()">
           <i caption="زیادکردن" class="fa fa-plus-circle fa-2x"></i></button>
        </div>
                            <br>
        <div class="text-center no-print">
           <input type="submit" name="submit" value="تۆمارکردن" class="btn-danger text-center btn-lg btn3d"/>
        </div> 

     <div class="clearfix"></div>
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
  
  $("#menu-top li a").removeClass("menu-top-active");              
  $('#sale').addClass('menu-top-active');
  
 
        $().ready(function(){
          $.validator.messages.required = '';
          $('#saleFormValidation').validate();
        });
    </script>
 @endsection