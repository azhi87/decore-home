@extends('layouts.master')
<style>
  @media print {

    #container {
      position: absolute;
      top: 0;
      right: 10;
      left: 10;
      bottom: 0;
    }

    #top_div {
      position: absolute;
      top: 0;
      right: 10;
      left: 10;
      bottom: 50%;
      text-align: center;
    }

    #bottom_div {
      position: absolute;
      top: 50%;
      right: 10;
      left: 10;
      bottom: 0;
      text-align: center;
    }
</style>
@section('content')

<div id="container" >

  @if($sale->installments>0)
  <div id="top_div">
    <div class="row bordered-2">
      <img class="visible-print" width="1050" src="{{asset('/public/img/decorheader.jpg')}}" alt=" Decor Home Mobilya">
    </div>

    <div class="row bordered-1">
      <table class="table table-bordered table-striped table-responsive table-text-center tfs10boldp ">
        <thead>
          <tr class="h5">
            <td style="border:1px solid black; padding: 2px;" colspan="3"><span class="bd">&nbsp; ناوی کڕیار : </span>{{$sale->customer->name}}</td>
            <td style="border:1px solid black; padding: 2px;" colspan="2">{{$sale->id}}<span class="bd">&nbsp; :ژ. وەصل</span></td>
          </tr>
          <tr class="h5">
            <td style="border:1px solid black; padding: 2px;" colspan="3"> {{$sale->created_at->format("Y/m/d H:i A")}}<span class="bd">&nbsp; :بەروار</span></td>
            <td style="border:1px solid black; padding: 2px;" colspan="2">{{$sale->customer->tel}}<span class="bd">:تێل </span></td>
          </tr>
          <tr class="bg-success">
            <th style="padding: 2px;">ئیمزا</th>
            <th style="padding: 2px;">بەروار</th>
            <th style="padding: 2px;"> کۆی پارەی دراو </th>
            <th style="padding: 2px;">پارەی داواکراو</th>
            <th style="padding: 2px;">قیست</th>
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
          @if($ins->created_at>=\Carbon\Carbon::Now() || $ins->calculatedPaid>0)
          <tr class="text-center h6 ">
            @else
          <tr class="text-center h6 bg-danger">
            @endif
            <th style="padding: 2px;" class="col-print-2">
              </td>
            <th style="padding: 2px;" class="col-print-11 ">{{$ins->created_at->format('d/ m/ Y')}}</th>
            <th style="padding: 2px;" class="col-print-11 ">{{number_format($ins->calculatedPaid,2)}}</th>
            <th style="padding: 2px;" class="col-print-2">{{number_format($ins->expectedPaid,2)}}</th>
            <th style="padding: 2px;" class="col-print-0 bg-warning text-danger">{{$i++}}</th>
          </tr>
          @endforeach
        </thead>

      </table>
    </div>
    <div class="row bordered-1">
      <table class="table table-bordered table-striped table-responsive table-text-center tfs16boldp ">
        <tr>
          <td colspan="2" class="col-print-11  bg-warning text-danger bordered-2" style="padding: 5px; text-align: center; vertical-align: middle ; line-height: 40px; ">
            {{number_format($sale->total-$sale->actualPaid(),2)}} : کۆی قیستی ماوە
          </td>

          <td colspan="2" class="col-print-11  bg-warning text-danger bordered-2" style="padding: 5px; text-align: center; vertical-align: middle; line-height: 40px; ">
            {{number_format($sale->actualPaid(),2)}} :کۆی دراو
          </td>

          <td colspan="2" class="col-print-11 bg-warning text-danger bordered-2" style="padding: 5px; text-align: center; vertical-align: middle; line-height: 40px; ">
            {{number_format($sale->total,2)}} :کۆی داواکراو
          </td>
        </tr>
        <tr>
          <td colspan="2" class=" hidden col-print-11  bg-warning text-danger bordered-2" style=" padding: 4px; text-align: center; vertical-align: middle; line-height: 20px; "> {{number_format($sale->discount,2)}} :داشکاندن</td>

          <td colspan="2" class="hidden col-print-11  bg-warning text-danger bordered-2" style="padding: 4px; text-align: center; vertical-align: middle; line-height: 20px; "> {{number_format($sale->total+$sale->discount,2)}}: کۆی پسوڵە </td>

          <td colspan="2" class="hidden col-print-11  bg-warning text-danger bordered-2" style="padding: 4px; text-align: center; vertical-align: middle; line-height: 20px; "> {{number_format($sale->initial_amount,2)}} :پێشەکی</td>
        </tr>
      </table>
    </div>
  </div>
  @endif


  @if($sale->installments>0)
  <div id="bottom_div">

    <div class="row bordered-2 gradient4">
      <img class="visible-print" width="1050" height="100" src="{{asset('/public/img/decorheader.jpg')}}" alt=" Decor Home Mobilya">
    </div>

    <div class="row bordered-1">
      <table class="table table-bordered table-striped table-responsive table-text-center tfs10boldp ">
        <thead>
          <tr class="h5">
            <td style="border:1px solid black; padding: 2px;" colspan="3"><span class="bd">&nbsp; ناوی کڕیار : </span>{{$sale->customer->name}}</td>
            <td style="border:1px solid black; padding: 2px;" colspan="2">{{$sale->id}}<span class="bd">&nbsp; :ژ. وەصل</span></td>
          </tr>
          <tr class="h5">
            <td style="border:1px solid black; padding: 2px;" colspan="3"> {{$sale->created_at->format("Y/m/d H:i A")}}<span class="bd">&nbsp; :بەروار</span></td>
            <td style="border:1px solid black; padding: 2px;" colspan="2">{{$sale->customer->tel}}<span class="bd">:تێل </span></td>
          </tr>
          <tr class="bg-success">
            <th style="padding: 2px;">ئیمزا</th>
            <th style="padding: 2px;">بەروار</th>
            <th style="padding: 2px;"> کۆی پارەی دراو </th>
            <th style="padding: 2px;">پارەی داواکراو</th>
            <th style="padding: 2px;">قیست</th>
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
          @if($ins->created_at>=\Carbon\Carbon::Now() || $ins->calculatedPaid>0)
          <tr class="text-center h6 ">
            @else
          <tr class="text-center h6 bg-danger">
            @endif
            <th style="padding: 2px;" class="col-print-2">
              </td>
            <th style="padding: 2px;" class="col-print-11 ">{{$ins->created_at->format('d/ m/ Y')}}</th>
            <th style="padding: 2px;" class="col-print-11 ">{{number_format($ins->calculatedPaid,2)}}</th>
            <th style="padding: 2px;" class="col-print-2">{{number_format($ins->expectedPaid,2)}}</th>
            <th style="padding: 2px;" class="col-print-0 bg-warning text-danger">{{$i++}}</th>
          </tr>
          @endforeach
        </thead>

      </table>
    </div>
    <div class="row bordered-1">
      <table class="table table-bordered table-striped table-responsive table-text-center tfs16boldp ">
        <tr>
          <td colspan="2" class="col-print-11  bg-warning text-danger bordered-2" style="padding: 5px; text-align: center; vertical-align: middle ; line-height: 40px; ">
            {{number_format($sale->total-$sale->actualPaid(),2)}} : کۆی قیستی ماوە
          </td>

          <td colspan="2" class="col-print-11  bg-warning text-danger bordered-2" style="padding: 5px; text-align: center; vertical-align: middle; line-height: 40px; ">
            {{number_format($sale->actualPaid(),2)}} :کۆی دراو
          </td>

          <td colspan="2" class="col-print-11 bg-warning text-danger bordered-2" style="padding: 5px; text-align: center; vertical-align: middle; line-height: 40px; ">
            {{number_format($sale->total,2)}} :کۆی داواکراو
          </td>
        </tr>
        <tr>
          <td colspan="2" class=" hidden col-print-11  bg-warning text-danger bordered-2" style=" padding: 4px; text-align: center; vertical-align: middle; line-height: 20px; "> {{number_format($sale->discount,2)}} :داشکاندن</td>

          <td colspan="2" class="hidden col-print-11  bg-warning text-danger bordered-2" style="padding: 4px; text-align: center; vertical-align: middle; line-height: 20px; "> {{number_format($sale->total+$sale->discount,2)}}: کۆی پسوڵە </td>

          <td colspan="2" class="hidden col-print-11  bg-warning text-danger bordered-2" style="padding: 4px; text-align: center; vertical-align: middle; line-height: 20px; "> {{number_format($sale->initial_amount,2)}} :پێشەکی</td>
        </tr>
      </table>
    </div>
  </div>
  @endif
</div>

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