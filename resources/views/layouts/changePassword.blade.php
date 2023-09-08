@extends('layouts.app')

@section('title',"Change Password")
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
                                Change Password
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
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Change Password <br>
                        </h4>
                        <small style="font-size: 14px"
                            class="p-0 m-0">{{ Auth()->user()->first_name . ' ' . Auth()->user()->middel_name . ' ' . Auth()->user()->last_name }}
                            <i class="fa-solid fa-minus text-secondary px-2"></i>Hospital
                            Management System</small>

                        <label class="mt-3 pb-4">Your password must be at least eight characters and should
                            include a combination of numbers, letters and special characters
                            (!$@%).</label>

                        <form action="{{ route('updateMyPassword') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @error('old_password')
                                @php
                                    $error = $message;
                                @endphp
                            @enderror
                            <x-input type="password" placeholder="New Password" name="password" required="true" />
                            <x-input type="password" placeholder="Confirm Password" name="password_confirmation"
                                required="true" />
                            <input type="submit" value="Change Password" class="btn btn-info col-12 mt-3">

                        </form>

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
