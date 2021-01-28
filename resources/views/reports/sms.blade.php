
@extends('layouts.master')

@section('content')

<br />
<div class="card col-md-10 col-md-offset-1">
<div class="row bordered-2">
<div class="col-md-12 col-sm-12 text-center">
    <p class="h2" ><strong> ڕاپۆرتی قیستی دواکەوتوو - بەروار</strong>  </p> 
</div>
</div>

<div class="row bordered-1">

        <table class="table table-bordered  table-responsive table-text-center">
    <thead   >
        <tr class="bg-success">
            <th>کارمەند</th>
            <th>بەروار</th>
            <th>ناوەڕۆک</th>
            <th>مۆبایل ٢</th>       
            <th>مۆبایل</th>
            <th>ناوی کڕیار</th>
            <th>#</th>
        </tr>

    </thead>

			@foreach ($smss as $sms)
				    <tr >
                    <td class="text-danger"> {{$sms->user->name}}</td>
					<td class=""> {{$sms->created_at->format('d-m-Y')}} </td>
                    <td class="text-danger"> {{$sms->customer->tel2}} </td>
					<td class="text-danger"> {{$sms->customer->tel}} </td>
                    <td class="text-danger"> {{$sms->customer->name}}</td>
					<td class="text-danger"> {{$loop->iteration}}</td>
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