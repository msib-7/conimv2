@extends('layouts.theme.master')

@section('title')
    Change Suggestion System
@endsection

@section('content')
    <div class="row">
        <div class="col-lg">
            @if ($data->status == 'approve')
                <div class="alert alert-danger d-flex align-items-center mb-3 shadow-sm" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"
                        class="me-3">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M12 1.67c.955 0 1.845 .467 2.39 1.247l.105 .16l8.114 13.548a2.914 2.914 0 0 1 -2.307 4.363l-.195 .008h-16.225a2.914 2.914 0 0 1 -2.582 -4.2l.099 -.185l8.11 -13.538a2.914 2.914 0 0 1 2.491 -1.403zm0 9.33h-1l-.117 .007a1 1 0 0 0 0 1.986l.117 .007v3l.007 .117a1 1 0 0 0 .876 .876l.117 .007h1l.117 -.007a1 1 0 0 0 .876 -.876l.007 -.117l-.007 -.117a1 1 0 0 0 -.764 -.857l-.112 -.02l-.117 -.006v-3l-.007 -.117a1 1 0 0 0 -.876 -.876l-.117 -.007zm.01 -3l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z" />
                    </svg>
                    <div> <strong>NOTE REVISI : </strong> {{ $data->history->note }}</div>
                </div>
            @endif
            
            <div class="card">
                <div class="card-header">
                    <h5>Change Suggestion System</h5>
                </div>
                <div class="card-body">
                    @if ($data->status == 'publish')
                        <div class="alert alert-danger d-flex align-items-center mb-3 shadow-sm" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="currentColor" class="me-3">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M12 1.67c.955 0 1.845 .467 2.39 1.247l.105 .16l8.114 13.548a2.914 2.914 0 0 1 -2.307 4.363l-.195 .008h-16.225a2.914 2.914 0 0 1 -2.582 -4.2l.099 -.185l8.11 -13.538a2.914 2.914 0 0 1 2.491 -1.403zm0 9.33h-1l-.117 .007a1 1 0 0 0 0 1.986l.117 .007v3l.007 .117a1 1 0 0 0 .876 .876l.117 .007h1l.117 -.007a1 1 0 0 0 .876 -.876l.007 -.117l-.007 -.117a1 1 0 0 0 -.764 -.857l-.112 -.02l-.117 -.006v-3l-.007 -.117a1 1 0 0 0 -.876 -.876l-.117 -.007zm.01 -3l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007z" />
                            </svg>
                            <div> <strong>NOTE REVISI : </strong> {{ $data->history->note }}</div>
                        </div>
                    @endif
                    <form action="{{ route('v1.ss.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="nik">Full Name</label>
                                    <input type="text" class="form-control" disabled readonly
                                        value="{{ auth()->user()->fullname }}" placeholder="Title Notify">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="nik">NIK Employee</label>
                                    <input type="text" class="form-control" disabled readonly
                                        value="{{ auth()->user()->employeId }}" placeholder="Title Notify">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label" for="nik">Departement</label>
                                    <input type="text" class="form-control" disabled readonly
                                        value="{{ auth()->user()->groupName }}" placeholder="Title Notify">
                                </div>
                            </div>

                            <hr>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="tema">Tema <small
                                            class="text-danger">*</small></label>
                                    <input type="text" class="form-control @error('tema') is-invalid @enderror"
                                        name="tema" placeholder="E.g Tema SS" value="{{ $data->tema }}">
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
                                        name="lokasi" placeholder="E.g lokasi SS" value="{{ $data->lokasi }}">
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
                                    <select class="form-select @error('mesin') is-invalid @enderror" name="mesin"
                                        id="mesin">
                                    </select>
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
                                    <textarea class="form-control @error('permasalahan') is-invalid @enderror" id="permasalahan" name="permasalahan"
                                        rows="3" placeholder="Insert Your Message">{!! $data->permasalahan !!}</textarea>
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
                                    <textarea class="form-control @error('improvment') is-invalid @enderror" id="improvment" name="improvment"
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
                                    <textarea class="form-control @error('uraian_biaya') is-invalid @enderror" id="message" name="uraian_biaya"
                                        rows="3" placeholder="Insert Your Message">{!! $data->uraian_biaya !!}</textarea>
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
                                    <textarea class="form-control @error('keuntungan') is-invalid @enderror" id="message" name="keuntungan"
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
                                <img src="{{ $data->kondisi_sebelum ?? asset('assets/images/no_image.png') }}"
                                    class="imgPrev" id="prevSebelum">
                                <div class="form-group">
                                    <label class="form-label" for="tema">Kondisi Sebelum </label>
                                    <input type="file"
                                        class="form-control @error('kondisi_sebelum') is-invalid @enderror"
                                        name="kondisi_sebelum" placeholder="E.g kondisi_sebelum SS" id="uploadSebelum">
                                    @error('kondisi_sebelum')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <img src="{{ $data->kondisi_sesudah ?? asset('assets/images/no_image.png') }}"
                                    class="imgPrev" id="prevSesudah">
                                <div class="form-group">
                                    <label class="form-label" for="tema">Kondisi Sesudah </label>
                                    <input type="file"
                                        class="form-control @error('kondisi_sesudah') is-invalid @enderror"
                                        name="kondisi_sesudah" placeholder="E.g kondisi_sesudah SS" id="uploadSesudah">
                                    @error('kondisi_sesudah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @if ($data->status == 'draft')
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="customswitch1" name="draft"
                                    value="enabled">
                                <label class="form-check-label" for="customswitch1">Simpan Draft Untuk Saat ini</label>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary mb-4 w-100 mt-4">Update</button>
                    </form>
                </div>
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

    <script>
        uploadSebelum.onchange = evt => {
            const [file] = uploadSebelum.files
            if (file) {
                prevSebelum.src = URL.createObjectURL(file)
            }
        }

        uploadSesudah.onchange = evt => {
            const [file] = uploadSesudah.files
            if (file) {
                prevSesudah.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
