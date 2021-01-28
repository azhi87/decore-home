@extends('layouts.master')

@section('content')

<br/>
<div class="row bordered-2 ">
	
<div class="col-md-12 col-sm-12 text-center">
<br/>
	<strong><p style="font-size: 48px; ">ڕاپۆرتی مارکێتی گەڕەکەکان </p> </strong>
</div>

<div class="col-md-12 col-sm-12 text-right">
<br/>

	<h1> <span class="label label-default">  گەڕەك : {{$garak}}</span></h1>
<br/>
</div>
</div>


<div class="row bordered-1">

		<table class="table table-bordered table-text-center table-striped table-responsive tfs16boldc tfs24boldp" >
    <thead   >
        <tr class="bg-info">
           <th> دوا بەرواری قەرز</th>
            <th>ژمارەی مۆبایل</th>
            <th>کۆی قەرز / دۆلار</th>
            <th>ناوی کڕیار</th>
            <th>کۆدی کڕیار</th>
        </tr>

    </thead>
    <tbody>
@foreach ($customers as $customer)
	@if ($customer->status==="disabled")
			<tr class="text-center bg-danger">
		@else
		<tr class="text-center">
		@endif

<td class="{{$customer->bgChange()}}">{{$customer->daysFromLastDebtPayment()}}</td>
<td >{{$customer->mobile}}</td>
<td >{{$customer->customerDebt()}}</td>
<td >{{$customer->name}}</td>
<td class="bg-warning text-danger">{{$customer->id}}</td>

</tr>
@endforeach
</tbody>
</table>

</div>

</div>
@endsection

@section('afterFooter')
 <script type="text/javascript">
    $(document).ready(function () {
  $("#menu-top li a").removeClass("menu-top-active");              
  $('#customer').addClass('menu-top-active');
  });
 </script>

 @endsection