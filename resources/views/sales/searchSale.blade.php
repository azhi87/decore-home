@extends('layouts.master')
@section('content')
<?php $user=new \App\User();$users=$user->users();
?>
<style>
	.input-group-addon{color:black;min-width:120px;font-weight: bold}
</style>
@include('sales.header')

<br/>
 <div class="row">
                <div class="col-md-3 col-sm-2"></div>
                <div class="col-md-6 col-sm-8">
                    <!-- Form Elements -->
                   <div class="card" data-background-color="brown">
                        <div class="card-header text-center" >
                        <span class='h3'><b>گەڕانی فرۆشتن</b></span>
                        </div>
                    <div class="card-content text-right">
                        <form action='/sale/search' method='post' role="form">
                        			{{csrf_field()}}
                                        <div class="form-group input-group ">
                                            <input type="text" name='customer_name' class="form-control text-right" >
                                            <span class="input-group-addon">ناوی کڕیار</span>
                                        </div>
                                       
                                        <div class="form-group input-group ">
                                            
                                            <input type="text" name='tel' class="form-control text-right" >
                                            <span class="input-group-addon">ژمارەی تەلەفۆن</span>
                                        </div>
                                        <div class="form-group input-group ">
                                            <input type="text" name='sale_id' class="form-control text-right" >
                                           
                                            <span class="input-group-addon">ژمارەی وەصل</span>
                                        </div>

                                        

                                        <div class="form-group input-group ">
                                            <select  class="form-control" name="user_id" >
                                            <option value="-1" selected="selected">------</option>
                                            @foreach ($users as $user)
                                            <option value="{{$user->id}}"> {{$user->name}} </option>
                                            @endforeach
                                            </select>
                                            <span class="input-group-addon">ناوی کارمەند</span>
                                        </div>

                                        <div class="form-group input-group ">
                                            <select  class="form-control" name="qist" >
                                            <option value="-1" selected="selected">------</option>
                                            <option value="1">نەقد</option>
                                            <option value="2">قیست</option>
                                            
                                         
                                            </select>
                                            <span class="input-group-addon">جۆری فرۆشتن</span>
                                        </div>

                                        
                                        <div class="form-group input-group ">
                                            <input type="date" name='from' class="form-control text-right" >
                                            <span class="input-group-addon">لە</span>
                                        </div>

                                       <div class="form-group input-group ">
                                            <input type="date" name='to' class="form-control text-right" >
                                            <span class="input-group-addon">بۆ</span>
                                        </div>
                                        
                                         <div class="form-group text-center">
                                            <input type="submit" value="گەڕان" class="btn-lg btn-info btn3d">
                                        </div>
                                        </div>
                                    </form>
                        </div>                                  
                                </div>
                            </div>
@endsection

@section('afterFooter')
 <script type="text/javascript">
    $(document).ready(function () {
  $("#menu-top li a").removeClass("menu-top-active");              
  $('#sale').addClass('menu-top-active');
  });
 </script>

 @endsection