@extends('layouts.master')
@section('content')

<div class="col-md-4 col-sm-3 col"></div>

<div class="col-md-4 col-sm-6 col-xs-6 hidden-print">
@include('layouts.errorMessages')
       <div class="panel panel-info">

                <div class="panel-heading text-center">
                <span class="color-black h3"><b>گۆڕانکار لە مەصروفات</b></span>
                </div>
                <div class="panel-body">
					<form class='text-right' method="POST" action="/expenses/store/{{$expense->id}}" id="addForm">
					{{csrf_field()}}
					<fieldset class="form-group">
					<label for="name">بڕی پارە</label>
					<div class="input-group">
					    <select type="text" name="currency"  class="form-control">
					    <option value="IQD"></option>
					    </select>
					    <span class="input-group-addon">-</span>
					    <input type="text" value="{{$expense->amount}}" name="amount" class="form-control"/>
					</div>
					</fieldset>
					
					<fieldset class="form-group has-warning">
							<label for="name">هۆکار</label>
							<select type="text" name="reason"  class="form-control">
        			            <option value="{{$expense->reason}}" selected>{{$expense->reason}}</option>
							    @foreach($reasons as $reason)
            			            <option value="{{$reason->name}}">{{$reason->name}}</option>
            			        @endforeach
					    </select>
							<textarea class="form-control" name="reason_new" placeholder="هۆکاری نوێ"></textarea>
					</fieldset>
						
					<fieldset class="form-group">
							<label for="name">تێبینی</label>
							<textarea class="form-control" value="{{$expense->note}}" name="note">{{$expense->note}}</textarea>
					</fieldset>
						
					<fieldset class="form-group">
							<label for="name">بەروار</label>
							<input type="date" class="form-control" name="created_at" value="{{$expense->created_at->format('Y-m-d')}}"/>
					</fieldset>
					
						<div class="form-group text-center">
						<button type="submit" class="btn btn-primary btn-lg ">تۆمارکردن</button>
						</div>
					</form>
					</div>
	</div>
@endsection


@section('afterFooter')
 <script type="text/javascript">
 	$(document).ready(function () {
  $("#menu-top li a").removeClass("menu-top-active");              
  $('#exchange').addClass('menu-top-active');
  });
 </script>

 @endsection