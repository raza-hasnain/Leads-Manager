@extends('layouts.app')

@section('content')

<div class="login-wrapper">
    <div class="container-center">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="view-header">
                    <div class="header-icon">
                        <i class="pe-7s-refresh-2"></i>
                    </div>
                    <div class="header-title">
                        <h3>{{ __('Reset Password') }}</h3>
                        <small><strong>Please fill the form to recover your password</strong></small>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <p>Fill with your mail to receive instructions on how to reset your password.</p>
                    <div class="form-group">
                        <label class="control-label" for="email">{{ __('E-Mail Address') }}</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required  placeholder="Please enter you email adress" autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-base btn-block">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
