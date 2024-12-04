@extends('layouts.theme.master')

@section('title')
    Approval Cost Saving Report
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Preview Lampiran</h5>
                </div>
                <div class="card-body pdfView">
                    <embed src="{{ $data->lampiran ?? asset('assets/images/no_file.pdf') }}#toolbar=0&navpanes=0&scrollbar=0"
                        type="application/pdf" frameBorder="0" scrolling="auto" height="100%" width="100%"></embed>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
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
                                    value="{{ auth()->user()->getFasilitator($data)['nik'] }}" placeholder="Title Notify">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="nik">Fasilitator Dept</label>
                                <input type="text" class="form-control" disabled readonly
                                    value="{{ auth()->user()->getFasilitator($data)['dept'] }}" placeholder="Title Notify">
                            </div>
                        </div>

                        <hr>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="tema">Tema <small class="text-danger">*</small></label>
                                <input type="text" class="form-control @error('tema') is-invalid @enderror"
                                    name="tema" placeholder="E.g Tema CSR" readonly value="{{ $data->tema }}">
                                @error('tema')
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
                                <input type="number" class="form-control @error('cost_saving') is-invalid @enderror"
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
                                <input type="file" class="form-control @error('lampiran') is-invalid @enderror"
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

                    <div class="d-flex justify-align-between">
                        <button type="button" class="btn btn-danger w-100 mt-4" data-bs-toggle="modal"
                            data-bs-target="#returnModalCenter">Return</button>
                        <button type="button" class="btn btn-success w-100 ms-3 mt-4" data-bs-toggle="modal"
                            data-bs-target="#approvalModalCenter">Approve</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="returnModalCenter" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="returnModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Return Cost Saving Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('v1.financeAccounting.costSavingReport.store', $data->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="status" value="return" class="d-none">

                        <div class="form-group">
                            <label class="form-label" for="exampleFormControlTextarea1">Note Return</label>
                            <textarea class="form-control @error('note')  @enderror" id="note" name="note" rows="3"></textarea>
                            @error('note')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button class="btn btn-primary w-100" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="approvalModalCenter" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="approvalModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Approve Cost Saving Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('v1.mstdSpv.costSavingReport.store', $data->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="text" name="status" value="approve" class="d-none">
                        @if ($data->cost_saving > 0)
                            <div class="form-group">
                                <label class="form-label" for="jenis_saving">Kategori Jenis Saving</label>
                                <select class="form-select @error('jenis_saving') is-invalid @enderror" id="jenis_saving"
                                    name="jenis_saving">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($jenis_saving as $saving)
                                        <option value="{{ $saving->id }}">{{ $saving->title }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_saving')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endif

                        <p>Dengan ini saya menyetujui persetujuan Cost Saving Report yang telah dibuat</p>

                        <button class="btn btn-primary w-100">Submit</button>
                    </form>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Ketika switch butuhCC diubah
            $('#butuhCC').change(function() {
                if ($(this).is(':checked')) {
                    // Jika switch aktif, tampilkan div nomorCC
                    $('#nomorCC').removeClass('d-none');
                } else {
                    // Jika switch tidak aktif, sembunyikan div nomorCC
                    $('#nomorCC').addClass('d-none')
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
