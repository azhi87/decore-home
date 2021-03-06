@extends('layouts.master')

@section('content')
<br>
<div class="col-md-10 col-md-offset-1">
<div class="row bordered-2">
	
<div class="col-md-12 col-sm-12 text-center color-black">
</br>
	<p style="font-size: 48px; "><strong>لیستی قازانجی هەر مەوادێک  </strong></p> 
    </br>
    </br>
</div>
</div>

<div class="row bordered-1">

<br>

    <table class="table table-bordered tseparate-1 tfs16boldc tfs18boldp">
    <tbody  class="text-center ">

      <tr  >
            <td class="col-print-11 bordered-0" ></td>
            <td class="col-print-12"> {{$to}}</td>
            <td class="col-print-1 bg-info">: بۆ</td> 

            <td class="col-print-12"> {{$from}}</td>
            <td class="col-print-1 bg-info">: لە</td> 
            <td class="col-print-11 bordered-0" > </td>  
        </tr>

</tbody>
</table>

</div>

<div class="row bordered-1" >

		<table class="table table-bordered table-striped table-responsive table-text-center tfs16boldc tfs18boldp">
    <thead  >
        <tr class="bg-info">
           
            <th>قازانج</th>
            <th>ژ.فرۆشراو</th>
            <th>ناوی مەواد</th>
            <th>کۆدی مەواد</th>
        </tr>

    </thead>
<?php $totalQuantity=0;$totalProfit=0;?>
@foreach ($items as $item)
<?php $totalQuantity+=$item->totalSaleByDate($from,$to);?>
<?php $totalProfit+=$item->totalProfit($from,$to);?>
<tr >
<td class="col-print-11"> {{number_format($item->totalProfit($from,$to),2)}}</td>
<td class="col-print-11">{{number_format($item->totalSaleByDate($from,$to),0)}}</td>
<td class="col-print-4">{{$item->name}}</td>
<td class="col-print-1 bg-warning text-danger">{{$item->id}}</td>

</tr>
@endforeach
</table>
</div>



<div class="row bordered-1" >
<br>
        <table class="table  table-bordered tseparate-1 tfs16boldc tfs18boldp">
        <tbody  class="text-center">

        <tr>
            <td class="col-print-1 bordered-0" ></td>
            <td class="col-print-4 bg-warning text-danger"> {{number_format($totalQuantity)}}</td>
            <td class="col-print-3 bg-info"> : سەرجەمی ژ.فرۆشراو</td>
            <td class="col-print-1 bordered-0" ></td>
        </tr>

        <tr>
            <td class="bordered-0"></td>
            <td class="bg-warning text-danger"> 
            {{number_format($totalProfit,2)}}
            </td>
            <td class="bg-info"> : سەرجەمی قازانج</td>
            <td class="bordered-0"></td>
        </tr>


</tbody>
</table>
</div>


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