@extends('layouts.master')
@section('content')
<br>

<div class="row hidden-print">
<form method="post" action="/debts/search" class=" form-inline text-center" >
{{csrf_field()}}

@if (Auth::user()->type!="mandwb")
<a href="/debt/generalSearch" type="button" class="btn btn3d btn3d-pull btn-primary"><strong>گەڕانی گشتی </strong></a>
@endif
<div class="input-group has-warning col-md-4 col-sm-4 col-xs-8">
      <span class="input-group-btn">
       <button class="btn btn-magick btn3d btn3d-pull" type="submit"> <strong>گەڕان </strong><span class="fa fa-search fa-1x"></span></button>
      </span>
      <input type="text" name="name" class="form-control " placeholder="...گەڕان بۆ ناوی کڕیار">
</div>

<div class="input-group has-warning col-md-4 col-sm-4 col-xs-8">
      <span class="input-group-btn">
       <button class="btn btn-magick btn3d btn3d-pull" type="submit"><strong>گەڕان </strong><span class="fa fa-search fa-1x"></span></button>
      </span>
      <input type="number" name="tel" class="form-control " placeholder="...گەڕان بۆ کۆدی کڕیار">
</div>

</form>
</div>



@if(!empty($customer))
<div class="well col-md-12 col-sm-12 col-xs-12 table-responsive">

<table class="table table-borderless table-responsive">
	<thead >
		<tr>
            <th><a type="button"  href="/returns/{{$customer->id}}" class="btn btn-info btn3d"> <strong> مەوادی گەڕاوە </strong></a></th>
            <th><a type="button"  href="/kashfi7sab/{{$customer->id}}" class="btn btn-info  btn3d"><strong>کەشفی حیساب </strong></a></th>
			<th class="text-right color-red h4"><bd>{{number_format($customer->customerDebt(),2)}}</bd></th>
			<th class="text-left h4">:کۆی قەرز</th>
			<th class="text-right color-red h4"><strong>{{$customer->name}}&nbsp;-&nbsp;{{$customer->id}}</strong></th>
			<th class="text-left h4"> : ناوی کڕیار</th>

		</tr>
	</thead>
</table>
 
</div>

<div class="row">
 <div class="col-md-9 col-sm-12 col-xs-12 table-responsive">
<table class="table table-bordered table-striped table-responsive">
	<thead class="bg-success">
		<tr class="custom_centered">
		    @if(Auth::user()->type!="mandwb")
			<th class="hidden-print">گۆڕانکاری</th>
			@endif
			<th class="hidden-print">پرینت</th>
			<th>ئەدمین</th>
			<th>زانیاری</th>
			<th>کۆ</th>
			<th>نرخی دۆلار</th>
			<th>دینار</th>
			<th>دۆلار</th>
			<th>بەروار</th>
		</tr>
	</thead>

	<tbody>
	
		@foreach ($customer->debts->sortByDesc('created_at') as $debt) 
			<tr class="text-center">
			    @if(Auth::user()->type!="mandwb")
				<td class="hidden-print"><a href={{"/debts/edit/".$debt->id}}><span class="fa fa-edit fa-1x"></span></a></td>
				@endif
				<td class="hidden-print"><a href={{"/debt/print/".$debt->id}}><span class="fa fa-print fa-1x"></span></a></td>
				
				<td>{{$debt->statusText()}}</td>
				<td>{{$debt->description}}</td>
				<td>$ {{number_format($debt->calculatedPaid,2)}}
				<td>{{$debt->rate}}</td>
				<td>{{$debt->dinars}}</td>
				<td>$ {{$debt->dollars}}</td>
				<td>{{$debt->created_at}}</td>
			</tr>
		@endforeach
	</tbody>
       
</table>
</div>
@if(!$customer->hasUnConfirmedDebts())
<div class="col-md-3 col-sm-5 col-xs-10 col-md-offset-0 col-sm-offset-7 col-xs-offset-0 hidden-print" id="box">

@include('layouts.errorMessages')
<div class="text-center color-white" style="margin-top:10px;">
 <span class="h3 text-center"><bd>وەسڵی قەرزی کڕیار</bd></span>
 </div>               
<hr>
<form class="form-horizontal" method="POST" action="/debt/store" id="contact_form">
	{{csrf_field()}}
	<input type="hidden" name="customer_id" value="{{$customer->id}}">

	<div class="form-group">

	<div class="col-md-12">
	    <div class="input-group">
		<input type="text" value="0" onkeyup="calculateTotalPaid({{$rate->rate}});" onblur="calculateTotalPaid({{$rate->rate}});" name="dollars" class="form-control" id="dollars">
		<span class="input-group-addon">:دۆلار</span>
 
	    </div>

	</div>
	</div>
<div class="form-group">

	<div class="col-md-12">
	    <div class="input-group">
	<input type="text" class="form-control" onkeyup="calculateTotalPaid({{$rate->rate}});" onblur="calculateTotalPaid({{$rate->rate}});" name="dinars" value="0" class="form-control" id="dinars">
			<span class="input-group-addon">:دینار</span>   
	    </div>

	</div>
	</div>
<div class="form-group">
		<div class="col-md-12">
	    <div class="input-group">
			<input readonly='readonly' name="calculatedPaid" class="form-control" id="totalPaid" >
			<span class="input-group-addon">سەرجەم</span>

		</div></div></div>
<div class="form-group">
		<div class="col-md-12">
	    <div class="input-group">
			<input readonly='readonly' name='rate' value="{{$rate->rate}}" class="form-control" id="exampleInputEmail2">
		<span class="input-group-addon">:نرخی دۆلار</span>
		</div></div></div>

<div class="form-group">
	<div class="col-md-12 inputGroupContainer">
            <div class="input-group">
                <textarea class="form-control" name="description"></textarea>
                <span class="input-group-addon">زانیاری</span>
            </div>
        </div>
    </div>

<div class="form-group">
	
<div class="col-md-8 col-sm-12">	
		<button type="submit" class="btn btn-success btn3d btn-lg btn-block"> <strong>تۆمارکردن </strong>    </button>
</div>
</div>

</form>
</div>
</div>
@endif
@endif
@endsection
@section('afterFooter')
 <script type="text/javascript">
 	$(document).ready(function () {
  $("#menu-top li a").removeClass("menu-top-active");              
  $('#debtHeader').addClass('menu-top-active');
  });
 </script>

 @endsection