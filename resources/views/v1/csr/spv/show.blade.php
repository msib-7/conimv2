@extends('layouts.theme.master')

@section('title')
    Show Cost Saving Report
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body border-bottom pb-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">@yield('title')</h5>
                        <div class="dropdown">
                            <a class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" href="#"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti ti-dots-vertical f-18"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Today</a>
                                <a class="dropdown-item" href="#">Weekly</a>
                                <a class="dropdown-item" href="#">Monthly</a>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs analytics-tab" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="analytics-tab-1" data-bs-toggle="tab"
                                data-bs-target="#analytics-tab-1-pane" type="button" role="tab"
                                aria-controls="analytics-tab-1-pane" aria-selected="true">Detail</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="analytics-tab-2" data-bs-toggle="tab"
                                data-bs-target="#analytics-tab-2-pane" type="button" role="tab"
                                aria-controls="analytics-tab-2-pane" aria-selected="false">History Approval</button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="analytics-tab-1-pane" role="tabpanel"
                        aria-labelledby="analytics-tab-1" tabindex="0">

                        {{-- Start Detail --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-header">
                                    <h5>Preview Lampiran</h5>
                                </div>
                                <div class="card-body pdfView">
                                    <embed
                                        src="{{ $data->lampiran ?? asset('assets/images/no_file.pdf') }}#toolbar=0&navpanes=0&scrollbar=0"
                                        type="application/pdf" frameBorder="0" scrolling="auto" height="100%"
                                        width="100%"></embed>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-header">
                                    <h5>Show Cost Saving Report</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="nik">Full Name</label>
                                                <input type="text" class="form-control" disabled readonly
                                                    value="{{ $data->pemohon->fullname }}" placeholder="Title Notify">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="nik">NIK Employee</label>
                                                <input type="text" class="form-control" disabled readonly
                                                    value="{{ $data->pemohon->employeId }}" placeholder="Title Notify">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="nik">Departement</label>
                                                <input type="text" class="form-control" disabled readonly
                                                    value="{{ $data->pemohon->groupName }}" placeholder="Title Notify">
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="nik">Fasilitator Name</label>
                                                <input type="text" class="form-control" disabled readonly
                                                    value="{{ auth()->user()->getFasilitator($data)['fullname'] }}"
                                                    placeholder="Title Notify">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="nik">Fasilitator NIK</label>
                                                <input type="text" class="form-control" disabled readonly
                                                    value="{{ auth()->user()->getFasilitator($data)['nik'] }}"
                                                    placeholder="Title Notify">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="nik">Fasilitator Dept</label>
                                                <input type="text" class="form-control" disabled readonly
                                                    value="{{ auth()->user()->getFasilitator($data)['dept'] }}"
                                                    placeholder="Title Notify">
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="tema">Tema <small
                                                        class="text-danger">*</small></label>
                                                <input type="text"
                                                    class="form-control @error('tema') is-invalid @enderror"
                                                    name="tema" placeholder="E.g Tema CSR" readonly
                                                    value="{{ $data->tema }}">
                                                @error('tema')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="tema">Total Keuntungan (cost
                                                    saving) <small class="text-danger">*</small></label>
                                                <input type="number"
                                                    class="form-control @error('cost_saving') is-invalid @enderror"
                                                    name="cost_saving" placeholder="E.g cost_saving CSR" readonly
                                                    value="{{ $data->cost_saving }}">
                                                @error('cost_saving')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="tema">Attach File <small
                                                        class="text-danger">*</small></label>
                                                <input type="file"
                                                    class="form-control @error('lampiran') is-invalid @enderror"
                                                    name="lampiran" placeholder="E.g lampiran SS">
                                                @error('lampiran')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="message">Kondisi Sebelum<small
                                                        class="text-danger">*</small></label>
                                                <textarea class="form-control @error('sebelum') is-invalid @enderror" id="message" name="sebelum" rows="3"
                                                    placeholder="Insert Your Message" readonly>{!! $data->sebelum !!}</textarea>
                                                @error('sebelum')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="message">Kondisi Sesudah <small
                                                        class="text-danger">*</small></label>
                                                <textarea class="form-control @error('sesudah') is-invalid @enderror" id="message" name="sesudah" rows="3"
                                                    placeholder="Insert Your Message" readonly>{!! $data->sesudah !!}</textarea>
                                                @error('sesudah')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Detail --}}
                    </div>
                    <div class="tab-pane fade" id="analytics-tab-2-pane" role="tabpanel"
                        aria-labelledby="analytics-tab-2" tabindex="0">

                        {{-- Start --}}
                        <div class="p-4">
                            <div class="dt-responsive table-responsive">
                                <table id="footer-select" class="table table-striped table-bordered w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Lengkap</th>
                                            <th>Status</th>
                                            <th>Catatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Lengkap</th>
                                            <th>Status</th>
                                            <th>Catatan</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        {{-- end --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                ajax: "{{ route('v1.csr.edit', $data->id) }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'users',
                        name: 'users'
                    },
                    {
                        data: 'approvalnya',
                        name: 'approvalnya'
                    }, {
                        data: 'note',
                        name: 'note'
                    }
                ],
                rowCallback: function(row, data, index) {
                    // Periksa apakah kolom `approvalnya` mengandung kata "Return"
                    if (data.approvalnya.includes('Return')) {
                        $(row).css('background-color', '#FF746C'); // Ubah background row menjadi merah
                    } else if (data.approvalnya.includes('Finish')) {
                        $(row).css('background-color',
                            '#6FC276'); // Ubah background row menjadi hijau)
                    }
                }
            });
        });
    </script>
@endsection
