@extends('layouts.app')

@section('title', 'Report')
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
                                Report
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
                <div class="card mb-30">
                    <div class="pd-20 d-flex justify-content-between">
                        <h4 class="text-blue h4">Booking Report</h4>
                        <div class="d-flex">
                            <form action="{{ route('exportExcel') }}" method="GET">






                                {{-- ============================================ --}}
                                <input type="hidden" value="{{ $_GET['customer'] ? $_GET['customer'] : '' }}"
                                    name="customer">
                                <input type="hidden" value="{{ $_GET['origin'] ? $_GET['origin'] : '' }}" name="origin">
                                <input type="hidden" value="{{ $_GET['destination'] ? $_GET['destination'] : '' }}"
                                    name="destination">
                                <input type="hidden"
                                    value="{{ $_GET['departureTime'] ? $_GET['departureTime'] : '' }}" name="departureTime"
                                    placeholder="Destination" class="form-control">
                                {{-- <hr> --}}
                                <input type="hidden" value="{{ $_GET['arrivalTime'] ? $_GET['arrivalTime'] : '' }}"
                                    name="arrivalTime">
                                <input type="hidden" value="{{ $_GET['bookingId'] ? $_GET['bookingId'] : '' }}"
                                    name="bookingId">
                                <input type="hidden" value="{{ $_GET['status'] ? $_GET['status'] : '' }}" name="status">
                                {{-- ============================================ --}}



                                <button type="submit" class="btn btn-info"><i class="fa-solid fa-file-excel"></i>
                                    EXCEL</button>
                            </form>
                            {{-- <button class="btn btn-info"><i class="fa-solid fa-file-csv"></i> CSV</button> --}}
                            <button class="btn btn-info mx-3"><i class="fa-solid fa-file-pdf"></i> PDF</button>
                        </div>
                    </div>
                    <div class="col-12">
                        <form action="{{ route('reportFilter') }}" method="GET">
                            <div class="row">
                                <div class="col-xl-2">
                                    <input type="text" value="{{ $_GET['customer'] ? $_GET['customer'] : '' }}"
                                        name="customer" placeholder="Customer" class="form-control">
                                </div>
                                <div class="col-xl-2">
                                    <input type="text" value="{{ $_GET['origin'] ? $_GET['origin'] : '' }}"
                                        name="origin" placeholder="Origin" class="form-control">
                                </div>
                                <div class="col-xl-2">
                                    <input type="text" value="{{ $_GET['destination'] ? $_GET['destination'] : '' }}"
                                        name="destination" placeholder="Destination" class="form-control">
                                </div>
                                <div class="col-xl-2 m-0 p-0 pt-1">
                                    <div class="dropdown show m-0 p-0 col-12">
                                        <a class="btn col-12 btn-white border text-left dropdown-toggle" href="#"
                                            role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Departure - Arival
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <div class="p-2">
                                                <label class="text-muted">Departure</label>
                                                <input type="datetime-local"
                                                    value="{{ $_GET['departureTime'] ? $_GET['departureTime'] : '' }}"
                                                    name="departureTime" placeholder="Destination" class="form-control">
                                                {{-- <hr> --}}
                                                <label class="text-muted mt-2">Arrival</label>
                                                <input type="datetime-local"
                                                    value="{{ $_GET['arrivalTime'] ? $_GET['arrivalTime'] : '' }}"
                                                    name="arrivalTime" placeholder="Destination" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2">
                                    <input type="text" value="{{ $_GET['bookingId'] ? $_GET['bookingId'] : '' }}"
                                        name="bookingId" placeholder="Booking ID" class="form-control">
                                </div>
                                <div class="col-xl-2">
                                    <input type="text" value="{{ $_GET['status'] ? $_GET['status'] : '' }}"
                                        name="status" placeholder="Status" class="form-control">
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <div class="mt-2 mr-2">
                                        <button class="btn btn-info col-12" type="submit"><i
                                                class="mr-2 fa-solid fa-filter"></i> Filter</button>
                                        {{-- <input type="submit" value="Filter" > --}}
                                    </div>
                                    <div class="mt-2">
                                        <button class="btn btn-danger col-12" type="button"><i
                                                class="fa-solid fa-xmark mr-2"></i> Cancel</button>
                                        {{-- <input type="submit" value="Cancel" > --}}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="pb-20">
                        <table class="data-table table hover multiple-select-row nowrap">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">S.N.</th>
                                    <th>Customer</th>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Refrence</th>
                                    <th>Booking Id</th>
                                    <th>Price</th>
                                    <th>status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $report)
                                    {{-- <tr>
                                        <td>
                                            @php
                                                print_r($report['user']['first_name']);
                                            @endphp
                                        </td>
                                    </tr> --}}
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $report->first_name }} {{ $report->last_name }} <br> {{ $report->email }}
                                        </td>
                                        <td>
                                            {{ getCity($report->fromIataCode) }} ({{ $report->fromIataCode }})
                                            <br>
                                            {{ getDates($report->fromTime) }} {{ getTime($report->fromTime) }}
                                        </td>
                                        <td>
                                            {{ getCity($report->toIataCode) }} ({{ $report->toIataCode }})
                                            <br>
                                            {{ getDates($report->toTime) }} {{ getTime($report->toTime) }}
                                        </td>
                                        <td>{{ $report->booking_refrence }}</td>
                                        <td>{{ $report->booking_id }}</td>
                                        <td>{{ $report->price }}</td>
                                        <td>{{ $report->status }}</td>
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
