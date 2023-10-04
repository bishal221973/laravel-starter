@extends('layouts.app')

@section('title', 'Verify Email')
@section('content')
    <div class="main-container">
        <div class="card mb-2">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb p-4 m-0">
                            <li class="breadcrumb-item">
                                <a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Airline
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
                <form action="{{$agency->id ? route('agency.update',$agency) : route('agency.store') }}" method="POST">
                    @csrf
                    @isset($agency->id)
                        @method('PUT')
                    @endisset
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-4">
                                    <x-input name="airline_name" type="text" placeholder="Airline Name"
                                        label="Airline Name * :" required="true" default="{{$agency->id ? $agency->airline_name : ''}}" />
                                </div>

                                <div class="col-xl-4">
                                    <x-input name="phone" type="text" placeholder="Phone Number"
                                        label="Phone Number * :" required="true" default="{{$agency->id ? $agency->phone : ''}}"/>
                                </div>

                                <div class="col-xl-4">
                                    <x-input name="email" type="text" placeholder="Email Address" label="Email * :"
                                        required="true" default="{{$agency->id ? $agency->email : ''}}"/>
                                </div>

                                <div class="col-xl-4">
                                    <x-input name="address" type="text" placeholder="Airline Address"
                                        label="Airline Address * :" required="true" default="{{$agency->id ? $agency->address : ''}}"/>
                                </div>

                                <div class="col-xl-4">
                                    <x-input name="city" type="text" placeholder="City" label="City * :"
                                        required="true" default="{{$agency->id ? $agency->city : ''}}"/>
                                </div>

                                <div class="col-xl-4">
                                    <x-input name="state" type="text" placeholder="State/Province"
                                        label="State/Province * :" required="true" default="{{$agency->id ? $agency->state : ''}}"/>
                                </div>

                                <div class="col-xl-4">
                                    <x-input name="zip_code" type="text" placeholder="Zip Code" label="Zip Code * :"
                                        required="true" default="{{$agency->id ? $agency->zip_code : ''}}"/>
                                </div>

                                <div class="col-xl-4">
                                    <x-input name="country" type="text" placeholder="Country" label="Country * :"
                                        required="true" default="{{$agency->id ? $agency->country : ''}}"/>
                                </div>

                                <div class="col-xl-4">
                                    <x-input name="website" type="text" placeholder="Website" label="Website * :"
                                        required="true" default="{{$agency->id ? $agency->website : ''}}"/>
                                </div>
                            </div>
                            <div class=" d-flex justify-content-end">
                                <input type="submit" value="{{$agency->id ? 'Update' : 'Save'}}" class="btn btn-info ">
                            </div>
                        </div>
                    </div>


                </form>
            </div>
            <div class="col-xl-12">
                <div class="card mb-30">

                    <div class="pb-20">
                        <table class="data-table table hover multiple-select-row nowrap">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">S.N.</th>
                                    <th>Airline Name</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>State/Province</th>
                                    <th>Zip Code</th>
                                    <th>Country</th>
                                    <th>Website</th>
                                    <th>Action</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agencies as $agency)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $agency->airline_name}}</td>
                                        <td>{{ $agency->phone}}</td>
                                        <td>{{ $agency->email}}</td>
                                        <td>{{ $agency->address}}</td>
                                        <td>{{ $agency->city}}</td>
                                        <td>{{ $agency->state}}</td>
                                        <td>{{ $agency->zip_code}}</td>
                                        <td>{{ $agency->country}}</td>
                                        <td>{{ $agency->website ? $agency->website : ''}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle text-decoration-none"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item" href="{{route('agency.edit',$agency)}}"><i class="dw dw-edit2"></i> Edit</a>
                                                    <form action="{{route('agency.destroy',$agency)}}" method="POST" onsubmit="return confirm('Are you sure to delete ?')">
                                                        @csrf
                                                        @method('delete')

                                                        <button class="dropdown-item" href="#"><i class="dw dw-delete-3"></i>
                                                            Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
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
