@extends('layouts.master')
@section('content')
<div class="card">

	<p class="text-center">
		<a type="button" href="/register" class="btn btn-primary btn-lg btn3d"> زیادکردنی بەکارهێنەر </span></a>
	</p>


	<div class="col-md-1 col-sm-0"></div>
	<div class="col-md-10 col-sm-10 col-xs-10 table-responsive text-center">
		<h4>بەشی بەکارهێنەرەکان</h4>
		<table class="table table-bordered table-striped table-responsive">
			<thead class="bg-success">
				<tr class="custom_centered">
					<th class="hidden-print">سڕکردن</th>
					<th class="hidden-print">گۆڕانکاری</th>
					<th>بەرواری دروستکردن</th>
					<th>جۆری بەکارهێنەر</th>
					<th>فەرع</th>
					<th>ئیمەیڵ</th>
					<th>ناو </th>
				</tr>
			</thead>

			<tbody>
				@foreach ($users as $user)
				<tr class="text-center">
					<?php $user->status=="0"?$btn="btn-primary":$btn="btn-danger";?>
					<td class="hidden-print">
						<a href="/users/toggle/{{$user->id}}" type="button" class="btn {{$btn}} btn3d"><span
								class="fa fa-power-off fa-1x"></span></a></td>
					<td class="hidden-print">
						<a href="/users/edit/{{$user->id}}"><span class="fa fa-edit fa-2x"></span></a>
					</td>
					<td>{{$user->created_at->format('d/m/Y')}}</td>
					<td>{{$user->typeText()}}</td>
					<td>{{$user->branchs()}}</td>
					<td>{{$user->email}}</td>
					<td>{{$user->name}}</td>
				</tr>
				@endforeach
			</tbody>

		</table>
	</div>
</div>
@endsection

@section('afterFooter')
<script type="text/javascript">
	$(document).ready(function () {
  $("#menu-top li a").removeClass("menu-top-active");              
  $('#user').addClass('menu-top-active');
  });
</script>

@endsection