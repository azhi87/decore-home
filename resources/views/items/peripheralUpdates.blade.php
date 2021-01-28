@extends('layouts.master')

@section('content')
<br>

<div class="row">




<div class="col-md-4 col-sm-4">
<div class="panel panel-warning">
<div class="panel panel-heading text-center "> گۆڕانکاری لە شار </div>
<table class="table table-responsive table-text-center">

	<thead>
		<tr>
		<th>تۆمارکردن</th>
		<th>ناوی شار</th>
			
		</tr>
	</thead>
	<tbody>
	@foreach ($cities as $city)
	<form action="/city/edit/{{$city->id}}" method="POST">
		<tr >
<td ><button type="submit" class="btn btn-sm btn-primary"><b>تۆمارکردن</b></button></td>
<td ><input class="text-center" name="city"  type="text"  value="{{$city->city}}"></td>
		</tr>
	</form>
	@endforeach
	</tbody>
</table>

</div>
</div>



<div class="col-md-4 col-sm-4">
<div class="panel panel-success">
<div class="panel panel-heading text-center "> گۆڕانکاری لە گەڕەك</div>
<table class="table table-responsive table-text-center">

	<thead>
		<tr>
			<th>تۆمارکردن</th>
			<th>ناوی گەڕەک</th>
		</tr>
	</thead>
	<tbody>
	@foreach ($garaks as $garak)
	<form action="/garak/edit/{{$garak->id}}" method="POST">
		<tr >
<td ><button type="submit" class="btn btn-sm btn-primary"><b>تۆمارکردن</b></button></td>
<td ><input class="text-center" name="garak" type="text"  value="{{$garak->garak}}"></td>
		</tr>
	</form>
	@endforeach
	</tbody>
</table>
</div>
</div>


</div>
@endsection