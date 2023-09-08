@extends('layouts.app')

@section('content')
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">

            <div class="col-md-6 col-lg-5">
                <div class="p-3 bg-white box-shadow border-radius-10 " style="width: max-content">
                    {{-- <div class="login-title">
                </div> --}}
                    <div class="d-flex  align-items-center">

                        @if (settings()->get('logo'))
                            <img src="{{ asset('storage') }}{{ '/' }}{{ settings()->get('logo') }}" alt=""
                                id="test" class="logo" />
                        @else
                            <img src="{{ asset('logo.png') }}" alt="" class="logo">
                        @endif
                        <div class="d-block">
                            <h3 class=" pl-2 text-primary text-info">Reset
                                {{ settings()->get('short_name', $default = 'System') }} Password.</h3>
                            <label class="pl-2 text-secondary"
                                style="letter-spacing: 1px">{{ settings()->get('full_name', $default = null) }}</label>
                        </div>
                    </div>
                    <hr>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <label>Please enter a registered email to receive the code to <br> reset your password.</label>
                        <div class="input-group custom mt-3">
                            <input type="text" class="form-control form-control-lg" name="email" placeholder="Email" />
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                            </div>
                        </div>
                        @error('email')
                            <label class="text-danger" style="position: relative;top:-20px">{{ $message }}</label>
                        @enderror

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group mb-0">
                                    <input class="btn btn-info btn-lg btn-block" value="Sign In" type="submit" />
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
