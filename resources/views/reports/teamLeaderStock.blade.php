@extends('layouts.master')
@section('content')
<div class="row bordered-2" >
	
<div class="col-md-12 col-sm-12 col-sx-12 text-center">
</br>
	<strong><p style="font-size: 48px; ">ڕاپۆرتی تیملیدەر - مەخزەن </p> </strong>
    </br>
    </br>
</div>
</div>

<div class="row bordered-1" >

<br>

        <table class="table table-bordered tseparate-1 tfs16boldc tfs24boldp " >
    <tbody  class="text-center">

        <tr >
            <td class="col-print-11 bordered-0" ></td>
            <td class="col-print-4"> {{$user->user}}</td>
            <td class="col-print-11 bg-info">: ناو</td> 
            <td class="col-print-11 bordered-0" > </td>  
        </tr>  

</tbody>
</table>

 

</div>
<div class="row bordered-1" >

        <table class="table table-bordered table-striped table-responsive table-text-center tfs16boldc tfs18boldp">
    <thead  >
        <tr class="bg-info">
           
            <th>ژ.مەخزەن</th>
            <th>ناوی مەواد</th>
            <th>کۆدی مەواد</th>
        </tr>

    </thead>

@foreach ($items as $item)
<tr >
<td class="col-print-11">{{number_format($item->teamLeaderStockReport($user->id))}}</td>
<td class="col-print-4">{{$item->name}}</td>
<td class="col-print-1 bg-warning text-danger">{{$item->id}}</td>

</tr>
@endforeach
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