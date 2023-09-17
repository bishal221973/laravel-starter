{{-- <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hospital Management System</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html> --}}



<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>{{ settings()->get('short_name', $default = 'SYSTEM') }} | @yield('title')</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/core.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/icon-font.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('src/plugins/datatables/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/all.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('imgCrop/croppie.css') }}" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258"
        crossorigin="anonymous"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-GBZ3SGGX85");
    </script>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                "gtm.start": new Date().getTime(),
                event: "gtm.js"
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != "dataLayer" ? "&l=" + l : "";
            j.async = true;
            j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, "script", "dataLayer", "GTM-NXZMQSS");
    </script>
    <!-- End Google Tag Manager -->

    <style>
        .avatar-photo {
            height: 150px !important;
            border-radius: 50%;
            width: 150px !important;
        }

        .profile-card {
            height: 350px;

            background-size: cover !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
        }

        .profile-card .profile {
            position: relative;
            top: 270px;
            display: flex;
        }

        .profile-name {
            margin-top: 70px;
            margin-left: 20px;
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .upload {
            display: none;
        }

        .uploadLabel {
            display: inline-block;
            text-transform: uppercase;
            color: #fff;
            background-color: #c0392b;
            text-align: center;
            user-select: none;
            cursor: pointer;
            width: 100%;
        }

        #editProfile,
        #editCover {
            z-index: 9999 !important;
            background-color: rgba(0, 0, 0, 0.2) !important;
        }

        #btnProfileCrop,
        #btnProfileSave,
        #btnProfileCancel,
        #btnProfileOk,
        #btnCoverSave {
            display: none;
        }

        .user-icon img {
            height: 60px !important;
            min-width: 60px !important;
        }

        .dropdown-toggle {
            margin-top: -4px;
        }

        .dropdown-toggle::after {
            content: "" !important;
        }

        .header-profile-image {
            width: 70px;
            height: 70px;
            border-radius: 20px;
            margin-top: 15px;
        }

        .profile-dropdown {
            width: max-content;
        }

        .nav-link.active {
            background-color: #ccc !important;
            color: #000 !important;
        }
    </style>

    <style>
        .logo {
            height: 80px;
            width: 80px;
            border-radius: 20px;
        }
        .dropdown-toggle{
            padding: 0 !important;
            padding-left:10px !important;
            padding-top: 10px !important;
            padding-bottom: 10px !important;
        }

        .myicon {
            margin: 0;
            padding: 0;
            font-size: 21px !important;
            padding-right: 10px;
        }
        .register-panel{
            height: 100vh !important;
            background-image: url('flight2.jpg') !important;
        }
    </style>
</head>

<body>

    @guest
        @yield('content')
    @else
        <x-header-component />
        <x-sidebar-component />





        <div class="mobile-menu-overlay"></div>

        @yield('content')
    @endguest


    <!-- welcome modal end -->
    <!-- js -->
    <script src="{{ asset('vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('vendors/scripts/layout-settings.js') }}"></script>
    <script src="{{ asset('src/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/scripts/dashboard3.js') }}"></script>
    <script src="{{ asset('fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('imgCrop/croppie.js') }}"></script>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- End Google Tag Manager (noscript) -->
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    </script>
    @stack('message')
    <script>
        // Get references to the input and image elements
        const imageInput = document.getElementById("uploadProfile");
        const imagePreview = document.getElementById("profilePreview");

        // Add an event listener to the input element
        imageInput.addEventListener("change", function() {
            // Check if a file was selected
            if (imageInput.files && imageInput.files[0]) {
                const reader = new FileReader();

                // Set up a callback function to run when the image is loaded
                reader.onload = function(e) {
                    // Set the image source to the loaded data URL
                    imagePreview.src = e.target.result;
                };

                // Read the selected image file as a data URL
                reader.readAsDataURL(imageInput.files[0]);

            }
            $("#btnProfileCrop").css("display", "block");
            $("#btnProfileSave").css("display", "block");
        });
    </script>
    <script>
        let cropper;
        $("#btnProfileCrop").on("click", function() {
            const image = document.getElementById('profilePreview');
            cropper = new Cropper(image, {
                aspectRatio: 0,
                viewMode: 0,
            });
            $("#btnProfileSave").css("display", "none");
            $("#btnProfileCrop").css("display", "none");
            $("#btnProfileOk").css("display", "block");
            $("#btnProfileCancel").css("display", "block");

        });

        $("#btnProfileCancel").on("click", function() {
            cropper.destroy();
            $("#btnProfileSave").css("display", "block");
            $("#btnProfileCrop").css("display", "block");
            $("#btnProfileOk").css("display", "none");
            $("#btnProfileCancel").css("display", "none");
        });

        $("#btnProfileOk").on("click", function() {
            const croppedCanvas = cropper.getCroppedCanvas({
                minWidth: 256,
                minHeight: 256,
                maxWidth: 4096,
                maxHeight: 4096,
            });
            cropper.destroy();
            const croppedImageDataURL = croppedCanvas.toDataURL("image/jpeg"); // Change format if needed

            // Display the cropped image in an <img> element
            const croppedImage = document.getElementById("profilePreview");
            croppedImage.src = croppedImageDataURL;

            $("#btnProfileSave").css("display", "block");
            $("#btnProfileCrop").css("display", "block");
            $("#btnProfileOk").css("display", "none");
            $("#btnProfileCancel").css("display", "none");
        });
        $("#btnProfileSave").on("click", function() {});
    </script>
    <script>
        // Get references to the input and image elements
        const imageInput1 = document.getElementById("uploadCover");
        const imagePreview1 = document.getElementById("coverPreview");

        // Add an event listener to the input element
        imageInput1.addEventListener("change", function() {
            // Check if a file was selected
            if (imageInput1.files && imageInput1.files[0]) {
                const reader = new FileReader();

                // Set up a callback function to run when the image is loaded
                reader.onload = function(e) {
                    // Set the image source to the loaded data URL
                    imagePreview1.src = e.target.result;
                };

                // Read the selected image file as a data URL
                reader.readAsDataURL(imageInput1.files[0]);

            }
            $("#btnCoverSave").css("display", "block");
        });
    </script>
    <script>
        $('#country_id').on('change', function() {
            var id = $(this).val();
            var url = "{{ route('setting.selectProvince', ':id') }}";
            // alert(id);
            url = url.replace(':id', id);
            $("#province_id").empty();

            var x = document.getElementById("province_id");
            var option = document.createElement("option");
            option.text = "Please select a province";
            option.value = "";
            x.add(option);

            $.ajax({
                url: url,
                type: "GET",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    console.log(dataResult.data);
                    var resultData = dataResult.data;
                    var bodyData = '';
                    var i = 0;
                    for (var i = 0; i < dataResult.data.length; i++) {
                        $('#province_id').append($('<option>', {
                            value: dataResult.data[i].id,
                            text: dataResult.data[i].province_name
                        }));
                        // appendImageCategorySelect(resultData[i].id, resultData[i].category);
                    }
                }
            });
        });
    </script>

    <script>
        $('#province_id').on('change', function() {
            var id = $(this).val();
            var url = "{{ route('setting.selectDistrict', ':id') }}";
            // alert(id);
            url = url.replace(':id', id);
            $("#district_id").empty();
            var x = document.getElementById("district_id");
            var option = document.createElement("option");
            option.text = "Please select a district";
            option.value = "";

            x.add(option);
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    console.log(dataResult.data);
                    var resultData = dataResult.data;
                    var bodyData = '';
                    var i = 0;
                    for (var i = 0; i < dataResult.data.length; i++) {
                        $('#district_id').append($('<option>', {
                            value: dataResult.data[i].id,
                            text: dataResult.data[i].district_name
                        }));
                        // appendImageCategorySelect(resultData[i].id, resultData[i].category);
                    }
                }
            });
        });
    </script>

    <script>
        $('#district_id').on('change', function() {
            var id = $(this).val();
            var url = "{{ route('setting.selectMunicipality', ':id') }}";
            // alert(id);
            url = url.replace(':id', id);
            $("#municipality_id").empty();
            var x = document.getElementById("municipality_id");
            var option = document.createElement("option");
            option.text = "Please select a municipality";
            option.value = "";

            x.add(option);

            $.ajax({
                url: url,
                type: "GET",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    console.log(dataResult.data);
                    var resultData = dataResult.data;
                    var bodyData = '';
                    var i = 0;
                    for (var i = 0; i < dataResult.data.length; i++) {
                        $('#municipality_id').append($('<option>', {
                            value: dataResult.data[i].id,
                            text: dataResult.data[i].municipality
                        }));
                        // appendImageCategorySelect(resultData[i].id, resultData[i].category);
                    }
                }
            });
        });
    </script>
</body>

@yield('datatable')
</html>
