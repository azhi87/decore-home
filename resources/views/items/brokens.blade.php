@extends('layouts.master')

@section('content')
<br>

<div class="row">
	<div class="col-md-4 col-sm-6 col-xs-12 hidden-print">
		<form method="POST" action="/broken/search" >
		{{csrf_field()}}
			<div class="input-group has-warning">
			      <span class="input-group-btn">
			        <button class="btn btn-secondary btn-danger" type="submit">!گەڕان</button>
			      </span>
			      <input type="text" name="barcode" class="form-control" placeholder="...گەڕان بەپێی کۆدی مەواد">
			</div>
		</form>
	</div>
	
</div>
 <br>

<div class="row">

 <div class="col-md-8 col-sm-12 col-xs-12">

<table class="table table-bordered table-striped table-responsive">
	<thead class="bg-success">
		<tr class="custom_centered">

			<th class="hidden-print">گۆڕانکاری</th>
			<th>بەروار</th>
			<th>ژمارە</th>
			<th>ناوی مەواد</th>
			<th>کۆدی مەواد</th>
		</tr>
	</thead>

	<tbody>
	

		@foreach ($brokens as $broken)

			<tr class="text-center">
				<td class="hidden-print"><a href="/broken/edit/{{$broken->id}}"><span class="fa fa-edit fa-1x "></span></a></td>
				<td>{{$broken->created_at->format('d-m-Y')}}</td>
				<td>{{$broken->quantity}}</span></td>
				<td>{{$broken->item->name}}</td>
				<td>{{$broken->item_id}}</td>
			</tr>
		@endforeach
	</tbody>
       
</table>



 @if ($brokens->has('links'))
 {{ $brokens->links('vendor.pagination.bootstrap-4') }}
 @endif
</div>
<div class="col-md-4 col-sm-6 col-xs-6 hidden-print">
@include('layouts.errorMessages')
       <div class="panel panel-info">
            <div class="panel-heading color-black text-center color-black"><b class="color-black">زیادکردنی مەوادی تەلەفکراو</b></div>
            <div class="panel-body">
				<form class='text-right form-horizontal' method="POST" action="/broken/store" id="addForm">
					{{csrf_field()}}
					

	<div class="form-group">

	<div class="col-md-12">
	    <div class="input-group">
		<input type="text" name="barcode" onblur="getItemPrice(this.value,this.id)" class="form-control" id="item0" >
		<span class="input-group-addon">:کۆد</span>
	</div>
	

	</div>
	</div>
<div class="form-group">

	<div class="col-md-12">
	    <div class="input-group">
	<input type="text" readonly="readonly" class="form-control" id="name0"  name="name" class="form-control" >
			<span class="input-group-addon">:ناو</span>   
	    </div>

	</div>
	</div>
<div class="form-group">
		<div class="col-md-12">
	    <div class="input-group">
			<input  name="quantity" class="form-control">
			<span class="input-group-addon">ژمارە</span>

		</div></div></div>
	



<div class="form-group">
<div class="col-md-12">
		<button type="submit" class="btn btn-primary btn-block">تۆمارکردن </span></button>
</div>
</div>

					</form>
					</div>
	</div>

	
 

</div>
</div>
@endsection('content')
@section('afterFooter')
 <script type="text/javascript">
 	$(document).ready(function () {
  $("#menu-top li a").removeClass("menu-top-active");              
  $('#item').addClass('menu-top-active');
  });
 </script>

 @endsection