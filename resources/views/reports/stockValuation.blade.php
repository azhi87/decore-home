
@extends('layouts.master')
@section('content')
<div class="row bordered-2" >
    
<div class="col-md-12 col-sm-12 col-xs-12 text-center">
<br>
    <strong><p style="font-size: 40px;  ">نرخی مەوادەکانی مەخزەن</p> </strong>
    <br>
</div>
</div>


<div class="row bordered-1" >

    <table class="table table-bordered table-responsive table-striped table-text-center tfs16boldc " >
    <thead>
        <tr class="bg-info">
             <th>   نرخی گشتی  </th>
             <th>   ژ.مەخزەن  </th>
             <th>  نرخی کڕین  </th>
             <th>  ناوی مەواد  </th>
             <th>  کۆد  </th>
        </tr>
    </thead>
    <?php $total=0;$totalD=0;$totalQuantity=0;?>
   @foreach ($items as $item)

    <tr >
<?php 
$totalQuantity+=$item->stock();
 $stock=$item->stock();
 if($item->currency=='IQD')
 {
    $valuation=$stock*$item->averagePurchasePrice();
     $total+=$valuation;
  }
  else
  {
      $valuation=$stock*$item->averagePurchasePrice();
       $totalD+=$valuation;
  }
?>
          <td>{{$item->currency}}  {{number_format($valuation,0)}}</td>
          <td class=" color-brown">{{number_format($stock,0)}}</td>
          <td class="text-warning">{{number_format($item->averagePurchasePrice(),0)}}</td>
          <td>{{$item->name}}</td>
          <td class="bg-warning color-brown">{{$item->id}}</td>
        </tr>
   
@endforeach
   
</table>
</div>

<div class="row bordered-1">

    <table class="table table-bordered tseparate-1 tfs16boldc  ">
    <tbody class="text-center bordered-1">


        <tr  >
            <td class="col-print-2 bordered-0" ></td>
            <td class="col-print-4 bg-warning text-danger"> {{number_format($totalD,2)}}</td>
            <td class="col-print-3 bg-info"> : سەرجەمی پارە دۆلار</td>
            <td class="col-print-2 bordered-0" ></td>
        </tr>
        <tr  >
            <td class="col-print-2 bordered-0" ></td>
            <td class="col-print-4 bg-warning text-danger"> {{number_format($totalQuantity)}}</td>
            <td class="col-print-3 bg-info"> : کۆی ژمارەی مەخزەن</td>
            <td class="col-print-2 bordered-0" ></td>
        </tr>


<br>    
</tbody>
</table>
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