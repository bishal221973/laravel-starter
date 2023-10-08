@extends('layouts.app')

@section('title', 'Verify Email')
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
                                Country
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
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ $user->id ? route('user.update', $user->id) : route('user.store') }}"
                            method="POST">
                            @csrf
                            @isset($user->id)
                                @method('put')
                            @endisset
                            <div class="row">
                                <div class="col-xl-3">
                                    <x-input name="first_name" type="text" placeholder="First Name"
                                        label="First Name * :" required="true"
                                        default="{{ $user->id ? $user->first_name : '' }}" />
                                </div>
                                <div class="col-xl-3">
                                    <x-input name="last_name" type="text" placeholder="Last Name" label="Last Name * :"
                                        required="true" default="{{ $user->id ? $user->last_name : '' }}" />
                                </div>
                                <div class="col-xl-3">
                                    <x-input name="dob" type="text" placeholder="DOB" label="DOB * :" required="true"
                                        default="{{ $user->id ? $user->dob : '' }}" />
                                </div>



                                <div class="col-xl-3">
                                    <div class="form-group">
                                        <label>Gender * :</label>
                                        <select name="gender" class="form-control">
                                            <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <x-input name="email" type="text" placeholder="Email" label="Email * :"
                                        required="true" default="{{ $user->id ? $user->dob : '' }}" />
                                </div>
                                <div class="col-xl-3">
                                    <x-input name="contact_number" type="text" placeholder="Contact" label="Contact * :"
                                        required="true" default="{{ $user->id ? $user->contact_number : '' }}" />
                                </div>
                                @if (!$user->id)
                                    <div class="col-xl-3 ">
                                        <x-input name="password" type="password" placeholder="Password" label="Password * :"
                                            required="true" />
                                    </div>
                                    <div class="col-xl-3">
                                        <x-input name="password_confirmation" type="password" placeholder="Password"
                                            label="Password * :" required="true" />
                                    </div>
                                @endif
                            </div>
                            <div class=" d-flex justify-content-end">
                                <input type="submit" value="{{ $user->id ? 'Update' : 'Save' }}" class="btn btn-info ">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 mt-3">
                <div class="card mb-30">
                    <div class="pd-20">
                    </div>
                    <div class="pb-20">
                        <table class="data-table table hover multiple-select-row nowrap">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">S.N.</th>
                                    <th>Name</th>
                                    <th>DOB</th>
                                    <th>Gender</th>
                                    <th>contact</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->first_name }} {{ $user->last_name }} <br>{{ $user->email }}</td>
                                        <td>{{ $user->dob }}</td>
                                        <td>{{ $user->gender }}</td>
                                        <td>{{ $user->contact_number }}</td>
                                        <td>{{ $user->roles[0]->name }}</td>

                                        @if ($user->roles[0]->name !='super-admin')
                                        <td class="d-flex">
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">Edit</a>

                                            <form action="{{route('user.destroy',$user->id)}}" onsubmit="return confirm('Are you sure ?')">

                                                <input type="submit" class="ml-2 btn btn-danger" value="Delete">
                                            </form>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>



    </div>

    @push('datatable')
    @endpush
@endsection
