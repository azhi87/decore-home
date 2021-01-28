@extends('layouts.master')
@section('content')
<div class="col-md-12">
<div class="row bordered-2">
	
<div class="col-md-12 col-sm-12 col-xs-12 text-center">
<br>
	<p class="h3 color-black"><strong> ڕاپۆرتی قەرز - کۆمپانیا </strong></p> 
<br>

</div>
</div>

<div class="row bordered-1" >
		<table class="table table-bordered table-striped table-responsive table-text-center h6" >
    <thead >
        <tr  class="bg-info">
            <th> سەرجەمی قەرز</th>
             <th> سەرجەمی گێڕانەوەی پارە</th>

            <th> سەرجەمی پارەدان</th>
            <th> سەرجەمی داشکاندن</th>

            <th> سەرجەمی کڕین</th>
            <th> ناو</th>
        
        </tr>

    </thead>

<tbody>
<?php $total=0;?>
    @foreach($suppliers as $supplier)
       <?php $total+=$supplier->supplierDebt();?>
        <tr >
            <td class="bg-warning">{{number_format($supplier->supplierDebt(),2)}}</td>
            <td >{{number_format($supplier->transfers->sum('amount'),2)}}</td>
            <td >{{number_format($supplier->purchases->sum('paid'),2)}}</td>
            <td >{{number_format($supplier->purchases->sum('discount'),2)}}</td>
            <td >{{number_format($supplier->purchases->sum('total'),2)}}</td>
            <td class="bg-warning"> {{$supplier->name}}</td>
        </tr>

    @endforeach
</tbody>


</table>
</div>

<div class="row bordered-1" >
        <table class="table tseparate-1 table-bordered table-text-center h5 ">
    <tbody class="bordered-1">

        <tr >
            <td class="bg-warning text-danger"><strong> {{number_format($total,2)}} </strong></td>
            <td class="bg-info"><strong> :کۆی قەرز بە دۆلار</strong></td>
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
  $('#report').addClass('menu-top-active');
  });
 </script>

 @endsection