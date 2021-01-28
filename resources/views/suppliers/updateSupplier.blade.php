@extends('layouts.master')

@section('content')
<br>

<div class="row">


{{-- <img src="{{asset('storage/img_2.png')}}" alt="what">
 --}}
<div class="col-md-3"></div>
<div class="col-md-6 col-sm-6 col-xs-6 .hidden-print">
@include('layouts.errorMessages')
       <div class="panel panel-info">
                <div class="panel-heading text-center">
                  <span class="h3 color-black "><b>زیادکردنی فرۆشیار</b></span>
                </div>
                <div class="panel-body">
		
			<form class='text-right' method="POST" action="/suppliers/store/{{$supplier->id}}" enctype="multipart/form-data" id="addForm">
			{{csrf_field()}}
			<fieldset class="form-group">
					<label for="formGroupExampleInput2">کۆدی کۆمپانیا</label>
					<input type="text" readonly="readonly" name="id" value="{{$supplier->id}}" class="form-control" id="formGroupExampleInput2">
				</fieldset>

				<fieldset class="form-group">
					<label for="name">ناوی کۆمپانیا</label>
			<input type="text" class="form-control" value="{{$supplier->name}}" name="name" required>
				</fieldset>
				<fieldset class="form-group">
					<label for="formGroupExampleInput2"> ئیمەیڵ</label>
					<input type="text" name="mobile" value="{{$supplier->mobile}}" class="form-control" id="formGroupExampleInput2">
				</fieldset>

				<fieldset class="form-group">
					<label for="formGroupExampleInput2">ناونیشان</label>
					<input type="text" name="address" value="{{$supplier->address}}"  class="form-control" id="formGroupExampleInput2" required>
				</fieldset>

				
				<button type="submit" class="btn btn-primary btn-lg btn-block">تۆمارکردن</button>
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