@extends('layouts.master')

@section('content')
<br>
<div class="col-md-10 col-md-offset-1">
<div class="row bordered-2">
	
<div class="col-md-12 col-sm-12 text-center color-black">
</br>
	<p style="font-size: 48px; "><strong>ڕاپۆرتی مەصروفات  </strong></p> 
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
           
            <th>کۆی پارە</th>
            <th>هۆکار</th>
        </tr>

    </thead>
@foreach ($expenses as $expense)
<tr >
    <td class="col-print-11">{{number_format($expense->sum,2)}} $</td>

<td class="col-print-11"> {{$expense->reason}}</td>

</tr>
@endforeach
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