@extends('layouts.master')
@section('content')
@include('purchases.header')

<div class="row hidden-print" >
      <div class="col-md-3 col-sm-3"></div>
    <div class="col-md-6 col-sm-6 text-right">
    <form method="POST" action="/purchase/search" id="addForm">
          {{csrf_field()}}
          <div class="input-group">
            <span class="input-group-btn">
                <button class="btn btn-secondary btn-danger btn-fill" type="submit"><b>!گەڕان</b></button>
            </span>
              <input type="text" name="purchase_id" class="form-control"/>
              <span class="input-group-addon">ژمارەی وەصل</span>
              <input type="text" name="invoice_id" class="form-control"/>
				  <span class="input-group-addon">کۆدی کڕین</span>
          </div>
    </form>
  </div>
 </div>

<div class="row">
  <div class="card col-md-12" data-background-color="white">
  <div class="card-header text-center"><span class='h3'><b>بەشی کڕین</b></span> </div>
  
  @foreach ($purchases as $purchase)
   <div class="card-content">     
  <div class="table-responsive" style="border:1px solid black;">             
    <table  class="table table-bordered1 text-center table-responsive">
      <tbody class="h5" style="background-color: #ede5af;">

       <tr>
               <td><span class="bd">کۆی کاڵا : </span>{{$purchase->items()->sum('quantity')}}</td>
            <td>{{$purchase->created_at->format('d/m/Y')}}<span >&nbsp; :بەروار</span></td>
            <td colspan="1"><span ><b>ناوی فرۆشیار : </b></span>{{$purchase->supplier->name}}</td>
            <td>{{$purchase->id}}<span>&nbsp; : ژمارەی وەصل </span></td>
       </tr>

       <tr>
            <td colspan="1"><span >داشکاندن : </span>{{$purchase->discount}}</td>
            <td colspan="1"><span >تێچووی زیادە : </span>{{$purchase->extra}}</td>
            <td >{{$purchase->paid}}<span>&nbsp; :پارەی دراو</span></td>
            <td><span><b>&nbsp; کۆی پسوڵە : </b></span> {{number_format($purchase->total)}}</td>
       </tr>
       <tr>
            
            <td <span > ناوی کارمەند : </span>{{$purchase->user->name}}</td> 
              
            <td colspan="2" class="text-right">{{$purchase->description}}</td>
            <td><span > زانیاری</span></td>
            
       </tr>
   </tbody>
  </table>

<div class="table-responsive text-center">
<table class="table">
   <thead>
       <tr class="text-center color-bottom-txt danger">
          <th class="text-center">کۆ</th>
           <th class="text-center">ژمارە</th>
            <th class="text-center">نرخی هەر مەوادێک</th>
           <th class="text-center">ناوی مەواد</th>
           <th class="text-center">کۆدی مەواد</th>
           <th class="text-center">#</th>
       </tr>
   </thead>
   <tbody >
<?php $i=1;?>
@foreach ($purchase->items as $item)
        <tr class="text-center">
            <td>{{$item->pivot->quantity * $item->pivot->ppi}}</td>
            <td>{{$item->pivot->quantity}}</td>
            <td>{{$item->pivot->ppi}}</td>
            <td>{{$item->name}}</td>
            <td >{{$item->id}}</td>
            <td>{{$i}}</td>
        </tr>
 <?php $i++;?>       
@endforeach

   </tbody>
</table>


</div>
 

@if(Auth::user()->type=="admin")
<div class="text-center">
<a class="btn btn-danger" onclick='confirmDelete("{{$purchase->id}}")'><span class="fa fa-trash fa-2x"></span></a>
<a class="btn btn-primary" href="/purchase/edit/{{$purchase->id}}"><span class="fa fa-edit fa-2x"></span></a>

</div>
<br/>
@endif
 </div>
 </div>
<br/>


     @if ($purchases->count())
    {{ $purchases->links('vendor.pagination.bootstrap-4') }}
   @endif
@endforeach
   

</div>
</div>
@endsection

   
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">سڕینەوەی کڕین</h4>
      </div>
      <div class="modal-body text-center">
        <h3>دڵنیایت لە سڕینەوەی ئەم کڕینە؟</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">نەخێر</button>
        <a id="delete" href="" type="button" class="btn btn-danger">بەڵێ</a>
      </div>
    </div>
  </div>
</div>
@section('afterFooter')
<script type="text/javascript">
function confirmDelete(id)
{
$("#delete").attr('href', "/purchase/delete/"+id);
$('#myModal').modal('show');
}
</script>
@endsection