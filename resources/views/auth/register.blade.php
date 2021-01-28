@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-8 col-xs-12 col-md-offset-3 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading bg-info h2 text-center">تۆمارکردن</div>
                <div class="panel-body">
                    <form class="form-horizontal text-right" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                             <label for="name" class="col-md-4 control-label">ناوی سیانی</label>
                        </div>

                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">                         
                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" required autofocus>

                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>

                            
                             <label for="mobile" class="col-md-4 control-label">ژمارەی مۆبایل</label>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="email" class="col-md-4 control-label">ئیمەیڵ</label>
                        </div>
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            
                            <div class="col-md-6">
                                <select  type="type" class="form-control" name="type" required>
                                <option value="mandwb">مەندوب</option>
                                <option value="accountant">محاسب</option>
                                <option value="installment_filter">قیست و فلتەر</option>
                                <option value="team_leader">تیم لیدەر</option>
                                <option value="admin">بەڕێوبەر</option>
                                </select>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="email" class="col-md-4 control-label">جۆری بەکار‌هێنەر</label>

                        </div>
                   


                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="password" class="col-md-4 control-label">ووشەی نهێنی</label>
                        </div>

                        <div class="form-group">
                            

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                            <label for="password-confirm" class="col-md-4 control-label">دوبارەکردنەوەی ووشەی نهێنی</label>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2 col-sm-2 col-md-offset-4 col-sm-offset-4">
                                <button type="submit" class="btn btn-primary btn-lg ">
                                    تۆمارکردن
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
