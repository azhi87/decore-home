@extends('layouts.master')

@section('content')

    <style type="text/css">.input-group-addon{font-weight:bold; padding:4px;}</style>

<br>
@include('sales.header')

<br/>
@endsection
@section('afterFooter')
 <script type="text/javascript">
    $(document).ready(function () {
  $("#menu-top li a").removeClass("menu-top-active");              
  $('#sale').addClass('menu-top-active');
  });
 </script>

 @endsection