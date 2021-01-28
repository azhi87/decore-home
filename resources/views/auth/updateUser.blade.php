@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
       <div class="col-md-6 col-sm-8 col-md-offset-3 col-sm-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading text-center"><span class="h3">گۆڕانکاری بەکارهێنەر</span></div>
                <div class="panel-body">
                    <form class="form-horizontal text-right" role="form" method="POST" action="/users/update/{{$user->id}}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name}}" required autofocus>
                            </div>
                             <label for="name" class="col-md-4 control-label">ناوی سیانی</label>
                        </div>

                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control" name="mobile" value="{{$user->mobile}}" required autofocus>
                            </div>
                             <label for="mobile" class="col-md-4 control-label">ژمارەی مۆبایل</label>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" required>
                            </div>
                            <label for="email" class="col-md-4 control-label">ئیمەیڵ</label>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}" hidden>
                            <div class="col-md-6">
                                <select class="form-control" name="type" required>
                                <option selected="selected" value="{{$user->type}}">{{$user->typeText()}}</option>
                                <option value="accountant">محاسب</option>
                                <option value="supervisor">چاودێر</option>
                                <option value="admin">ئەدمین</option>
                                <option value="mandwb">مەندووب</option>
                                <option value="spstock">سەرپەرشتیاری مەخزەن</option>
                                </select>
                            </div>
                            <label for="email" class="col-md-4 control-label">جۆری بەکار‌هێنەر</label>
                        </div>



                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" >
                            </div>
                            <label for="password" class="col-md-4 control-label">ووشەی نهێنی</label>
                        </div>

                        <div class="form-group">
                            

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                            </div>
                            <label for="password-confirm" class="col-md-4 control-label">دوبارەکردنەوەی ووشەی نهێنی</label>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4 col-sm-6 col-sm-offset-4">
                                <button type="submit" class="btn btn3d btn-primary ">
                                 <b>   تۆمارکردن </b>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('afterFooter')
 <script type="text/javascript">
    $(document).ready(function () {
  $("#menu-top li a").removeClass("menu-top-active");              
  $('#user').addClass('menu-top-active');
  });
 </script>

 @endsection