@extends('layouts.master')
@section('content')
<br>

<style>
	.input-group-addon{color:black;min-width:130px;font-weight: bold}
</style>


<div class="row">

<div class="col-md-6 col-sm-6 col-xs-10 col-md-offset-3 col-sm-offset-3 col-xs-offset-1 hidden-print" id="box">
<div class="text-center" style="margin-top:10px;">
 <span class="h3 text-center color-white"><bd>فۆڕمی پارە ناردن</bd></span>
 </div>               
<hr>
<form class="form-horizontal" method="POST" action="/transfers/store/{{$transfer->id}}" id="contact_form">
	{{csrf_field()}}
	
	<div class="form-group">

	<div class="col-md-12">
	    <div class="input-group">
	    <select name="supplier_id" class="form-control">
	    @foreach ($suppliers as $supplier)
	    @if($supplier->id==$transfer->supplier_id)
	    	<option selected="selected" value="{{$supplier->id}}">{{$supplier->name}}</option>
	    @else
	    	<option value="{{$supplier->id}}">{{$supplier->name}}</option>
	    @endif

	    
	    @endforeach
	    </select>
		<span class="input-group-addon">:ناوی کۆمپانیا</span>
 
	    </div>

	</div>
	</div>





<div class="form-group">

	<div class="col-md-12">
	    <div class="input-group">
	<input type="text" class="form-control"  name="amount" value="{{$transfer->amount}}" class="form-control" id="dinars">
			<span class="input-group-addon">بڕی پارە</span>   
	    </div>

	</div>
	</div>
	
	 <div class="form-group">
    <div class="col-md-12 inputGroupContainer">
            <div class="input-group">
                <input class="form-control" type="date" value="{{$transfer->created_at->format('Y-m-d')}}" name="created_at"/>
                <span class="input-group-addon">بەروار</span>
            </div>
        </div>
    </div>
	
	
{{--	<div class="form-group">

	<div class="col-md-12">
	    <div class="input-group">
	<input type="date" class="form-control"  name="created_at" value="{{$transfer->created_at}}" class="form-control" id="dinars">
			<span class="input-group-addon">بەروار</span>   
	    </div>

	</div>
	</div>  --}}
	
	
	
<div class="form-group">

	
	</div>

<div class="form-group">
	<div class="col-md-12 inputGroupContainer">
            <div class="input-group">
                <textarea class="form-control" name="description">{{$transfer->description}}</textarea>
                <span class="input-group-addon">زانیاری</span>
            </div>
        </div>
    </div>

<div class="form-group">
	
<div class="col-md-8 col-sm-12">	
		<button type="submit" class="btn btn-success btn3d btn-lg btn-block"> <strong>تۆمارکردن </strong>    </button>
</div>
</div>

</form>
</div>
</div>


@endsection
@section('afterFooter')
 <script type="text/javascript">
 	$(document).ready(function () {
  $("#menu-top li a").removeClass("menu-top-active");              
  $('#admin').addClass('menu-top-active');
  });
 </script>

 @endsection