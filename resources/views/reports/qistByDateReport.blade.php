@extends('layouts.master')
@section('content')

<div class="card col-md-12">
<div class="row bordered-2">
<div class="col-md-12 col-sm-12 text-center">
<br>
    <p class="h3"><strong>     خەرجی ڕۆژانە + حسابی هاتوو </strong>  </p> 
<br>
</div>
</div>

<div class="row bordered-1" >
    <table class="table table-borderless tfs16bold">
    <tbody  class="text-center">
      <tr>
            <td class="col-md-2 col-print-3 h5 text-right" class="bordersolid"><strong> {{$to}}</strong></td>
            <td class="col-md-2 col-print-2 h5 text-left" class="backcsilver"><strong>: بۆ بەرواری </strong></td> 
            <td class="col-md-2 col-print-3 h5 text-right" class="bordersolid"><strong> {{$from}}</strong></td>
            <td class="col-md-2 col-print-2 h5 text-left" class="backcsilver"><strong>: لە بەرواری </strong></td>
            <td class="col-print-1"></td> 
      </tr>
    </tbody>
</table>
</div>

<div class="text-right">
<h3 class="text-right "> <span class="label box-bcolor "> بەشی قیست</span></h3>
<div class="row bordered-1">
        <table class="table table-bordered  table-responsive table-text-center">
    <thead>
        <tr class="bg-info">
            <th> پارەی وەرگیراو - دینار</th>  
            <th>پارەی وەرگیراو - دۆلار</th>  
            <th>ژمارەی وەصل</th>        
            <th>ناوی کڕیار</th>
            <th>ناوی کارمەند</th>
        </tr>
    </thead>
       
			@foreach ($installments as $in)
            @if($in->calculatedPaid!=0)
            <tr>
					<td class=""> {{number_format($in->dinarsPaid)}} </td>
					<td class=""> {{number_format($in->dollarsPaid,2)}} </td>
                    <td><a href="/installments/{{$in->sale_id}}">{{$in->sale_id}}</a></td>
					<td class="text-danger"> {{$in->sale->customer->name}}</td>
					<td class="text-danger"> {{$in->user->name}}</td>
			</tr>
            @endif
			@endforeach
</table>
</div>
</div>


<div class="text-right">
<h3 class="text-right "> <span class="label box-bcolor "> بەشی وەسڵ</span></h3>
<div class="row bordered-1">
        <table class="table table-bordered  table-responsive table-text-center">
    <thead>
        <tr class="bg-info">
            <th> پارەی وەرگیراو - دینار</th>  
            <th>پارەی وەرگیراو - دۆلار</th>  
            <th>ناوی کڕیار</th>
            <th>ناوی کارمەند</th>
        </tr>
    </thead>
       
			@foreach ($sales as $in)
            <tr>
					<td class=""> {{number_format($in->dinars)}} </td>
					<td class=""> {{number_format($in->dollars,2)}} </td>
					<td class="text-danger"> {{$in->customer->name}}</td>
					<td class="text-danger"> {{$in->user->name}}</td>
			</tr>
			@endforeach
</table>
</div>
</div>

<div class="text-right">
<h3 class="text-right "> <span class="label box-bcolor "> بەشی خەرجیەکان</span></h3>
<div class="row bordered-1">
        <table class="table table-bordered  table-responsive table-text-center">
    <thead>
        <tr class="bg-info">
            <th> پارە  - دینار</th>  
            <th>پارە - دۆلار</th>  
            <th هۆکار</th>
            <th>ناوی کارمەند</th>
        </tr>
    </thead>
       
			@foreach ($expenses as $in)
            <tr>
					<td class=""> {{number_format($in->dinars)}} </td>
					<td class=""> {{number_format($in->dollars,2)}} </td>
					<td class="text-danger"> {{$in->id}} - {{$in->reason}}</td>
					<td class="text-danger"> {{$in->user->name}}</td>
			</tr>
			@endforeach
</table>
</div>
</div>

<div class="print-single text-right">
<h3 class="text-right "> <span class="label box-bcolor "> حسابی کۆتایی </span></h3>
<div class="row bordered-1" >
        <table class="table text-center tseparate table-bordered tfs14boldc tfs12boldp margin-1">
      <tbody class="bordered-1">
        <tr>
            <td class="col-print-3  text-danger bg-warning">IQD {{number_format($sales->sum('dinars')+$installments->sum('dinarsPaid'))}}  </td>
            <td class="col-print-3  text-danger bg-warning">$ {{number_format($sales->sum('dollars')+$installments->sum('dollarsPaid'),2)}}       </td>
            <td class="col-print-4 bg-info"> : کۆی گشتی هاتووی  </td>
        </tr>

        <tr  >
           <td class="col-print-3  text-danger bg-warning">IQD {{number_format($expenses->sum('dinars'))}} </td>
            <td class="col-print-3  text-danger bg-warning">$ {{number_format($expenses->sum('dollars'),2)}} </td>
            <td class="bg-info"> :کۆی گشتی خەرجی  </td>
        </tr>

        <tr  >
           <td class="col-print-3  text-danger bg-warning">IQD {{number_format($sales->sum('dinars')+$installments->sum('dinarsPaid')-$expenses->sum('dinars'))}} </td>
            <td class="col-print-3  text-danger bg-warning">$ {{number_format($sales->sum('dollars')+$installments->sum('dollarsPaid')-$expenses->sum('dollars'),2)}} </td>
            <td class="bg-info"> :کۆی گشتی پارە  </td>
        </tr>



         <tr  >
           <td class="col-print-3  text-danger bg-warning"> </td>
            <td class="col-print-3  text-danger bg-warning"> </td>
            <td class="bg-info"> :  تەسلیم کرا بە </td>
        </tr>


         <tr  >
           <td class="col-print-3  text-danger bg-warning"> </td>
            <td class="col-print-3  text-danger bg-warning"> </td>
            <td class="bg-info"> : باقیات ماوە</td>
      </tr>
 </tbody>
</table>
</div>
</div>

</div>

@endsection

@section('afterFooter')
 <script type="text/javascript">
    $(document).ready(function () {
  $("#menu-top li a").removeClass("menu-top-active");              
  $('#report').addClass('menu-top-active');
  });
 </script>

 @endsection