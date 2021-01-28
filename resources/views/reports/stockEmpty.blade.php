
@extends('layouts.master')

@section('content')


<div class="card col-md-12">
<div class="row bordered-2" >
<div class="col-md-12 col-sm-12 col-xs-12 text-center">
<br/>
    <strong><p class="h3"><b>کاڵای ناو مەخزەن - نەماوە</b></p> </strong>
    <br/>
  
</div>
</div>
<div class="row bordered-1" >

    <table class="table table-bordered table-responsive table-text-center tfs16boldc " >
    <thead >
        <tr class="bg-info">
            <th>   ژ.مەخزەن  </th>
            <th>  فرۆشراو </th>
            <th>  کڕاو  </th>

            <th>سایز</th>
            <th>ڕەنگ</th>
            <th>گروپ</th>
            <th>  ن/فرۆشتن   </th>

            <th>  ناوی کاڵا  </th>
            <th>  کۆد  </th>
        </tr>
    </thead>
   @foreach ($items as $item)
    @if($item->stock() < 1 )
    
            @if($item->stock()==0)
            <tr class="danger">
            @elseif($item->stock()==1)
            <tr class="warning">
            @elseif($item->stock()==2)
            <tr class="success">
            @else
            <tr>
            @endif
                <td class="color-brown">
                {{number_format($item->stock(),0)}}
                </td>
                <td class="text-danger">{{$item->totalSale()}}</td>
                <td class="color-success">{{$item->totalPurchase()}}</td>
                <td >  {{$item->description}}</td>
                <td >  {{$item->color}}</td>

                <td >  {{$item->category->name}}</td>
                <td >  {{$item->sale_price}}</td>

                <td >  {{$item->name}}</td>
                <td class="color-brown">{{$item->id}}</td>
            </tr>
            @endif
    @endforeach
   
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