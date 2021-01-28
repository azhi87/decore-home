@extends('layouts.master')
@section('content')

<style>
    @media print {
        @page {
            margin: 1;
        }

        #Header,
        #Footer {
            display: none !important;
        }
    }
</style>

<div class="hidden-print col-md-offset-5">
    <button class="bg-danger btn-lg" onclick="myFunction()">پرێنت کردن  </button>
</div>

<div class="row visible-print gradient4 ">
    <img class="visible-print" width="300" src="{{asset('/public/img/decorheader.jpg')}}" alt="  دیکۆر هۆم مۆبیلیات">
</div>

<div class=" table-fixed">
    <table class="table table-striped text-center pt-5"  >
        <tbody>
            <tr class="info">
                <td colspan="2" class="text-center"><strong style="font-size: 18px !important; font-weight: bold !important;">وەسڵی پارە وەرگرتن  قیست</strong></td>
            </tr>
            <tr class="info ">
                <td style="font-size: 10px !important;"  class="text-right bordered-1"><span>&nbsp;ژ.قیست:</span>&nbsp;{{$ins->id}}</td>
                <td style="font-size: 10px !important;" class="text-right bordered-1"><span>&nbsp;ژ.وەسڵ:</span>&nbsp;{{$ins->sale->id}}</td>
            </tr>

            <tr class="info ">
                <td style="font-size: 10px !important;" colspan="2" class="text-right bordered-1">&nbsp;ناوی کڕیار: &nbsp;{{ $ins->customer->name ?? '' }}</td>
            </tr>
            <tr class="info ">
                <td style="font-size: 10px !important;" class="text-right bordered-1"><span>&nbsp;کارمەند:</span>&nbsp;{{$ins->user->name}}</td>
                <td style="font-size: 10px !important;" class="text-right bordered-1"><span>&nbsp;بەروار:</span>&nbsp;{{$ins->created_at->format('d-m-yy')}}</td>
            </tr>
        </tbody>
    </table>

<div class=" table-fixed">
    <table class="table table-striped text-center pt-5" >
        <tbody>
                <tr>
                    <td class="col-print-11 bg-warning text-danger bordered-1" 
                    style="text-align: center !important; vertical-align: middle !important; line-height: 20px !important; font-size: 14px !important;"> 
                    {{number_format($ins->calculatedPaid,2)}}: کۆی دراو  </td>
                </tr>
                <tr>
                    <td class="col-print-11 bg-warning text-danger bordered-1" 
                    style="text-align: center !important; vertical-align: middle !important; line-height: 20px !important; font-size: 14px !important;">
                         {{number_format($ins->sale->total-$ins->sale->actualPaid(),2)}} :کۆی قیستی ماوە</td>
                </tr>
        </tbody>
    </table>
   
</div>

</div>

@endsection
@section('afterFooter')
<script>
$(document).ready(function () {
  $("#menu-top li a").removeClass("menu-top-active");              
  $('#sale').addClass('menu-top-active');
  window.print();
  });
</script>
@endsection