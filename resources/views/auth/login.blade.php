@extends('layouts.app')
@section('content')
<br>
<br>
<div class="container">
    <div class="row ">
        <div class="col-md-6 col-sm-8 col-md-offset-3 col-sm-offset-2 well">
            <div class="panel panel-success">                
                <div class="panel-heading text-center"><span class="h3"><strong>چوونە ژوورەوە </strong></span></div>
                <div class="panel-body bg-inverse">
                    <form class="form" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" placeholder="ئیمەیڵ" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" placeholder="ووشەی نهێنی" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group">
                                <button type="submit" class="btn-lg btn-danger btn-block">
                                    <b><strong>چوونە ژوورەوە </strong></b>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection