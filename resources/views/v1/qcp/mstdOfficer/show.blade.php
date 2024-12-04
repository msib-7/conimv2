@extends('layouts.theme.master')

@section('title')
    Quality Circle Project Report
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

            <div class="card mt-3">
                <div class="card-header">
                    <h5>List Of Member Teams</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Employe ID</th>
                                <th scope="col">Full Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->team as $team)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $team->member }}</td>
                                    <td>{{ $team->fullname }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Quality Circle Project Report</h5>
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

                        <div class="col-md-6">
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
                                <label class="form-label" for="teams">Nama Teams <small
                                        class="text-danger">*</small></label>
                                <input type="text" class="form-control @error('teams') is-invalid @enderror"
                                    name="teams" placeholder="E.g Tema CSR" readonly value="{{ $data->teams }}">
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

    {{-- Return Modal --}}
    <div id="returnModalCenter" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="returnModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Return Quality Circle Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('v1.mstdOfficer.qcp.store', $data->id) }}" method="POST"
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
                    <h5 class="modal-title" id="exampleModalCenterTitle">Approve Quality Circle Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('v1.mstdOfficer.qcp.store', $data->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="text" name="status" value="approve" class="d-none">
                        @if ($data->cost_saving > 0)
                            <div class="form-group">
                                <label class="form-label" for="cat_saving">Kategori Cost Saving</label>
                                <select class="form-select @error('cat_saving') is-invalid @enderror" id="cat_saving"
                                    name="cat_saving">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($cat_saving as $saving)
                                        <option value="{{ $saving->id }}">{{ $saving->title }}</option>
                                    @endforeach
                                </select>
                                @error('cat_saving')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endif

                        <div class="form-group" id="nomorCC">
                            <label class="form-label" for="nomorQCP">Nomor QCP</label>
                            <input type="text" class="form-control" readonly name="nomorQCP" value="QCP/2024/1241"
                                placeholder="Masukan Nomor SS">
                        </div>

                        <p>Dengan ini saya menyetujui persetujuan Quality Circle Project yang telah dibuat</p>
                        
                        <button class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
