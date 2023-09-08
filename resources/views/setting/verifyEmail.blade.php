@extends('layouts.app')

@section('title',"Verify Email")
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
                                Verify Email
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
                        <h5>Verify-your email</h5>
                        <hr>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-block">
                                <label>Dear {{Auth()->user()->first_name . " " . Auth()->user()->middel_name . " " . Auth()->user()->last_name}}, we find your email is not verified. Please verify your email before performing any action in Hospital Management System.</label>
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-circle text-primary pr-3"></i>
                                    <div class="d-block">
                                        <label class="p-0 m-0">Send verification code via email</label><br>
                                        <label class="p-0 m-0">
                                            @php
                                                echo substr(Auth()->user()->email, 0, 3) . '*************.com';
                                            @endphp
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="col-12 d-flex justify-content-end">
                            <a href="{{route('setting.verifyCode')}}" class="btn btn-secondary">Continue</a>
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
