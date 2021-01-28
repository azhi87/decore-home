@extends('layouts.master')

@section('content')
<div class="row " style="border-style: double !important;" >

 
<div class="col-sm-12 col-md-12 col-xs-12 text-center" style="padding-top: 15px !important;" >

  <p style="font-size: 36px !important;"> کۆمپانیایی فۆرئێڤەر کلین </p> 
  <p class="tfs16boldc tfs16boldp "> بریکاری بەرهەمەکانی پیرۆز ..... سلێمانی</p> 
  <p class="tfs16boldc tfs16boldp "> 0750 122 7194   *   0770 137 6102</p> 

</div>

<br>

<div class="col-md-12 col-xs-12 col-xs-12 ">
<table class="table tfs20boldc tfs18boldp " >
  <tbody>
    <tr class=" bordered-0 ">

    <td  class="text-center " > پسووڵەی پارە وەرگرتن</td>
       
    </tr>
  </tbody>
</table>
</div>
</div>



<div class="row" style="border-style: double !important;">

<div class="col-sm-12 col-md-12 col-xs-12" style="padding-top: 5px !important; padding-bottom: 5px !important;" >

<table class="table table-responsive margin-1 tfs18boldp">

<tbody  >
    <tr >
  <td class=" text-right"> {{$debt->created_at}}</td>
  <td class=" text-left"> :بەروار</td>

  <td class=" text-right"> {{$debt->id}} </td>
  <td class=" text-right"> :ژ.پسوڵە </td>

</tbody>  
</table>

<table class="table table-responsive margin-1 tfs18boldp">

<tbody  >
    <tr class="text-right">

    <td >  {{$debt->customer->id}} </td>
    <td > :کۆدی کڕیار</td>
    </tr>

</tbody>  

<tbody>
    <tr class="text-right">

    <td >{{$debt->customer->name}}</td>
    <td >:بەڕێز</td>
    </tr>

</tbody>  
  <tr class="text-right">

    <td >{{$debt->customer->garak->city->city}} {{$debt->customer->garak->garak}} </td>
    <td > :  ناونیشان</td>
    </tr>

</tbody>  

</table>

<table class="table table-responsive margin-1 tfs20boldp">

<tbody  >
    <tr class="  text-right ">
    <td > {{number_format($debt->dinars,0)}}</td>
    <td > : (IQ) پارەی دراو بە دینار  </td>
    </tr>

</tbody>  

<tbody  >
    <tr class="  text-right ">
    <td >{{number_format($debt->dollars,2)}}</td>
    <td > :($) پارەی دراو بە دۆلار </td>
    </tr>
</tbody> 

<tbody  >
    <tr class=" text-right ">
    <td style="font-size: 28px !important;" > {{number_format($debt->calculatedPaid,2)}} </td>
    <td > : ($) بڕی پارەی دراو  </td>
    </tr>

</tbody>  

<tbody  >
    <tr class=" text-right ">
    <td > {{$debt->rate}} </td>
    <td > :($) شکانەوەی دۆلار </td>
    </tr>

</tbody>  

<tbody  >
    <tr class=" text-right ">

    <td style="font-size: 28px !important;"> {{number_format(($debt->customer->customerDebt() - $debt->calculatedPaid),2)}} </td>
    <td > :($) باقیات  </td>
    </tr>

</tbody>  

</table>

</div>
</div>

<br/>
<br/>


<div class="row   " style="border-style: double !important;">
<div class="col-md-12 col-sm-12 col-xs-12 " >

<table class="table tfs20boldp margin-1" >
  <tbody >
    
    <tr class="text-right">

    <td >{{$debt->user->name}}</td>
    <td > :ناوی وەرگر</td>
    </tr>
</tbody>
</table>

<br/>

<table class="table table-text-center  tfs16boldc tfs20boldp " >
  <tbody >
    
    <tr >

    <td class="col-md-3  " > </td>
    <td class="col-md-1  "> ئیمزای پێدەر </td>
    
    <td class="col-md-4  " > </td>
    <td class="col-md-1  "> ئیمزای وەرگر </td>
   
    </tr>
</tbody>
</table>
<br>
<br>
<br>
<br>
<br>
<hr>

</div>
</div>

@endsection

@section('afterFooter')
<script type="text/javascript">

$(document).ready(function () {
  window.print();
  });

</script>
@endsection