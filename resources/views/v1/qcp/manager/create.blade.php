@extends('layouts.theme.master')

@section('title')
    Add New Quality Circle Project
@endsection

@section('content')
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <h5>New Quality Circle Project</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('v1.qcp.store') }}" method="POST" enctype="multipart/form-data">
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

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="tema">Tema <small
                                            class="text-danger">*</small></label>
                                    <input type="text" class="form-control @error('tema') is-invalid @enderror"
                                        name="tema" placeholder="E.g Tema CSR">
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
                                        name="teams" placeholder="E.g Kalbis Teams">
                                    @error('teams')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="tema">Total (cost saving) <small
                                            class="text-danger">*</small></label>
                                    <input type="number" class="form-control @error('cost_saving') is-invalid @enderror"
                                        name="cost_saving" placeholder="E.g cost_saving CSR">
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
                                        name="lampiran" placeholder="E.g lampiran SS" accept=".pdf">
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
                                        placeholder="Insert Your Message"></textarea>
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
                                        placeholder="Insert Your Message"></textarea>
                                    @error('sesudah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="tema">Anggota Team <small
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
                        </div>

                        <div class="form-check form-switch mb-2 mt-2">
                            <input type="checkbox" class="form-check-input" id="customswitch1" name="draft"
                                value="enabled">
                            <label class="form-check-label" for="customswitch1">Simpan Draft Untuk Saat ini</label>
                        </div>

                        <button type="submit" class="btn btn-primary mb-4 w-100 mt-4">Submit</button>
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
