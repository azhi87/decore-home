<?php include (app_path().'/includes/langs/ku.php');?>
@if (!Auth::check())
{{redirect('/login')}}
@endif
<html lang="en">

<head>
  <title> </title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" type="text/css" media="print" href="{{asset('public/css/print.css?version=344')}}">
  <link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet" screen="screen" />
  <link href="{{asset('public/css/animate.min.css')}}" rel="stylesheet" />
  <link rel="stylesheet" media="screen" href="{{asset('public/css/paper-dashboard.css')}}">
  <link rel="stylesheet" href="{{asset('public/css/demo.css')}}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{asset('public/css/custom.css')}}">
  <link href="{{asset('public/css/themify-icons.css')}}" rel="stylesheet" screen="screen" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
  <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
  <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">

  @yield('links')
</head>

<body class="sidebar-mini " style="font-family: 'Xendan-Regular';">

  <div class="wrapper" style="font-family: 'Xendan-Regular';">

    @include('layouts.navbar')
    <div class="content">
      <div class="container-fluid ">


        @yield('content')

      </div>
    </div>
  </div>
</body>

@include('layouts.footer')
@include('layouts.messages')
@yield('afterFooter')

</html>