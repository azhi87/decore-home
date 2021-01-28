@extends('layouts.master')
@section('content')

<div class="row">

{{-- <img src="{{asset('storage/img_2.png')}}" alt="what">
 --}}

<div class="col-md-4 col-sm-6 col-xs-6 hidden-print">
	<form method="POST" action="/suppliers/search" >
{{csrf_field()}}
<div class="input-group">
      <span class="input-group-btn">
        <button class="btn btn-secondary btn-danger btn-fill" type="submit"><b>!گەڕان </b></button>
      </span>
      <input type="text" name="id" class="form-control border-input" placeholder="...گەڕان بۆ کۆمپانیا">
</div>
	</form>
  </div>
 </div>
 
<div class="row">

<div class="col-md-8 col-sm-12 col-xs-12 table-responsive">
<table class="table table-bordered table-striped table-responsive table-full-width">
	<thead class="bg-success">
		<tr class="custom_centered">
			<th class="hidden-print">گۆڕانکاری</th>
			<th>ناونیشان</th>
			<th>ئیمەیڵ/ويب سایت</th>
			<th>ناوی کۆمپانیا</th>
			<th>کۆد</th>
		</tr>
	</thead>

	<tbody>
	<?php if (isset($searchSuppliers))
		{ 	
			$suppliers=$searchSuppliers;
			$update=1;
		}
		else {
			$update=0;
			}
		?>

		@foreach ($suppliers as $supplier) 
			<tr class="text-center">
				
				<td class="hidden-print"><a href={{"/suppliers/edit/".$supplier->id}}><span class="fa fa-edit fa-1x "></span></a></td>
				<td>{{$supplier->address}}</td>
				<td>{{$supplier->mobile}}</td>
				<td>{{$supplier->name}}</td>
				<td>{{$supplier->id}}</td>
			</tr>
		@endforeach
	</tbody>
       
</table>
 @if ($update==0)
 {{ $suppliers->links('vendor.pagination.bootstrap-4') }}
 @endif
</div>

<div class="col-md-4 col-sm-6 col-xs-10 col-md-offset-0 col-sm-offset-6 hidden-print">
@include('layouts.errorMessages')
   
<div class="panel panel-info">
                <div class="panel-heading text-center">
                <span class="h4"> کۆمپانیاکان</span>
                </div>
                <div class="panel-body">
		
			<form class='text-right' method="POST" action="/suppliers/store" enctype="multipart/form-data" id="addForm">
			{{csrf_field()}}
			<fieldset class="form-group hidden">
					<label for="formGroupExampleInput2">کۆدی کۆمپانیا</label>
					<input type="text" name="id" class="form-control border-input " id="formGroupExampleInput2">
				</fieldset>

				<fieldset class="form-group">
					<label for="name">ناوی کۆمپانیا</label>
			<input type="text" class="form-control border-input" name="name" required>
				</fieldset>
				<fieldset class="form-group">
					<label for="formGroupExampleInput2">ئیمەیڵ/وێب سایت </label>
					<input type="text" name="mobile"  class="form-control border-input" id="formGroupExampleInput2">
				</fieldset>

				<fieldset class="form-group">
					<label for="formGroupExampleInput2">ناونیشان</label>
					<input type="text" name="address"  class="form-control border-input" id="formGroupExampleInput2" required>
				</fieldset>

				
				<button type="submit" class="btn btn-primary btn-lg btn-block"> <b>تۆمارکردن</b></button>
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
  $('#supplier').addClass('menu-top-active');
  });
 </script>

 @endsection