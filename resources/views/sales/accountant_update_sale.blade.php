@extends('layouts.master')
@section('content')
<style type="text/css">
	.input-group-addon {
		font-weight: bold;
		padding: 4px;
	}
</style>
@include('sales.header')

<!-- Form Elements -->
<div class="col-lg-12 col-md-12 ">
	<div class="card">
		<div class="card-header text-center text-danger"><span class='h3'><b>گۆڕانکاری فرۆشتن</b></span> </div>

		<div class="card-content well">
			<form action='/sale/accountantUpdate/{{$sale->id}}' method='post' id="saleFormValidation" role="form">
				{{csrf_field()}}
				<input type="hidden" name="rate" value="{{$sale->rate}}" id="rate">
				<input type="hidden" name="customer_id" value="{{$sale->customer_id}}">

				<div class="row text-right color-black">

                    <div class="col-md-3"></div>

					<div class="row text-right color-black">
						<div class="col-md-8">
							<div class="form-group">
								<label> تێبینی</label>
								<textarea type="text" name="description" class="form-control border-input">{{$sale->description}} </textarea>
							</div>
						</div>
					</div>
				</div>

				<div class="row text-right color-black">
                    <div class="col-md-3"></div>
					<div class="col-md-4">
						<div class="form-group">
							<label> پارەی دراو دۆلار</label>
							<input readonly="readonly" type="text" name="dollars" id="dollars" value="{{$sale->dollars}}" onchange="getSaleTotalPrice();" onkeyup="getSaleTotalPrice();" class="form-control border-input" required>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label>پارەی دراو دینار</label>
								<input readonly="readonly" type="text" name="dinars" id="dinars" value="{{$sale->dinars}}" onchange="getSaleTotalPrice();" onkeyup="getSaleTotalPrice();" class="form-control border-input" required>
						</div>
					</div>

				</div>
				<div class="row text-right color-black">
				<div class="col-md-3"></div>
				 <div class="col-md-4">
                                            <div class="form-group">
                                                <label>2 پارەی دراو دۆلار</label>
            <input type="text" name="dollars_2" id="dollars_2" value="{{$sale->dollars_2}}" onchange="getSaleTotalPrice();" 
                    onkeyup="getSaleTotalPrice();" class="form-control border-input" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>2 پارەی دراو دینار</label>
            <input type="text" name="dinars" id="dinars_2" onchange="getSaleTotalPrice();" value="{{$sale->dinars_2}}"
                    onkeyup="getSaleTotalPrice();" class="form-control border-input" required>
                                </div>

				<br>
				<div class="text-center no-print">
					<input type="submit" name="submit" value="تۆمارکردن" class="btn-danger text-center btn-lg btn3d" />
				</div>

				<div class="clearfix"></div>
			</form>
		</div>
	</div>
</div>




@endsection

@section('afterFooter')
<script type="text/javascript">
	$("#menu-top li a").removeClass("menu-top-active");
	$('#sale').addClass('menu-top-active');

	$().ready(function() {
		$.validator.messages.required = '';
		$('#saleFormValidation').validate();
	});
</script>
@endsection