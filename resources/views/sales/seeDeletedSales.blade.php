@extends('layouts.master')
@section('content')

<div class="row">
<div class="card col-md-12" data-background-color="white">
<div class="card-header text-center"><span class='h3'><b>فرۆشتنە سڕاوەکان</b></span> </div>

@foreach($sales->sortByDesc('id') as $sale)

  <div class="card-content">     
  <div class="table-responsive" style="border:1px solid black;">             
    <table  class="table table-bordered1 text-center table-responsive">
      <tbody style="background-color: #ede5af;">
       
       <tr class="h5">
          <td>{{$sale->customer->tel}}<span class="bd">:تێل </span></td>
          <td><span class="bd">&nbsp; ناوی کڕیار : </span>{{$sale->customer->name}}</td>
          <td>{{$sale->id}}<span class="bd">&nbsp; :ژ. وەصل</span></td>
       </tr>

       <tr class="h5">
          <td><span class="bd">&nbsp; ناوی کارمەند :</span>{{$sale->user->name}}</td>
          <td>گواستراوە : {{$sale->statusText()}}</td>
          <td>{{$sale->created_at}}<span class="bd">&nbsp; :بەروار</span></td>
       </tr>
       
       <tr class="h5">
          <td ><span class="bd"> پارەی ماوە : </span>
            {{number_format($sale->total-$sale->actualPaid())}}
          </td>
          <td><span>&nbsp; جۆر: </span> {{($sale->qistType())}}</td>
          <td ><span>&nbsp; کۆی پسوڵە : </span> {{number_format($sale->total)}} </td>
       </tr>
       
       <tr class="h5">
           <td colspan="3">{{$sale->description}}<span class="bd">&nbsp; : کۆدی مەواد</s</td> 
       </tr>
             <tr class="h5">
          <td colspan="1" class="bg-info">{{$sale->updated_at}}<span class="bd">&nbsp; :بەرواری سڕینەوە</span></td>
           <td colspan="2" class="bg-danger"><span class="bd">&nbsp;    ناوی کارمەندی فرۆشتن: </span> {{$sale->mandwb->name}}</td> 
       </tr>
   </tbody>
  </table>

</div>
</div>

@endforeach
     @if ($sales->count())
    {{ $sales->links('vendor.pagination.bootstrap-4') }}
   @endif
</div>
</div>

@endsection
@section('afterFooter')
<script type="text/javascript">

$(document).ready(function () {
  $("#menu-top li a").removeClass("menu-top-active");              
  $('#sale').addClass('menu-top-active');
  });
function confirmDeleteSale(id)
{
$("#delete").attr('href', "/sale/delete/"+id);
$('#myModal').modal('show');
}
</script>
@endsection