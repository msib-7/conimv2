@extends('layouts.theme.master')

@section('title')
    Add New Quality Circle Control
@endsection

@section('content')
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <h5>New Quality Circle Control</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('v1.qcc.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <label class="form-label" for="team">Team <small
                                            class="text-danger">*</small></label>
                                    <input type="text" class="form-control @error('team') is-invalid @enderror"
                                        name="team" placeholder="E.g Sabi Teams">
                                    @error('team')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="jumlah">Jumlah Tema yang Diselesaikan <small
                                            class="text-danger">*</small></label>
                                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                                        name="jumlah" placeholder="E.g jumlah Tema">
                                    @error('jumlah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="tema">Sekretaris <small
                                            class="text-danger">*</small></label>
                                    <select class="form-select @error('sekretaris') is-invalid @enderror"
                                        aria-label="Default select example" id="sekretaris" name="sekretaris">
                                    </select>
                                    @error('sekretaris')
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

                        <hr>
                        <p class="fw-bold">Timeline Plan QCC</p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Step</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Step 1 - Latar Belakang & Menentukan Tema</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="date"
                                                class="form-control @error('mulai_1') is-invalid @enderror" name="mulai_1">
                                            @error('mulai_1')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="date"
                                                class="form-control @error('selesai_1') is-invalid @enderror"
                                                name="selesai_1">
                                            @error('selesai_1')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Step 2 - Menentukan Target</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="date"
                                                class="form-control @error('mulai_2') is-invalid @enderror"
                                                name="mulai_2">
                                            @error('mulai_2')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="date"
                                                class="form-control @error('selesai_2') is-invalid @enderror"
                                                name="selesai_2">
                                            @error('selesai_2')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Step 3 - Analisa Kondisi Yang Ada</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="date"
                                                class="form-control @error('mulai_3') is-invalid @enderror"
                                                name="mulai_3">
                                            @error('mulai_3')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="date"
                                                class="form-control @error('selesai_3') is-invalid @enderror"
                                                name="selesai_3">
                                            @error('selesai_3')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Step 4 - Analisa Sebab Akibat</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="date"
                                                class="form-control @error('mulai_4') is-invalid @enderror"
                                                name="mulai_4">
                                            @error('mulai_4')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="date"
                                                class="form-control @error('selesai_4') is-invalid @enderror"
                                                name="selesai_4">
                                            @error('selesai_4')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Step 5 - Rencana Penanggulangan</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="date"
                                                class="form-control @error('mulai_5') is-invalid @enderror"
                                                name="mulai_5">
                                            @error('mulai_5')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="date"
                                                class="form-control @error('selesai_5') is-invalid @enderror"
                                                name="selesai_5">
                                            @error('selesai_5')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Step 6 - Penanggunglangan</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="date"
                                                class="form-control @error('mulai_6') is-invalid @enderror"
                                                name="mulai_6">
                                            @error('mulai_6')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="date"
                                                class="form-control @error('selesai_6') is-invalid @enderror"
                                                name="selesai_6">
                                            @error('selesai_6')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Step 7 - Evaluasi Hasil</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="date"
                                                class="form-control @error('mulai_7') is-invalid @enderror"
                                                name="mulai_7">
                                            @error('mulai_7')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="date"
                                                class="form-control @error('selesai_7') is-invalid @enderror"
                                                name="selesai_7">
                                            @error('selesai_7')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Step 8 - Standarisasi dan Tindak Lanjut</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="date"
                                                class="form-control @error('mulai_8') is-invalid @enderror"
                                                name="mulai_8">
                                            @error('mulai_8')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="date"
                                                class="form-control @error('selesai_8') is-invalid @enderror"
                                                name="selesai_8">
                                            @error('selesai_8')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>
                                </tr>


                            </tbody>
                        </table>

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
        $('#sekretaris').select2({
            theme: 'bootstrap-5',
            minimumInputLength: 2,
            placeholder: 'Pilih Employee',
            ajax: {
                url: "{{ route('admin.users.FA.getHrisEmployee') }}",
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
        });
        $('#anggota').select2({
            theme: 'bootstrap-5',
            minimumInputLength: 2,
            placeholder: 'Pilih Employee',
            ajax: {
                url: "{{ route('admin.users.FA.getHrisEmployee') }}",
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
