    @extends('layouts.master')
    <?php $user=new \App\User();$users=$user->users();?>
    @section('content')
    @include('sales.header')

    <div class="row">
    <div class="card col-md-12 " data-background-color="white">
    <div class="card-header text-center"><span class='h3'><b>بەشی فرۆشتن</b></span> </div>

    @foreach($sales as $sale)

  <div class="card-content">     
  <div class="table-responsive" style="border:1px solid black;">             
        <table  class="table table-bordered1 text-center table-responsive">
        <tbody style="background-color: #ede5af;">
          
       <tr class="h5">
          <td>{{$sale->customer->tel}}<span class="bd">:تێل </span></td>
          <td><span class="bd">&nbsp; ناوی کڕیار : </span>&nbsp;{{$sale->customer->name}}</td>
          <td>{{$sale->id}}<span class="bd">&nbsp; :ژ. وەصل</span></td>
       </tr>

       <tr class="h5">
          <td><span class="bd">&nbsp; تێل ٢:&nbsp;</span>{{$sale->customer->tel2}}</td>
          <td>{{$sale->created_at}}<span class="bd">&nbsp; :بەروار</span></td>
          <td class="bg-info"> {{$sale->branch->name}}</td>
       </tr>
       
       <tr class="h5">
          <td colspan="1"><span class="bd">&nbsp; ناوی کارمەند :</span>{{$sale->user->name}}</td>
          <td style="direction: rtl;" colspan="2"><span class="bd">&nbsp; ناونیشان:&nbsp;</span>{{$sale->customer->city}}--{{$sale->customer->garak}}--{{$sale->customer->kolan}}--{{$sale->customer->mal}}</td>
       </tr>

       <tr class="h5">
          <td ><span class="bd"> پارەی ماوە : </span>{{number_format($sale->total-$sale->actualPaid())}}</td>
          <td ><span class="bd">  داشکاندن : </span>{{number_format($sale->discount)}}</td>
          <td ><span>&nbsp; کۆی پسوڵە : </span> {{number_format($sale->total)}} </td>
       </tr>
       
       <tr class="h5">           
                       <td style="border:1px solid black;"><span>&nbsp; جۆر: </span> {{($sale->qistType())}}</td>
        @if($sale->support=="1")
           <td class="bg-info">پشتگیری : {{$sale->supportText()}} -- ژمارە {{$sale->support_no}}</td>
           @else
            <td class="bg-danger">پشتگیری : {{$sale->supportText()}}</td>
           @endif
           
           <td class="bg-info">گواستراوە : {{$sale->statusText()}} - {{$sale->transferDate()}}</td>
       </tr>
        <tr>           
            <td colspan="3" style="direction: rtl;" ><span class="bd"  style="direction: rtl; text-align: right;" > تێبینی: </span>{{$sale->description}}</td> 
        </tr>
   </tbody>
  </table>

<div class="table-responsive text-center">
<table class="table">
   <thead>
       <tr class="text-center btn-success color-black">
          <th class="text-center">نرخی هەر مەوادێک</th>
          <th class="text-center">ژمارە</th>
          <th class="text-center">ناوی مەواد</th>
          <th class="text-center">کۆد</th>
       </tr>
   </thead>
  
   <tbody >   
   @foreach ($sale->items as $item)
        <tr class="text-center">
            <td><b>{{$item->pivot->ppi}}</b></td>
            <td><b>{{$item->pivot->quantity}}</b></td>
            <td><b>{{$item->name}}</b></td>
            <td><b>{{$item->id}}</b></td>
        </tr>
    @endforeach
   </tbody>
</table> 
</div>
</div> 

    <div class="text-center well">
    
    @if(Auth::user()->type=="admin" || Auth::user()->type=='accountant')

        <a class="btn btn-danger" onclick='confirmDeleteSale("{{$sale->id}}")'><span class="fa fa-trash fa-2x"></span></a>

        <a href="/sale/update/{{$sale->id}}"  class="btn  btn-circle btn-warning" ><span class="fa fa-edit fa-2x"></span></a>

        <a href="/sale/print/{{$sale->id}}" class="btn  btn-circle btn-success"><span class="fa fa-print fa-2x"></span></a>

    @endif
        
    @if(\Auth::user()->branch_id=='1' || \Auth::user()->branch_id=='2')
    @if(($sale->status=='0'))
          <a onclick='confirmTransferSale("{{$sale->id}}")' class="btn btn-lg btn-circle btn-info" >گواستنەوە</a>
    @endif
    @endif
        
    @if(\Auth::user()->branch_id==$sale->branch_id)
    @if(is_null($sale->support_no))
        <form method="get" action="/sale/support/{{$sale->id}}" class="form-inline">
             <input name="support_no" value="{{$sale->support_no}}" type="text" placeholder="پشتگیری">
             <input type="submit" class="btn">
         </form>
    @else
    <label class="label label-primary">{{$sale->support_no}}: ژ.پشتگیری</label>
    @endif
    @endif

</div>
</div>


<br/>
     @endforeach
     @if ($sales->count())
    {{ $sales->links('vendor.pagination.bootstrap-4') }}
   @endif
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

<div class="modal fade" id="myModala" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"> گواسنەوەی مەواد</h4>
      </div>
      <div class="modal-body text-center">
        <h3>دڵنیایت لە گواستنەوەی ئەم فرۆشتنە؟</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">نەخێر</button>
        <a id="transfer" href="" type="button" class="btn btn-danger">بەڵێ</a>
      </div>
    </div>
  </div>
</div>
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

<script type="text/javascript">
function confirmTransferSale(id)
{
$("#transfer").attr('href', "/sale/transfer/"+id);
$('#myModala').modal('show');
}
</script>
@endsection