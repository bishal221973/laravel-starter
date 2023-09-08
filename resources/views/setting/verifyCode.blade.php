@extends('layouts.app')

@section('title',"Get Code")
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
        @push('message')
            <script>
                let timeLeft;
                // Set the initial time in seconds
                if (localStorage.getItem("timeLeft")) {
                    timeLeft = localStorage.getItem("timeLeft");
                } else {
                    localStorage.setItem("timeLeft", "60");
                    timeLeft = localStorage.getItem("timeLeft");
                }

                // Function to update the timer display
                function updateTimer() {
                    document.getElementById('timer').innerHTML = `OTP will expire in: ${timeLeft} seconds`;

                    if (timeLeft > 0) {
                        timeLeft--;
                        localStorage.setItem("timeLeft", timeLeft);
                        setTimeout(updateTimer, 1000); // Update every 1 second (1000 milliseconds)
                    } else {
                        localStorage.removeItem("timeLeft");


                        var email = "{{ Auth()->user()->email }}";
                        var url = "{{ route('otp.delete', ':email') }}";
                        url = url.replace(':email', email);
                        var token = $("meta[name='csrf-token']").attr("content");



                        $.ajax(

                            {

                                url: url,

                                type: 'DELETE',

                                data: {

                                    "email": email,

                                    "_token": "{{ csrf_token() }}",

                                },

                                success: function(response) {

                                    console.log(response);

                                }

                            });

                        document.getElementById('timer').innerHTML = 'Time is up!';

                        document.getElementById("timer").classList.add("d-none");
                        document.getElementById("didNotGetCode").classList.remove("d-none");
                    }
                }

                // Start the timer
                updateTimer();
            </script>
        @endpush
        <div class="row d-flex justify-content-center">
            <div class="col-xl-5 col-lg-7 col-md-8 col-sm-10">
                <div class="card">
                    <div class="card-body">
                        <h5>Enter verification code</h5>
                        <hr>

                        <div class="d-block">
                            <label>Please check your email for 6 digit verification code.</label>
                            <div class="d-flex align-items-center">

                            </div>
                        </div>
                        <form action="{{ route('setting.verifyEmailCode') }}" method="GET">
                            @csrf
                            <div class="d-flex ">
                                <x-input type="number" name="code" placeholder="Enter Code" />
                                <div class="d-block ml-3">
                                    <label>We send your code to:</label><br>
                                    @php
                                        echo substr(Auth()->user()->email, 0, 3) . '*************.com';
                                    @endphp
                                </div>
                            </div>

                            <hr>
                            <div class="col-12 d-flex align-items-center justify-content-between">
                                <div id="timer" class="text-secondary"></div>
                                <a href="{{ route('forgetPassword') }}" id="didNotGetCode"
                                    class="text-primary d-none">Didn't
                                    get a
                                    code ?</a>
                                <input type="submit" class="btn btn-secondary" value="Continue"/>
                            </div>
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
