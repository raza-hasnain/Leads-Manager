@extends('layouts.app')

@section('content')
<div class="register-wrapper">
    <div class="container-center lg">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="view-header">
                    <div class="header-icon">
                        <i class="pe-7s-pen"></i>
                    </div>
                    <div class="header-title"> 
                        <h3>Register</h3> 
                        <small><strong>Please enter your data<br> to register.</strong></small>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <form method="POST" action="{{ route('register') }}">
                        @csrf
                    <!--Social Buttons--> 
                    <div class="social">
                        <strong>Register in using social network:</strong><br>
                        <a href="#" class="btn_1 twitter_bg"><i class="fa fa-twitter"></i>Login Twitter</a>
                        <a href="#" class="btn_2 fb_bg"><i class="fa fa-facebook"></i>Login Facebook</a>
                    </div>
                    <div class="form-group">
                        <label class="control-label">{{ __('Name') }}</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ clean($message) }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="******" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ clean($message) }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Repeat Password</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="******" required autocomplete="new-password">  
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Please enter your email address" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ clean($message) }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-base float-right">
                            {{ __('Register') }}
                        </button>
                        <a href="{{route('login')}}" class="btn btn-base float-right mr-2">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
