@extends('layouts.master')
@section('content')
<style type="text/css">.input-group-addon{font-weight:bold; padding:4px;}</style>
@include('xwastns.header')

                    <!-- Form Elements -->
                    <div class="col-lg-12 col-md-12">
                        <div class="card" >
                            <div class="card-header text-center text-danger"><span class='h3'><b>زیادکردنی خواستی فرۆشتن</b></span> </div>
                            <hr/>
                            
                            <div class="card-content">
                        <form action='/xwastn/store'  method='post' id="saleFormValidation" role="form">
                                    <div class="row text-right color-black">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>ناونیشان</label>
                                                <input type="text"  name="address" id="address" class="form-control border-input" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>ژمارەی مۆبایل ٢</label>
                                                <input type="text"  name="tel2" id="tel2" class="form-control border-input" >
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>ژمارەی مۆبایل</label>
                                                <input type="text"  name="tel" id="tel" onchange="getCustomerName();" class="form-control border-input" required min="11">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>ناوی کڕیار</label>
                                                <input type="text" name="name" id="customerName" class="form-control border-input" required>
                                            </div>
                                        </div>
                                    </div>
                            {{-- Form header second row                                     --}}

                                   <div class="row text-right color-black">
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>زانیاری</label>
                                                <textarea type="text" onchange="calculateTotalPaid();" name="description" class="form-control border-input" required></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>ژمارە</label>
                                                <textarea name="quantity" class="form-control border-input" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>ناوی مەواد</label>
                                                <textarea type="text readonly="readonly" name="item_name" class="form-control border-input" required></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    
  



  {{-- end of header table                                --}}
                        <hr/>

   

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