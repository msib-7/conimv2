@extends('layouts.theme.master')

@section('title')
    Detail OneSheet Saving Report
@endsection

@section('content')
    <div class="row">
        <div class="col-lg">
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
                    <h5>Detail OneSheet Saving Report</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('v1.osr.update', $data->id) }}" method="POST" enctype="multipart/form-data">
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
                                    <label class="form-label" for="tema">tema / Latar Belakang (7 tools) <small
                                            class="text-danger">*</small></label>
                                    <input type="text" class="form-control @error('tema') is-invalid @enderror"
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
                                    <a href="{{ $data->lampiran ?? asset('assets/images/no_file.pdf') }}"
                                        class="btn btn-warning w-100 btn-lampiran"><i class="ti ti-file me-1"></i>Show
                                        PDF</a>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <!-- MP Info Toggle Switch -->
                        <div class="col-md-12 mt-2">
                            <div class="mt-0 form-group">
                                <label class="react-toggle-wrapper">
                                    Diperlukan MP INFO: <br>
                                    Improvement terkait dengan perubahan desain mesin termasuk material part mesin
                                    <div class="col-md-2 mt-2">
                                        <div class="form-check form-switch mt-2">
                                            <input class="form-check-input justifikasiSwitch" type="checkbox"
                                                id="justifikasiSwitch-0" data-target=".root-cause-container">
                                            <label class="form-check-label" for="justifikasiSwitch-0">Aktifkan</label>
                                        </div>
                                    </div>
                                </label>
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
                                        <textarea class="form-control @error('setelaherubahan') is-invalid @enderror" id="message-1" name="setelaherubahan"
                                            rows="2" placeholder="Jelaskan kejadian Setelah Perubahan"></textarea>
                                        @error('setelaherubahan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        @if ($data->status == 'draft')
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="customswitch1" name="draft"
                                    value="enabled">
                                <label class="form-check-label" for="customswitch1">Simpan Draft Untuk Saat ini</label>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary mb-4 w-100 mt-4">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Hitungan --}}
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="fw-bold">Soft Saving/Potential Saving:</h4>
                    <p class="text-muted">Penghematan yang didapat secara tidak langsung (Waktu/jumlah kasus)</p>

                    <label class="fw-bold">Cara Hitung 1:</label>
                    <p class="text-muted">**Jam (Penghematan improvement) x Jumlah orang x Proses/Kegiatan 1 bulan x harga
                        manhours
                        (23.175) x sisa bulan berjalan sampai akhir tahun (contoh buat conim di maret maka dikali 9
                        bulan)</p>
                    <label class="fw-bold">Cara Hitung 2:</label>
                    <p class="text-muted">**Jumlah kasus dalam satu tahun (penghematan improvement) x biaya kerugian yang
                        disebabkan oleh
                        tiap kasus tersebut</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="fw-bold">Hard Saving:</h4>
                    <p class="text-muted">Penghematan yang di dapat secara langsung, ( contoh: Penghematan Harga bahan/
                        Reagen/Material/Energi)</p>

                    <label class="fw-bold">Cara Hitung: </label>
                    <p class="text-muted">Selisih Harga Per Pcs/Bahan/Reagen/Energi (Penghematan improvement) x Proses.
                        (atau)</p>
                    <p class="text-muted">Kegiatan 1 bulan x sisa bulan berjalan sampai akhir tahun (contoh buat conim di
                        maret maka dikali
                        9 bulan) Jika menggunakan jumlah BN, gunakan ROFO 1 tahun
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <!-- data tables css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />


    <style>
        .select2-selection__rendered {
            line-height: 50px !important;
        }

        .select2-container .select2-selection--single {
            height: 50px !important;
            padding-top: 0px;
        }

        .select2-selection__arrow {
            height: 50px !important;
            padding-top: 0px;
        }

        .btn-lampiran {
            height: 50px;
            padding-top: 13px;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        var idMesin = '{{ $data->mesin_id }}'
        $('#mesin').select2({
            placeholder: 'Select a Machine',
            theme: 'bootstrap-5',
            ajax: {
                url: '{{ route('v1.osr.machine') }}',
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
