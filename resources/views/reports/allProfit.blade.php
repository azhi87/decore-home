@extends('layouts.master')
@section('content')
<?php $sale=new \App\Sale();?>
<div class="row">

            <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                        <div class="card-header">
                                    <h4 class="card-title h3 text-center">ڕاپۆرتی قازانجی گشتی</h4>
                                    <p class="category text-center">لە بەرواری {{$from}} بۆ بەرواری {{$to}}</p>
                        </div>
            <div class="card-content table-responsive table-full-width">
                                    
        <table class="table table-hover text-center">
        <thead class="h3">
         <tr>
            <th class="text-center">دۆلار</th>
            <th class="text-center">  جۆر  </th>
        </tr>
        </thead>
        <tbody >

        <tr  class="success">
            <td>{{number_format($profits['purchase'],2)}} </td>
            <td> <b> سەرجەمی کڕین </b> </td>
        </tr>
         <tr >
            <td>{{number_format($profits['sale'],2)}}</td>
            <td><b> سەرجەمی فرۆشتن </b> </td>
        </tr>
         <tr class="danger">
            <td>{{number_format($profits['qist'],2)}}</td>
            <td><b> سەرجەمی قیست</b></td>
         </tr>
         
         <tr >
            <td> {{number_format($sale->totalSupplierDebt(),0)}}</td>
            <td><b>    سەرجەمی قەرزی کۆمپانیاکان </b> </td>
        </tr>
        
         <tr class="warning">
            <td> {{number_format($sale->totalQist(),0)}}</td>
            <td><b>سەرجەمی پارە لە قیستدا</b></td>
         </tr>
         <tr  >
            <td> {{number_format($profits['expense'],2)}}</td>
            <td><b> سەرجەمی مەصروفات</b></td>
        </tr>
   


         <tr class="info" >
            <td>{{number_format($profits['itemProfit'],2)}}</td>
            <td><b>قازانج لە فرۆشتنی مەواد </b> </td>
         </tr>  
 

         <tr class="h3" >
            <td >{{number_format($profits['totalProfit'],2)}}</td>
            <td > قازانجی گشتی  </td>
        </tr>  

 </tbody>
</table>
</div>
</div>
</div>
</div>

@endsection