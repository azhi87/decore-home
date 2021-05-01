@extends('layouts.master')
<style>
    @media print {
        .pagebreak {
            page-break-before: always;
        }

        /* page-break-after works, as well */
    }
</style>
@section('content')

<div class="row bordered-2 gradient4 ">
    <img class="visible-print" width="1165" src="{{asset('/public/img/decorheader.jpg')}}" alt=" Decor Home Mobilya">
</div>

<div class="row bordered-1">
    <div class="table-responsive tfs14boldp">
        <table class="table  text-center table-responsive">

            <tr class="h5">
                <td style="border:1px solid black; direction: rtl;" colspan="3"><span class="bd">&nbsp; ناونیشان:&nbsp;</span>{{$sale->customer->city}}--{{$sale->customer->garak}}--{{$sale->customer->kolan}}--{{$sale->customer->mal}}</td>
                <td style="border:1px solid black;"><span class="bd">&nbsp; ناوی کڕیار : </span>{{$sale->customer->name}}</td>
            </tr>

            <tr class="h5">
                <td style="border:1px solid black;" colspan="2"> {{$sale->created_at->format("Y/m/d H:i A")}}<span class="bd">&nbsp; :بەروار</span></td>
                <td style="border:1px solid black;"><span class="bd">&nbsp; تێل ٢:&nbsp;</span>{{$sale->customer->tel2}}</td>
                <td style="border:1px solid black;">{{$sale->customer->tel}}<span class="bd">:تێل </span></td>
            </tr>

            <tr class="h5">
                <td style="border:1px solid black;"><span>&nbsp; جۆر: </span> {{($sale->qistType())}}</td>
                <td style="border:1px solid black;" class="text-center"> {{$sale->support_no}} : ژ،.پشتگیری </td>
                <td style="border:1px solid black;">{{$sale->id}}<span class="bd">&nbsp; :ژ. وەصل</span></td>
                <td style="border:1px solid black;" class="bg-info"> {{$sale->branch->name}}</td>
            </tr>
            <tr>           
                 <td colspan="4" style="direction: rtl;" ><span class="bd"  style="direction: rtl; text-align: right;" > تێبینی: </span>{{$sale->description}}</td> 
            </tr>
        </table>
    </div>
    @if($sale->installments>0)
    <img class="visible-print" width="1165" src="{{asset('/public/img/decor.jpg')}}" alt=" Decor Home Mobilya">
    @endif
</div>

<div class="row bordered-1">
    <table class="table table-bordered table-striped table-responsive table-text-center tfs12boldp  ">
        <thead>
            <tr class="bg-success">
                <th>کۆ</th>
                <th>نرخ</th>
                <th>دانە</th>
                <th>ناوی کاڵا</th>
                <th>کۆدی کاڵا</th>
            </tr>
        </thead>

        <tbody>
            @foreach($sale->items as $item)
            <tr>
                <td>{{$item->pivot->ppi * $item->pivot->quantity}}</td>
                <td>{{$item->pivot->ppi}}</td>
                <td>{{$item->pivot->quantity}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->id}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<div class="row bordered-2">
    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 15px !important;">
        <table class="table table-text-center tfs16boldp">
            <tbody>
                <tr>
                    <td class="col-print-11  bg-warning text-danger bordered-2" style="text-align: center; vertical-align: middle; line-height: 30px; "> {{number_format($sale->total,2)}} :کۆی داواکراو </td>

                    <td class="col-print-11  bg-warning text-danger bordered-2" style="text-align: center; vertical-align: middle; line-height: 30px; "> {{number_format($sale->discount,2)}} :داشکاندن</td>

                    <td class="col-print-11  bg-warning text-danger bordered-2" style="text-align: center; vertical-align: middle; line-height: 30px; "> {{number_format($sale->total+$sale->discount,2)}}: کۆی پسوڵە </td>
                </tr>

                <tr>
                    <td class="col-print-11 bg-warning text-danger bordered-2" style="text-align: center !important; ; vertical-align: middle !important; ; line-height: 30px !important; "> {{number_format($sale->total-$sale->actualPaid(),2)}} : کۆی قیستی ماوە</td>

                    <td class="col-print-11  bg-warning text-danger bordered-2" style="text-align: center; vertical-align: middle; line-height: 30px; "> {{number_format($sale->actualPaid(),2)}} :کۆی دراو</td>

                    <td class="col-print-11  bg-warning text-danger bordered-2" style="text-align: center; vertical-align: middle; line-height: 30px; "> {{number_format($sale->initial_amount,2)}} :پێشەکی</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row bordered-2 gradient4" style="padding-top: 2px !important; ">
    <img class="visible-print" width="1165" src="{{asset('/public/img/decor-footerr.jpg')}}" alt=" Decor Home Mobilya">
</div>

<div class="pagebreak"> </div>

@if($sale->installments>0)

<div class="row bordered-2 gradient4">
    <img class="visible-print" width="1165" src="{{asset('/public/img/decorheader.jpg')}}" alt=" Decor Home Mobilya">
</div>

<div class="row bordered-1">
    <div class="table-responsive tfs14boldp">
        <table class="table  text-center table-responsive">
            <tr class="h5">
                <td style="border:1px solid black; direction: rtl;" colspan="2"><span class="bd">&nbsp; ناونیشان:&nbsp;</span>{{$sale->customer->city}}--{{$sale->customer->garak}}--{{$sale->customer->kolan}}--{{$sale->customer->mal}}</td>

                <td style="border:1px solid black;"><span class="bd">&nbsp; ناوی کڕیار : </span>{{$sale->customer->name}}</td>
            </tr>

            <tr class="h5">
                <td style="border:1px solid black;"><span class="bd">&nbsp; ناوی کارمەند :</span>{{$sale->user->name}}</td>
                <td style="border:1px solid black;"><span class="bd">&nbsp; تێل ٢:&nbsp;</span>{{$sale->customer->tel2}}</td>
                <td style="border:1px solid black;">{{$sale->customer->tel}}<span class="bd">:تێل </span></td>
            </tr>

            <tr class="h5">
                <td style="border:1px solid black;" colspan="2"> {{$sale->created_at->format("Y/m/d H:i A")}}<span class="bd">&nbsp; :بەروار</span></td>
                <td style="border:1px solid black;" class="bg-info"> {{$sale->branch->name}}</td>
            </tr>

            <tr class="h5">
                <td style="border:1px solid black;"><span>&nbsp; جۆر: </span> {{($sale->qistType())}}</td>
                <td style="border:1px solid black;" class="text-center"> {{$sale->support_no}} : ژ،.پشتگیری </td>
                <td style="border:1px solid black;">{{$sale->id}}<span class="bd">&nbsp; :ژ. وەصل</span></td>
            </tr>
        </table>
    </div>
</div>

<div class="row bordered-1">
    <table class="table table-bordered table-striped table-responsive table-text-center tfs14boldp ">
        <thead>
            <tr class="bg-success">
                <th>ئیمزا</th>
                <th>ناوی وەرگر</th>
                <th>بەروار</th>
                <th> کۆی پارەی دراو </th>
                <th>پارەی دراو - دۆلار </th>
                <th> پارەی دراو - دینار</th>
                <th>پارەی داواکراو</th>
                <th>قیست</th>
            </tr>
        </thead>

        <thead>
            <?php $i = 1; ?>
            @foreach($sale->ins as $ins)
            <?php if ($ins->calculatedPaid == 0) {
                $name = '----';
            } else {
                $name = $ins->user->name;
            }
            ?>
            <tr>
                <th class="col-print-1"></td>
                <th class="col-print-11">{{$name}}</td>
                <th class="col-print-11 ">{{$ins->created_at->format('d/ m/ Y')}}</th>
                <th class="col-print-11 ">{{number_format($ins->calculatedPaid,2)}}</th>
                <th class="col-print-11 ">{{number_format($ins->dollarsPaid,2)}}</th>
                <th class="col-print-11">{{number_format($ins->dinarsPaid)}}</th>
                <th class="col-print-2">{{number_format($ins->expectedPaid,2)}}</th>
                <th class="col-print-0 bg-warning text-danger">{{$i++}}</th>
            </tr>
            @endforeach
        </thead>
    </table>
</div>

<div class="row bordered-2">
    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 15px !important;">
        <table class="table table-text-center tfs16boldp">
            <tbody>
                <tr>
                    <td class="col-print-11  bg-warning text-danger bordered-2" style="text-align: center; vertical-align: middle; line-height: 30px; "> {{number_format($sale->total,2)}} :کۆی داواکراو </td>

                    <td class="col-print-11  bg-warning text-danger bordered-2" style="text-align: center; vertical-align: middle; line-height: 30px; "> {{number_format($sale->discount,2)}} :داشکاندن</td>

                    <td class="col-print-11  bg-warning text-danger bordered-2" style="text-align: center; vertical-align: middle; line-height: 30px; "> {{number_format($sale->total+$sale->discount,2)}}: کۆی پسوڵە </td>
                </tr>

                <tr>
                    <td class="col-print-11 bg-warning text-danger bordered-2" style="text-align: center !important; ; vertical-align: middle !important; ; line-height: 30px !important; "> {{number_format($sale->total-$sale->actualPaid(),2)}} : کۆی قیستی ماوە</td>

                    <td class="col-print-11  bg-warning text-danger bordered-2" style="text-align: center; vertical-align: middle; line-height: 30px; "> {{number_format($sale->actualPaid(),2)}} :کۆی دراو</td>

                    <td class="col-print-11  bg-warning text-danger bordered-2" style="text-align: center; vertical-align: middle; line-height: 30px; "> {{number_format($sale->initial_amount,2)}} :پێشەکی</td>
                </tr>
            </tbody>
    </div>
</div>

<div class="row bordered-2 gradient4" style="padding-top: 2px !important; ">
    <img class="visible-print" width="1165" src="{{asset('/public/img/decor-footerr.jpg')}}" alt=" Decor Home Mobilya">
</div>
@endif

<!--<div class="row bordered-1" style="background-color: #DCDCDC !important;">
<div class="col-md-12 col-xs-12 col-sm-12 text-center" >

<p style="padding-top: 6px;" class="h6 " ><strong> بۆ دامەزراندن و دروست کردنی هەموو جۆرە بەرنامەیەکی ژمێریاری و بەڕێوەبردن </strong></p>

<p class="contract h6"><strong> FB: facebook.com/techsaz || Website: techsaz.net  ||  Tel:  0750 194 1599</strong></p>


</div>
</div>-->


@endsection

@section('afterFooter')
<script type="text/javascript">
    $(document).ready(function() {
        $("#menu-top li a").removeClass("menu-top-active");
        $('#sale').addClass('menu-top-active');
        window.print();
    });

    function confirmDeleteSale(id) {
        $("#delete").attr('href', "/sale/delete/" + id);
        $('#myModal').modal('show');
    }
</script>
@endsection