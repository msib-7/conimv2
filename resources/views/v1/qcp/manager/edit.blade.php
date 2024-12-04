@extends('layouts.theme.master')

@section('title')
    Show Quality Circle Project
@endsection

@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <h5>Show Quality Circle Project</h5>
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

                    <form action="{{ route('v1.qcp.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

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
                                    <label class="form-label" for="tema">Tema <small
                                            class="text-danger">*</small></label>
                                    <input type="text" class="form-control @error('tema') is-invalid @enderror"
                                        name="tema" placeholder="E.g Tema CSR" value="{{ $data->tema }}">
                                    @error('tema')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="tema">Nama Team <small
                                            class="text-danger">*</small></label>
                                    <input type="text" class="form-control @error('teams') is-invalid @enderror"
                                        name="teams" placeholder="E.g Kalbis Teams" value="{{ $data->teams }}">
                                    @error('teams')
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
                                        name="cost_saving" placeholder="E.g cost_saving CSR"
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
                                        placeholder="Insert Your Message">{!! $data->sebelum !!}</textarea>
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
                                        placeholder="Insert Your Message">{!! $data->sesudah !!}</textarea>
                                    @error('sesudah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @if (count($data->team) > 1)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="tema">Ulangi Anggota Team <small
                                            class="text-danger">*</small></label>
                                    <select class="form-select @error('anggota') is-invalid @enderror"
                                        aria-label="Default select example" id="anggota" name="anggota[]" multiple>
                                    </select>
                                    @error('anggota')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        @if ($data->status == 'draft')
                            <div class="form-check form-switch mb-2 mt-2">
                                <input type="checkbox" class="form-check-input" id="customswitch1" name="draft"
                                    value="enabled">
                                <label class="form-check-label" for="customswitch1">Simpan Draft Untuk Saat ini</label>
                            </div>
                        @endif

                        <button class="btn btn-primary w-100">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <!-- data tables css -->
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/select2-bootstrap-5-theme.min.css') }}" />

    <style>
        .select2-selection__rendered {
            line-height: 36px !important;
        }

        .select2-container .select2-selection--single {
            height: 50px !important;
        }

        .select2-selection__arrow {
            height: 50px !important;
        }
    </style>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script>
        $('#anggota').select2({
            theme: 'bootstrap-5',
            minimumInputLength: 2,
            placeholder: 'Pilih Employee',
            ajax: {
                url: "{{ route('v1.qcp.hrisGetEmployee') }}",
                dataType: 'json',
                delay: 150,
                processResults: data => {
                    return {
                        results: data.map(res => {
                            console.log(res);
                            var text = res.fullname + ' - ' + res.dept;
                            var id = res.id + ' - ' + res.fullname;
                            return {
                                text: text,
                                id: id,
                            }
                        })
                    }
                },
                cache: true
            }
        })
    </script>
@endsection