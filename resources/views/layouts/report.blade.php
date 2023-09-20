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
                    <div class="pd-20">
                        <h4 class="text-blue h4">Booking Report</h4>
                    </div>
                    <div class="pb-20">
                        <table class="data-table table hover multiple-select-row nowrap">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">S.N.</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Refrence</th>
                                    <th>Booking Id</th>
                                    <th>Price</th>
                                    <th>status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $report)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{getCity($report->fromIataCode)}} ({{ $report->fromIataCode }})
                                            <br>
                                            {{getDates($report->fromTime)}} {{getTime($report->fromTime)}}
                                        </td>
                                        <td>
                                            {{getCity($report->toIataCode)}} ({{ $report->toIataCode }})
                                            <br>
                                            {{getDates($report->toTime)}} {{getTime($report->toTime)}}
                                        </td>
                                        <td>{{$report->booking_refrence}}</td>
                                        <td>{{$report->booking_id}}</td>
                                        <td>{{$report->price}}</td>
                                        <td>{{$report->status}}</td>
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
