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
                <button class="btn btn-secondary btn-warning btn-fill" type="submit"><b>!گەڕان</b></button>
            </span>
              <input type="date" name="end_date" class="form-control"/>
              <span class="input-group-addon">بۆ</span>
              <input type="date"  name="start_date" class="form-control" placeholder="End"/>

          </div>
          
          
    </form>
  </div>
 </div>
 
<div class="row">
<div class="col-md-1"></div>
<div class="col-md-10">
<div class="panel panel-default">
<div class="panel-heading text-center"><b class="h3"> سەرجەمی کڕینەکان</b></div>




  <div class="panel-body">     
    <table  class="table table-striped table-bordered table-responsive table-hover text-center" id="dataTables-example">
      <thead class="bg-success">
      <tr class="custom_centered">
          <th>کۆی وەصل</th>
          <th>بەروار</th>
          <th>ناوی کۆمپانیا</th>
          <th>ژمارەی وەصل</th>
          
    </tr>
  </thead>

      <tbody>
@foreach ($purchases as $purchase)
       <tr>
           <td> $ {{$purchase->total}}</td>
           <td>{{$purchase->created_at->format('Y-m-d')}}</td>
           <td>{{$purchase->supplier->name}}</td>
           <td ><a href="/purchase/see/{{$purchase->id}}"><b class="color-red">{{$purchase->id}}</b></a></td>
       </tr>
 @endforeach
      
   </tbody>
  </table>
 @if ($purchases->has('links'))
 {{ $purchases->links('vendor.pagination.bootstrap-4') }}
 @endif

</div>
</div> 
</div>
</div>

@endsection