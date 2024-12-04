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
                    <form action="{{ route('v1.approval.fasilitator.suggestion_System.store', $data->id) }}"
                        method="POST" enctype="multipart/form-data">
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
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Approve Suggestion System</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('v1.approval.fasilitator.suggestion_System.store', $data->id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="text" name="status" value="approve" class="d-none">
                        <div class="form-group">
                            <label class="form-label" for="cat_improvment">Kategori Improvment</label>
                            <select class="form-select @error('cat_improvment') is-invalid @enderror" id="cat_improvment"
                                name="cat_improvment">
                                <option value="">-- Pilih --</option>
                                @foreach ($cat_improvment as $improvment)
                                    <option value="{{ $improvment->id }}">{{ $improvment->title }}</option>
                                @endforeach
                            </select>
                            @error('cat_improvment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="cat_corp">Kategori Corporate</label>
                            <select class="form-select @error('cat_corp') is-invalid @enderror" id="cat_corp"
                                name="cat_corp">
                                <option value="">-- Pilih --</option>
                                @foreach ($cat_corp as $corp)
                                    <option value="{{ $corp->id }}">{{ $corp->title }}</option>
                                @endforeach
                            </select>
                            @error('cat_corp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="cat_impact">Kategori Impact To</label>
                            <select class="form-select @error('cat_impact') is-invalid @enderror" id="cat_impact"
                                name="cat_impact">
                                <option value="">-- Pilih --</option>
                                @foreach ($cat_impact as $impact)
                                    <option value="{{ $impact->id }}">{{ $impact->title }}</option>
                                @endforeach
                            </select>
                            @error('cat_impact')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- MP info and CC Toggle -->
                        <div class="d-flex justify-content-between mb-3">
                            <div class="col-md-2 mt-2">
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input justifikasiSwitch" type="checkbox"
                                        id="justifikasiSwitch-0" data-target=".root-cause-container"
                                        name="mp_info" value="enabled">
                                    <label class="form-check-label" for="justifikasiSwitch-0">MP Info</label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Root Cause Container (Initially Hidden) -->
                        <div class="root-cause-container" style="display: none;">
                            <!-- Row 1: Kategori and Section Mesin -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="KategoriMPInfo">Kategori MP Info<small
                                                class="text-danger">*</small></label>
                                        <select class="form-select @error('kategoriMPInfo') is-invalid @enderror"
                                            aria-label="Default select example" id="kategoriMPInfo"
                                            name="kategoriMPInfo">
                                            <option value=""></option>
                                            <option value="Equipment">Equipment</option>
                                            <option value="Building">Building</option>
                                            <option value="Instrument">Instrument</option>
                                        </select>
                                        @error('kategoriMPInfo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="SectionMesin">Section Mesin <small
                                                class="text-danger">*</small></label>
                                        <input type="text"
                                            class="form-control @error('sectionMesin') is-invalid @enderror"
                                            name="sectionMesin" placeholder="Isi section Mesin MP Info">
                                        @error('sectionMesin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Row 2: Jenis Mesin -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" for="JenisMesin">Jenis Mesin<small
                                                class="text-danger">*</small></label>
                                        <select class="form-select @error('jenisMesin') is-invalid @enderror"
                                            aria-label="Default select example" id="jenisMesin" name="jenisMesin">
                                            <option value=""></option>
                                            <option value="Granulasi">Granulasi</option>
                                            <option value="Dryer">Dryer</option>
                                            <option value="Camas">Camas</option>
                                            <option value="Cetak">Cetak</option>
                                            <option value="Blistering">Blistering</option>
                                            <option value="Striping">Striping</option>
                                            <option value="Robotic Secondary Packaging">Robotic Secondary Packaging
                                            </option>
                                            <option value="Cartoning">Cartoning</option>
                                            <option value="Palletizer">Palletizer</option>
                                            <option value="Motor Coating Pan">Motor Coating Pan</option>
                                            <option value="Mesh Deduster">Mesh Deduster</option>
                                            <option value="Hot Air">Hot Air</option>
                                            <option value="Filling">Filling</option>
                                            <option value="Labelling">Labelling</option>
                                            <option value="Case Packer">Case Packer</option>
                                            <option value="Premix Tank">Premix Tank</option>
                                            <option value="Feed Hopper">Feed Hopper</option>
                                            <option value="Conveyor">Conveyor</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        @error('jenisMesin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Row 3: Alasan MP Info and MP Info Detail -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for=">Alasan">Alasan adanya MP INFO <small
                                                class="text-danger">*</small></label>
                                        <p>Dampak positif terhadap kualitas, OHSE, pengoperasian, perawatan, dll</p>
                                        <textarea class="form-control @error('alasan') is-invalid @enderror" id="message-1" name="alasan" rows="2"
                                            placeholder="Jelaskanalasan MP INFO "></textarea>
                                        @error('alasan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="infoDetail">MP Info Detail<small
                                                class="text-danger">*</small></label>
                                        <p>Jelaskan masukan atau catatan secara spesifik untuk standarisasi (URS).
                                            contoh :
                                            - Material part mesin yang kontak langsung dengan produk harus terbuat dari
                                            stainless steel 316 L. - Posisi tombol emergensi ditempatkan dekat area
                                            kerja
                                            Operator.</p>
                                        <textarea class="form-control @error('infoDetail') is-invalid @enderror" id="message-1" name="infoDetail"
                                            rows="2" placeholder="Deskripsi secara detail MP Info"></textarea>
                                        @error('infoDetail')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="SebelumPerubahan">Sebelum Perubahan<small
                                                class="text-danger">*</small></label>
                                        <p>Deskripsi desain komponen/bagian mesin</p>
                                        <textarea class="form-control @error('sebelumPerubahan') is-invalid @enderror" id="message-1"
                                            name="sebelumPerubahan" rows="2" placeholder="Jelaskan kejadian Sebelum Perubahan"></textarea>
                                        @error('sebelumPerubahan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Setelaherubahan">Setelah Perubahan<small
                                                class="text-danger">*</small></label>
                                        <p>Deskripsi desain komponen/bagian mesin</p>
                                        <textarea class="form-control @error('setelahPerubahan') is-invalid @enderror" id="message-1"
                                            name="setelahPerubahan" rows="2" placeholder="Jelaskan kejadian Setelah Perubahan"></textarea>
                                        @error('setelahPerubahan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="butuhCC">
                                <label class="form-check-label" for="butuhCC">Butuh CC</label>
                            </div>
                        </div>


                        <div class="form-group d-none" id="nomorCC">
                            <label class="form-label" for="exampleFormControlSelect1">Nomor CC</label>
                            <input type="text" class="form-control" name="nomorCC" placeholder="Masukan Nomor CC">
                        </div>
                        <p>Dengan ini saya menyetujui persetujuan Suggestion System yang telah dibuat</p>

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
        $(document).ready(function() {
            $('#justifikasiSwitch-0').change(function() {
                var target = $(this).data('target');
                if ($(this).is(':checked')) {
                    $(target).show(); // Show element when checkbox is checked
                } else {
                    $(target).hide(); // Hide element when checkbox is unchecked
                }
            });
        });
    </script>
    <script>
        // Script to toggle multiple root cause containers if needed
        const switches = document.querySelectorAll('.justifikasiSwitch');

        switches.forEach((switchButton, index) => {
            switchButton.addEventListener('change', function() {
                const rootCauseContainer = document.querySelectorAll('.root-cause-container')[index];
                if (this.checked) {
                    rootCauseContainer.style.display = 'block'; // Show
                } else {
                    rootCauseContainer.style.display = 'none'; // Hide
                }
            });
        });
    </script>
    <script type="text/javascript">
        $('#mesin').select2({
            placeholder: 'Select a Machine',
            theme: 'bootstrap-5',
            ajax: {
                url: '{{ route('v1.ss.machine') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        search: params.term // search term
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.id,
                                text: item.title
                            };
                        })
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        });
    </script>
@endsection
