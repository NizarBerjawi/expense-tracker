@extends('layouts.app')

@section('content')
    <div class="be-wrapper be-login be-signup">
        <div class="be-content">
            <div class="main-content container-fluid">
                <div class="splash-container">
                    <div class="panel panel-default panel-border-color panel-border-color-custom">
                        <div class="panel-heading"><img src="{{ asset('img/logo.png') }}" alt="logo" class="logo-img"></div>
                        <div class="panel-body">
                            <form action="{{ route('register') }}" method="POST"><span class="splash-title xs-pb-20">Sign Up</span>
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <input type="text" name="name" required="" placeholder="Full Name" autocomplete="off" class="form-control" value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" required="" placeholder="E-mail" autocomplete="off" class="form-control" value="{{ old('email') }}" required>
                                </div>


                                <div class="form-group row signup-password">
                                    <div class="col-xs-6">
                                        <input type="password" class="form-control" name="password" placeholder="Password" required="">
                                    </div>
                                    <div class="col-xs-6">
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm" required>
                                    </div>
                                </div>

                                <div class="form-group xs-pt-10">
                                    <button type="submit" class="btn btn-block btn-custom btn-xl">Sign Up</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="splash-footer"><span>Already registered? <a href="{{ route('login') }}">Log in</a></span></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
