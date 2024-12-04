<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>@yield('title') - {{ env('TITLE_APP') }}</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Manage Your System By MSTD IT, Get Request System For Dept">
    <meta name="author" content="OJAN MSTD">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <!-- [ Pre-loader ] End -->

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

    <div class="auth-main">
        <div class="auth-wrapper v1">
            @yield('content')
        </div>
    </div>
    <!-- [ Main Content ] end -->

    {{-- Modal --}}
    <div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Panduan Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        Jika anda mengalami lupa password, segera hubungi IT Support Dengan melakukan request reset
                        password pada Device, jika sudah silahkan login kembali.
                    </p>
                    <strong>Have A Nice Day</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Js -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
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
