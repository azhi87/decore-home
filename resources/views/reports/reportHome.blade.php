@extends('layouts.master')

<?php $users = new App\User();  
		 $mandwbs = $users->users('mandwb');
	//	 $accountants = $users->users('accountant'); Not this way man
		  $accountants = $users->all();
		 $sale=new \App\Sale();
		 $branches=\App\Branch::all();
		 $cats=\App\Category::all();
?>
@section('content')

@if(Auth::user()->type=='admin' || Auth::user()->type=='accountant')
<div class="row">

	<div class="col-md-3 col-sm-6 col-xs-10">
		@include('layouts.errorMessages')
		<div class="card panel-info">
			<div class="panel-heading text-center">
				<span class='h5 color-black'> ڕاپۆرتی پارەی هاتوو - خەرجییەکان </span>
			</div>
			<div class="panel-body text-right">
				<form method="POST" action="/reports/qistByDate" id="contact_form">
					{{csrf_field()}}
					<fieldset class="form-group">
						<label for="id"> ناوی کارمەند</label>
						<select class="form-control" name="user_id">
							<option value="0">هەموو</option>
							@foreach ($accountants as $user)
							@if($user->email=='bilal@gmail.com')
							@continue;
							@endif
							<option value="{{$user->id}}"> {{$user->name}} </option>
							@endforeach
						</select>
					</fieldset>

					<fieldset class="form-group">
						<label for="id">لە بەرواری</label>
						<input type="date" class="form-control" name="from">
					</fieldset>
					<fieldset class="form-group">
						<label for="formGroupExampleInput2">بۆ بەرواری</label>
						<input type="date" class="form-control" name="to" required>
					</fieldset>
					<div class="form-group">
						<div class="col-md-12">
							<button type="submit" name="boxes" class="btn btn-primary btn-block btn3d"><strong>
									کارتۆن</strong></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	@endif
	{{-- ***********************************************************************
 --}}


	{{-- ***********************************************************************
 --}}
	@if(Auth::user()->type=='admin')
	<div class="col-md-3 col-sm-6 col-xs-10">
		@include('layouts.errorMessages')
		<div class="card panel-info">
			<div class="panel-heading text-center">
				<span class='h5 color-black'>قازانجی مەواد</span>
			</div>
			<div class="panel-body text-right">
				<form method="POST" action="/reports/profitByItemByDate" id="contact_form">
					{{csrf_field()}}
					<fieldset class="form-group">
						<label for="id">لە بەرواری</label>
						<input type="date" class="form-control" name="from">
					</fieldset>
					<fieldset class="form-group">
						<label for="formGroupExampleInput2">بۆ بەرواری</label>
						<input type="date" class="form-control" name="to" required>
					</fieldset>
					<div class="form-group">
						<div class="col-md-12">
							<button type="submit"
								class="btn btn-primary btn3d btn-block"><strong>گەڕان</strong></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>



	<div class="col-md-3 col-sm-6 col-xs-10">
		@include('layouts.errorMessages')
		<div class="card panel-info">
			<div class="panel-heading text-center">
				<span class='h5 color-black'> ڕاپۆرتی مەسروفات</span>
			</div>
			<div class="panel-body text-right">
				<form method="POST" action="/reports/expenseByCategory" id="contact_form">
					{{csrf_field()}}

					<fieldset class="form-group">
						<label for="id">لە بەرواری</label>
						<input type="date" class="form-control" name="from">
					</fieldset>
					<fieldset class="form-group">
						<label for="formGroupExampleInput2">بۆ بەرواری</label>
						<input type="date" class="form-control" name="to" required>
					</fieldset>
					<div class="form-group">
						<div class="col-md-12">
							<button type="submit" name="report"
								class="btn btn-primary btn3d btn-block"><strong>گەڕان</strong></button>

						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	{{-- ***********************************************************************
 --}}

	<div class="col-md-3 col-sm-6 col-xs-10">
		@include('layouts.errorMessages')
		<div class="card panel-info">
			<div class="panel-heading text-center">
				<span class='h5 color-black'> قازانجی گشتی</span>
			</div>
			<div class="panel-body text-right">
				<form method="POST" action="/reports/profit" id="contact_form">
					{{csrf_field()}}

					<fieldset class="form-group">
						<label for="id"> لق</label>
						<select class="form-control" name="branch_id">
							<option value="0">هەموو</option>

							@foreach ($branches as $branch)
							<option value="{{$branch->id}}"> {{$branch->name}} </option>
							@endforeach
						</select>
					</fieldset>

					<fieldset class="form-group">
						<label for="id">لە بەرواری</label>
						<input type="date" class="form-control" name="from">
					</fieldset>
					<fieldset class="form-group">
						<label for="formGroupExampleInput2">بۆ بەرواری</label>
						<input type="date" class="form-control" name="to" required>
					</fieldset>
					<div class="form-group">
						<div class="col-md-12">
							<button type="submit"
								class="btn btn-primary btn3d btn-block"><strong>گەڕان</strong></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	{{-- ***********************************************************************
 --}}

	<div class="col-md-3 col-sm-6 col-xs-10 hidden">
		@include('layouts.errorMessages')
		<div class="card panel-info">
			<div class="panel-heading text-center">
				<span class='h5 color-black'>قازانجی مەواد - کارمەند</span>
			</div>
			<div class="panel-body text-right">
				<form method="POST" action="/reports/stpReport" id="contact_form">
					{{csrf_field()}}
					<fieldset class="form-group">
						<label for="id">لە بەرواری</label>
						<input type="date" class="form-control" name="from">
					</fieldset>
					<fieldset class="form-group">
						<label for="formGroupExampleInput2">بۆ بەرواری</label>
						<input type="date" class="form-control" name="to" required>
					</fieldset>
					<div class="form-group">
						<div class="col-md-12">
							<button type="submit"
								class="btn btn-primary btn3d btn-block"><strong>گەڕان</strong></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>



</div>


{{-- ***********************************************************************
 --}}
<hr />
<div class="row">

	<div class="col-md-3 col-sm-6 col-xs-10">
		@include('layouts.errorMessages')
		<div class="card panel-info">


			<div class="panel-heading text-center">
				<span class='h5 color-black'>پارەی هاتوو</span>
			</div>
			<div class="panel-body text-right">
				<form method="POST" action="/reports/income">
					{{csrf_field()}}

					<fieldset class="form-group">
						<label for="id"> لق</label>
						<select class="form-control" name="branch_id">
							<option value="0">هەموو</option>

							@foreach ($branches as $branch)
							<option value="{{$branch->id}}"> {{$branch->name}} </option>
							@endforeach
						</select>
					</fieldset>
					<fieldset class="form-group">
						<label for="id">لە بەرواری</label>
						<input type="date" class="form-control" name="from">
					</fieldset>
					<fieldset class="form-group">
						<label for="formGroupExampleInput2">بۆ بەرواری</label>
						<input type="date" name="to" class="form-control" required>
					</fieldset>
					<div class="form-group">
						<div class="col-md-12">
							<button type="submit"
								class="btn btn-primary btn3d btn-block"><strong>گەڕان</strong></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	{{-- ***********************************************************************
 --}}
	@endif

	@if(Auth::user()->type=='admin' || Auth::user()->type=='accountant')
	<div class="col-md-3 col-sm-6 col-xs-10">
		@include('layouts.errorMessages')
		<div class="card panel-info">
			<div class="panel-heading text-center">
				<span class='h5 color-black'> قیستی دواکەوتوو بە پێی بەروار</span>
			</div>
			<div class="panel-body text-right">
				<form method="POST" action="/reports/due" id="contact_form">
					{{csrf_field()}}

					<fieldset class="form-group">
						<label for="id">لە بەرواری</label>
						<input type="date" class="form-control" name="from">
					</fieldset>
					<fieldset class="form-group">
						<label for="formGroupExampleInput2">بۆ بەرواری</label>
						<input type="date" class="form-control" name="to" required>
					</fieldset>

					<div class="col-md-12">

						<button type="submit" name="submit"
							class="btn btn-primary btn-block btn3d"><strong>گەڕان</strong></button>
					</div>
			</div>
			</form>
		</div>
	</div>

	@endif

	{{-- ***********************************************************************
 --}}
	@if(Auth::user()->type=='admin')
	<?php $suppliers=\App\Supplier::all();$customers=\App\Customer::all(); ?>
	<div class="col-md-3 col-sm-6 col-xs-10">
		@include('layouts.errorMessages')
		<div class="card panel-info">
			<div class="panel-heading text-center">
				<span class='h5 color-black'>ڕاپۆرتی فرۆشتن - کۆمپانیا </span>
			</div>
			<div class="panel-body text-right">
				<form method="POST" action="/reports/supplierSale" id="contact_form">
					{{csrf_field()}}
					<fieldset class="form-group">
						<label for="id"> ناوی کۆمپانیا</label>
						<select class="form-control" name="supplier_id">
							@foreach ($suppliers as $supplier)
							<option value="{{$supplier->id}}">{{$supplier->name}} </option>
							@endforeach
						</select>
					</fieldset>

					<fieldset class="form-group">
						<label for="id">لە بەرواری</label>
						<input type="date" class="form-control" name="from">
					</fieldset>
					<fieldset class="form-group">
						<label for="formGroupExampleInput2">بۆ بەرواری</label>
						<input type="date" class="form-control" name="to" required>
					</fieldset>

					<div class="col-md-12">
						<button type="submit" class="btn btn-primary btn-block btn3d"><strong>گەڕان</strong></button>
					</div>

				</form>
			</div>
		</div>
	</div>

	{{-- ***********************************************************************
 --}}
	<?php $suppliers=\App\Supplier::all(); ?>
	<div class="col-md-3 col-sm-6 col-xs-10">
		@include('layouts.errorMessages')
		<div class="card panel-info">
			<div class="panel-heading text-center">
				<span class='h5 color-black'> هاتوو و ڕۆیشتوو </span>
			</div>
			<div class="panel-body text-right">
				<form method="POST" action="/reports/stpSale" id="contact_form">
					{{csrf_field()}}
					<fieldset class="form-group">
						<label for="id"> کۆدی کاڵا</label>
						<input type="text" class="form-control" name="item_id" required>
					</fieldset>

					<fieldset class="form-group">
						<label for="id">لە بەرواری</label>
						<input type="date" class="form-control" name="from">
					</fieldset>
					<fieldset class="form-group">
						<label for="formGroupExampleInput2">بۆ بەرواری</label>
						<input type="date" class="form-control" name="to" required>
					</fieldset>

					<div class="col-md-12">

						<div class="col-md-6">
							<button type="submit" name="purchase"
								class="btn btn-primary btn-block btn3d"><strong>کڕین</strong></button>
						</div>
						<div class="col-md-6">

							<button type="submit" name="sale"
								class="btn btn-primary btn-block btn3d"><strong>فرۆشتن</strong></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>
{{-- ***********************************************************************
 --}}

<hr />
<div class="row">


	<div class="col-md-3 col-sm-6 col-xs-10">
		@include('layouts.errorMessages')
		<div class="card panel-info">
			<div class="panel-heading text-center">
				<span class='h5 color-black'> نرخی مەوادەکانی مەخزەن </span>
			</div>
			<div class="panel-body text-right">

				<a type="button" href='reports/stockValuation'
					class="btn btn-primary btn-block btn3d"><strong>گەڕان</strong></a>
			</div>
		</div>
	</div>

	{{-- ***********************************************************************
 --}}

	<div class="col-md-3 col-sm-6 col-xs-10 hidden">
		@include('layouts.errorMessages')
		<div class="card panel-info">
			<div class="panel-heading text-center">
				<span class='h5 color-black'> ڕاپۆرتی قیست</span>
			</div>
			<div class="panel-body text-right">

				<a type="button" href='reports/' class="btn btn-primary btn-block btn3d"><strong>گەڕان</strong></a>
			</div>


		</div>
	</div>

	{{-- ***********************************************************************
 --}}

	<?php $suppliers=\App\Supplier::all(); ?>
	<div class="col-md-3 col-sm-6 col-xs-10">
		@include('layouts.errorMessages')
		<div class="card panel-info">
			<div class="panel-heading text-center">
				<span class='h5 color-black'>ڕاپۆرتی قەرز - کۆمپانیا </span>
			</div>
			<div class="panel-body text-right">
				<form method="POST" action="/reports/supplierDebt" id="contact_form">
					{{csrf_field()}}

					<div class="col-md-12">
						<button type="submit" class="btn btn-primary btn-block btn3d"><strong>گەڕان</strong></button>
					</div>

				</form>
			</div>
		</div>
	</div>

	<div class="col-md-3 col-sm-6 col-xs-10">
		@include('layouts.errorMessages')
		<div class="card panel-info">
			<div class="panel-heading text-center">
				<span class='h5 color-black'> فرۆشتنە سڕاوەکان </span>
			</div>
			<div class="panel-body text-right">
				<form method="GET" action="/sale/seeDeletedSales" id="contact_form">
					{{csrf_field()}}

					<div class="col-md-12">
						<button type="submit" class="btn btn-primary btn-block btn3d"><strong>گەڕان</strong></button>
					</div>

				</form>
			</div>
		</div>
	</div>

</div>

{{-- ***********************************************************************
 --}}
<hr />
<div class="row">

	<div class="col-lg-6 col-sm-6">
		<div class="card">
			<div class="card-content">
				<div class="row">

					<div class="col-xs-6">
						<div class="numbers text-center ">
							<p><b><a class=" text-center" style="color:inherit;" href="/reports/supplierDebt"> سەرجەمی
										قەرزی کۆمپانیاکان</a></b> </p>
							{{number_format($sale->totalSupplierDebt(),0)}}
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<div class="col-lg-6 col-sm-6 ">
		<div class="card">
			<div class="card-content">
				<div class="row">

					<div class="col-xs-5">
						<div class="numbers text-center">
							<p class="text-center" style="color:inherit;"><b>سەرجەمی پارە لە قیستا</b></p>
							{{number_format($sale->totalQist(),2)}}
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>




</div>
</div>

<div class="col-md-3 col-sm-6 col-xs-10">
	@include('layouts.errorMessages')
	<div class="card panel-info">
		<div class="panel-heading text-center">
			<span class='h5 color-black'> ڕاپۆرتی نامە </span>
		</div>
		<div class="panel-body text-right">
			<form method="POST" action="/reports/sms" id="contact_form">
				{{csrf_field()}}
				<fieldset class="form-group">
					<label for="id"> کڕیار</label>
					<select name="customer_id" class="form-control select2">
						@foreach ($customers as $customer)
						<option value="{{$customer->id}}">{{$customer->name}} - {{$customer->tel}}</option>
						@endforeach
					</select>
				</fieldset>

				<fieldset class="form-group">
					<label for="id">لە بەرواری</label>
					<input type="date" class="form-control" name="from">
				</fieldset>
				<fieldset class="form-group">
					<label for="formGroupExampleInput2">بۆ بەرواری</label>
					<input type="date" class="form-control" name="to">
				</fieldset>

				<div class="col-md-12">
					<button type="submit" name="sale"
						class="btn btn-primary btn-block btn3d"><strong>فرۆشتن</strong></button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="col-md-3 col-sm-6 col-xs-10">
	@include('layouts.errorMessages')
	<div class="card panel-info">
		<div class="panel-heading text-center">
			<span class='h5 color-black'> ڕاپۆرتی فرۆشتن - ئێکزڵ</span>
		</div>
		<div class="panel-body text-right">
			<form method="POST" action="/sales/export" id="contact_form">
				{{csrf_field()}}

				<fieldset class="form-group">
					<label for="id"> لق</label>
					<select class="form-control" name="branch_id">
						<option value="0">هەموو</option>
						@foreach ($branches as $branch)
						<option value="{{$branch->id}}"> {{$branch->name}} </option>
						@endforeach
					</select>
				</fieldset>

				<fieldset class="form-group">
					<label for="id">لە بەرواری</label>
					<input type="date" class="form-control" name="from">
				</fieldset>
				<fieldset class="form-group">
					<label for="formGroupExampleInput2">بۆ بەرواری</label>
					<input type="date" class="form-control" name="to" required>
				</fieldset>
				<div class="form-group">
					<div class="col-md-12">
						<button type="submit" class="btn btn-primary btn3d btn-block"><strong>گەڕان</strong></button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
{{-- ***********************************************************************
 --}}



@endif


@endsection


@section('afterFooter')
<script type="text/javascript">
	$(document).ready(function () {
  $(".select2").select2();
  });
</script>

@endsection