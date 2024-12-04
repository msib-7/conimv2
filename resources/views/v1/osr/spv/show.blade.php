@extends('layouts.theme.master')

@section('title')
    Show OneSheet Report
@endsection

@section('content')
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body border-bottom pb-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">@yield('title')</h5>
                        <div class="dropdown">
                            <a class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" href="#"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti ti-dots-vertical f-18"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Today</a>
                                <a class="dropdown-item" href="#">Weekly</a>
                                <a class="dropdown-item" href="#">Monthly</a>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs analytics-tab" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="analytics-tab-1" data-bs-toggle="tab"
                                data-bs-target="#analytics-tab-1-pane" type="button" role="tab"
                                aria-controls="analytics-tab-1-pane" aria-selected="true">Detail</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="analytics-tab-2" data-bs-toggle="tab"
                                data-bs-target="#analytics-tab-2-pane" type="button" role="tab"
                                aria-controls="analytics-tab-2-pane" aria-selected="false">History Approval</button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="analytics-tab-1-pane" role="tabpanel"
                        aria-labelledby="analytics-tab-1" tabindex="0">

                        {{-- Start Detail --}}
                        <form class="p-4">
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
                                        <label class="form-label" for="mesin">mesin yang berkaitan dengan
                                            improvement<small class="text-danger">*</small></label>
                                        <input type="text" class="form-control @error('mesin') is-invalid @enderror"
                                            name="mesin" placeholder="mesin" value="{{ $data->mesin->title }}">
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
                                    <dd>Menganalisa sebab akibat menggunakan 7 tools, lampirkan pada attach dibawah (7
                                        tools)
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
                                        <input type="number"
                                            class="form-control @error('totalBiaya') is-invalid @enderror"
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
                                        <input type="number"
                                            class="form-control @error('costSaving') is-invalid @enderror"
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
                                                class="form-control @error('lampiran') is-invalid @enderror"
                                                name="lampiran" placeholder="lampiran">
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
                        {{-- End Detail --}}
                    </div>
                    <div class="tab-pane fade" id="analytics-tab-2-pane" role="tabpanel"
                        aria-labelledby="analytics-tab-2" tabindex="0">

                        {{-- Start --}}
                        <div class="p-4">
                            <div class="dt-responsive table-responsive">
                                <table id="footer-select" class="table table-striped table-bordered w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Lengkap</th>
                                            <th>Status</th>
                                            <th>Catatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Lengkap</th>
                                            <th>Status</th>
                                            <th>Catatan</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        {{-- end --}}
                    </div>
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
@endsection

@section('styles')
    <!-- data tables css -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap5.min.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $('form :input').prop('readonly', true);
    </script>

    <script type="text/javascript">
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#footer-select').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('v1.osr.edit', $data->id) }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'users',
                        name: 'users'
                    },
                    {
                        data: 'approvalnya',
                        name: 'approvalnya'
                    }, {
                        data: 'note',
                        name: 'note'
                    }
                ],
                rowCallback: function(row, data, index) {
                    // Periksa apakah kolom `approvalnya` mengandung kata "Return"
                    if (data.approvalnya.includes('Return')) {
                        $(row).css('background-color', '#FF746C'); // Ubah background row menjadi merah
                    } else if (data.approvalnya.includes('Finish')) {
                        $(row).css('background-color',
                            '#6FC276'); // Ubah background row menjadi hijau)
                    }
                }
            });
        });
    </script>
@endsection
