@extends('layouts.app')

@section('content')
<div class="login-wrapper">
    <div class="container-center">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="view-header">
                    <div class="header-icon">
                        <i class="pe-7s-unlock"></i>
                    </div>
                    <div class="header-title">
                        <h3>@lang('layout.login')</h3>
                        <small><strong>@lang('layout.please_enter_your_credentials_to_login')</strong></small>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <form method="POST" action="{{ route('login') }}" validate>
                        @csrf
                  
                    <div class="form-group">
                        <label class="control-label">@lang('layout.email_address')</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input id="email" type="email" placeholder="@lang('layout.please_enter_email_address')"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required >
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">@lang('layout.password')</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input id="pass" type="password" placeholder="@lang('layout.password')" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                        <button class="btn btn-base pull-right">Login</button>
                        <div class="checkbox checkbox-success p-0">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">@lang('layout.keep_me_signed_in')</label>
                        </div>
                    </div>
                </form>
                
            </div>
               
        </div>
     
    </div>
</div> 
@endsection
