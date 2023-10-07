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
                                Reviews
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

            @if ($review->id)
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('reviews.update', $review->id) }}">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $review->name) }}" id="">
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <textarea name="comment" class="form-control" id="" cols="30" rows="10">{{ old('comment', $review->comment) }}</textarea>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <input type="submit" class="btn btn-info" value="Update" id="">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-xl-12">
                <div class="card mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Customer reviews lists</h4>
                    </div>
                    <div class="pb-20">
                        <table class="data-table table hover multiple-select-row nowrap">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">S.N.</th>
                                    <th>Customer Name</th>
                                    <th>Comment</th>
                                    <th>Rating</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $review->name }}</td>
                                        <td>{{ Str::substr($review->comment, 0, 50) }}</td>
                                        <td>
                                            <div class="rateYo" data-rateyo-rating="{{$review->rating}}"></div>

                                        </td>
                                        <td class="d-flex">
                                            <a href="{{ route('reviews.edit', $review->id) }}"
                                                class="btn btn-danger">Edit</a>

                                                <form action="{{route('reviews.delete',$review->id)}}" onsubmit="return confirm('Are you sure ?')">
                                                    <button class="ml-2 btn btn-warning">Delete</button>
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
