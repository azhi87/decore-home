@extends('layouts.master')
@section('content')
{{-- @include('sales.header') --}}
<div class="col-lg-6 col-md-6 col-md-offset-3 well">
    <div clas="card ">
        <div class="card-header  text-center text-danger"><span class='h3'><b>بەشی گۆڕانکاری قیست</b></span> </div>
        <hr />
        <div class="card-content ">

            <form method="post" action='/installments/update' role="form">
                <div class="row text-right color-black">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>پارەی پارە - دینار</label>
                            <input type="text" class="form-control" name="dinars" value="{{$ins->dinarsPaid / 1000}}"
                                onchange="calculateDollars();" onkeyup="calculateDollars();" id="dinars">
                            <input type="hidden" value="{{$rate->rate}}" id="rate">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>بڕی پارە - دۆلار</label>
                            <input type="text" class="form-control" name="dollars" value="{{$ins->dollarsPaid}}"
                                id="dollars" onchange="calculateDollars();" onkeyup="calculateDollars();">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>کۆی پارە</label>
                            <input type="text" class="form-control" name="calculatedPaid"
                                value="{{$ins->calculatedPaid}}" id="calculatedPaid" required readonly="">
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label>بڕی پارەی داواکراو</label>
                            <input type="text" class="form-control" name="expectedPaid" value="{{$ins->expectedPaid}}"
                                required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>تێبینی</label>
                            <textarea class="form-control" name="description">{{$ins->description}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="text-danger"> {{$ins->created_at->format('Y-m-d')}} :بەرواری ڕاستەقینەی
                                پارەدان</label>
                            <input class="form-control" name="created_at"
                                value="{{ $ins->created_at->format('Y-m-d') }}" type="date">


                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{$ins->id}}" />
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-lg text-center"><strong>تۆمارکردن</strong>
                            </button>
                        </div>
                    </div>

                </div>

            </form>
        </div>






    </div>
</div>

@endsection