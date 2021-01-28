
@extends('layouts.master')

@section('content')

<br />
<div class="card col-md-10 col-md-offset-1">
<div class="row bordered-2">
<div class="col-md-12 col-sm-12 text-center">
<br />
    <p class="h2"><strong> ڕاپۆرتی قیستی کڕیار</strong>  </p> 
    <br />

</div>
</div>

<div class="row bordered-1">

        <table class="table table-bordered  table-responsive table-text-center">
    <thead   >
        <tr class="bg-info">
            <th>دوا بەرواری قیست</th>
            <th>بڕی ماوە</th>
            <th>بەرواری کڕین</th>
            <th>ماوە - مانگ</th>  
            <th>ژمارەی وەصل</th>        
            <th>ژمارەی مۆبایل</th>
            <th>ناوی کڕیار</th>
        </tr>

    </thead>

			@foreach ($ins as $in)
            @if(($in->sale->total - $in->sale->ins->sum('paid'))<1)
            <?php continue;?>
            @endif

            @if($in->created_at->diffInDays(\Carbon\Carbon::now()) >30)
            <tr class="danger">
            @else
            <tr >
            @endif

				    
					<td class="text-danger"><span >{{$in->created_at->format('d-m-Y')}}</td>
					<td >{{$in->sale->total - $in->sale->ins->sum('paid')}} $</td>
					<td class=""> {{$in->sale->created_at->format('d-m-Y')}} </td>
					<td class=""> {{$in->sale->installments}} </td>
                    <td><a href="/installments/{{$in->sale_id}}">{{$in->sale_id}}</a>
					<td class="text-danger"> {{$in->sale->customer->tel}} </td>
					<td class="text-danger"> {{$in->sale->customer->name}}</td>
				</tr>

			@endforeach



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