@extends('layouts.theme.master')
@section('title')
    Progress QCC
@endsection

@section('button')
    <button class="btn btn-primary btn-nav ms-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
        <i data-feather="plus"></i> Add Progress
    </button>
@endsection

@section('styles')
    <!-- data tables css -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap5.min.css') }}">
@endsection

@section('content')
    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">@yield('title')</h5>
                    <p class="mt-0">
                        Manage Your Progress QCC
                    </p>
                </div>
                <div class="card-body table-card">
                    <div class="dt-responsive table-responsive">
                        <table id="footer-select" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Step</th>
                                    <th>Description</th>
                                    <th>Absensi</th>
                                    <th>Status</th>
                                    <th>Absensi</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Step</th>
                                    <th>Description</th>
                                    <th>Absensi</th>
                                    <th>Status</th>
                                    <th>Absensi</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- Add User Baru -->
    <div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">New Progress QCC</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('v1.qcc.progress.store', $data->id) }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label class="form-label">Title <small class="text-danger">*</small></label>
                            <select class="form-select @error('langkah') is-invalid @enderror" aria-label="Langkah"
                                name="langkah">
                                <option value="">-- Pilih --</option>
                                <option value="Langkah 1 - Latar belakang & menentukan tema">Langkah 1 - Latar
                                    belakang & menentukan tema</option>
                                <option value="Langkah 2 - Menentukan target">Langkah 2 - Menentukan target</option>
                                <option value="Langkah 3 - Analisa kondisi yang ada">Langkah 3 - Analisa kondisi yang ada
                                </option>
                                <option value="Langkah 4 - Analisa sebab akibat">Langkah 4 - Analisa sebab akibat</option>
                                <option value="Langkah 5 - Rencana penanggulangan">Langkah 5 - Rencana penanggulangan
                                </option>
                                <option value="Langkah 6 - Penanggulangan">Langkah 6 - Penanggulangan</option>
                                <option value="Langkah 7 - Evaluasi hasil">Langkah 7 - Evaluasi hasil</option>
                                <option value="Langkah 8 - Standardisasi & Tindak lanjut">Langkah 8 - Standardisasi & Tindak
                                    lanjut</option>
                            </select>
                            @error('langkah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="fw-bold">Plan QCC</p>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Start Date</td>
                                            <td>:</td>
                                            <td id="planStartDate"></td>
                                        </tr>
                                        <tr>
                                            <td>End Date</td>
                                            <td>:</td>
                                            <td id="planEndDate"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="message">Actual Start Date <small
                                            class="text-danger">*</small></label>
                                    <input type="date" class="form-control @error('startDate') is-invalid @enderror"
                                        name="startDate" placeholder="E.g startDate QCC">
                                    @error('startDate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="message">Actual End Date <small
                                            class="text-danger">*</small></label>
                                    <input type="date" class="form-control @error('endDate') is-invalid @enderror"
                                        name="endDate" placeholder="E.g endDate QCC">
                                    @error('endDate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="message">Notulensi <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('notulensi') is-invalid @enderror" id="notulensi" name="notulensi" rows="3"
                                        placeholder="Insert Your Message"></textarea>
                                    @error('notulensi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="tema">Masukan File <small
                                            class="text-danger">*</small></label>
                                    <input type="file" class="form-control @error('lampiran') is-invalid @enderror"
                                        name="lampiran" placeholder="E.g lampiran QCC">
                                    @error('lampiran')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Full Name</th>
                                            <th scope="col"></th>
                                            <th scope="col">Abensi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($absensi as $item)
                                            <tr>
                                                <td>{{ $item->fullname }}</td>
                                                <td>:</td>
                                                <td>
                                                    <div class="form-check">
                                                        <input
                                                            class="form-check-input @error('absensi') is-invalid @enderror"
                                                            type="checkbox" name="absensi[]" value="{{ $item->member }}">
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    @error('absensi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </table>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-3" id="savedata">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <!-- data tables css -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2-bootstrap-5-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var url = '{{ route('v1.qcc.progress.index', $data->id) }}';

            var table = $('#footer-select').DataTable({
                processing: true,
                serverSide: true,
                ajax: url,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'step',
                        name: 'step'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi'
                    },
                    {
                        data: 'approvalnya',
                        name: 'approvalnya'
                    }, {
                        data: 'approvalnya',
                        name: 'approvalnya'
                    }, {
                        data: 'absennya',
                        name: 'absennya'
                    }, {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ],
                initComplete: function() {
                    var column = this.api().column(1); // Kolom ke-2 (index 1) adalah 'name'
                    var select = $(
                            '<select class="form-control form-control-sm"><option value=""></option></select>'
                        )
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function(d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });
                }
            });

            $('body').on('click', '.deletePost', function() {

                var url = $(this).attr("data-url");
                var device = $(this).attr("data-phone");
                Swal.fire({
                    title: "Apakah anda yakin ?",
                    text: "Menghapus data Progress QCC akan menghapus seluruh informasi QCC Anda",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            success: function(data) {
                                if (data.success) {
                                    Swal.fire({
                                        title: "Terhapus !",
                                        text: data.message,
                                        icon: "success"
                                    });
                                    table.draw();
                                } else {
                                    Swal.fire({
                                        title: "Error System !",
                                        text: data.message,
                                        icon: "error"
                                    });
                                }
                            },
                            error: function(data) {
                                Swal.fire({
                                    title: "Galat System !",
                                    text: data,
                                    icon: "error"
                                });
                                console.log('Error:', data);
                            }
                        });
                    }
                });
            });


        });
    </script>
@endsection
