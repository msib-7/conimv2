@extends('layouts.theme.master')

@section('title')
    Add New Cost Saving Report
@endsection

@section('content')
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <h5>New Cost Saving Report</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('v1.csr.store') }}" method="POST" enctype="multipart/form-data">
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

                            <div class="col-md-12">
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
                                    <label class="form-label" for="tema">Total Keuntungan (cost saving) <small
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
                        </div>

                        <div class="form-check form-switch">
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
