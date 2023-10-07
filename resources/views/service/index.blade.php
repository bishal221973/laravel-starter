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
                                Services
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
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ $service->id ? route('servece.update',$service) : route('servece.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @isset($service->id)
                                @method('PUT')
                            @endisset
                            <div class="row">
                                <div class="col-xl-6">
                                    <x-input name="name" type="text" placeholder="Service Name" label="Service Name * :"
                                        required="true" default="{{$service->id ? $service->name : ''}}" />
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label>Image *:</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Descripion :</label>
                                        <textarea name="description" class="form-control" id="" cols="30" rows="10">{{old('description',$service->description)}}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class=" d-flex justify-content-end">
                                        <input type="submit" value="{{$service->id ? 'Update' : 'Save'}}" class="btn btn-info ">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-30">
                    <div class="pd-20">
                        {{-- <h4 class="text-blue h4">Data Table with multiple select row</h4> --}}
                    </div>
                    <div class="pb-20">
                        <table class="data-table table hover multiple-select-row nowrap">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">S.N.</th>
                                    <th>Service Name</th>
                                    <th>Description</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td>
                                            <img src="{{asset('storage')}}{{'/'}}{{$service->image}}" style="height: 50px" alt="">
                                            {{ $loop->iteration }}</td>
                                        <td>{{ $service->name }}</td>
                                        <td>{{ Str::substr($service->description, 0, 30) }}</td>

                                        <td class="d-flex">
                                            <a href="{{route('servece.edit',$service)}}" class="btn btn-warning">Edit</a>
                                            <form action="{{route('service',$service->id)}}" method="POST" onsubmit="return confirm('Are you sure ?')">
                                                @method('get')
                                                <input type="submit" class="btn btn-danger ml-3" value="Delete">
                                            </form>
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
