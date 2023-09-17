@extends('layouts.app')

@section('content')
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center justify-content-center">

                <div class="col-md-12 m-0 p-0 col-lg-5">
                    <div class="col-12 p-3  bg-white box-shadow border-radius-10">
                        {{-- <div class="login-title">
                    </div> --}}
                        <div class="d-flex  align-items-center">

                            @if (settings()->get('logo'))
                                <img src="{{ asset('storage') }}{{ '/' }}{{ settings()->get('logo') }}"
                                    alt="" id="test" class="logo" />
                            @else
                                <img src="{{ asset('logo.png') }}" alt="" class="logo">
                            @endif
                            <div class="d-block">
                                <h3 class=" pl-2 text-primary text-info">Login To
                                    {{ settings()->get('short_name', $default = 'System') }}</h3>
                                <label class="pl-2 text-secondary"
                                    style="letter-spacing: 1px">{{ settings()->get('full_name', $default = null) }}</label>
                            </div>
                        </div>
                        <hr>
                        <form method="POST" action="{{route('user.register')}}">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="input-group custom">
                                        <input type="text" class="form-control form-control-lg" name="first_name"
                                            placeholder="First name" />
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="input-group custom">
                                        <input type="text" class="form-control form-control-lg" name="last_name"
                                            placeholder="Last Name" />
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg" name="email"
                                    placeholder="Email" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg" name="password"
                                    placeholder="Password" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg" name="password_confirmation"
                                    placeholder="Confirm Password" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>

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
    </div>
@endsection
