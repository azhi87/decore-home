@extends('layouts.master')
@section('content')

    <div class="row bordered-2" >
        <div class="col-md-12 col-sm-12 col-sx-12 text-center">
</br>
	<p class="h3 color-black"><b> کاڵای ڕۆیشتوو</b></p>
</br>
     </div>
</div>

<div class="row bordered-1" >

       <table class="table table-bordered tseparate-1 tfs14boldc  ">
    <tbody  class="text-center">

  <tr  >
            <td> {{$item->name}}</td>
            <td>: ناوی کاڵا</td> 

            <td> {{$item->id}}</td>
            <td>: کۆدی کاڵا</td> 
    </tr>
    
    <tr  >
            <td> {{$to}}</td>
            <td>: بۆ</td> 

            <td> {{$from}}</td>
            <td>: لە</td> 
    </tr>

</tbody>
</table>

</div>

<div class="row bordered-1">

		<table class="table table-bordered table-striped table-responsive table-text-center tfs14boldc" >
    <thead>
        <tr class="bg-info" >
      
            <th >کۆ</th>
            <th >نرخی فرۆشتن</th>
            <th > دانەی فرۆشراو</th>
            <th >  بەروار</th>
            <th >ناوی وەرگر</th>
            <th > ناوی کڕیار</th>
            <th > ژ.وەسڵ</th>
                                    
        </tr>
    </thead>
<?php $totalSale=0;$totalQuantity=0;?>
@foreach ($sales as $sale)
 @foreach($sale->items->where('id',$item->id) as $item)
<tr class="bg-warning text-danger">
        <td>{{$item->pivot->ppi * $item->pivot->quantity}}</td>
        <td>{{$item->pivot->ppi}}</td>
        <td>{{$item->pivot->quantity}}</td>
        <td>{{$sale->created_at->format('d/m/Y')}}</td>
        <td>{{$sale->user->name}} </td>
        <td>{{$sale->customer->name}}</td>
        <td>{{$sale->id}}</td>
<td class="bg-warning text-danger"> <a class="hidden-print" href='/sale/print/{{$sale->id}}'>{{$sale->id}}</a><span class="visible-print">{{$sale->id}}</span></td>

</tr>
@endforeach
@endforeach


</tbody>
</table>
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