
@extends('layouts.master')
@section('content')
<div class="row bordered-2">
	
<div class="col-md-12 col-sm-12 text-center">
<br/>
	<strong><p style="font-size: 36px; ">ڕاپۆرتی مەندووب - فرۆشتن </p> </strong>
    </br>
    
</div>
</div>

<div class="row bordered-1" >

<br/>

    <table class="table table-bordered tseparate-1 tfs14boldc tfs14boldp " >
    <tbody  class="text-center">
        <tr >
            <td class="col-print-11 bordered-0" ></td>
            <td class="col-print-4"> {{$user}}</td>
            <td class="col-print-2 bg-info">: ناوی مەندووب</td> 
            <td class="col-print-11 bordered-0" > </td>  
        </tr >  
    </tbody>
    </table>

    <table class="table table-bordered tseparate-1 tfs14boldc tfs14boldp">
    <tbody  class="text-center">
    <tr >
            <td class="col-print-11 bordered-0" ></td>
            <td class="col-print-2"> {{$to}}</td>
            <td class="col-print-1 bg-info">: بۆ</td> 
            <td class="col-print-2"> {{$from}}</td>
            <td class="col-print-1 bg-info">: لە</td> 
            <td class="col-print-11 bordered-0" > </td>  
    </tr >
    </tbody>
    </table>

</div>

<div class="row bordered-1">

    <table class="table table-bordered table-striped table-responsive tseparate table-text-center tfs14boldc tfs14boldp " >
        <thead  >
    <tr class="bg-info" >
        <th >سەرجەمی فرۆشتن</th>
        <th >بەرواری فرۆشتن</th>
    </tr>

 @foreach ($sales as $sale)
   
    <tr class="bg-warning text-danger">
        <td >{{$sale->total}}</td>
        <td >{{$sale->created_at->format('d/m/Y')}}</td>
    </tr>
  
 @endforeach
</tbody>
</table>
</div>

<div class="row bordered-1">

    <table class="table table-bordered tseparate-1 tfs14boldc tfs14boldp ">
    <tbody class="text-center bordered-1">

    <tr >
        <td class="col-print-11 bordered-0" ></td>
        <td class="col-print-4 bg-warning text-danger"> {{$sales->sum('total')}}</td>
        <td class="col-print-2 bg-info"> : سەرجەمی فرۆشتن</td>
        <td class="col-print-11 bordered-0" ></td>
    </tr>

<br/>    
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