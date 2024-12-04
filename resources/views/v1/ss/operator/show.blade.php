@extends('layouts.theme.master')

@section('title')
    Show Suggestion System
@endsection

@section('content')
    <div class="row">
        <div class="col-lg">

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
                        <div class="p-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="nik">Full Name</label>
                                        <input type="text" class="form-control" disabled readonly
                                            value="{{ $data->pemohon->fullname }}" placeholder="Title Notify">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label" for="nik">NIK Employee</label>
                                        <input type="text" class="form-control" disabled readonly
                                            value="{{ $data->pemohon->employeId }}" placeholder="Title Notify">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-label" for="nik">Departement</label>
                                        <input type="text" class="form-control" disabled readonly
                                            value="{{ $data->pemohon->groupName }}" placeholder="Title Notify">
                                    </div>
                                </div>

                                <hr>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="nik">Fasilitator Name</label>
                                        <input type="text" class="form-control" disabled readonly
                                            value="{{ auth()->user()->getFasilitator($data)['fullname'] }}"
                                            placeholder="Title Notify">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label" for="nik">Fasilitator NIK</label>
                                        <input type="text" class="form-control" disabled readonly
                                            value="{{ auth()->user()->getFasilitator($data)['nik'] }}"
                                            placeholder="Title Notify">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-label" for="nik">Fasilitator Dept</label>
                                        <input type="text" class="form-control" disabled readonly
                                            value="{{ auth()->user()->getFasilitator($data)['dept'] }}"
                                            placeholder="Title Notify">
                                    </div>
                                </div>

                                <hr>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="tema">Tema <small
                                                class="text-danger">*</small></label>
                                        <input type="text" class="form-control @error('tema') is-invalid @enderror"
                                            name="tema" placeholder="E.g Tema SS" readonly
                                            value="{{ $data->tema }}">
                                        @error('tema')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="tema">Lokasi <small
                                                class="text-danger">*</small></label>
                                        <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                            name="lokasi" placeholder="E.g lokasi SS" readonly
                                            value="{{ $data->lokasi }}">
                                        @error('lokasi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label" for="tema">Mesin Yang Berkaitan <small
                                                class="text-danger">*</small></label>
                                        <input type="text" class="form-control @error('mesin') is-invalid @enderror"
                                            name="mesin" placeholder="E.g mesin SS" readonly
                                            value="{{ $data->mesin->title }}">
                                        @error('mesin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="permasalahan">Permasalahan Yang Ada <small
                                                class="text-danger">*</small></label>
                                        <textarea class="form-control @error('permasalahan') is-invalid @enderror" readonly id="permasalahan"
                                            name="permasalahan" rows="3" placeholder="Insert Your Message">{!! $data->permasalahan !!}</textarea>
                                        @error('permasalahan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="improvment">Improvement yang dilakukan <small
                                                class="text-danger">*</small></label>
                                        <textarea class="form-control @error('improvment') is-invalid @enderror" readonly id="improvment" name="improvment"
                                            rows="3" placeholder="Insert Your Message">{!! $data->improvment !!}</textarea>
                                        @error('improvment')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="tema">Total Biaya <small
                                                class="text-danger">*</small></label>
                                        <input type="number" class="form-control @error('biaya') is-invalid @enderror"
                                            readonly name="biaya" placeholder="E.g biaya SS"
                                            value="{{ $data->biaya }}">
                                        @error('biaya')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="message">Biaya Uraian <small
                                                class="text-danger">*</small></label>
                                        <textarea class="form-control @error('uraian_biaya') is-invalid @enderror" readonly id="message"
                                            name="uraian_biaya" rows="3" placeholder="Insert Your Message">{!! $data->uraian_biaya !!}</textarea>
                                        @error('uraian_biaya')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="tema">Total Keuntungan (cost saving) <small
                                                class="text-danger">*</small></label>
                                        <input type="number"
                                            class="form-control @error('cost_saving') is-invalid @enderror" readonly
                                            name="cost_saving" placeholder="E.g cost_saving SS"
                                            value="{{ $data->cost_saving }}">
                                        @error('cost_saving')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="message">Keuntungan (Cost Saving) Uraian <small
                                                class="text-danger">*</small></label>
                                        <textarea class="form-control @error('keuntungan') is-invalid @enderror" readonly id="message" name="keuntungan"
                                            rows="3" placeholder="Insert Your Message">{!! $data->keuntungan !!}</textarea>
                                        @error('keuntungan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h6 class="fw-bold">Melampirkan foto : *optional</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <a
                                        data-lightbox="{{ $data->kondisi_sebelum ?? asset('assets/images/no_image.png') }}"><img
                                            src="{{ $data->kondisi_sebelum ?? asset('assets/images/no_image.png') }}"
                                            class="imgPrev" alt="">
                                    </a>

                                    <p class="text-muted mt-0">Kondisi Sebelum <small class="text-danger">( Klik Gambar
                                            Untuk
                                            Melihat
                                            Lebih Besar )</small></p>
                                </div>

                                <div class="col-md-6">
                                    <a
                                        data-lightbox="{{ $data->kondisi_sesudah ?? asset('assets/images/no_image.png') }}"><img
                                            src="{{ $data->kondisi_sesudah ?? asset('assets/images/no_image.png') }}"
                                            class="imgPrev" alt="">
                                    </a>
                                    <p class="text-muted mt-0">Kondisi Sesudah <small class="text-danger">( Klik Gambar
                                            Untuk
                                            Melihat
                                            Lebih Besar )</small></p>
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

    <div class="modal fade modal-lightbox" id="lightboxModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <img src="" alt="images" class="modal-image img-fluid">
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
                ajax: "{{ route('v1.ss.edit', $data->id) }}",
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
    <script>
        var lightboxModal = new bootstrap.Modal(document.getElementById('lightboxModal'));
        var elem = document.querySelectorAll('[data-lightbox]');
        for (var j = 0; j < elem.length; j++) {
            elem[j].addEventListener('click', function() {
                var images_path = event.target;
                if (images_path.tagName == 'IMG') {
                    images_path = images_path.parentNode;
                }
                var recipient = images_path.getAttribute('data-lightbox');
                var image = document.querySelector('.modal-image');
                image.setAttribute('src', recipient);
                lightboxModal.show();
            });
        }

        function removeClassByPrefix(node, prefix) {
            for (let i = 0; i < node.classList.length; i++) {
                let value = node.classList[i];
                if (value.startsWith(prefix)) {
                    node.classList.remove(value);
                }
            }
        }
    </script>
@endsection
