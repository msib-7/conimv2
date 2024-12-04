<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>@yield('title') - {{ env('TITLE_APP') }}</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="OJAN MSTD">

    <!-- [Favicon] icon -->
    <link rel="icon" href="../assets/images/favicon.svg" type="image/x-icon">
    <!-- [Font] Family -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/inter/inter.css') }}" id="main-font-link" />

    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}" />
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}" />
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}" />
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link" />
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}" />
    @yield('styles')
</head>
<!-- [Head] end -->
<style>
    .btn-nav {
        padding-top: 13px;
        width: 150px;
        height: 50px;
    }

    .nav-icon {
        padding-top: 13px;
        width: 50px;
        height: 50px;
        padding-top: 14px;
        padding-left: 14px;
    }

    .img-banner {
        width: 100%;
        height: 300px;
        border-radius: 10px;
        object-fit: cover;
        object-position: center;
    }

    .modal-open .modal-backdrop {
        backdrop-filter: blur(3px);
        background-color: rgba(31, 31, 31, 0.091);
        opacity:
    }

    .nav-icon i {
        font-size: 20px;
    }

    .btn {
        border-radius: 15px;
    }

    .loading-overlay-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .loading-overlay {
        display: none;
        background: rgba(255, 255, 255, 0.6);
        position: fixed;
        height: 100%;
        width: 100%;
        z-index: 5000;
        top: 0;
        left: 0;
        cursor: wait;
        /* Tambahkan baris ini */
    }

    .loading-text {
        color: #69c395;
        font-size: 1.2rem;
        margin-top: 10px;
    }
</style>
<!-- [Body] Start -->

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <!-- loading -->
    <div class="loading-overlay" id="loading-overlay">
        <div class="loading-overlay-content">
            {{-- <img src="https://i.gifer.com/ZKZg.gif" width="80" height="80" alt="Loading" id="loading"> --}}
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200">
                <radialGradient id="a12" cx=".66" fx=".66" cy=".3125" fy=".3125"
                    gradientTransform="scale(1.5)">
                    <stop offset="0" stop-color="#0B902D"></stop>
                    <stop offset=".3" stop-color="#0B902D" stop-opacity=".9"></stop>
                    <stop offset=".6" stop-color="#0B902D" stop-opacity=".6"></stop>
                    <stop offset=".8" stop-color="#0B902D" stop-opacity=".3"></stop>
                    <stop offset="1" stop-color="#0B902D" stop-opacity="0"></stop>
                </radialGradient>
                <circle transform-origin="center" fill="none" stroke="url(#a12)" stroke-width="15"
                    stroke-linecap="round" stroke-dasharray="200 1000" stroke-dashoffset="0" cx="100"
                    cy="100" r="70">
                    <animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2"
                        values="360;0" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform>
                </circle>
                <circle transform-origin="center" fill="none" opacity=".2" stroke="#0B902D" stroke-width="15"
                    stroke-linecap="round" cx="100" cy="100" r="70"></circle>
            </svg>
            <div class="loading-text"><strong>Loading...</strong></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- [ Sidebar Menu ] start -->
    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="#" class="b-brand text-primary">
                    <!-- ========   Change your logo from here   ============ -->
                    <img src="{{ asset('assets/images/Logo-Kalbe-&-BSB_Original.png') }}" width="220" />
                </a>
            </div>
            <div class="navbar-content">
                <div class="card pc-user-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('assets/images/user/avatar-1.jpg') }}" alt="user-image"
                                    class="user-avtar wid-45 rounded-circle" />
                            </div>
                            <div class="flex-grow-1 ms-3 me-2">
                                <h6 class="mb-0">
                                    {{ Illuminate\Support\Str::limit(auth()->user()->fullname, 13, '...') }}</h6>
                                <small>{{ auth()->user()->employeId }} - Employee</small>
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.theme.sidebar')
            </div>
        </div>
    </nav>
    <!-- [ Sidebar Menu ] end -->
    <!-- [ Header Topbar ] start -->
    <header class="pc-header">
        <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <!-- ======= Menu collapse Icon ===== -->
                    <li class="pc-h-item pc-sidebar-collapse">
                        <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="pc-h-item pc-sidebar-popup">
                        <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>

                </ul>
            </div>
            <!-- [Mobile Media Block end] -->
            <div class="ms-auto">
                <ul class="list-unstyled">
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-sun-1"></use>
                            </svg>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
                            <a href="#!" class="dropdown-item" onclick="layout_change('dark')">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-moon"></use>
                                </svg>
                                <span>Dark</span>
                            </a>
                            <a href="#!" class="dropdown-item" onclick="layout_change('light')">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-sun-1"></use>
                                </svg>
                                <span>Light</span>
                            </a>
                            <a href="#!" class="dropdown-item" onclick="layout_change_default()">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-setting-2"></use>
                                </svg>
                                <span>Default</span>
                            </a>
                        </div>
                    </li>


                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-notification"></use>
                            </svg>
                            <span class="badge bg-success pc-h-badge">{{ count(auth()->user()->notify()) }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <h5 class="m-0">Notifications</h5>
                                <a href="#!" class="btn btn-link btn-sm">Mark all read</a>
                            </div>
                            <div class="dropdown-body text-wrap header-notification-scroll position-relative"
                                style="max-height: calc(100vh - 215px)">
                                @foreach (auth()->user()->notify() as $notif)
                                    @php
                                        // Cek apakah notifikasi dari hari ini
                                        $isToday = Carbon\Carbon::parse($notif->created_at)->isToday();
                                        // Format waktu relative seperti "2 min ago"
                                        $relativeTime = Carbon\Carbon::parse($notif->created_at)->diffForHumans();
                                    @endphp

                                    @if ($loop->first || !$isToday)
                                        <p class="text-span">{{ $isToday ? 'Today' : 'Kemarin' }}</p>
                                    @endif

                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <svg class="pc-icon text-primary">
                                                        <use xlink:href="#custom-notification"></use>
                                                    </svg>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <span
                                                        class="float-end text-sm text-muted">{{ $relativeTime }}</span>
                                                    <h5 class="text-body mb-2">{{ $notif->title }}</h5>
                                                    <p class="mb-0">{{ $notif->message }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="text-center py-2">
                                <a href="#!" class="link-danger">Clear all Notifications</a>
                            </div>
                        </div>
                    </li>

                    <li class="dropdown pc-h-item header-user-profile">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" data-bs-auto-close="outside"
                            aria-expanded="false">
                            <img src="{{ asset('assets/images/user/avatar-2.jpg') }}" alt="user-image"
                                class="user-avtar" />
                        </a>
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <h5 class="m-0">Profile</h5>
                            </div>
                            <div class="dropdown-body">
                                <div class="profile-notification-scroll position-relative"
                                    style="max-height: calc(100vh - 225px)">
                                    <div class="d-flex mb-1">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('assets/images/user/avatar-2.jpg') }}"
                                                alt="user-image" class="user-avtar wid-35" />
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">{{ auth()->user()->fullname }} 🖖</h6>
                                            <span>{{ auth()->user()->email }}</span>
                                        </div>
                                    </div>
                                    <hr class="border-secondary border-opacity-50" />
                                    <div class="card">
                                        <div class="card-body py-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0 d-inline-flex align-items-center"><svg
                                                        class="pc-icon text-muted me-2">
                                                        <use xlink:href="#custom-notification-outline"></use>
                                                    </svg>Notification</h5>
                                                <div class="form-check form-switch form-check-reverse m-0">
                                                    <input class="form-check-input f-18" type="checkbox"
                                                        role="switch" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-span">Manage</p>
                                    <a href="#" class="dropdown-item">
                                        <span>
                                            <svg class="pc-icon text-muted me-2">
                                                <use xlink:href="#custom-setting-outline"></use>
                                            </svg>
                                            <span>Settings</span>
                                        </span>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <span>
                                            <svg class="pc-icon text-muted me-2">
                                                <use xlink:href="#custom-share-bold"></use>
                                            </svg>
                                            <span>Share</span>
                                        </span>
                                    </a>
                                    <hr class="border-secondary border-opacity-50" />

                                    <div class="d-grid mb-3">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            <button type="submit" class="btn btn-primary text-light w-100">
                                                <svg class="pc-icon me-2">
                                                    <use xlink:href="#custom-logout-1-outline"></use>
                                                </svg>Logout
                                            </button>
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- [ Header ] end -->



    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="d-flex justify-content-between">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0)">Employee</a></li>
                                    <li class="breadcrumb-item" aria-current="page">@yield('title')</li>
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    <h2 class="mb-0">@yield('title')</h2>
                                </div>
                            </div>
                        </div>
                        @yield('button')
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            @yield('content')
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col my-1">
                    <p class="m-0">Kalbe Farma &#9829; crafted by MSTD Team</p>
                </div>
                <div class="col-auto my-1">
                    <ul class="list-inline footer-link mb-0">
                        <li class="list-inline-item"><a href="#" target="_blank">Documentation</a></li>
                        <li class="list-inline-item"><a href="#" target="_blank">Support</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- [Page Specific JS] end -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <!-- Required Js -->
    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
    @if (session('success'))
        <script type="text/javascript">
            Swal.fire({
                title: 'Terima Kasih',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Tutup'
            });
        </script>
    @endif
    @if (session('galat'))
        <script type="text/javascript">
            Swal.fire({
                title: 'Mohon Maaf',
                text: '{{ session('galat') }}',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Tutup'
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            function showLoading() {
                $('#loading-overlay').fadeIn(); // Gunakan fadeIn untuk efek yang halus
            }

            // Fungsi untuk menyembunyikan overlay
            function hideLoading() {
                $('#loading-overlay').fadeOut(); // Gunakan fadeOut untuk efek yang halus
            }

            $('form').on('submit', function(e) {
                e.preventDefault(); // Mencegah submit form default

                // Disable tombol submit setelah form disubmit
                var $form = $(this);
                $form.find('button[type="submit"]').attr('disabled', true);
                $form.find('button[type="submit"]').text('Loading...');

                // Gunakan FormData untuk menyertakan file
                var formData = new FormData(this);

                // Submit data menggunakan AJAX
                $.ajax({
                    type: $form.attr('method'), // Method form POST atau GET
                    url: $form.attr('action'), // URL tujuan
                    data: formData, // Gunakan FormData
                    processData: false, // Jangan memproses data
                    contentType: false, // Jangan set content type
                    beforeSend: function() {
                        showLoading();
                        $form.find('button[type="submit"]').attr('disabled', true);
                        $form.find('button[type="submit"]').text('Loading...');
                    },
                    success: function(response) {
                        // Proses selesai, enable kembali tombol
                        $form.find('button[type="submit"]').attr('disabled', false);
                        $form.find('button[type="submit"]').text('Submit');
                        console.log(response);

                        // Opsional: tangani respons dari Laravel
                        if (response.success) {
                            // Menampilkan SweetAlert dengan pesan sukses
                            Swal.fire({
                                title: response.message,
                                text: 'Anda akan dialihkan dalam 3 detik.',
                                icon: 'success',
                                allowOutsideClick: false, // Tidak bisa ditutup dengan klik luar
                                allowEscapeKey: false, // Tidak bisa ditutup dengan tombol escape
                                timer: 3000, // Timer 3 detik sebelum redirect
                                timerProgressBar: true, // Progress bar di bawah modal
                                didOpen: () => {
                                    Swal
                                        .showLoading(); // Menampilkan loading di dalam modal
                                },
                                willClose: () => {
                                    // Redirect ke halaman setelah timer selesai
                                    window.location.href = response.redirect;
                                }
                            });
                        } else {
                            // Menampilkan SweetAlert dengan pesan error
                            Swal.fire({
                                title: 'Error System',
                                text: response.message,
                                icon: 'error',
                                allowOutsideClick: false, // Tidak bisa ditutup dengan klik luar
                                allowEscapeKey: false, // Tidak bisa ditutup dengan tombol escape
                            });

                            // Enable kembali tombol submit
                            $form.find('button[type="submit"]').attr('disabled', false).text(
                                'Submit');
                        }
                    },
                    error: function(xhr) {
                        // Enable kembali tombol submit
                        $form.find('button[type="submit"]').attr('disabled', false).text(
                            'Submit');

                        // Tangani error validasi dari Laravel
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;

                            // Hapus pesan error sebelumnya
                            $('.invalid-feedback').remove();
                            $('.is-invalid').removeClass('is-invalid');

                            // Tampilkan pesan error
                            $.each(errors, function(key, value) {
                                var inputField = $form.find(`[name="${key}"]`);
                                inputField.addClass('is-invalid');
                                inputField.after(
                                    `<span class="invalid-feedback" role="alert"><strong>${value[0]}</strong></span>`
                                );
                            });

                        } else {
                            alert('Terjadi kesalahan, coba lagi.');
                        }
                    },
                    complete: function() {
                        hideLoading();
                        $form.find('button[type="submit"]').attr('disabled', false);
                    }
                });
            });
        });
    </script>


    @yield('scripts')
</body>
<!-- [Body] end -->

</html>
