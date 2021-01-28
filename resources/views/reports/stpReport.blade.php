@extends('layouts.master')
@section('content')

<div class="row bordered-2" >
<div class="col-md-12 col-sm-12 col-sx-12 text-center">
</br>
	<p class="h3 color-black"><b> قازانج لە فرۆشی مەوادەکان</b></p>
    </br>

</div>
</div>

<div class="row bordered-1" >

<br>
       <table class="table table-bordered tseparate-1 tfs14boldc tfs14boldp ">
    <tbody  class="text-center">

      <tr  >
            <td> {{$to}}</td>
            <td>: بۆ</td> 

            <td> {{$from}}</td>
            <td>: لە</td> 
        </tr>

</tbody>
</table>
</div>

<div class="row bordered-1">
		<table class="table table-bordered table-striped table-responsive  table-text-center" >
    <thead>
        <tr class="bg-info" >
      
            <th >ناوی کارمەند</th>
            <th >قازانج لە مەواد</th>
            <th >کۆی فرۆشتن</th>
            <th >دانە</th>
            <th >بەروار</th>
            <th > ناوی کاڵا</th>
            <th > کۆدی کاڵا</th>
                                    
        </tr>
    </thead>
<?php $totalSale=0;$totalQuantity=0;?>
@foreach ($sales as $sale)

<?php $totalSale+=($sale->total);?>
<tr class="bg-warning text-danger">
    
        <td>
            @if($sale->mandwb_id!=0)
            {{$sale->mandwb->name}}
            @else
                ---------
            @endif
            </td>
        <td>{{number_format($sale->items()->first()->pivot->quantity*($sale->items()->first()->pivot->ppi-$sale->items()->first()->averagePurchasePrice()),0)}}</td>
        <td>{{$sale->items()->first()->pivot->ppi*$sale->items()->first()->pivot->quantity}}</td>
        <td>{{$sale->items()->first()->pivot->quantity}}</td>
        <td>{{$sale->created_at}}</td>
        <td>{{$sale->items()->first()->name}}</td>
        <td>{{$sale->items()->first()->id}}</td>

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
  $('#report').addClass('menu-top-active');
  });
 </script>

 @endsection