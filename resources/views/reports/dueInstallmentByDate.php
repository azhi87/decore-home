
@extends('layouts.master')
@section('content')

<div class="card col-md-12">
<div class="row bordered-2">
<div class="col-md-12 col-sm-12 text-center">
    <p class="h2" ><strong> ڕاپۆرتی قیستی دواکەوتوو - بەروار</strong>  </p> 
</div>
</div>

<div class="row bordered-1">

        <table class="table table-bordered  table-responsive table-text-center">
    <thead   >
        <tr class="bg-success">
            <th class="hidden-print">ناردنی نامە</th>
            <th class="hidden-print">نامەی نێرراو</th>
            <th>دوا بەرواری قیست</th>
            <th>بڕی ماوە</th>
            {{-- <th>بەرواری کڕین</th> --}}
            <th>ماوە - مانگ</th>  
            <th >ژمارەی وەصل</th> 
            <th>مۆبایل ٢</th>       
            <th>مۆبایل</th>
            <th>ناوی کڕیار</th>
        </tr>

    </thead>

			@foreach ($ins as $in)
				    <tr >
                    <td  class="hidden-print"><a href='/installments/send/{{$in->id}}' type="button" role="button" class="btn btn-primary">ناردن</a></td>
                    <td class="text-danger hidden-print"><button class="btn btn-icon btn-danger">
                                                {{$in->countMessage()}}
                                            </button></td>
					<td class="text-danger"><span >{{$in->created_at->format('d-m-Y')}}</td>
					<td >{{$in->sale->total - $in->sale->actualPaid()}} $</td>
					{{-- <td class=""> {{$in->sale->created_at->format('d-m-Y')}} </td> --}}
					<td class=""> {{$in->sale->installments}} </td>
                    <td ><a href="/installments/{{$in->sale_id}}"><b >{{$in->sale_id}}</b></a>
                    <td class="text-danger"> {{$in->sale->customer->tel2}} </td>
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