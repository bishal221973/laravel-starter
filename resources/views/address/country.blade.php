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
        <form action="{{ route('role.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <x-input name="role" type="text" placeholder="New Role Name" label="Role Name * :"  required="true" />
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-body">
                    {{-- <h5 class="text-uppercase">Permissions</h5> --}}
                    <div class="col-12 d-flex justify-content-end">
                        <input type="submit" value="Save" class="btn btn-info ">
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
