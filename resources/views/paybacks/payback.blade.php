@extends('layouts.master')
@section('content')
<br>

<style>
	.input-group-addon{color:black;min-width:130px;font-weight: bold}
</style>


<div class="row">
 <div class="col-md-8 col-sm-12 col-xs-12 table-responsive">
<table class="table table-bordered table-striped table-responsive">
	<thead class="bg-success">
		<tr class="custom_centered">
			<th class="hidden-print">گۆڕانکاری</th>
			<th>زانیاری زیاتر</th>
			<th>بڕی پارەی دراو</th>
			<th>ناوی محاسب</th>
			<th>بەرواری پارە گەڕانەوە</th>
		</tr>
	</thead>

	<tbody>
		@foreach($paybacks as $payback) 
			<tr class="text-center">
				<td class="hidden-print">
					<a href="/paybacks/edit/{{$payback->id}}"><span class="fa fa-edit fa-1x"></span></a>
				</td>
				<td>{{$payback->description}}</td>
				<td>{{number_format($payback->paid)}}</td>
				<td>{{$payback->user->name}}</td>
				<td>{{$payback->created_at->format('d/m/Y')}}</td>
			</tr>
		@endforeach
	</tbody>
</table>
</div>

<div class="col-md-4 col-sm-5 col-xs-10 col-md-offset-0 col-sm-offset-7 col-xs-offset-0 hidden-print">
<div class="panel panel-primary">
                <div class="panel-heading text-center">
                  <span class=""><b> فۆرمی پارەگەڕانەوە</b></span>
                </div>
                <div class="panel-body">
<form class="form-horizontal" method="POST" action="/paybacks/store" id="contact_form">
	{{csrf_field()}}
	
	<div class="form-group">

	<div class="col-md-12">
	    <div class="input-group">
	    <select name="user_id" class="form-control">
	    @foreach ($users as $user)
	    <option value="{{$user->id}}">{{$user->name}}</option>
	    @endforeach
	    </select>
		<span class="input-group-addon">:ناو</span>
 
	    </div>

	</div>
	</div>
<div class="form-group">

	<div class="col-md-12">
	    <div class="input-group">
	<input type="text" class="form-control"  name="paid" value="0" class="form-control" id="dinars">
			<span class="input-group-addon">:بڕی پارەی وەرگیراو</span>   
	    </div>

	</div>
	</div>
<div class="form-group">
	<div class="col-md-12 inputGroupContainer">
            <div class="input-group">
                <textarea class="form-control" name="description"></textarea>
                <span class="input-group-addon">زانیاری</span>
            </div>
        </div>
    </div>

<div class="form-group">
	
<div class="col-md-8 col-sm-12">	
		<button type="submit" class="btn btn-primary btn3d btn-lg btn-block"> <strong>تۆمارکردن </strong>    </button>
</div>
</div>

</form>
</div>
</div>

</div>
</div>

@endsection
@section('afterFooter')
 <script type="text/javascript">
 	$(document).ready(function () {
  $("#menu-top li a").removeClass("menu-top-active");              
  $('#debtHeader').addClass('menu-top-active');
  });
 </script>

 @endsection