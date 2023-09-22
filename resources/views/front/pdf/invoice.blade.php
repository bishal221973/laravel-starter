<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/fontawesome.min.css"/> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/> --}}


    <style>
        .label-12 {
            font-size: 12px !important;
        }

        .label-13 {
            font-size: 13px !important;
        }

        .fw-bold {
            font-weight: bold !important;
        }

        .label1 {
            position: relative !important;
            top: -10px !important;
        }

        .bg-secondary {
            background-color: #F5F5F7 !important;
        }

        h5 {
            font-size: 18px !important;
        }

        .d-flex {
            display: flex !important;
        }

        .align-items-center {
            align-items: center !important;
        }

        .card1 {
            width: 100px !important;
        }

    </style>
</head>

<body>
    <div class="card mb-3">
        <div class="card-body m-0 p-0 px-3">
            <table style="width: 100%">
                <tr style="width: 100%">
                    <td style="width: 60%">111</td>
                    <td>
                        <span class="label-12 "><span class="fw-bold">Payment Status</span> : Unpaid</span> <br>
                        <span class="label-12 m-0 p-0"><span class="fw-bold m-0 p-0">Phone</span> : 9814668499</span>
                        <br>
                        <span class="label-12 m-0 p-0"><span class="fw-bold m-0 p-0">Email</span> :
                            bishalcodeslaravel@gmail.com</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="card bg-secondary py-2 mb-3">
        <div class="card-body m-0 p-0 px-3">
            <table style="width: 100%">
                <tr style="width: 100%">
                    <td style="width: 60%">
                        <div style="display: inline-block">
                            <h5 class="">Pay With</h5>

                            <div style="display: flex;justify-content:center" class="card">
                                <label class="px-3 py-1">Bank Transfer</label>
                            </div>
                        </div>
                    </td>
                    <td style="display: flex;justify-content:end">
                        <h5 class="pt-4 text-right">126 EUR</h5>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <table style="width: 100%" class="mb-3">
        <tr class="bg-secondary">
            <th class="label-12 border p-3">Booking Refrence</th>
            <th class="label-12 border p-3">Booking ID</th>
            <th class="label-12 border p-3">Booking Date</th>
        </tr>
        <tr>
            <td class="label-12 border px-3 py-2">dt4t588t</td>
            <td class="label-12 border px-3 py-2"> erer4555erffg=rfff77f</td>
            <td class="label-12 border px-3 py-2"> 2020-02-02T01:02:03</td>
        </tr>

    </table>

    <div class="card p-1" style="border-bottom:none;border-bottom-left-radius:0px;border-bottom-right-radius:0px">
        <h5 class="text-uppercase">Travellers</h5>
    </div>
    <table style="width: 100%" class="mb-3">
        <tr class="bg-secondary">
            <th class="label-12 border p-3">S.N.</th>
            <th class="label-12 border p-3">Name</th>
            <th class="label-12 border p-3">Date of Birth</th>
            <th class="label-12 border p-3">Gender</th>
        </tr>
        <tr>
            <td class="label-12 border px-3 py-2">1</td>
            <td class="label-12 border px-3 py-2"> Bishal Chaudhary</td>
            <td class="label-12 border px-3 py-2"> 2020-02-02</td>
            <td class="label-12 border px-3 py-2"> Male</td>
        </tr>

    </table>

    <div class="card">
        <div class="card-header">
            <h5 class="text-uppercase">Flight</h5>
        </div>
        <div class="card-body">
            <table>
                <tr>
                    <td>
                        <i class="fa fa-heart"></i>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
