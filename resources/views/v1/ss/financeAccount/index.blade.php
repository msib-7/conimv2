@extends('layouts.theme.master')
@section('title')
    Approval Suggestion System
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
                        Approval Suggestion System
                    </p>
                </div>
                <div class="card-body table-card">
                    <div class="dt-responsive table-responsive">
                        <table id="footer-select" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tema</th>
                                    <th>Lokasi</th>
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
                                    <th>Lokasi</th>
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
                ajax: "{{ route('v1.financeAccounting.suggestionSystem.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'tema',
                        name: 'tema'
                    },
                    {
                        data: 'lokasi',
                        name: 'lokasi'
                    }, {
                        data: 'status_approval',
                        name: 'status_approval'
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
        });
    </script>
@endsection
