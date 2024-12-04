@extends('layouts.theme.master')

@section('title')
    Approval Suggestion System
@endsection

@section('content')
    <div class="row">
        <div class="col-lg">

            <div class="card">
                <div class="card-header">
                    <h5>Approval Suggestion System</h5>
                </div>
                <div class="card-body">

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
                                    value="{{ auth()->user()->getFasilitator($data)['nik'] }}" placeholder="Title Notify">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="form-label" for="nik">Fasilitator Dept</label>
                                <input type="text" class="form-control" disabled readonly
                                    value="{{ auth()->user()->getFasilitator($data)['dept'] }}" placeholder="Title Notify">
                            </div>
                        </div>

                        <hr>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="tema">Tema <small class="text-danger">*</small></label>
                                <input type="text" class="form-control @error('tema') is-invalid @enderror"
                                    name="tema" placeholder="E.g Tema SS" readonly value="{{ $data->tema }}">
                                @error('tema')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="tema">Lokasi <small class="text-danger">*</small></label>
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                    name="lokasi" placeholder="E.g lokasi SS" readonly value="{{ $data->lokasi }}">
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
                                    name="mesin" placeholder="E.g mesin SS" readonly value="{{ $data->mesin->title }}">
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
                                <input type="number" class="form-control @error('biaya') is-invalid @enderror" readonly
                                    name="biaya" placeholder="E.g biaya SS" value="{{ $data->biaya }}">
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
                                <input type="number" class="form-control @error('cost_saving') is-invalid @enderror"
                                    readonly name="cost_saving" placeholder="E.g cost_saving SS"
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
                            <a data-lightbox="{{ $data->kondisi_sebelum ?? asset('assets/images/no_image.png') }}"><img
                                    src="{{ $data->kondisi_sebelum ?? asset('assets/images/no_image.png') }}"
                                    class="imgPrev" alt="">
                            </a>

                            <p class="text-muted mt-0">Kondisi Sebelum <small class="text-danger">( Klik Gambar Untuk
                                    Melihat
                                    Lebih Besar )</small></p>
                        </div>

                        <div class="col-md-6">
                            <a data-lightbox="{{ $data->kondisi_sesudah ?? asset('assets/images/no_image.png') }}"><img
                                    src="{{ $data->kondisi_sesudah ?? asset('assets/images/no_image.png') }}"
                                    class="imgPrev" alt="">
                            </a>
                            <p class="text-muted mt-0">Kondisi Sesudah <small class="text-danger">( Klik Gambar Untuk
                                    Melihat
                                    Lebih Besar )</small></p>
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

    {{-- Return Modal --}}
    <div id="returnModalCenter" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="returnModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Return Suggestion System</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('v1.financeAccounting.suggestionSystem.store', $data->id) }}" method="POST"
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

    {{-- Approve Modal --}}
    <div id="approvalModalCenter" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="approvalModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Approve Suggestion System</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('v1.financeAccounting.suggestionSystem.store', $data->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="text" name="status" value="approve" class="d-none">
                        <p>Dengan ini saya telah membaca dan menyetujui hasil cost saving yang telah diinputkan pada laporan
                            Sugestion System, untuk itu maka saya telah menyetujui hasil tersebut.</p>
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
