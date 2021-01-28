@extends('layouts.master')

@section('content')

<div class=" row row-print bordered-2 text-center " >
    <br/>
    <p class="h3 color-black"><b>ڕاپۆرتی پارەی هاتوو و ڕۆیشتوو</b></p> 
    <br/>
</div>

<div class="row bordered-1" >
<br>
    <table class="table table-borderless tfs16bold">
    <tbody  class="text-center">
      
    </tbody>
</table>

</div>


<div class="row text-center">
        <table class="table table-bordered table-striped table-text-center tfs16bold">
    <thead class="text-center" style="background-color:#cea"> 
        <tr class="custom_centered">
            <th class="h4">سەرجەمی پارەی دۆلار</th>
            <th class="h4">جۆر</th>
        </tr>

    </thead>
    <tbody>



<tr class="custom_centered">
    <td class="col-print-4 h4 color-red">{{number_format($qist,2)}}</td>
    <td class="col-print-4 h4 color-red">قیست</td>
</tr>
<tr class="custom_centered">
    <td class="col-print-4 h4 color-red">{{number_format($sale,2)}}</td>
    <td class="col-print-4 h4 color-red">فرۆشتن</td>
</tr>



</tbody>
</table>
</div>



<div class="row row1px text-center ">
<br>
        <table class="table table-borderless text-center tfs24bold">
        <tbody  class="text-center">
            <tr>
                <td class="col-print-3 col-md-3"></td>
                <td class="col-print-3 h3 col-md-3" class="borderfred"><strong>{{number_format($sale+$qist,2)}}</strong></td>
                <td class="col-print-3 h3 col-md-3" class="backcsilver"><strong> :کۆی گشتی</bd> </strong>
                <td class="col-print-3 col-md-3"></td>
            </tr>            
        </tbody>
    </table>
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