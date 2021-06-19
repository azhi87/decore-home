@extends('layouts.master')
@section('content')

<div class="row hidden-print">

	<div class="col-md-7 col-sm-12 col-xs-12 hidden-print">
		<form method="post" action="/items/search" class="form-inline text-center">
			{{csrf_field()}}

			<div class="col-md-10 col-sm-9">
				<select name="id" class="select2" id="select2" style="min-width: 500px;">
					<option value="0">گەڕان بۆ ناوی مەواد</option>
					@foreach ($items_all as $item1)
					<option value="{{$item1->id}}">{{$item1->id}}--{{$item1->name}}</option>
					@endforeach
				</select>

			</div>

			<div class="col-md-2 col-sm-3 input-group-btn">
				<button class="btn btn-magick btn3d btn3d-pull" type="submit"> <strong>گەڕان </strong><span
						class="fa fa-search fa-1x"></span></button>
			</div>
		</form>
	</div>

	<div class="col-md-4 col-sm-4 col-xs-10">
		<form method="POST" action="/cats/add">
			{{csrf_field()}}
			<div class="input-group has-warning">
				<span class="input-group-btn">
					<button class="btn btn-secondary btn-info btn-fill" type="submit"><b>!زیادکردن</b></button>
				</span>
				<input type="text" name="name" class="form-control border-input" placeholder="زیادکردنی جۆری مەواد">
			</div>
		</form>
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-9 col-sm-12 col-xs-12 table-responsive">
		<table class="table table-bordered table-striped table-responsive ">
			<thead class="bg-success">
				<tr class="custom_centered">
					<th class="hidden-print">گۆڕانکاری</th>
					<th>سەبکاتیگۆری</th>
					<th>گروپ</th>
					<th>ن/ فرۆشتن</th>
					<th>ن/ کڕین</th>
					<th>ناوی کاڵا</th>
					<th>کۆدی کاڵا </th>
					<th>کۆدی بەرنامە</th>
				</tr>
			</thead>

			<tbody>
				@php if(isset($searchItems)) {
				$items = $searchItems;
				}
				@endphp
				@foreach ($items as $item)

				<?php $sale_price=number_format($item->sale_price,2);
			  $purchase_price=number_format($item->purchase_price,2);
		?>

				<tr class="text-center">
					<td class="hidden-print"><a href={{"/items/edit/".$item->id}}><span
								class="fa fa-edit fa-1x"></span></a></td>
					<td>{{$item->subcategory->name}}</td>
					<td>{{$item->category->name}}</td>
					<td>{{$sale_price}}</td>
					<td>{{$purchase_price}}</td>
					<td>{{$item->name}}</td>
					<td>{{$item->code}}</td>
					<td>{{$item->id}}</td>
				</tr>
				@endforeach
			</tbody>

		</table>
		<div class="hidden-print">

			{{ $items->links('vendor.pagination.bootstrap-4') }}

		</div>
	</div>
	<div class="col-md-3 col-sm-6 col-xs-10 col-md-offset-0 col-sm-offset-6 hidden-print">
		@include('layouts.errorMessages')
		<div class="panel panel-primary">
			<div class="panel-heading text-center">
				<span class=""><b>ناساندنی کالا</b></span>
			</div>
			<div class="panel-body">

				<form class='text-right' method="POST" action="/items/store" id="addForm">
					{{csrf_field()}}
					<fieldset class="form-group">
						<label for="id">کۆدی بەرنامە </label>
						<input type="text" class="form-control border-input" name="id" required>
					</fieldset>

					<fieldset class="form-group">
						<label for="id">کۆدی کاڵا</label>
						<input type="text" class="form-control border-input" name="code">
					</fieldset>

					<fieldset class="form-group">
						<label for="name">ناوی کاڵا</label>
						<input type="text" class="form-control border-input" name="name" required>
					</fieldset>

					<fieldset class="form-group">
						<label for="formGroupExampleInput2">نرخی کڕین</label>
						<input type="text" value="0" name="purchase_price" class="form-control border-input"
							id="formGroupExampleInput2" required>
					</fieldset>

					<fieldset class="form-group">
						<label for="formGroupExampleInput2">نرخی فرۆشتن</label>
						<input type="text" value="0" name="sale_price" class="form-control border-input"
							id="formGroupExampleInput2" required>
					</fieldset>


					<fieldset class="form-group">
						<label for="formGroupExampleInput2">سەبکاتیگۆری </label>
						<select class="form-control border-input select2" name="subcategory_id" required>
							@foreach ($subcategories as $subcategory)
							<option value="{{$subcategory->id}}"> {{ $subcategory->category->name }} -
								{{$subcategory->name}}</option>
							@endforeach
						</select>
					</fieldset>

					<fieldset class="form-group">
						<label for="formGroupExampleInput2">کۆمپانیا</label>
						<select class="form-control border-input" name="supplier_id">
							@foreach ($suppliers as $supplier)
							<option value={{$supplier->id}}>{{$supplier->name}}</option>
							@endforeach
						</select>
					</fieldset>

					<fieldset class="form-group">
						<label for="formGroupExampleInput2">شێوە</label>
						<input type="text" name="shewa" class="form-control border-input" id="formGroupExampleInput2">
					</fieldset>

					<fieldset class="form-group">
						<label for="formGroupExampleInput2">قوماش</label>
						<input type="text" name="qomash" class="form-control border-input" id="formGroupExampleInput2">
					</fieldset>

					<fieldset class="form-group">
						<label for="formGroupExampleInput2">چەرم</label>
						<input type="text" name="charm" class="form-control border-input" id="formGroupExampleInput2">
					</fieldset>

					<fieldset class="form-group">
						<label for="formGroupExampleInput2">گۆشە</label>
						<input type="text" name="gozha" class="form-control border-input" id="formGroupExampleInput2">
					</fieldset>

					<fieldset class="form-group hidden">
						<label for="formGroupExampleInput2">حاڵەت</label>
						<input type="text" name="status" value="1" class="form-control border-input"
							id="formGroupExampleInput2">
					</fieldset>

					<fieldset class="form-group">
						<label for="formGroupExampleInput2">ڕەنگ</label>
						<input type="text" name="color" class="form-control border-input" id="formGroupExampleInput2">
					</fieldset>

					<fieldset class="form-group">
						<label for="name">زانیاری</label>
						<textarea class="form-control border-input" name="description"></textarea>
					</fieldset>
					<button type="submit" class="btn btn-primary btn3d btn-block"><b>تۆمارکردن</b></button>
				</form>
			</div>

		</div>
	</div>
</div>

@endsection('content')
@section('afterFooter')
<script type="text/javascript">
	$(document).ready(function () {
    $('.select2').select2();
  $("#menu-top li a").removeClass("menu-top-active");              
  $('#items/add').addClass('menu-top-active');
  });
</script>
@endsection