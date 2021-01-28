@extends('layouts.master')
@section('content')
    <div class="row bordered-2">
<div class="col-md-12 col-sm-12 text-center">
</br>
    <strong><p style="font-size: 36px; "> ڕاپۆرتی مانگانەی مەندووبەکان  </p> </strong>
    </br>
</div>
</div>

<div class="row bordered-1" >

<br>
        <table class="table  table-bordered tfs18boldp tseparate-1 tfs14boldc tfs14boldp">
    <tbody  class="text-center">

        <tr  >
            <td class="col-print-2 bordered-0"></td>
            <td class="col-print-4"> {{$user}}</td>
            <td class="col-print-2 bg-info">: ناوی مەندووب</td> 
            <td class="col-print-1 bordered-0"> </td>  
        </tr>  

</tbody>
</table>

    <table class="table table-bordered tseparate-1 tfs14boldc tfs14boldp">
    <tbody  class="text-center ">

      <tr  >
            <td class="col-print-2 bordered-0"></td>
            <td class="col-print-2"> {{$to}}</td>
            <td class="col-print-1 bg-info">: بۆ</td> 

            <td class="col-print-2"> {{$from}}</td>
            <td class="col-print-1 bg-info">: لە</td> 
            <td class="col-print-1 bordered-0"> </td>  
        </tr>

</tbody>
</table>

</div>

<div class="row bordered-1">

        <table class="table table-bordered table-striped  table-responsive table-text-center tfs14boldc tfs14boldp">
    <thead   >

        <tr class="bg-info">
            <th>کۆی پسووڵە</th>
            <th>بەروار</th>          
            <th>کۆدی وەسڵ</th>
            <th>ناوی کڕیار</th>
            <th>کۆد</th>
         
        </tr>

    </thead>

@foreach ($sales as $sale)
    

<tr >

<td class="col-print-2">{{number_format($sale->total,2)}}</td>
<td class="col-print-11">{{$sale->created_at->format('d/m/Y')}}</td>
<td class="col-print-11 text-danger">{{$sale->id}}</td>
<td class="col-print-4">{{$sale->customer->name}}</td>
<td class="col-print-1 bg-warning text-danger">{{$sale->customer->id}}</td>
</tr>
@endforeach

</table>
</div>




<div class="row bordered-1">

    <table class="table table-bordered tseparate-1 tfs14boldc tfs14boldp">
    <tbody class="text-center bordered-1">

        <tr  >
            <td class="col-print-1 bordered-0" ></td>
            <td class="col-print-4 bg-warning text-danger">{{number_format($sales->sum('total'),2)}}</td>
            <td class="col-print-2 bg-info"> : سەرجەمی پسووڵە</td>
            <td class="col-print-1 bordered-0"></td>
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