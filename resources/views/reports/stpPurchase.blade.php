@extends('layouts.master')
@section('content')
<div class="row bordered-2" >
	
<div class="col-md-12 col-sm-12 col-sx-12 text-center">
</br>
	<p class="h3 color-black"><b> کاڵای هاتوو/کڕین</b></p>
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
            <th >نرخی کڕین</th>
            <th > دانەی کڕاو</th>
            <th >  بەروار</th>
            <th > ناوی کۆمپانیا</th>
            <th > ژ.وەسڵ</th>
                                    
        </tr>
    </thead>
@foreach ($purchases as $purchase)
  @foreach($purchase->items->where('id',$item->id) as $item)

<tr class="bg-warning text-danger">
        <td>{{$item->pivot->ppi * $item->pivot->quantity}}</td>
        <td>{{$item->pivot->ppi}}</td>
        <td>{{$item->pivot->quantity}}</td>
        <td>{{$purchase->created_at->format('d/m/Y')}}</td>
        <td>{{$purchase->supplier->name}}</td>

<td class="bg-warning text-danger"> <a class="hidden-print" href='/purchase/see/{{$purchase->id}}'>{{$purchase->id}}</a><span class="visible-print">{{$purchase->id}}</span></td>

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