@extends('layouts.app')

@section('title', 'Setting')
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
                                Settings
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

        <div class="row d-flex justify-content-center" style="height: 84vh">
            <div class="col-lg-12 col-md-12 col-sm-12 mb-30 ">
                <div class="pd-20 card h-100">
                    <div class="tab h-100">
                        <div class="row  h-100 clearfix">
                            <div class="col-md-3 col-sm-12">
                                <ul class="nav flex-column nav-pills vtabs pr-4" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active rounded py-3" data-toggle="tab" href="#home7"
                                            role="tab" aria-selected="true"><i
                                                class="fa-solid fa-address-card pr-2"></i>
                                            Personal
                                            Details</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link rounded py-3" data-toggle="tab" href="#profile7" role="tab"
                                            aria-selected="false"><i class="fa-solid fa-lock pr-2"></i>Security &
                                            Password</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link rounded py-3" data-toggle="tab" href="#contact7" role="tab"
                                            aria-selected="false"><i class="fa-solid fa-address-book pr-2"></i>Contact
                                            Detail</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link rounded py-3" data-toggle="tab" href="#address" role="tab"
                                            aria-selected="false"><i class="fa-solid fa-map pr-2"></i>Address Detail</a>
                                    </li>
                                    @role('super-admin')
                                        <hr>
                                        <li class="nav-item ">
                                            <a class="nav-link rounded py-3" data-toggle="tab" href="#appSetting" role="tab"
                                                aria-selected="false"><i class="fa-solid fa-globe pr-2"></i>App Setting</a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link rounded py-3" data-toggle="tab" href="#mailSetting" role="tab"
                                                aria-selected="false"><i class="fa-solid fa-envelope pr-2"></i>Mail Setting</a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link rounded py-3" data-toggle="tab" href="#orgSetting" role="tab"
                                                aria-selected="false"><i class="fa-solid fa-envelope pr-2"></i>Organization Setting</a>
                                        </li>
                                    @endrole
                                </ul>
                            </div>
                            <div class="col-md-9 col-sm-12 ">
                                <div class="tab-content" style="max-height: 100%;">
                                    <div class="tab-pane fade " id="home7" role="tabpanel">
                                        <h5 class="text-uppercase">personal details</h5>
                                        <small style="font-size: 14px"
                                            class="p-0 m-0">{{ Auth()->user()->first_name . ' ' . Auth()->user()->middel_name . ' ' . Auth()->user()->last_name }}
                                            <i
                                                class="fa-solid fa-minus text-secondary px-2"></i>{{ settings()->get('full_name', $default = null) }}
                                            {{ settings()->get('short_name') ? '(' . settings()->get('short_name') . ')' : '' }}</small>
                                        <br> <br>
                                        <div class="mt-3 rounded p-3" style="background-color: #ccc">
                                            <h5>Name :</h5>
                                            {{Auth()->user()->first_name . " " . Auth()->user()->middel_name . " " .Auth()->user()->last_name}}
                                            <br>
                                            <h5 class="mt-2">DOB :</h5>
                                            {{Auth()->user()->dob}}
                                            <h5 class="mt-2">Age :</h5>
                                            {{Auth()->user()->age}}
                                            <h5 class="mt-2">Gender :</h5>
                                            {{Auth()->user()->gender}}
                                        </div>

                                        <hr>
                                        <h5 class="text-uppercase">Change personal details</h5>
                                        <form action="{{ route('setting.personalDetail') }}" method="POST" class="mt-3">
                                            @csrf
                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <x-input type="text" name="first_name" label="First Name* :"
                                                        required="true" default="{{ Auth()->user()->first_name }}" />
                                                </div>
                                                <div class="col-xl-4">
                                                    <x-input type="text" name="middle_name" label="Middle Name :"
                                                        default="{{ Auth()->user()->middle_name }}" />
                                                </div>
                                                <div class="col-xl-4">
                                                    <x-input type="text" name="last_name" label="Last Name* :"
                                                        required="true" default="{{ Auth()->user()->last_name }}" />
                                                </div>

                                                <div class="col-xl-4">
                                                    <x-input type="text" name="dob" label="DOB :" required="true"
                                                        default="{{ Auth()->user()->dob }}" />
                                                </div>

                                                <div class="col-xl-4">
                                                    <x-input type="text" name="age" label="Age :"
                                                        required="true" default="{{ Auth()->user()->age }}" />
                                                </div>

                                                <div class="col-xl-4">
                                                    <x-input type="text" name="gender" label="Gender :"
                                                        required="true" default="{{ Auth()->user()->gender }}" />
                                                </div>

                                            </div>
                                            <hr>
                                            <div class="col-12 d-flex justify-content-end">
                                                <input type="submit" class="btn btn-success" value="Update">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="profile7" role="tabpanel">
                                        <div class="pd-20">
                                            <h5 class="text-uppercase">Security and password</h5>
                                            <small style="font-size: 14px"
                                                class="p-0 m-0">{{ Auth()->user()->first_name . ' ' . Auth()->user()->middel_name . ' ' . Auth()->user()->last_name }}
                                                <i
                                                    class="fa-solid fa-minus text-secondary px-2"></i>{{ settings()->get('full_name', $default = null) }}
                                                {{ settings()->get('short_name') ? '(' . settings()->get('short_name') . ')' : '' }}</small>

                                            <label class="mt-3">Your password must be at least eight characters and
                                                should
                                                include a combination of numbers, letters and special characters
                                                (!$@%).</label>

                                            <div class="rounded p-3" style="background-color: #ccc">
                                                <h5><i class="fa-solid fa-lightbulb text-primary pr-2"></i>Passwords Tips
                                                </h5>

                                                <ul class="mt-3 pl-5">
                                                    <li class="mb-2"> <i
                                                            class="fa fa-solid fa-circle text-secondary pr-2"></i>Choose a
                                                        password that you don't use anywhere else online.</li>

                                                    <li class="mb-2"> <i
                                                            class="fa fa-solid fa-circle text-secondary pr-2"></i>Make it
                                                        easy for you to remember and difficult for other to guess</li>
                                                    <li> <i class="fa fa-solid fa-circle text-secondary pr-2"></i>Never
                                                        share your password with anyone.</li>
                                                </ul>
                                            </div>
                                            <label class="mt-3">If your HMS password is used elsewhere online then your
                                                account may be less secure. Protect yourself by choosing a strong
                                                password.</label>
                                            <hr>
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
                                    <div class="tab-pane fade " id="contact7" role="tabpanel">
                                        <div class="pd-20">
                                            <h5 class="text-uppercase">contact details</h5>
                                            <small style="font-size: 14px"
                                                class="p-0 m-0">{{ Auth()->user()->first_name . ' ' . Auth()->user()->middel_name . ' ' . Auth()->user()->last_name }}
                                                <i
                                                    class="fa-solid fa-minus text-secondary px-2"></i>{{ settings()->get('full_name', $default = null) }}
                                                {{ settings()->get('short_name') ? '(' . settings()->get('short_name') . ')' : '' }}</small>
                                            <br>

                                            <div class="mt-3 rounded p-3" style="background-color: #ccc">
                                                <h5>Email :</h5>
                                                <label class="pl-3 mt-2">{{ Auth()->user()->email }}</label> <br>
                                                @if (Auth()->user()->email_verified_at != '2000-01-01 00:00:00')
                                                    <label class="pl-3 text-secondary">Your email is <span
                                                            class="text-success font-weight-bold">verified</span>.</label>
                                                @else
                                                    <label class="pl-3 text-secondary">Your email is not verified. please
                                                        <a href="{{ route('setting.verifyEmail') }}"
                                                            class="text-primary">verify</a> your
                                                        email.</label>
                                                @endif
                                                <h5 class="mt-3">Phonr Number :</h5>
                                                <label class="pl-3 mt-2">{{ Auth()->user()->contact_number }}</label><br>
                                            </div>


                                            <hr>
                                            <h5 class="text-uppercase mb-3">Change Email</h5>
                                            <form action="{{ route('setting.changeEmail') }}" method="POST">
                                                @csrf
                                                <x-input type="email" placeholder="Email" name="email"
                                                    required="true" />
                                                <div class="d-flex col-12 justify-content-end">
                                                    <input type="submit" value="Change Email" class="btn btn-info">
                                                </div>
                                            </form>

                                            <hr>

                                            <h5 class="text-uppercase mb-3">Change Contact number</h5>
                                            <form action="{{ route('setting.changePhone') }}" method="POST">
                                                @csrf
                                                <x-input type="number" placeholder="Contact number"
                                                    name="contact_number" required="true" />
                                                <div class="d-flex col-12 justify-content-end">
                                                    <input type="submit" value="Change Phone Number"
                                                        class="btn btn-info">
                                                </div>
                                            </form>

                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="address" role="tabpanel" style="overflow: scroll">
                                        <div class="pd-20">
                                            <h5 class="text-uppercase">Address details</h5>
                                            <small style="font-size: 14px"
                                                class="p-0 m-0">{{ Auth()->user()->first_name . ' ' . Auth()->user()->middel_name . ' ' . Auth()->user()->last_name }}
                                                <i
                                                    class="fa-solid fa-minus text-secondary px-2"></i>{{ settings()->get('full_name', $default = null) }}
                                                {{ settings()->get('short_name') ? '(' . settings()->get('short_name') . ')' : '' }}</small>
                                            <br>

                                            <div class="mt-3 rounded p-3" style="background-color: #ccc">
                                                <h5>Address :</h5>
                                                @if ($address)
                                                    <label class="pl-3 mt-2"><i
                                                            class="fa fa fa-circle text-secondary pr-2"></i>{{ $address->municipality ? $address->municipality->municipality : '' }},
                                                        Ward no.- {{ $address->ward_no }}, {{ $address->tole }},
                                                        {{ $address->district ? $address->district->district_name : '' }},
                                                        {{ $address->province ? $address->province->province_name : '' }},{{ $address->country ? $address->country->country_name : '' }}</label>
                                                @else
                                                    Not defined
                                                @endif
                                                <br>

                                            </div>


                                            <hr>
                                            <h5 class="text-uppercase mb-3">Change Address</h5>
                                            <form action="{{ route('setting.changeAddress') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>Country :</label>
                                                            @if ($address && $address->country)
                                                                <select class="custom-select2 form-control" required
                                                                    name="country_id" style="width: 100%; height: 38px"
                                                                    id="country_id">
                                                                    <optgroup label="Countries">
                                                                        <option value="">Please select a country
                                                                        </option>
                                                                        @foreach ($countries as $country)
                                                                            <option value="{{ $country->id }}"
                                                                                {{ $address->country->id == $country->id ? 'selected' : '' }}>
                                                                                {{ $country->country_name }}</option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                </select>
                                                            @else
                                                                <select class="custom-select2 form-control" required
                                                                    name="country_id" style="width: 100%; height: 38px"
                                                                    id="country_id">
                                                                    <optgroup label="Countries">
                                                                        <option value="">Please select a country
                                                                        </option>
                                                                        @foreach ($countries as $country)
                                                                            <option value="{{ $country->id }}">
                                                                                {{ $country->country_name }}</option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                </select>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>Province :</label>
                                                            @if ($address && $address->province)
                                                                <select class="custom-select2 form-control" required
                                                                    name="province_id" style="width: 100%; height: 38px"
                                                                    id="province_id">
                                                                    @foreach ($provinces as $province)
                                                                        <option value="{{ $province->id }}"
                                                                            {{ $address->province->id == $province->id ? 'selected' : '' }}>
                                                                            {{ $province->province_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            @else
                                                                <select class="custom-select2 form-control" required
                                                                    name="province_id" style="width: 100%; height: 38px"
                                                                    id="province_id">

                                                                </select>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>District :</label>
                                                            @if ($address && $address->district)
                                                                <select class="custom-select2 form-control" required
                                                                    name="district_id" style="width: 100%; height: 38px"
                                                                    id="district_id">
                                                                    @foreach ($districts as $district)
                                                                        <option value="{{ $district->id }}"
                                                                            {{ $address->district->id == $district->id ? 'selected' : '' }}>
                                                                            {{ $district->district_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            @else
                                                                <select class="custom-select2 form-control" required
                                                                    name="district_id" style="width: 100%; height: 38px"
                                                                    id="district_id">

                                                                </select>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>Municipality :</label>
                                                            @if ($address && $address->municipality)
                                                                <select class="custom-select2 form-control" required
                                                                    name="municipality_id"
                                                                    style="width: 100%; height: 38px"
                                                                    id="municipality_id">

                                                                    @foreach ($municipalities as $municipality)
                                                                        <option value="{{ $municipality->id }}"
                                                                            {{ $address->municipality->id == $municipality->id ? 'selected' : '' }}>
                                                                            {{ $municipality->municipality }}</option>
                                                                    @endforeach
                                                                </select>
                                                            @else
                                                                <select class="custom-select2 form-control" required
                                                                    name="municipality_id"
                                                                    style="width: 100%; height: 38px"
                                                                    id="municipality_id">

                                                                </select>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-6">
                                                        @if ($address)
                                                            <x-input label="Ward Number :" type="number" name="ward_no"
                                                                default="{{ $address->ward_no }}" required="true" />
                                                        @else
                                                            <x-input label="Ward Number :" type="number" name="ward_no"
                                                                required="true" />
                                                        @endif

                                                    </div>
                                                    <div class="col-xl-6">
                                                        @if ($address)
                                                            <x-input label="Tole :" type="text" name="tole"
                                                                default="{{ $address->tole }}" required="true" />
                                                        @else
                                                            <x-input label="Tole :" type="text" name="tole"
                                                                required="true" />
                                                        @endif

                                                    </div>
                                                </div>


                                                <input type="submit" value="Change Address" class="btn btn-info col-12">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade " id="appSetting" role="tabpanel"
                                        style="overflow: scroll">
                                        <div class="pd-20">
                                            <h5 class="text-uppercase">App Setting</h5>
                                            <small style="font-size: 14px"
                                                class="p-0 m-0">{{ Auth()->user()->first_name . ' ' . Auth()->user()->middel_name . ' ' . Auth()->user()->last_name }}
                                                <i
                                                    class="fa-solid fa-minus text-secondary px-2"></i>{{ settings()->get('full_name', $default = null) }}
                                                {{ settings()->get('short_name') ? '(' . settings()->get('short_name') . ')' : '' }}</small>
                                            <br>

                                            <div class="mt-3 rounded p-3" style="background-color: #ccc">
                                                <h5>App Name :</h5>
                                                {{ settings()->get('full_name', $default = null) }}
                                                ({{ settings()->get('short_name', $default = null) }})
                                                <br>
                                                <h5>Logo :</h5>
                                                @if (settings()->get('logo'))
                                                    <img src="{{ asset('storage') }}{{ '/' }}{{ settings()->get('logo') }}"
                                                        alt="" id="test" style="width: 100px"
                                                        class="rounded" />
                                                @else
                                                    <img src="{{ asset('user1.png') }}" alt="" id="test"
                                                        style="width: 100px" class="rounded" />
                                                @endif
                                            </div>


                                            <hr>
                                            <h5 class="text-uppercase mb-3">Change App Setting</h5>
                                            <form action="{{ route('setting.appSetting') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <x-input type="text" name="short_name" placeholder="SHORT NAME"
                                                    label="APP NAME (Short) :"
                                                    default="{{ settings()->get('short_name', $default = null) }}" />
                                                <x-input type="text" name="full_name" placeholder="FULL NAME"
                                                    label="APP NAME (Full) :"
                                                    default="{{ settings()->get('full_name', $default = null) }}" />
                                                <div class="form-group">
                                                    <label>LOGO :</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="logo" class="custom-file-input" />
                                                        <label class="custom-file-label">Choose file</label>
                                                    </div>
                                                </div>
                                                <input type="submit" value="Change Address" class="btn btn-info col-12">
                                            </form>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="mailSetting" role="tabpanel"
                                        style="overflow: scroll">
                                        <div class="pd-20">
                                            <h5 class="text-uppercase">Mail Setting</h5>
                                            <small style="font-size: 14px"
                                                class="p-0 m-0">{{ Auth()->user()->first_name . ' ' . Auth()->user()->middel_name . ' ' . Auth()->user()->last_name }}
                                                <i
                                                    class="fa-solid fa-minus text-secondary px-2"></i>{{ settings()->get('full_name', $default = null) }}
                                                {{ settings()->get('short_name') ? '(' . settings()->get('short_name') . ')' : '' }}</small>
                                            <br>




                                            <hr>
                                            <h5 class="text-uppercase mb-3">Change Mail Setting</h5>
                                            <form action="{{ route('setting.mailSetting') }}" method="POST">
                                                @csrf

                                                <div class="row">
                                                    <div class="col-xl-4">
                                                        <x-input required="true" type="text" name="mail_transport"
                                                            label="Mail Transport :" placeholder="Mail Transport"
                                                            default="{{ settings()->get('mail_transport', $default = null) }}" />
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <x-input required="true" type="text" name="mail_host"
                                                            label="Mail Host :" placeholder="Mail Host"
                                                            default="{{ settings()->get('mail_host', $default = null) }}" />
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <x-input required="true" type="text" name="mail_port"
                                                            label="Mail Port :" placeholder="Mail Port"
                                                            default="{{ settings()->get('mail_port', $default = null) }}" />
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <x-input required="true" type="text" name="mail_username"
                                                            label="Mail Username :" placeholder="Mail Username"
                                                            default="{{ settings()->get('mail_username', $default = null) }}" />
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <x-input required="true" type="password" name="mail_password"
                                                            label="Mail Password :" placeholder="Mail Password"
                                                            default="{{ settings()->get('mail_password', $default = null) }}" />
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <x-input required="true" type="text" name="mail_encryption"
                                                            label="Mail Encryption :" placeholder="Mail Encryption"
                                                            default="{{ settings()->get('mail_encryption', $default = null) }}" />
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <x-input required="true" type="text" name="mail_from"
                                                            label="Mail From Address:" placeholder="Mail From Address"
                                                            default="{{ settings()->get('mail_from', $default = null) }}" />
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <x-input required="true" type="text" name="mail_from_name"
                                                            label="Mail From Name:" placeholder="Mail From Name"
                                                            default="{{ settings()->get('mail_from_name', $default = null) }}" />
                                                    </div>
                                                </div>

                                                <input type="submit" value="Change Address" class="btn btn-info col-12">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show active" id="orgSetting" role="tabpanel"
                                        style="overflow: scroll">
                                        <div class="pd-20">
                                            <h5 class="text-uppercase">Organization Setting</h5>
                                            <small style="font-size: 14px"
                                                class="p-0 m-0">{{ Auth()->user()->first_name . ' ' . Auth()->user()->middel_name . ' ' . Auth()->user()->last_name }}
                                                <i
                                                    class="fa-solid fa-minus text-secondary px-2"></i>{{ settings()->get('full_name', $default = null) }}
                                                {{ settings()->get('short_name') ? '(' . settings()->get('short_name') . ')' : '' }}</small>
                                            <br>




                                            <hr>
                                            <h5 class="text-uppercase mb-3">Change Organization Setting</h5>
                                            <form action="{{ route('setting.orgSetting') }}" method="POST">
                                                @csrf

                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <x-input required="true" type="text" name="org_name"
                                                            label="Organization Name :" placeholder="Organization Name"
                                                            default="{{ settings()->get('org_name', $default = null) }}" />
                                                    </div>
                                                    <div class="col-xl-12">
                                                        <x-input required="true" type="text" name="org_email"
                                                            label="Organization Email :" placeholder="Organization Email"
                                                            default="{{ settings()->get('org_email', $default = null) }}" />
                                                    </div>
                                                    <div class="col-xl-12">
                                                        <x-input required="true" type="text" name="org_contact"
                                                            label="Organization Contact :" placeholder="Organization Contact"
                                                            default="{{ settings()->get('org_contact', $default = null) }}" />
                                                    </div>
                                                    <div class="col-xl-12">
                                                        <x-input required="true" type="text" name="org_address"
                                                            label="Organization Address :" placeholder="Organization Address"
                                                            default="{{ settings()->get('org_address', $default = null) }}" />
                                                    </div>

                                                </div>

                                                <input type="submit" value="Change  " class="btn btn-info col-12">
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
        {{-- <div class="footer-wrap pd-20 mb-20 card-box">
            Hospital Management System By
            <a href="https://cbishal.com.np" target="_blank">Bishal Chaudhary</a>
        </div> --}}

    </div>
@endsection
