@extends('layouts.theme.master')
@section('title')
    Cost Saving Report
@endsection

@section('button')
    <div class="d-flex">
        <a href="{{ route('v1.csr.create') }}" class="btn btn-primary btn-nav"><i class="ti ti-plus me-1"></i>Add New</a>
    </div>
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
                        Manage Your Cost Saving Report
                    </p>
                </div>
                <div class="card-body table-card">
                    <div class="dt-responsive table-responsive">
                        <table id="footer-select" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tema</th>
                                    <th>Cost Saving</th>
                                    <th>Status</th>
                                    <th>Status Approval</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Tema</th>
                                    <th>Cost Saving</th>
                                    <th>Status</th>
                                    <th>Status Approval</th>
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
@endsection

@section('styles')
    <!-- data tables css -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap5.min.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#footer-select').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('v1.csr.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'tema',
                        name: 'tema'
                    }, {
                        data: 'savings',
                        name: 'savings'
                    }, {
                        data: 'status',
                        name: 'status'
                    }, {
                        data: 'approvalnya',
                        name: 'approvalnya'
                    }, {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ],
                initComplete: function() {
                    var column = this.api().column(3); // Kolom ke-2 (index 1) adalah 'name'
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
                    text: "Menghapus data Cost Saving Report akan menghapus seluruh informasi Cost Saving Report",
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
