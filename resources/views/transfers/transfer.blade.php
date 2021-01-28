@extends('layouts.master')
@section('content')
<br>

<div class="row hidden-print">
	<div class="col-md-12">
		<div class="col-md-3 col-sm-6 col-xs-12 hidden-print">
			<form method="POST" action="/transfers/searchBySupplier" >
					{{csrf_field()}}
					<div class="input-group has-warning">
					      <span class="input-group-btn">
					        <button class="btn btn-secondary btn-danger btn-fill" type="submit"><b>!گەڕان</b></button>
					      </span>
					      <select name="supplier_id" class="form-control">
                    	    @foreach ($suppliers as $supplier)
                    	    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                    	    @endforeach
	                        </select>
					</div>
			</form>
		</div>
{{--		<form method="POST" action="/transfers/searchByDate" >
			<div class="col-md-9">
				<div class="input-group">
					<span class="input-group-btn">
					        <button class="btn btn-secondary btn-danger btn-fill" type="submit"><b>!گەڕان</b></button>
					      </span>
					    <input type="date" name="to" class="form-control"/>
					    <span class="input-group-addon">بۆ</span>
					    <input type="date"  name="from" class="form-control" placeholder="کۆتا بەروار"/>
					</div>
			</div>		
		</form >   --}}
		
		
	</div>
</div>

<div class="row">
 <div class="col-md-8 col-sm-12 col-xs-12 table-responsive">
<table class="table table-bordered table-striped table-responsive">
	<thead class="bg-success">
		<tr class="custom_centered">
			<th class="hidden-print">گۆڕانکاری</th>
			<th>زانیاری زیاتر</th>
			<th>بڕی پارە</th>
{{--			<th>جۆری پارە</th>   --}}
			<th>ناوی کۆمپانیا</th>
			<th>ناردنی پارە</th>
		</tr>
	</thead>

	<tbody>
		@foreach($transfers as $transfer) 
			<tr class="text-center">
				<td class="hidden-print">
					<a href="/transfers/edit/{{$transfer->id}}"><span class="fa fa-edit fa-1x"></span></a>
				</td>
				<td>{{$transfer->description}}</td>
				<td>{{number_format($transfer->amount)}}</td>
		{{--		<td>{{$transfer->type}}</td>     --}}
				<td>{{$transfer->supplier->name}}</td>
				<td>{{$transfer->created_at}}</td>
			</tr>
		@endforeach
	</tbody>
</table>
<div class="text-center">
<h3><span class="label label-info"> سەرجەمی پارە  {{number_format($transfers->sum('amount'),0)}}</span></h3>

</div>
</div>

<div class="col-md-4 col-sm-5 col-xs-10 col-md-offset-0 col-sm-offset-7 col-xs-offset-0 hidden-print" id="box">
<div class="text-center" style="margin-top:10px;">
 <span class="h3 text-center color-white"><bd>فۆڕمی پارە ناردن</bd></span>
 </div>               
<hr>
<form class="form-horizontal" method="POST" action="/transfers/store" id="contact_form">
	{{csrf_field()}}
	
	<div class="form-group">

	<div class="col-md-12">
	    <div class="input-group">
	    <select name="supplier_id" class="form-control">
	    @foreach ($suppliers as $supplier)
	    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
	    @endforeach
	    </select>
		<span class="input-group-addon">ناوی کۆمپانیا</span>
 
	    </div>

	</div>

	</div>
<div class="form-group">

	<div class="col-md-12">
	    <div class="input-group">
	<input type="text" class="form-control"  name="amount"  class="form-control" required>
                                <span class="input-group-addon">بڕی پارە</span>   
	    </div>

	</div>
	
{{--		<div class="col-md-12">
	    <div class="input-group">
	<input type="date" class="form-control"  name="created_at"  class="form-control" required>
    <span class="input-group-addon">بەروار</span>   
	    </div>

	</div>    --}}
	
	</div>
	
	<div class="form-group">

	<div class="col-md-12">
	    <div class="input-group">
	    <select name="currency" class="form-control">
	    <option value="$">دۆلار</option>
	  {{--  <option value="IQD">دینار</option>   --}}
	    </select>
		<span class="input-group-addon">:جۆری دراو</span>
	    </div>
	</div>
	</div>
	
	 <div class="form-group">
    <div class="col-md-12 inputGroupContainer">
            <div class="input-group">
                <input class="form-control" type="date" name="created_at"/>
                <span class="input-group-addon">بەروار</span>
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
  $('#debtHeader').addClass('menu-top-active');
  });
 </script>

 @endsection