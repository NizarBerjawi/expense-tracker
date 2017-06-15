@extends('layouts.app')

@section('content')
    <div class="be-wrapper be-login">
        <div class="be-content">
            <div class="main-content container-fluid">
                <div class="splash-container">
                    <div class="panel panel-default panel-border-color panel-border-color-custom">
                        <div class="panel-heading"><img src="{{ asset('img/logo.png') }}" alt="logo" class="logo-img"></div>
                        <div class="panel-body">
                            <form action="{{ route('login') }}" method="POST"><span class="splash-title xs-pb-20">Log in</span>
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <input id="email" type="email" placeholder="Email" autocomplete="off" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                </div>

                                <div class="form-group">
                                    <input id="password" type="password" placeholder="Password" class="form-control" name="password" required>
                                </div>

                                <div class="form-group row login-tools">
                                    <div class="col-xs-6 login-remember">
                                        <div class="be-checkbox">
                                            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} >
                                            <label for="remember">Remember Me</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 login-forgot-password"><a href="{{ route('password.request') }}">Forgot Password?</a></div>
                                </div>
                                <div class="form-group login-submit">
                                    <button data-dismiss="modal" type="submit" class="btn btn-custom btn-xl">Sign me in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="splash-footer"><span>Don't have an account? <a href="{{ route('register') }}">Sign Up</a></span></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
