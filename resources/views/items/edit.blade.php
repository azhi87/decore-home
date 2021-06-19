@extends('layouts.master')
@section('content')

<div class="col-md-3 col-sm-3 col-xs-6 hidden-print">
</div>
<div class="col-md-6 col-sm-6 col-xs-6 hidden-print">
	@include('layouts.errorMessages')

	<div class="panel panel-info">
		<div class="panel-heading text-center">
			<span class="h3 color-black"><b>گۆڕانکاری کاڵا</b></span>
		</div>
		<div class="panel-body">

			<form class='text-right' method="POST" action="/items/update/{{$item->id}}" enctype="multipart/form-data"
				id="addForm">
				{{csrf_field()}}

				<fieldset class="form-group">
					<label for="id">کۆدی بەرنامە </label>
					<input type="text" value="{{$item->id}}" class="form-control border-input" name="id">
				</fieldset>

				<fieldset class="form-group">
					<label for="id">کۆدی کاڵا</label>
					<input type="text" value="{{$item->code}}" class="form-control border-input" name="code">
				</fieldset>

				<fieldset class="form-group">
					<label for="name">ناوی کاڵا</label>
					<input type="text" class="form-control" name="name" value="{{$item->name}}">
				</fieldset>

				<fieldset class="form-group">
					<label for="formGroupExampleInput2">سەبکاتیگۆری </label>
					<select class="form-control border-input select2" name="subcategory_id" required>
						@foreach ($subcategories as $subcategory)
						<option value="{{$subcategory->id}}"
							{{ $subcategory->id == $item->subcategory_id ? 'selected' : '' }}>
							{{ $subcategory->category->name }} -
							{{$subcategory->name}}</option>
						@endforeach
					</select>
				</fieldset>

				<fieldset class="form-group">
					<label for="formGroupExampleInput2">نرخی کڕین</label>
					<input type="text" name="purchase_price" value="{{$item->purchase_price}}" class="form-control"
						id="formGroupExampleInput2">
				</fieldset>

				<fieldset class="form-group">
					<label for="formGroupExampleInput2">نرخی فرۆشتن</label>
					<input type="text" name="sale_price" value="{{$item->sale_price}}" class="form-control"
						id="formGroupExampleInput2" required>
				</fieldset>

				<fieldset class="form-group">
					<label for="formGroupExampleInput2">کۆمپانیا</label>
					<select class="form-control" name="supplier_id">
						@foreach ($suppliers as $supplier)
						@if($supplier->id==$item->supplier_id)
						<option selected="selected" value="{{$supplier->id}}">{{$supplier->name}}</option>
						@else
						<option value={{$supplier->id}}>{{$supplier->name}}</option>
						@endif
						@endforeach
					</select>
				</fieldset>

				<fieldset class="form-group">
					<label for="formGroupExampleInput2">شێوە</label>
					<input type="text" name="shewa" value="{{$item->shewa}}" class="form-control border-input"
						id="formGroupExampleInput2">
				</fieldset>

				<fieldset class="form-group">
					<label for="formGroupExampleInput2">قوماش</label>
					<input type="text" name="qomash" value="{{$item->qomash}}" class="form-control border-input"
						id="formGroupExampleInput2">
				</fieldset>

				<fieldset class="form-group">
					<label for="formGroupExampleInput2">چەرم</label>
					<input type="text" name="charm" value="{{$item->charm}}" class="form-control border-input"
						id="formGroupExampleInput2">
				</fieldset>

				<fieldset class="form-group">
					<label for="formGroupExampleInput2">گۆشە</label>
					<input type="text" name="gozha" value="{{$item->gozha}}" class="form-control border-input"
						id="formGroupExampleInput2">
				</fieldset>

				<fieldset class="form-group">
					<label for="formGroupExampleInput2">ڕەنگ</label>
					<input type="text" name="color" value="{{$item->color}}" class="form-control border-input"
						id="formGroupExampleInput2">
				</fieldset>

				<fieldset class="form-group">
					<label for="formGroupExampleInput2">سرینەوەی مەواد</label>
					<select class="form-control" name='status'>
						@if($item->status=='0')
						<option value="1">نەخێر</option>
						<option style="color:red;font-size:20px;" value="0" selected>بەڵێ</option>
						@else
						<option value="1" selected>نەخێر</option>
						<option style="color:red;font-size:20px;" value="0">بەڵێ</option>
						@endif
					</select>
				</fieldset>

				<fieldset class="form-group">
					<label for="name">زانیاری</label>
					<textarea class="form-control" name="description">{{$item->description}}</textarea>
				</fieldset>

				<button type="submit" class="btn btn-primary btn-lg btn-block">تۆمارکردن</button>
			</form>
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