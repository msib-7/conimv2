@extends('layouts.theme.master')

@section('title')
    Approval One Sheet Reports
@endsection

@section('content')
    <div class="row">
        <div class="col-lg">

            <div class="card">
                <div class="card-header">
                    <h5>Approval One Sheet Reports</h5>
                </div>
                <div class="card-body">

                    <form id="detailOsr">
                        <div class="row">
                            <div class="col-md-3">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="nik">Departement</label>
                                    <input type="text" class="form-control" disabled readonly
                                        value="{{ auth()->user()->groupName }}" placeholder="Title Notify">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="nik">Fasilitator</label>
                                    <input type="text" class="form-control" disabled readonly
                                        value="{{ $data->fasilitator }}" placeholder="Title Notify">
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
                                        value="{{ auth()->user()->getFasilitator($data)['nik'] }}"
                                        placeholder="Title Notify">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label" for="nik">Fasilitator Dept</label>
                                    <input type="text" class="form-control" disabled readonly
                                        value="{{ auth()->user()->getFasilitator($data)['dept'] }}"
                                        placeholder="Title Notify">
                                </div>
                            </div>

                            <hr>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="tema">tema / Latar Belakang (7 tools) <small
                                            class="text-danger">*</small></label>
                                    <input type="email" class="form-control @error('tema') is-invalid @enderror"
                                        name="tema" placeholder="tema" value="{{ $data->tema }}">
                                    @error('tema')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="lokasi">lokasi Improvement <small
                                            class="text-danger">*</small></label>
                                    <input type="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
                                        name="lokasi" placeholder="lokasi" value="{{ $data->lokasi }}">
                                    @error('lokasi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="noCC">No. CC <small
                                            class="Lokasi-danger">*</small></label>
                                    <input type="number" class="form-control @error('noCC') is-invalid @enderror"
                                        name="noCC" placeholder="noCC" value="{{ $data->nomorCC }}">
                                    @error('noCC')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="mesin">mesin yang berkaitan dengan improvement<small
                                            class="text-danger">*</small></label>
                                    <select class="form-select @error('mesin') is-invalid @enderror"
                                        aria-label="Default select example" id="mesin" name="mesin">
                                    </select>
                                    @error('mesin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>

                        <p class="fw-bold">Target (SMART)</p>
                        <p>Menjelaskan target berdasarkan komponen SMART (7 tools)</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="specific">specific <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('specific') is-invalid @enderror" id="message" name="specific" rows="2"
                                        placeholder="specific">{!! $data->smart_specific !!}</textarea>
                                    @error('specific')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="measurable">measurable <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('measurable') is-invalid @enderror" id="message" name="measurable"
                                        rows="2" placeholder="Measureable">{!! $data->smart_measurable !!}</textarea>
                                    @error('measurable')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="achievable">achievable <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('achievable') is-invalid @enderror" id="message" name="achievable"
                                        rows="2" placeholder="Achievable">{!! $data->smart_achievable !!}</textarea>
                                    @error('achievable')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="Reasonable">Reasonable <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('reasonable') is-invalid @enderror" id="message" name="reasonable"
                                        rows="2" placeholder="Reasonable">{!! $data->smart_reasonable !!}</textarea>
                                    @error('reasonable')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="TimeBased">Time Based <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('timeBased') is-invalid @enderror" id="message" name="timeBased"
                                        rows="2" placeholder="Time Based">{!! $data->smart_time !!}</textarea>
                                    @error('timeBased')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>

                        <p class="fw-bold">Analisa Kondisi yang ada</p>
                        <p>Menjelaskan kondisi berdasarkan hasil observasi masalah (WSBH & WAH)</p>
                        <div class="row">
                            <!-- Set 1 -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="ManWSBH">Man WSBH <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('manWSBH') is-invalid @enderror" id="message-0" name="manWSBH" rows="2"
                                        placeholder="Man WSBH">{!! $data->man_wsbh !!}</textarea>
                                    @error('manWSBH')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="ManWAH">Man WAH <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('manWAH') is-invalid @enderror" id="message-0" name="manWAH" rows="2"
                                        placeholder="Man WAH">{!! $data->man_wah !!}</textarea>
                                    @error('manWAH')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="justifikasiSwitch-0">Man Justifikasi <small
                                        class="text-danger">*</small>:</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input justifikasiSwitch" type="checkbox"
                                        id="justifikasiSwitch-0" name="manJustifikasi1"
                                        {{ $data->man_root_cause != null ? 'checked' : null }}>
                                    <label class="form-check-label" for="justifikasiSwitch-0"></label>
                                </div>
                            </div>

                            @if ($data->man_root_cause)
                                <div class="col-sm-12 root-cause-container">
                                    <div class="form-group">
                                        <label for="rootCause-0">Man Root Cause</label>
                                        <textarea id="rootCause-0" rows="2" placeholder="Man Root Cause" class="form-control" name="man_root_cause">{!! $data->man_root_cause !!}</textarea>
                                    </div>
                                </div>
                            @else
                                <div class="col-sm-12 root-cause-container" style="display: none;">
                                    <div class="form-group">
                                        <label for="rootCause-0">Man Root Cause</label>
                                        <textarea id="rootCause-0" rows="2" placeholder="Man Root Cause" class="form-control" name="man_root_cause"></textarea>
                                    </div>
                                </div>
                            @endif

                            <!-- Set 2 -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="MachineWSBH">Machine WSBH <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('machineWSBH') is-invalid @enderror" id="message-1" name="machineWSBH"
                                        rows="2" placeholder="Insert Your Message">{!! $data->machine_wsbh !!}</textarea>
                                    @error('machineWSBH')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="MachineWAH">Machine WAH <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('machineWAH') is-invalid @enderror" id="message-1" name="machineWAH"
                                        rows="2" placeholder="Insert Your Message">{!! $data->machine_wah !!}</textarea>
                                    @error('machineWAH')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="justifikasiSwitch-1">Machine Justifikasi <small
                                        class="text-danger">*</small>:</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input justifikasiSwitch" type="checkbox"
                                        id="justifikasiSwitch-1" name="manJustifikasi2"
                                        {{ $data->machine_root_cause != null ? 'checked' : null }}>
                                    <label class="form-check-label" for="justifikasiSwitch-1"></label>
                                </div>
                            </div>
                            @if ($data->machine_root_cause)
                                <div class="col-sm-12 root-cause-container">
                                    <div class="form-group">
                                        <label for="rootCause-1">Machine Root Cause</label>
                                        <textarea id="rootCause-1" rows="2" placeholder="Man Root Cause" class="form-control"
                                            name="machine_root_cause">{!! $data->machine_root_cause !!}</textarea>
                                    </div>
                                </div>
                            @else
                                <div class="col-sm-12 root-cause-container" style="display: none;">
                                    <div class="form-group">
                                        <label for="rootCause-1">Machine Root Cause</label>
                                        <textarea id="rootCause-1" rows="2" placeholder="Man Root Cause" class="form-control"
                                            name="machine_root_cause"></textarea>
                                    </div>
                                </div>
                            @endif

                            <!-- Set 3 -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="MethodWSBH">Method WSBH <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('methodWSBH') is-invalid @enderror" id="message-1" name="methodWSBH"
                                        rows="2" placeholder="Insert Your Message">{!! $data->method_wsbh !!}</textarea>
                                    @error('methodWSBH')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="MethodWAH">Method WAH <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('methodWAH') is-invalid @enderror" id="message-1" name="methodWAH"
                                        rows="2" placeholder="Insert Your Message">{!! $data->method_wah !!}</textarea>
                                    @error('methodWAH')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="justifikasiSwitch-1">Method Justifikasi <small
                                        class="text-danger">*</small>:</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input justifikasiSwitch" type="checkbox"
                                        id="justifikasiSwitch-1" name="manJustifikasi3"
                                        {{ $data->method_root_cause != null ? 'checked' : null }}>
                                    <label class="form-check-label" for="justifikasiSwitch-1"></label>
                                </div>
                            </div>

                            @if ($data->method_root_cause)
                                <div class="col-sm-12 root-cause-container">
                                    <div class="form-group">
                                        <label for="rootCause-1">Method Root Cause</label>
                                        <textarea id="rootCause-1" rows="2" placeholder="Man Root Cause" class="form-control"
                                            name="method_root_cause">{!! $data->method_root_cause !!}</textarea>
                                    </div>
                                </div>
                            @else
                                <div class="col-sm-12 root-cause-container" style="display: none;">
                                    <div class="form-group">
                                        <label for="rootCause-1">Method Root Cause</label>
                                        <textarea id="rootCause-1" rows="2" placeholder="Man Root Cause" class="form-control"
                                            name="method_root_cause"></textarea>
                                    </div>
                                </div>
                            @endif

                            <!-- Set 4 -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="MaterialWSBH">Material WSBH <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('materialWSBH') is-invalid @enderror" id="message-1" name="materialWSBH"
                                        rows="2" placeholder="Insert Your Message">{!! $data->material_wsbh !!}</textarea>
                                    @error('materialWSBH')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="MaterialWAH">Material WAH <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('materialWAH') is-invalid @enderror" id="message-1" name="materialWAH"
                                        rows="2" placeholder="Insert Your Message">{!! $data->material_wah !!}</textarea>
                                    @error('materialWAH')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="justifikasiSwitch-1">Material Justifikasi <small
                                        class="text-danger">*</small>:</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input justifikasiSwitch" type="checkbox"
                                        id="justifikasiSwitch-1" name="manJustifikasi4"
                                        {{ $data->material_root_cause != null ? 'checked' : null }}>
                                    <label class="form-check-label" for="justifikasiSwitch-1"></label>
                                </div>
                            </div>

                            @if ($data->material_root_cause)
                                <div class="col-sm-12 root-cause-container">
                                    <div class="form-group">
                                        <label for="rootCause-1">Material Root Cause</label>
                                        <textarea id="rootCause-1" rows="2" placeholder="Man Root Cause" class="form-control"
                                            name="material_root_cause">{!! $data->material_root_cause !!}</textarea>
                                    </div>
                                </div>
                            @else
                                <div class="col-sm-12 root-cause-container" style="display: none;">
                                    <div class="form-group">
                                        <label for="rootCause-1">Material Root Cause</label>
                                        <textarea id="rootCause-1" rows="2" placeholder="Man Root Cause" class="form-control"
                                            name="material_root_cause"></textarea>
                                    </div>
                                </div>
                            @endif


                            <!-- Set 5 -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="EnvironmentWSBH">Environment WSBH <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('environmentWSBH') is-invalid @enderror" id="message-1" name="environmentWSBH"
                                        rows="2" placeholder="Insert Your Message">{!! $data->environment_wsbh !!}</textarea>
                                    @error('environmentWSBH')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="EnvironmentWAH">Environment WAH <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('environmentWAH') is-invalid @enderror" id="message-1" name="environmentWAH"
                                        rows="2" placeholder="Insert Your Message">{!! $data->environment_wah !!}</textarea>
                                    @error('environmentWAH')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="justifikasiSwitch-1">Environment Justifikasi <small
                                        class="text-danger">*</small>:</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input justifikasiSwitch" type="checkbox"
                                        id="justifikasiSwitch-1" name="manJustifikasi5"
                                        {{ $data->environment_root_cause != null ? 'checked' : null }}>
                                    <label class="form-check-label" for="justifikasiSwitch-1"></label>
                                </div>
                            </div>

                            @if ($data->environment_root_cause)
                                <div class="col-sm-12 root-cause-container">
                                    <div class="form-group">
                                        <label for="rootCause-1">Environment Root Cause</label>
                                        <textarea id="rootCause-1" rows="2" placeholder="Man Root Cause" class="form-control"
                                            name="environment_root_cause">{!! $data->environment_root_cause !!}</textarea>
                                    </div>
                                </div>
                            @else
                                <div class="col-sm-12 root-cause-container" style="display: none;">
                                    <div class="form-group">
                                        <label for="rootCause-1">Environment Root Cause</label>
                                        <textarea id="rootCause-1" rows="2" placeholder="Man Root Cause" class="form-control"
                                            name="environment_root_cause"></textarea>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <hr>

                        <div class="col-sm-12" style="margin-top: 10px;">
                            <dl>
                                <dt>Analisa sebab akibat</dt>
                                <dd>Menganalisa sebab akibat menggunakan 7 tools, lampirkan pada attach dibawah (7 tools)
                                </dd>
                            </dl>
                        </div>
                        <div class="col-sm-12" style="margin-top: 10px;">
                            <dl>
                                <dt>Rencana Penanggulangan</dt>
                                <dd>Menjelaskan rencana penanggulangan dengan metode 5W1H</dd>
                            </dl>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="What">What <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('what') is-invalid @enderror" id="message-1" name="what" rows="2"
                                        placeholder="Apa rencana penanggulangannya?">{!! $data->what !!}</textarea>
                                    @error('what')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="Who">Who <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('who') is-invalid @enderror" id="message-1" name="who" rows="2"
                                        placeholder="Siapa yang melakukannya?">{!! $data->who !!}</textarea>
                                    @error('who')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="why">Why <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('why') is-invalid @enderror" id="message-1" name="why" rows="2"
                                        placeholder="Kenapa harus dilakukan?">{!! $data->why !!}</textarea>
                                    @error('why')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="Where">Where <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('where') is-invalid @enderror" id="message-1" name="where" rows="2"
                                        placeholder="Dimana penanggulangan tersebut dilakukan?">{!! $data->where !!}</textarea>
                                    @error('where')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="When">When <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('when') is-invalid @enderror" id="message-1" name="when" rows="2"
                                        placeholder="Kapan penanggulangan tersebut dilakukan?">{!! $data->when !!}</textarea>
                                    @error('when')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="How">How <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('how') is-invalid @enderror" id="message-1" name="how" rows="2"
                                        placeholder="Bagaimana caranya penanggulangan tersebut dilakukan?">{!! $data->how !!}</textarea>
                                    @error('how')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="col-sm-12" style="margin-top: 10px;">
                            <dl>
                                <dt>Evaluasi Akhir QCDSMPE</dt>
                                <dd>Menjelaskan hasil evaluasi dengan membandingkan antara kondisi awal dengan kondisi
                                    setelah improvement (7 tools)</dd>
                            </dl>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="Quality">Quality <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('quality') is-invalid @enderror" id="message-1" name="quality" rows="2"
                                        placeholder="quality">{!! $data->quality !!}</textarea>
                                    @error('quality')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="Cost">Cost <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('cost') is-invalid @enderror" id="message-1" name="cost" rows="2"
                                        placeholder="cost">{!! $data->cost !!}</textarea>
                                    @error('cost')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="Delivery">Delivery <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('delivery') is-invalid @enderror" id="message-1" name="delivery"
                                        rows="2" placeholder="delivery">{!! $data->delivery !!}</textarea>
                                    @error('delivery')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="Safety">Safety <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('safety') is-invalid @enderror" id="message-1" name="safety" rows="2"
                                        placeholder="safety">{!! $data->safety !!}</textarea>
                                    @error('safety')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="Morale">Morale <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('morale') is-invalid @enderror" id="message-1" name="morale" rows="2"
                                        placeholder="morale">{!! $data->morale !!}</textarea>
                                    @error('morale')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="Productivity">Productivity <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('productivity') is-invalid @enderror" id="message-1" name="productivity"
                                        rows="2" placeholder="productivity">{!! $data->productivity !!}</textarea>
                                    @error('productivity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="Environment">Environment <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('environment') is-invalid @enderror" id="message-1" name="environment"
                                        rows="2" placeholder="environment">{!! $data->environment !!}</textarea>
                                    @error('environment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="col-sm-12" style="margin-top: 10px;">
                            <dl>
                                <dt>Standarisasi</dt>
                                <dd>Langkah standarisasi terhadap improvement yang dilakukan (attach file)</dd>
                            </dl>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="Standarisasi">Standarisasi <small
                                        class="text-danger">*</small></label>
                                <textarea class="form-control @error('standarisasi') is-invalid @enderror" id="message-1" name="standarisasi"
                                    rows="2" placeholder="standarisasi">{!! $data->standarisasi !!}</textarea>
                                @error('standarisasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <div class="col-sm-12" style="margin-top: 10px;">
                            <dl>
                                <dt>Next Step</dt>
                                <dd>Rencana langkah berikutnya setelah improvement ini selesai (7 tools)</dd>
                            </dl>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="NextStep">Next Step <small
                                        class="text-danger">*</small></label>
                                <textarea class="form-control @error('nextStep') is-invalid @enderror" id="message-1" name="nextStep"
                                    rows="2" placeholder="Next Step">{!! $data->nextStep !!}</textarea>
                                @error('nextStep')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <div class="col-sm-12" style="margin-top: 10px;">
                            <dl>
                                <dt>Total</dt>
                                <dd>Total kebutuhan biaya untuk dilakukan improvement dan total keuntungan (cost saving)
                                    setelah dilakukan improvement</dd>
                            </dl>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="TotalBiaya">Total Biaya <small
                                            class="text-danger">*</small></label>
                                    <input type="number" class="form-control @error('totalBiaya') is-invalid @enderror"
                                        name="totalBiaya" placeholder="Total Biaya" value="{{ $data->biaya }}">
                                    @error('totalBiaya')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="costSaving">Total Keuntungan (cost saving) <small
                                            class="text-danger">*</small></label>
                                    <input type="number" class="form-control @error('costSaving') is-invalid @enderror"
                                        name="costSaving" placeholder="Total Keuntungan (cost saving)"
                                        value="{{ $data->costSaving }}">
                                    @error('costSaving')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="col-sm-12" style="margin-top: 10px;">
                            <dl>
                                <dt>Attach File</dt>
                                <dd>Lampirkan data pendukung seperti foto kondisi, tools diagram, dll (.pdf)</dd>
                            </dl>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <input type="file"
                                            class="form-control @error('lampiran') is-invalid @enderror" name="lampiran"
                                            placeholder="lampiran">
                                        @error('lampiran')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-warning w-100 btn-lampiran"
                                        data-bs-toggle="modal" data-bs-target="#pdfModal">
                                        <i class="ti ti-file me-1"></i> Show PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

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
                    <h5 class="modal-title" id="exampleModalCenterTitle">Return OneSheetReport</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('v1.approval.fasilitator.osr.store', $data->id) }}" method="POST"
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

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">PDF Viewer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe
                        src="{{ $data->lampiran ?? asset('assets/images/no_file.pdf') }}#toolbar=0&navpanes=0&scrollbar=0"
                        style="width: 100%; height: 500px;" frameborder="0"></iframe>
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
                    <h5 class="modal-title" id="exampleModalCenterTitle">Approve OneSheetReport</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('v1.approval.fasilitator.osr.store', $data->id) }}" method="POST"
                        enctype="multipart/form-data">
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

                        <p>Dengan ini saya menyetujui persetujuan One Sheet Report yang telah dibuat</p>

                        <button class="btn btn-primary w-100">Submit</button>
                    </form>
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

    <script>
        $('#detailOsr :input').prop('readonly', true);
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
