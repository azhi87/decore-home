
@extends('layouts.master')

@section('content')

<br />
<div class="row bordered-2">
    
<div class="col-md-12 col-sm-12 text-center ">
</br>
    <strong><p style="font-size: 48px; "> ڕاپۆرتی گۆڕینی فلتەر  </p> </strong>
    </br>
    </br>
</div>
</div>

<div class="row bordered-1">

        <table class="table table-bordered table-striped  table-responsive table-text-center tfs18boldc tfs24boldp"">
    <thead   >

        <tr class="bg-info">
    
            <th>دوا بەرواری فلتەر گۆڕین</th>
            <th>جۆری فیلتەر</th>          
            <th>ژمارەی مۆبایل</th>
            <th>ناوی کڕیار</th>
         
        </tr>

    </thead>

		@foreach ($filters as $filter)
		<tr >
			<td class="col-print-2 bg-warning text-danger">{{$filter->created_at->format('d - m - Y')}}</td>
			<td class="col-print-11">{{$filter->typeText()}}</td>
			<td class="col-print-2 bg-warning text-danger"> {{$filter->customer->tel}} </td>
			<td class="col-print-4 text-danger"> {{$filter->customer->name}}</td>
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