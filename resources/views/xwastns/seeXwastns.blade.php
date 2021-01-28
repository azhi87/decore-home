@extends('layouts.master')
<?php $user=new \App\User();$users=$user->users();?>
@section('content')
@include('xwastns.header')
<br/>
<div class="row">
<div class="card col-md-10 col-md-offset-1" data-background-color="white">
<div class="card-header text-center"><span class='h3'><b>بەشی خواستن</b></span> </div>
<br/>
@foreach($xwastns as $xwastn)

  <div class="card-content">     
  <div class="table-responsive" style="border:1px solid black;">             
    <table  class="table table-bordered1 text-center table-responsive">
      <tbody style="background-color: #ede5af;">
       <tr class="h5">
          <td>{{$xwastn->customer->tel}}<span class="bd">:تێل </span></td>
          <td><span class="bd">&nbsp; ناوی کڕیار : </span>{{$xwastn->customer->name}}</td>
       </tr>

       <tr class="h5">
          <td><span class="bd">&nbsp; ناوی کارمەند :</span>{{$xwastn->user->name}}</td>
          <td>{{$xwastn->created_at}}<span class="bd">&nbsp; :بەروار</span></td>
       </tr>
        <tr class="h5">
          <td colspan="2">{{$xwastn->branch->name}}</td>
       </tr>
     
       
   </tbody>
  </table>

<div class="table-responsive text-center">
<table class="table">
   <thead>
       <tr class="text-center btn-success color-black">
          <th class="text-center">زانیاری زیاتر</th>
          <th class="text-center">ژمارە</th>
          <th class="text-center">ناوی مەواد</th>
       </tr>
   </thead>
   <tbody >



        <tr class="text-center">
            <td><b>{{$xwastn->description}}</b></td>
            <td><b>{{$xwastn->quantity}}</b></td>
            <td><b>{{$xwastn->item_name}}</b></td>
        </tr>
  
   </tbody>
</table> 

</div>
</div>
</div> 
<div class="text-center">

@if(Auth::user()->type=="admin")
<a class="btn btn-danger" onclick='confirmXwastnDelete("{{$xwastn->id}}")'><span class="fa fa-trash fa-2x"></span></a>
@endif
</div>
<br/>
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

$(document).ready(function () {
  $("#menu-top li a").removeClass("menu-top-active");              
  $('#xwastns').addClass('menu-top-active');
  });
function confirmDeleteSale(id)
{
$("#delete").attr('href', "/xwastns/delete/"+id);
$('#myModal').modal('show');
}
</script>
@endsection