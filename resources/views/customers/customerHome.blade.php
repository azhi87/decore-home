@extends('layouts.master')
@section('content')

<div class="row hidden-print">
	<div class="col-md-8 col-sm-6 col-xs-12 hidden-print">
		<form method="POST" class="form-inline" action="/customers/search" >
		{{csrf_field()}}
			<div class="input-group has-warning">
			      <span class="input-group-btn">
			        <button class="btn btn-secondary btn-danger btn-fill" type="submit"><b>!گەڕان</b></button>
			      </span>
			      <input type="text" name="name" class="form-control" placeholder="...ناوی کڕیار">
			      <span class="input-group-addon">ناو</span>
	
			      <input type="text" name="tel" class="form-control" placeholder="...ژمارەی مۆبایل">
			      <span class="input-group-addon">تێل</span>
			</div>
					
		</form>
	</div>
</div>

 <div class="row">
 <div class="col-md-9 col-sm-12 col-xs-12 table-responsive">
<table class="table table-bordered table-responsive table-striped">
	<thead class="bg-info">
		<tr class="custom_centered">
			<th class="hidden-print ">گۆڕانکاری</th>
			<th>ژ. مۆبایل ٢</th>
			<th>ژ. مۆبایل</th>
			<th>ناوی فرۆشیار</th>
			<th>کۆد</th>
		</tr>
	</thead>
<tbody>
		@foreach ($customers as $customer) 
		<tr class="text-center">
				<td class="hidden-print "><a href={{"/customers/edit/".$customer->id}}><span class="fa fa-edit fa-1x"></span></a></td>
				<td>{{$customer->tel2}}</td>
				<td>{{$customer->tel}}</td>
				<td>{{$customer->name}}</td>
				<td>{{$customer->id}}</td>
			</tr>
		@endforeach
	</tbody>
</table>

 {{ $customers->links('vendor.pagination.bootstrap-4') }}
 {{-- @if ($customer->has('links'))
 {{ $customers->links('vendor.pagination.bootstrap-4') }}
 @endif --}}
</div>
<div class="col-md-3 col-sm-6 col-xs-10 col-md-offset-0 col-sm-offset-6 col-xs-offset-0 hidden-print">
@if(Auth::user()->type!='mandwb')
@include('layouts.errorMessages')
       <div class="panel panel-primary">
                <div class="panel-heading text-center">
                 زیادکردنی کڕیارەکان
                </div>
         <div class="panel-body">
		
			<form class='text-right' method="POST" action="/customers/store" enctype="multipart/form-data" id="addForm">
			{{csrf_field()}}

				<fieldset class="form-group">
					<label for="name">ناوی فرۆشیار</label>
					<input type="text" class="form-control border-input" name="name" required>
				</fieldset>
				

				<fieldset class="form-group">
					<label for="formGroupExampleInput2">ژمارەی مۆبایل</label>
					<input type="text" name="tel"  class="form-control border-input" id="formGroupExampleInput2" required>
				</fieldset>

				<fieldset class="form-group">
					<label for="formGroupExampleInput2">ژمارەی مۆبایل ٢</label>
					<input type="text" name="tel2"  class="form-control border-input" id="formGroupExampleInput2">
				</fieldset>

				<fieldset class="form-group">
					<label for="formGroupExampleInput2">شار</label>
					<input type="text" name="city"  class="form-control border-input" id="formGroupExampleInput2">
				</fieldset>

				<fieldset class="form-group">
					<label for="formGroupExampleInput2">گەڕەك</label>
					<input type="text" name="garak"  class="form-control border-input" id="formGroupExampleInput2">
				</fieldset>

				<fieldset class="form-group">
					<label for="formGroupExampleInput2">کۆلان</label>
					<input type="text" name="kolan"  class="form-control border-input" id="formGroupExampleInput2">
				</fieldset>

				<fieldset class="form-group">
					<label for="formGroupExampleInput2">ماڵ</label>
					<input type="text" name="mal"  class="form-control border-input" id="formGroupExampleInput2">
				</fieldset>

				<button type="submit" class="btn btn-primary btn-lg btn3d btn-block"><b>تۆمارکردن</b></button>
			</form>
	</div>
	</div>
	
		 	      
@endif
</div>
</div>
@endsection('content')
@section('afterFooter')
 <script type="text/javascript">
 	$(document).ready(function () {
  $("#menu-top li a").removeClass("menu-top-active");              
  $('#customer').addClass('menu-top-active');
  });
 </script>

 @endsection