@extends('layouts.theme.master')

@section('title')
    Update Cost Saving Report
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            @if ($data->status == 'publish')
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
                    <h5>Preview Lampiran</h5>
                </div>
                <div class="card-body pdfView">
                    <embed src="{{ $data->lampiran }}#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf"
                        frameBorder="0" scrolling="auto" height="100%" width="100%"></embed>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Update Cost Saving Report</h5>
                </div>
                <div class="card-body">                    
                    <form action="{{ route('v1.csr.update', $data->id) }}" method="POST" enctype="multipart/form-data">
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

                            <div class="col-md-12">
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

                        @if ($data->status == 'draft')
                            <div class="form-check form-switch mb-3">
                                <input type="checkbox" class="form-check-input" id="customswitch1" name="draft"
                                    value="enabled">
                                <label class="form-check-label" for="customswitch1">Simpan Draft Untuk Saat ini</label>
                            </div>
                        @endif

                        <button class="btn btn-primary w-100">Update Revisi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
