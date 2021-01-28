@extends('layouts.master')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<div class="row">
            <div class="col-md-12 text-center">
                <h4 class="header-line">{{Auth::user()->name}}</h4>
            </div>
</div>

<?php $debt=new \App\Debt();
      $sale=new \App\Sale();
      $expense=new \App\Expense();
      $ins=new \App\Installment();
      $user=new \App\User();
 	  $cats=\App\Category::all();
      $users=$user->users('accountant','admin');?>
      @if(Auth::user()->type!='maxzan' && Auth::user()->type!='supervisor')
<div class="row">
                 <div class="col-lg-3 col-sm-6">
                          <div class="card">
                              <div class="card-content">
                                  <div class="row">
                                      <div class="col-xs-5">
                                          <div class="icon-big icon-warning text-center">
                                              <i class="ti-server"></i>
                                          </div>
                                      </div>
                                      <div class="col-xs-7">
                                          <div class="numbers card-footer text-danger">
                                            <p><b><a style="color:inherit;" href="/installments"> قیست</a></b> </p>
                                            <span class="hidden">{{$ins->totalDue()}}</span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          <div class="card-footer">
                            <hr>
                            <div class="stats text-right">
                             <a  href='reports/due'>قیستی دواکەوتوو</a>
                            </div>
                          </div>
                          </div>
              </div>              
              <div class="col-lg-3 col-sm-6">
                          <div class="card">
                              <div class="card-content">
                                  <div class="row">
                                      <div class="col-xs-5">
                                          <div class="icon-big icon-success text-center">
                                              <i class="ti-wallet"></i>
                                          </div>
                                      </div>
                                      <div class="col-xs-7">
                                          <div class="numbers">
                                              <p><b>فرۆشتنی بارنەکراو</b></p>
                                              @if(\Auth::user()->type=='admin' )
                                                <a href="/sale/confirm">{{$sale->countUnConfirmed()}}</a>
                                              @else
                                               <a href="/sale/confirm">{{$sale->countUnConfirmed(\Auth::user()->branch_id)}}</a>
                                              @endif
                                          </div>
                                      </div>
                                  </div>
                              </div>
                <div class="card-footer">
                  <hr>
                  <div class="stats text-right">
                    	<a href='/sales/noSupport'>{{$sale->countNoSupport()}} :فرۆشتنی بێ بەڵگە</a>
                  </div>
                <br/>  
                  <div class="stats text-right">
	                    <a href='/sale/initials'> فرۆشتن کە پێشەکی ماوە </a>
                  </div>

                </div>
                          </div>
                      </div>
                <div class="col-lg-3 col-sm-6">
                          <div class="card">
                              <div class="card-content">
                                  <div class="row">
                                      <div class="col-xs-5">
                                          <div class="icon-big icon-danger text-center">
                                              <i class="ti-pulse"></i>
                                          </div>
                                      </div>
                                      <div class="col-xs-7">
                                          <div class="numbers">
                                              <p><b>فرۆشتنەکانی ئەمڕۆ</b></p>
                                             {{$sale->countToday()}}
                                          </div>
                                      </div>
                                       <div class="col-xs-7">
                                          <div class="numbers">
                                              <p><b>مەصروفاتی ئەمڕۆ</b></p>
                                             {{$expense->totalToday()}} $
                                          </div>
                                      </div>
                                  </div>
                              </div>
                <div class="card-footer">
                  <hr>
                  <div class="stats">
                    کۆی فرۆشتن $ {{number_format($sale->totalToday(),0)}}
                  </div>
                </div>
                          </div>
                      </div>
               <div class="col-lg-3 col-sm-6">
                          <div class="card">
                              <div class="card-content">
                                  <div class="row">
                                      <div class="col-xs-5">
                                          <div class="icon-big icon-warning text-center">
                                              <i class="ti-credit-card"></i>
                                          </div>
                                      </div>
                                      <div class="col-xs-7">
                                          <div class="numbers">
                                            <p><a style="color:inherit;" ><b>قیستەکانی ئەمڕۆ 
                                            </b></a> </p>
                                            {{$ins->countToday()}}
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          <div class="card-footer">
                            <hr>
                            <div class="stats text-right">
                             کۆی پارەی قیست {{number_format($ins->totalToday())}}
                            </div>
                          </div>
                          </div>
              </div>
        </div>

        <div class="row">
            
        <hr/>
        @endif
        @if(Auth::user()->type=='admin')
        
        <div class="col-md-3">
        <div class="card bg-info" style="background-color:snow;">            
        <div class="card-content table-responsive table-full-width">
                                    
        <table class="table table-hover text-center">
        <thead class="h5">
         <tr class="bg-info"> 
            <th class="text-center">پارەی لایە</th>
            <th class="text-center">  کارمەند  </th>
        </tr>
        </thead>
        <tbody >
        @foreach($users as $user)
        <tr>
            <td>{{number_format($user->balance(),0)}} </td>
            <td> {{$user->name}}</td>
        </tr>
        @endforeach
 </tbody>
</table>
</div>
</div>
</div>

@endif

<div class="col-md-3 col-sm-6">
<form method="post" action="/reports/stockCode" id="contact_form">
 {{csrf_field()}}

@include('layouts.errorMessages')
      <div class="card ">
               <div class="panel-heading text-center">
                <span class='h6 color-black'>ڕاپۆرتی مەخزەن - کۆد</span>
               </div>
        <div class="panel-body text-right">
            
      <fieldset class="form-group">
        <select name="item_id" class="form-control" id="select2" required>
            @foreach($items as $it)
            <option value="{{$it->id}}">{{$it->name}} - {{$it->id}}</option>
            @endforeach
        </select>
    </fieldset>
      
     <button type="submit" class="btn btn-info btn-block btn3d"><strong>گەڕان</strong></button>
   </div>
</div>
</form>
</div>


<div class="col-md-3 col-sm-6">
@include('layouts.errorMessages')
       <div class="card ">
                <div class="panel-heading text-center">
                 <span class='h6 color-black'>  گەڕان - مەخزەن</span>
                </div>
                <div class="panel-body text-right">
<form method="POST" action="reports/stock" id="contact_form">
	{{csrf_field()}}
				
				<fieldset class="form-group">
					
					<select  class="form-control" name="cat_id" >
					    <option value="0">هەموو</option>
					@foreach ($cats as $cat)
							<option value="{{$cat->id}}"> {{$cat->name}} </option>
					@endforeach
					</select>
				</fieldset>
				
		<div class="form-group">
		<div class="col-md-12">
						<button type="submit" class="btn btn-info btn3d btn-block"><strong>گەڕان</strong></button>
		</div>
		</div>
</form>
</div>
</div>
</div>

    <div class="col-md-3 col-sm-6 col-xs-12 table-responsive">
    @include('layouts.errorMessages')
       <div class="card ">
                <div class="panel-heading text-center">
                 <span class='h6 color-black'>  گەڕان - مەخزەن</span>
                </div>
                <div class="panel-body text-right">
    <form class="form-horizontal" method="POST" action="/reports/stockWord" id="contact_form">
    	{{csrf_field()}}
    
    	<div class="form-group">  
      <div class="col-md-12">
        <input type="text"  class="form-control" name="item_name">
       </div>
       </div>
       
		<div class="form-group">
		<div class="col-md-12">
						<button type="submit" class="btn btn-info btn3d btn-block"><strong>گەڕان</strong></button>
		</div>
		</div>

    </form>
    </div>
    </div>
    </div>

<div class="col-lg-3 col-sm-6">
                          <div class="card">
                              <div class="card-content">
                                  <div class="row">
                                      <div class="col-xs-4">
                                          <div class="icon-big icon-warning text-center">
                                              <i class="ti-alert"></i>
                                          </div>
                                      </div>
                                      <div class="col-xs-8">
                                          <br/>
                                       
                                          <div class="numbers ">
                                            <p><b><a style="color:inherit; font-size:18px;" href="/reports/stock"> ڕاپۆرتی مەخزەن - ماوە</a></b> </p>
                                          </div>
                                      
                                          <br/>
                                       
                                          <div class="numbers ">
                                            <p><b><a style="color:inherit; font-size:18px;" href="/reports/stockEmpty"> ڕاپۆرتی کاڵای - نەماوە</a></b> </p>
                                          </div>
                                          <br/>
                                            <br/>
                                      </div>
                                  </div>
                              </div>
                         
                          </div>
                          </div>              


</div>
@if(Auth::user()->type=='admin' || Auth::user()->id==4 || Auth::user()->id==3)
<div class="col-md-3 col-sm-6">
<form method="post" action="/rate/add" id="contact_form">
 {{csrf_field()}}

@include('layouts.errorMessages')
      <div class="card ">
               <div class="panel-heading text-center">
                <span class='h6 color-black'>گۆڕینی نرخی دۆلار</span>
               </div>
        <div class="panel-body text-right">
            
      <fieldset class="form-group">
        <input type="text" name="rate" class="form-control" value="{{$rate->rate}}" required>
      </fieldset>
           
    </fieldset>
      
     <button type="submit" class="btn btn-info btn-block btn3d"><strong>گەڕان</strong></button>
   </div>
</div>
</form>
</div>
@endif

@endsection

@section('afterFooter')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
 <script type="text/javascript">
  $(document).ready(function () {
   $('#select2').select2();
  $("#menu-top li a").removeClass("menu-top-active");              
  $('#main').addClass('menu-top-active');
 
  });
 </script>

 @endsection