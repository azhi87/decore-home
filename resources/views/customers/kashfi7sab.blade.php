
@extends('layouts.master')

@section('content')
<br/>
<div class="row bordered-2" >
    
<div class="col-md-12 col-sm-12 col-xs-12 text-center">
</br>
    <strong><p style="font-size: 48px; ">کەشفی حسابی کڕیار </p> </strong>
    </br>
    </br>
</div>
</div>

<div class="row bordered-1" >

        <table class="table table-bordered tfs16boldc tfs24boldp margin-2">
    <thead  class="text-center">

        <tr  >
            <td class="col-print-4"> {{$customer->name}}</td>
            <td class="bg-info col-print-11">: ناوی کڕیار</td> 
            <td class="col-print-11 bg-warning text-danger"> {{$customer->id}}</td>
            <td class="bg-info col-print-11"> :کۆدی کڕیار </td>
        </tr>

</thead>
</table>

        <table class="table table-bordered tfs16boldc tfs24boldp margin-2"  >
    <thead  class="text-center">

        <tr  >
            <td class="col-print-2"> {{$customer->mobile}}</td>
            <td class="col-print-3"> {{$customer->garak->garak}}</td>
            <td class="col-print-3"> {{$customer->garak->city->city}}</td>
            <td class="bg-info col-print-11"> :ناونیشان </td>
        </tr>

</thead>
</table>

</div>
<div class="text-right">
<h2> <span class="label label-success box-bcolor"> بەشی قەرز دانەوە</span></h2>
</div>
<div class="row bordered-1" >

        <table class="table table-bordered table-striped table-responsive table-text-center tfs16boldc tfs24boldp margin-1" >
    <thead >
        <tr class="bg-info" >
            <th class="col-print-2">   تێبینی  </th>
            <th class="col-print-2"> كۆی پارە</th>
            <th class="col-print-11">گۆڕینەوەی دۆلار</th>
            <th class="col-print-11">پارە بە دینار</th>
            <th class="col-print-11">پارە بە دۆلار</th>
            <th class="col-print-11 ">بەروار</th>
        </tr>

    </thead>
@foreach ($customer->debts as $debt)
@if($debt->calculatedPaid<0.01)
    <?php continue;?>
@endif
<tr >
<td >{{$debt->description}}</td>
<td >{{number_format($debt->calculatedPaid,2)}}</td>
<td >{{$debt->rate}}</td>
<td >{{$debt->dinars}}</td>
<td > {{$debt->dollars}}</td>
<td class="bg-warning text-danger">{{$debt->created_at->format('d/m/y')}}</td>

</tr>
@endforeach

</table>
</div>

<div class="text-right">
<h2 class="text-right "> <span class="label label-sccess box-bcolor "> بەشی وەسڵ</span></h2>
</div>
<div class="row bordered-1">

        <table class="table table-bordered table-responsive table-striped table-text-center tfs16boldc tfs24boldp margin-1 ">
    <thead  >
        <tr class="bg-info">
            <th>کۆی وەسڵ</th>
            <th>بەرواری وەسڵ</th>
            <th>ژ.وەسڵ</th>
        </tr>
</thead>

@foreach ($customer->sales as $sale)
  
<tr  >
<td >{{number_format($sale->total,2)}}</td>
<td > {{$sale->created_at->format('d/m/Y')}}</td>
<td class="bg-warning text-danger">{{$sale->id}}</td>

</tr>

@endforeach

</table>
</div>

<div class="print-single text-right">
<h2 class="text-right "> <span class="label label-success box-bcolor "> حسابی کۆتایی کڕیار</span></h2>

<div class="row bordered-1" >


        <table class="table text-center tseparate table-bordered tfs16boldc tfs24boldp margin-1">
      <tbody class="bordered-1">
        <tr  >
            <td class="col-print-0 "><i class="fa fa-dollar "></i> </td>
            <td class="col-print-3  text-danger bg-warning"> 
            {{number_format($customer->sales->sum('total'),2)}}</td>
            <td class="col-print-4 bg-info"> :سەرجەمی وەسڵی کڕیار </td>
        </tr>

         <tr  >
            <td ><i class="fa fa-dollar "></i></td>
            <td class="text-danger bg-warning"> 
            {{number_format($customer->debts->sum('calculatedPaid'),2)}}</td>
            <td class="bg-info"> :سەرجەمی پارەدانەوەی قەرز </td>
        </tr>

        <tr>
            <td ><i class="fa fa-dollar "></i></td>
            <td class="text-danger bg-warning"> 
            {{number_format($customer->installments->sum('paid'),2)}}</td>
            <td class="bg-info"> :سەرجەمی قیست دانەوە </td>
        </tr>


         <tr  >
            <td ><i class="fa fa-dollar "></i></td>
            <td class="text-danger bg-warning">  
            {{number_format($customer->sales->sum('total-calculatedPaid')-$customer->debts->sum('calculatedPaid'),2)}}
</td>
            <td class="bg-info"> :سەرجەمی قەرزی ئێستای کڕیار</td>
      </tr>
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