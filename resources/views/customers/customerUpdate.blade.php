@extends('layouts.master')
@section('content')

<div class="col-md-3 col-sm-3 col-xs-1 hidden-print">
</div>
<div class="col-md-6 col-sm-6 col-xs-10 hidden-print">
@include('layouts.errorMessages')

       <div class="panel panel-info">
                <div class="panel-heading text-center">
                  <span class="h3 color-black"><b>گۆڕانکاری فرۆشیار</b></span>
                </div>
         <div class="panel-body">
		
			<form class='text-right' method="POST" action="/customers/store/{{$customer->id}}" enctype="multipart/form-data" id="addForm">
			{{csrf_field()}}
			@if(Auth::user()->type=='mandwb')
			<div class="hidden">
			
			@else
			<div>
			@endif
			<fieldset class="form-group ">
					<label for="id">کۆدی فرۆشیار</label>
					<input readonly="readonly" type="text" value="{{$customer->id}}" class="form-control border-input" name="id" >
			</fieldset>

			<fieldset class="form-group">
					<label for="name">ناوی فرۆشیار</label>
					<input type="text" value="{{$customer->name}}" class="form-control border-input" name="name" required>
			</fieldset>
				
				</div>
				
				<fieldset class="form-group">
					<label for="formGroupExampleInput2">ژمارەی مۆبایل</label>
					<input type="text" value="{{$customer->tel}}" name="tel"  class="form-control border-input" id="formGroupExampleInput2" required>
				</fieldset>
				
				<fieldset class="form-group">
					<label for="formGroupExampleInput2">ژمارەی مۆبایل ٢</label>
					<input type="text" value="{{$customer->tel2}}" name="tel2"  class="form-control border-input" id="formGroupExampleInput2">
				</fieldset>
			
				<fieldset class="form-group">
					<label for="formGroupExampleInput2">شار</label>
					<input type="text" name="city" value="{{$customer->city}}" class="form-control border-input" id="formGroupExampleInput2">
				</fieldset>

				<fieldset class="form-group">
					<label for="formGroupExampleInput2">گەڕەك</label>
					<input type="text" name="garak" value="{{$customer->garak}}"  class="form-control border-input" id="formGroupExampleInput2">
				</fieldset>

				<fieldset class="form-group">
					<label for="formGroupExampleInput2">کۆلان</label>
					<input type="text" name="kolan" value="{{$customer->kolan}}" class="form-control border-input" id="formGroupExampleInput2">
				</fieldset>

				<fieldset class="form-group">
					<label for="formGroupExampleInput2">ماڵ</label>
					<input type="text" name="mal" value="{{$customer->mal}}" class="form-control border-input" id="formGroupExampleInput2">
				</fieldset>
				<button type="submit" class="btn btn-primary btn-lg btn-block">تۆمارکردن</button>
			</form>
	</div>
	</div>
	</div>
@endsection

@section('afterFooter')
 <script type="text/javascript">
 	$(document).ready(function () {
  $("#menu-top li a").removeClass("menu-top-active");              
  $('#customer').addClass('menu-top-active');
  });
 </script>

 @endsection