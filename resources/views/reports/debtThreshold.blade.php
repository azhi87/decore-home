@extends('layouts.master')
@section('content')

<div class="row bordered-2" >
    
<div class="col-md-12 col-sm-12 text-center">
</br>
    <strong><p style="font-size: 48px; "> قەرزی کڕیار </p> </strong>
    </br>
    </br>
</div>
</div>


<div class="row bordered-1" >

</div>

<div class="row bordered-1">

<div class="col-md-12 col-sm-12 col-xs-12">

        <table class="table table-bordered table-striped table-responsive table-text-center tfs16boldc tfs24boldp ">
        <tr class="bg-info" >

            <th >سەرجەمی قەرز بە دۆلار</th>           
            <th >ناوی کڕیار</th>
            <th >کۆدی کڕیار </th>
        </tr>
@foreach ($debts as $debt)


<tr class="bg-warning text-danger">

    <td>{{number_format($debt->totalDebt,2)}}</td>
    <td>{{$debt->name}}</td>
    <td>{{$debt->id}}</td>
</tr>
@endforeach
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