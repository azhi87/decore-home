@extends('layouts.master')
@section('content')

<div class="col-lg-12 col-md-12 ">
                        <div class="card well" >
                            <div class="card-header text-center text-danger"><span class='h3'><b>بەشی مەسروفات</b></span> 
                            </div>
                        <hr/>
<div class="row hidden-print">
	<div class="col-md-12 ">
		<div class="col-md-2 col-sm-6 col-xs-12 hidden-print hidden">
			<form method="POST" action="/expenses/searchReason" >
					{{csrf_field()}}
					<div class="input-group has-warning">
					      <span class="input-group-btn">
					        <button class="btn btn-secondary btn-danger btn-fill" type="submit"><b>!گەڕان</b></button>
					      </span>
					      <input type="text" name="reason" class="form-control" placeholder="...هۆکار">
					</div>
			</form>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12 hidden-print">
			<form method="POST" action="/expenses/searchUser" >
					{{csrf_field()}}
					<div class="input-group has-warning">
					      <span class="input-group-btn">
					        <button class="btn btn-secondary btn-danger btn-fill" type="submit"><b>!گەڕان</b></button>
					      </span>
					<select name="user_id" class="form-control">
							<option value="0">--هەموو--</option>
							@foreach ($users as $user)
							<option value="{{$user->id}}">{{$user->name}}</option>
							@endforeach
					</select>
			    	<span class="input-group-addon">کارمەند</span>
					</div>
			</form>
		</div>
		<form method="POST" action="/expenses/search" >
			<div class="col-md-3">
				<div class="input-group">
					<span class="input-group-btn">
					        <button class="btn btn-secondary btn-danger btn-fill" type="submit"><b>!گەڕان</b></button>
					      </span>
					<select name="branch_id" class="form-control">
							<option value="0">--هەموو--</option>
							@if(Auth::user()->type=='admin')
							    	@foreach ($branches as $branch)
							            <option value="{{$branch->id}}">{{$branch->name}}</option>
							        @endforeach
							@else
							            <option value="{{Auth::user()->branch_id}}"> {{Auth::user()->branch->name}}</option>
							@endif
						
					</select>
			    	<span class="input-group-addon">لق</span>
				</div>
			</div>

			<div class="col-md-3">
					<div class="input-group">
					    <input type="date" name="end_date" class="form-control"/>
					    <span class="input-group-addon">بۆ</span>
					    <input type="date"  name="start_date" class="form-control" placeholder="کۆتیا بەروار"/>
					</div>
			</div>		
		</form>
	</div>
</div>
 <br>

<div class="row">
	<div class="col-md-8 col-sm-12 col-xs-12 table-responsive">
<table class="table table-bordered table-striped table-responsive" >
	<thead class="bg-success">
		<tr class="custom_centered">
			<th class="hidden-print">گۆڕانکاری</th>
			<th>تێبینی</th>

			<th>بەروار</th>
			<th>هۆکار</th>
			<th> کۆی پارە</th>
			<th>دۆلار </th>
			<th>دینار </th>

			<th class="hidden-print">لق</th>
			<th class="hidden-print">ناوی کارمەند</th>
		</tr>
	</thead>

	<tbody>
	<?php if (isset($searchExpenses))
		{ 	
			$expenses=$searchExpenses;
			$update=1;
		}
		else {
			$update=0;
			}
		?>
		@foreach ($expenses as $expense)
			<tr class="text-center">
				<td class="hidden-print"><a href="/expenses/edit/{{$expense->id}}"><span class="fa fa-edit fa-1x "></span></a></td>
				<td>{{$expense->note}}</td>
	
				<td>{{$expense->created_at->format('Y-m-d')}}</td>
				<td>{{$expense->reason}}</td>
				<td>{{number_format($expense->amount,2)}}</span></td>
				<td>{{number_format($expense->dollars,2)}}</span></td>
				<td>{{number_format($expense->dinars)}}</span></td>
				<td class="hidden-print">{{$expense->branch->name}}</span></td>
				<td class="hidden-print">{{$expense->user->name}}</td>
			</tr>
		@endforeach
	</tbody>
       
</table>

	 <p class="text-center h3 text-danger color-red"><b>کۆی دۆلار : {{$expenses->sum('amount')}}</b></p>


 @if ($expenses->has('links'))
 {{ $expenses->links('vendor.pagination.bootstrap-4') }}
 @endif
</div>
<div class="col-md-4 col-sm-6 col-xs-10 col-md-offset-0 col-sm-offset-6 hidden-print">
@include('layouts.errorMessages')
       <div class="panel panel-info">
                <div class="panel-heading text-center">
                <span class="h4"><b> خەرجیەکان</b></span>
                </div>
                    <div class="panel-body">
					<form class='text-right' method="POST" action="/expenses/store" id="addForm">
					{{csrf_field()}}
					<fieldset class="form-group has-warning">
					<label for="name">  بڕی پارە بەدینار</label>
					<div class="input-group">
					    <select type="text" name="currency"  class="form-control hidden" >
					    <option value="IQD">IQD</option>
					    {{-- <option value="$">$</option> --}}
					    </select>
					    <span class="input-group-addon">هەزار</span>
					    <input type="text" value="0" min="0" onkeyup="calculateTotalPaid(0)" 
						onblur="calculateTotalPaid(0)" id="dinars"  name="dinars" 
						 class="form-control" onchange="calculateDollars();" onkeyup="calculateDollars();" />
					</div>
					</fieldset>
										
					<fieldset class="form-group has-warning">
					<label for="name">نرخی دۆلار</label>
					<div class="input-group">
					    <span class="input-group-addon">-</span>
					    <input type="text" id="rate" value="{{$rate->rate}}" onkeyup="calculateTotalPaid(0)" onblur="calculateTotalPaid(0)"  class="form-control"
					     onchange="calculateDollars();" onkeyup="calculateDollars();" readonly/>
					</div>
					</fieldset>

					<fieldset class="form-group has-warning">
					<label for="name">بڕی پارە بە دۆلار</label>
					<div class="input-group">
					    <span class="input-group-addon">-</span>
					    <input type="text" id="dollars" name="dollars" min="0" value="0"  onchange="calculateDollars();" onkeyup="calculateDollars();" class="form-control" required/>
					</div>
					</fieldset>

					<fieldset class="form-group has-warning">
					<label for="name">کۆی پارە</label>
					<div class="input-group">
					    <span class="input-group-addon">-</span>
					    <input type="text" id="calculatedPaid" min="0" name="amount" class="form-control" required readonly="" />
					</div>
					</fieldset>

						<fieldset class="form-group has-warning">
							<label for="name">هۆکار</label>
							<select type="text" name="reason"  class="form-control" >
							    <option></option>
							    @foreach($reasons as $reason)
            			            <option value="{{$reason->name}}">{{$reason->name}}</option>
            			        @endforeach
					    </select>
							<textarea class="form-control" name="reason_new" placeholder="هۆکاری نوێ"></textarea>
						</fieldset>
						
				    <fieldset class="form-group has-warning">
					<label for="name"> تێبینی</label>
					<div class="input-group">
					    <span class="input-group-addon">-</span>
					    <textarea type="text" name="note" cols="2" rows="2" class="form-control"/></textarea>
					</div>
					</fieldset>

						<div class="form-group text-center">
						<button type="submit" class="btn btn-primary btn-lg btn3d"><b>تۆمارکردن</b></button>
						</div>
					</form>
					</div>
	</div>
</div>
</div>
</div>
@endsection
@section('afterFooter')
 <script type="text/javascript">
 	$(document).ready(function () {
  $("#menu-top li a").removeClass("menu-top-active");              
  $('#expense').addClass('menu-top-active');

 
  });

 	

 </script>

 @endsection