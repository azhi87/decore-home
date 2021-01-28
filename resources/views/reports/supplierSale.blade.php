@extends('layouts.master')
@section('content')

    <div class="col-md-12">
<div class="row bordered-2">
	
<div class="col-md-12 col-sm-12 col-xs-12 text-center">
</br>
	<strong><p style="font-size: 36px; "> ڕاپۆرتی کۆمپانیا </p> </strong>
    </br>

</div>
</div>

<div class="row bordered-1" >

    <table class="table table-bordered tseparate-1 table-text-center tfs14boldc tfs14boldp " >
    <tbody>

        <tr  >
            <td class="col-print-11 bordered-0" ></td>
            <td class="col-print-4 " > {{$name}}</td>
            <td class="col-print-2 bg-info">: ناوی کۆمپانیا</td> 
            <td class="col-print-11 bordered-0" ></td>
             
        </tr>  
</tbody>
</table>

        <table class="table table-bordered table-text-center tseparate-1 tfs14boldc tfs14boldp  ">
    <tbody  >

      <tr  >
            <td class="col-print-11 bordered-0" > </td>
            <td class="col-print-2 "> {{$to}}</td>
            <td class="col-print-1 bg-info">: بۆ</td> 
            <td class="col-print-2 "> {{$from}}</td>
            <td class="col-print-1 bg-info">: لە</td> 
            <td class="col-print-11 bordered-0" > </td>
        </tr>

</tbody>
</table>

</div>

<div class="row bordered-1" >

		<table class="table table-bordered table-striped table-responsive table-text-center tfs14boldc tfs14boldp " >
    <thead >
        <tr  class="bg-info">
           
            <th class="col-print-2">سەرجەمی کارتۆن</th>
            <th class="col-print-6">ناوی مەواد</th>
            <th class="col-print-2">کۆدی مەواد</th>
        
        </tr>

    </thead>

<body>
<?php $total=0;$totalWeight=0;?>
@foreach ($items as $item)
   
   <?php $total+=$item->totalSaleByDate($from,$to);?>
   @if(number_format($item->totalSaleByDate($from,$to),2) > 0)
    <tr >
        <td class="bg-warning color-brown">{{number_format($item->totalSaleByDate($from,$to),2)}}</td>
        <td > {{$item->name}}</td>
        <td class="bg-warning color-brown">{{$item->id}}</td>
    </tr>
@endif
   {{-- expr --}}
@endforeach
</body>


</table>
</div>

<div class="row bordered-1" >

<br>

        <table class="table tseparate-1 table-bordered table-text-center tfs18boldc tfs18boldp">
    <tbody  class="bordered-1">

        <tr  >
            <td class="col-print-3 bg-warning text-danger"> {{number_format($total,2)}}</td>
            <td class="col-print-2 bg-info"> : سەرجەمی فرۆشراو</td>
        </tr>
<br>
        
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