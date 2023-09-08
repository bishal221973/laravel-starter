@extends('layouts.app')

@section('title','Profile')
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
                                Profile
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
                <script>
                    $("#changePassword").modal('show');
                </script>
            @endpush
        @endif
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
                <div class="pd-20 card profile-card"
                    @if (Auth()->user()->cover) style="background: url('{{ asset('storage') }}{{ '/' }}{{ Auth()->user()->cover }}');"
                @else
                style="background: url('/hospital1.jpg');" @endif>
                    {{-- <img src="{{asset('hospital1.jpg')}}" alt=""> --}}
                    <div class="profile">
                        @if (Auth()->user()->image)
                            <img src="{{ asset('storage') }}{{ '/' }}{{ Auth()->user()->image }}" alt=""
                                id="test" class="avatar-photo" />
                        @else
                            <img src="{{ asset('user1.png') }}" alt="" id="test" class="avatar-photo" />
                        @endif



                        <div class="profile-name">
                            <div>
                                <h3>{{ Auth()->user()->first_name . ' ' . Auth()->user()->last_name }}</h3>
                                <label>{{ Auth()->user()->email }}</label>
                            </div>
                            <div class="d-flex align-items-center">
                                <div>
                                    <a href="{{ route('setting.index') }}" class="btn btn-info"><i
                                            class="fa-solid fa-gear mr-2"></i> Setting</a>
                                    <a href="#" class="btn btn-secondary" data-toggle="modal"
                                        data-target="#Medium-modal"><i class="fa-solid fa-pen-to-square mr-2"></i>Edit
                                        Profile</a>

                                    <div class="modal fade" id="Medium-modal" tabindex="-1" role="dialog"
                                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myLargeModalLabel">
                                                        Edit Profile
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">
                                                        ×
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="d-flex justify-content-between">
                                                        <h5>Profile Picture</h5>
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#editProfile">Add</a>
                                                    </div>
                                                    <div class="d-flex justify-content-center">
                                                        <img src="{{ asset('user1.png') }}" alt="" srcset=""
                                                            width="180px" class="mt-5" style="border-radius: 50%">
                                                    </div>

                                                    <hr>

                                                    <div class="d-flex justify-content-between mt-3">
                                                        <h5>Cover Photo</h5>
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#editCover">Add</a>
                                                    </div>
                                                    <div class="d-flex justify-content-center">
                                                        <div class="col-12 rounded mt-3"
                                                            style="background-color: #dddddd;height:150px">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- ======== Edit Profile======= --}}
                                    <div class="modal fade" id="editProfile" tabindex="-1" role="dialog"
                                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myLargeModalLabel">
                                                        Update profile picture
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">
                                                        ×
                                                    </button>
                                                </div>
                                                <form action="{{ route('changeProfile') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="d-flex justify-content-between">
                                                            <input type="file" name="image" class="upload"
                                                                id="uploadProfile">
                                                            <label class="uploadLabel py-3 rounded" for="uploadProfile"><i
                                                                    class="fa-solid fa-upload mr-3"></i>Brows Profile
                                                                Image</label>

                                                        </div>
                                                        <img src="" class="profilePreview" id="profilePreview"
                                                            alt="" srcset="">

                                                        <div class="d-flex justify-content-end gap-3 mt-3">
                                                            <button type="button" class="btn btn-success"
                                                                id="btnProfileOk">Ok</button>
                                                            <button type="button" class="btn btn-warning"
                                                                id="btnProfileCrop">Crop</button> &nbsp;
                                                            <button type="submit" class="btn btn-info"
                                                                id="btnProfileSave">Save</button>
                                                            <button type="button" class="btn btn-info"
                                                                id="btnProfileCancel">Cancel</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- ======== Edit Cover======= --}}
                                    <div class="modal fade" id="editCover" tabindex="-1" role="dialog"
                                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myLargeModalLabel">
                                                        Update Cover Photo
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">
                                                        ×
                                                    </button>
                                                </div>
                                                <form action="{{ route('changeCover') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="d-flex justify-content-between">
                                                            <input type="file" name="cover" class="upload "
                                                                id="uploadCover">
                                                            <label class="uploadLabel py-3 rounded" for="uploadCover"><i
                                                                    class="fa-solid fa-upload mr-3"></i>Brows Cover
                                                                Photo</label>

                                                        </div>
                                                        <img src="" class="profilePreview" id="coverPreview"
                                                            alt="" srcset="">

                                                        <div class="d-flex justify-content-end gap-3 mt-3">

                                                            <button type="submit" class="btn btn-info"
                                                                id="btnCoverSave">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @role('super-admin')
                <div class="col-xl-12 mb-3" style="margin-top: 80px">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-3">
                            <div class="card bg-info">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-block text-white">
                                            <i class="fa-solid fa-users fa-3x"></i>
                                        </div>
                                        <div class="d-block">
                                            <h5 class="text-uppercase text-white">Users</h5>
                                            <h2 class="text-right text-white">{{ App\Models\User::count() }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-3">
                            <div class="card bg-success">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-block text-white">
                                            <i class="fa-solid fa-hospital fa-3x"></i>
                                        </div>
                                        <div class="d-block">
                                            <h5 class="text-uppercase text-white">Hospitals</h5>
                                            <h2 class="text-right text-white">0</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-3">
                            <div class="card bg-warning">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-block text-white">
                                            <i class="fa-solid fa-boxes-stacked fa-3x"></i>
                                        </div>
                                        <div class="d-block">
                                            <h5 class="text-uppercase text-white">Branchs</h5>
                                            <h2 class="text-right text-white">0</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-3">
                            <div class="card bg-secondary">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-block text-white">
                                            <i class="fa-solid fa-boxes-stacked fa-3x"></i>
                                        </div>
                                        <div class="d-block">
                                            <h5 class="text-uppercase text-white">Branchs</h5>
                                            <h2 class="text-right text-white">0</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole

            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-4">Auth</h5>

                                {{-- =========+Change Password==== --}}
                                <button class="btn btn-info col-12 mb-3" data-toggle="modal"
                                    data-target="#changePassword">Change Password</button>
                                <div class="modal fade" id="changePassword" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="p-3">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">
                                                    ×
                                                </button>
                                                <h4 class="modal-title" id="myLargeModalLabel">
                                                    Change Password <br>
                                                </h4>
                                                <small style="font-size: 14px"
                                                    class="p-0 m-0">{{ Auth()->user()->first_name . ' ' . Auth()->user()->middel_name . ' ' . Auth()->user()->last_name }}
                                                    <i
                                                        class="fa-solid fa-minus text-secondary px-2"></i>{{ settings()->get('full_name', $default = null) }}
                                                    {{ settings()->get('short_name') ? '(' . settings()->get('short_name') . ')' : '' }}</small>
                                            </div>
                                            <label class="px-3">Your password must be at least eight characters and
                                                should
                                                include a combination of numbers, letters and special characters
                                                (!$@%).</label>
                                            <form action="{{ route('changePassword') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    @error('old_password')
                                                        @php
                                                            $error = $message;
                                                        @endphp
                                                    @enderror
                                                    <x-input type="password" placeholder="Current Password"
                                                        name="old_password" required="true" />
                                                    <x-input type="password" placeholder="New Password" name="password"
                                                        required="true" />
                                                    <x-input type="password" placeholder="Confirm Password"
                                                        name="password_confirmation" required="true" />
                                                    <a href="{{ route('forgetPassword') }}"
                                                        class="text-primary">Forgotten Password ?</a>
                                                    <input type="submit" value="Change Password"
                                                        class="btn btn-info col-12 mt-3">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- <button class="btn btn-info col-12 mb-3">Change Email</button>
                                <button class="btn btn-info col-12 mb-3">Change Contact Number</button> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-8">
                        <div class="faq-wrap">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header">
                                        <button class="btn btn-block" data-toggle="collapse" data-target="#faq1">
                                            Basic Information
                                        </button>
                                    </div>
                                    <div id="faq1" class="collapse show" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-2">
                                                <h5>Name : </h5>
                                                <label>
                                                    {{ Auth()->user()->first_name . ' ' . Auth()->user()->middel_name . ' ' . Auth()->user()->last_name }}</label>
                                            </div>


                                            <div class="d-flex justify-content-between mb-2">
                                                <h5>DOB : </h5>
                                                <label>
                                                    {{ Auth()->user()->dob ? Auth()->user()->dob : 'xxxx-xx-xx' }}</label>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <h5>Age : </h5>
                                                <label>
                                                    {{ Auth()->user()->age ? Auth()->user()->age . ' Year' : 'xx Year' }}</label>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <h5>Gender : </h5>
                                                <label>
                                                    {{ Auth()->user()->gender ? Auth()->user()->gender : 'Not defined' }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="card">
                                    <div class="card-header">
                                        <button class="btn btn-block" data-toggle="collapse" data-target="#faq2-2">
                                            Contact Information
                                        </button>
                                    </div>
                                    <div id="faq2-2" class="collapse show" data-parent="#accordion">
                                        <div class="card-body">


                                            <div class="d-flex justify-content-between mb-2">
                                                <h5>Email : </h5>
                                                <label>
                                                    {{ Auth()->user()->email }}</label>
                                            </div>

                                            <div class="d-flex justify-content-between mb-2">
                                                <h5>Contact Number : </h5>
                                                <label>
                                                    {{ Auth()->user()->contact_number ? Auth()->user()->contact_number : 'Not defined' }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <button class="btn btn-block" data-toggle="collapse" data-target="#faq2-2">
                                            Address
                                        </button>
                                    </div>
                                    <div id="faq2-2" class="collapse show" data-parent="#accordion">
                                        <div class="card-body">


                                            <div class="d-flex justify-content-between mb-2">
                                                <h5>Country : </h5>
                                                <label>
                                                    {{ Auth()->user()->address ? Auth()->user()->address->country->country_name : 'Not defined' }}</label>
                                            </div>

                                            <div class="d-flex justify-content-between mb-2">
                                                <h5>Province : </h5>
                                                <label>
                                                    {{ Auth()->user()->address ? Auth()->user()->address->province->province_name : 'Not defined' }}</label>
                                            </div>

                                            <div class="d-flex justify-content-between mb-2">
                                                <h5>District : </h5>
                                                <label>
                                                    {{ Auth()->user()->address ? Auth()->user()->address->district->district_name : 'Not defined' }}</label>
                                            </div>

                                            <div class="d-flex justify-content-between mb-2">
                                                <h5>Municipality : </h5>
                                                <label>
                                                    {{ Auth()->user()->address ? Auth()->user()->address->municipality->municipality : 'Not defined' }}</label>
                                            </div>

                                            <div class="d-flex justify-content-between mb-2">
                                                <h5>Ward Number : </h5>
                                                <label>
                                                    {{ Auth()->user()->address ? Auth()->user()->address->ward_no : 'Not defined' }}</label>
                                            </div>

                                            <div class="d-flex justify-content-between mb-2">
                                                <h5>Tole : </h5>
                                                <label>
                                                    {{ Auth()->user()->address ? Auth()->user()->address->tole : 'Not defined' }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <button class="btn btn-block" data-toggle="collapse" data-target="#faq2-2">
                                            Remarks
                                        </button>
                                    </div>
                                    <div id="faq2-2" class="collapse show" data-parent="#accordion">
                                        <div class="card-body">


                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae iusto possimus
                                            excepturi officia ratione obcaecati sunt hic dolor ducimus odit.
                                        </div>
                                    </div>
                                </div>
                            </div>

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
