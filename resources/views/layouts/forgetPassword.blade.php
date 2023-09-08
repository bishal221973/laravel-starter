@extends('layouts.app')

@section('title','Forget Password')
@section('content')
    <div class="main-container">
        <div class="card mb-2">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb p-3 m-0">
                            <li class="breadcrumb-item">
                                <a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Forgot Password
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @if (session()->has('success'))
            @push('message')
                <script>
                    Toast.fire({
                        icon: 'success',
                        title: '{{ session()->get('success') }}'
                    })
                </script>
            @endpush
        @endif
        @if (session()->has('error'))
            @push('message')
                <script>
                    Toast.fire({
                        icon: 'error',
                        title: '{{ session()->get('error') }}'
                    })

                    if ('{{ session()->get('error') }}' == "Current password is incorrect") {
                        $("#changePassword").modal('show');
                    }
                </script>
            @endpush
        @endif
        @if ($errors->any())
            @push('message')
            @endpush
        @endif
        <div class="row d-flex justify-content-center">
            <div class="col-xl-5 col-lg-7 col-md-8 col-sm-10">
                <div class="card">
                    <div class="card-body">
                        <h5>Reset Your Password</h5>
                        <hr>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-block">
                                <label>Dear {{Auth()->user()->first_name . " " . Auth()->user()->middel_name . " " . Auth()->user()->last_name}}, how do you want to receive the code to reset your password?</label>
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-circle text-primary pr-3"></i>
                                    <div class="d-block">
                                        <label class="p-0 m-0">Send code via email</label><br>
                                        <label class="p-0 m-0">
                                            @php
                                                echo substr(Auth()->user()->email, 0, 3) . '*************.com';
                                            @endphp
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-block">
                                @if (Auth()->user()->image)
                                    <img src="{{ asset('storage') }}{{ '/' }}{{ Auth()->user()->image }}"
                                        alt="" id="test" class="header-profile-image text-center" />
                                @else
                                    <img src="{{ asset('user1.png') }}" alt="" class="header-profile-image"
                                        id="test" />
                                @endif &nbsp;&nbsp;&nbsp;
                                {{-- <label>{{ Auth()->user()->first_name . ' ' . Auth()->user()->middel_name . ' ' . Auth()->user()->last_name }}</label> --}}

                            </div>
                        </div>
                        <hr>
                        <div class="col-12 d-flex justify-content-end">
                            <a href="{{route('getCode')}}" class="btn btn-secondary">Continue</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="footer-wrap pd-20 mb-20 card-box">
            Hospital Management System By
            <a href="https://cbishal.com.np" target="_blank">Bishal Chaudhary</a>
        </div> --}}

    </div>
@endsection
