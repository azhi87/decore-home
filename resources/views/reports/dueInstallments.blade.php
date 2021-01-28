
@extends('layouts.master')
@section('content')

<div class="card col-md-12 ">
<div class="row bordered-2">
<div class="col-md-12 col-sm-12 text-center ">

    <p class="h2"><strong> ڕاپۆرتی قیستی دواکەوتوو</strong>  </p> 
  
</div>
</div>

<div class="row bordered-1">

        <table class="table table-bordered  table-responsive table-text-center" id="simpleTable">
    <thead   >
        <tr class="bg-success">
            <th class="hidden">ناردنی نامە</th>
            <th class="hidden">نامەی نێرراو</th>
            <th class="hidden">دوا بەرواری قیست</th>
            <th data-sort="int" data-sort-onload="yes" data-sort-default="desc">ژمارەی قیستی دواکەوتوو</th>
            <th data-sort="int">بڕی پارەی دواکەوتوو</th>
            <th data-sort="int">بڕی ماوە</th>
     {{--       <th>ماوە - مانگ</th>      --}}
            <th data-sort="int">ژمارەی وەصل</th> 
            <th data-sort="string">مۆبایل ٢</th>
            <th data-sort="string">مۆبایل</th>
            <th data-sort="string">ناوی کڕیار</th>
            <th data-sort="int">ژمارە</th>

        </tr>

    </thead>
    <tbody>
        <?php $i=1;?>

            @foreach ($ins as $in)
            
            @if(($in->total - $in->actualPaid()) > 0)
                    <tr >
                    <td class="hidden"><a href='/installments/send/{{$in->id}}' type="button" role="button" class="btn btn-primary">ناردن</a></td>
                    <td class="text-danger hidden"><button class="btn btn-icon btn-danger">
                                                
                                            </button></td>
                    <td class="text-danger hidden"><span >{{$in->created_at->format('d-m-Y')}}</span></td>
                    <td >{{$in->dueCount()}} </td>                    
                    <td >{{$in->dueMoney()}} </td>                    
                    <td >{{$in->total - $in->actualPaid()}} $</td>                    
       {{--             <td class=""> {{$in->sale->installments}} </td>     --}}
                    <td ><a   href="/installments/{{$in->id}}"><b >{{$in->id}}</b></a></td>
                   

  <td class="text-danger"> {{$in->customer->tel2}} </td>          

          <td class="text-danger"> {{$in->customer->tel}} </td>

<td class="text-danger"> {{$in->customer->name}}</td>

 <td class="text-primary bg-danger"><b>{{$i}}</b></td>
                
                </tr>
                        <?php $i++;?>
                  @endif
            @endforeach
            </tbody>

</table>
 {{-- @if ($ins->count())
    {{ $ins->links('vendor.pagination.bootstrap-4') }}
   @endif --}}
</div>

</div>
@endsection

@section('afterFooter')
 <script type="text/javascript">
    $(document).ready(function () {
        $('#simpleTable').stupidtable();
  });
 </script>

 @endsection