@extends('layouts.theme.master')

@section('title')
    Add New OneSheet Saving Report
@endsection

@section('content')
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <h5>New OneSheet Saving Report</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('v1.osr.store') }}" method="POST" enctype="multipart/form-data">
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
                                        name="tema" placeholder="tema">
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
                                        name="lokasi" placeholder="lokasi">
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
                                        name="noCC" placeholder="noCC">
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
                                        placeholder="specific"></textarea>
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
                                    <textarea class="form-control @error('measurable') is-invalid @enderror" id="message" name="measurable" rows="2"
                                        placeholder="Measureable"></textarea>
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
                                        rows="2" placeholder="Achievable"></textarea>
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
                                        rows="2" placeholder="Reasonable"></textarea>
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
                                        rows="2" placeholder="Time Based"></textarea>
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
                                        placeholder="Man WSBH"></textarea>
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
                                        placeholder="Man WAH"></textarea>
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
                                        id="justifikasiSwitch-0" name="manJustifikasi1">
                                    <label class="form-check-label" for="justifikasiSwitch-0"></label>
                                </div>
                            </div>
                            <div class="col-sm-12 root-cause-container" style="display: none;">
                                <div class="form-group">
                                    <label for="rootCause-0">Man Root Cause</label>
                                    <textarea id="rootCause-0" rows="2" placeholder="Man Root Cause" class="form-control" name="man_root_cause"></textarea>
                                </div>
                            </div>

                            <!-- Set 2 -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="MachineWSBH">Machine WSBH <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('machineWSBH') is-invalid @enderror" id="message-1" name="machineWSBH"
                                        rows="2" placeholder="Insert Your Message"></textarea>
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
                                        rows="2" placeholder="Insert Your Message"></textarea>
                                    @error('machineWAH')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="justifikasiSwitch-1">Man Justifikasi <small
                                        class="text-danger">*</small>:</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input justifikasiSwitch" type="checkbox"
                                        id="justifikasiSwitch-1" name="manJustifikasi2">
                                    <label class="form-check-label" for="justifikasiSwitch-1"></label>
                                </div>
                            </div>
                            <div class="col-sm-12 root-cause-container" style="display: none;">
                                <div class="form-group">
                                    <label for="rootCause-1">Man Root Cause</label>
                                    <textarea id="rootCause-1" rows="2" placeholder="Man Root Cause" class="form-control"
                                        name="machine_root_cause"></textarea>
                                </div>
                            </div>

                            <!-- Set 3 -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="MethodWSBH">Method WSBH <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('methodWSBH') is-invalid @enderror" id="message-1" name="methodWSBH"
                                        rows="2" placeholder="Insert Your Message"></textarea>
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
                                        rows="2" placeholder="Insert Your Message"></textarea>
                                    @error('methodWAH')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="justifikasiSwitch-1">Man Justifikasi <small
                                        class="text-danger">*</small>:</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input justifikasiSwitch" type="checkbox"
                                        id="justifikasiSwitch-1" name="manJustifikasi3">
                                    <label class="form-check-label" for="justifikasiSwitch-1"></label>
                                </div>
                            </div>
                            <div class="col-sm-12 root-cause-container" style="display: none;">
                                <div class="form-group">
                                    <label for="rootCause-1">Man Root Cause</label>
                                    <textarea id="rootCause-1" rows="2" placeholder="Man Root Cause" class="form-control"
                                        name="method_root_cause"></textarea>
                                </div>
                            </div>

                            <!-- Set 4 -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="MaterialWSBH">Material WSBH <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('materialWSBH') is-invalid @enderror" id="message-1" name="materialWSBH"
                                        rows="2" placeholder="Insert Your Message"></textarea>
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
                                        rows="2" placeholder="Insert Your Message"></textarea>
                                    @error('materialWAH')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="justifikasiSwitch-1">Man Justifikasi gvcghc <small
                                        class="text-danger">*</small>:</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input justifikasiSwitch" type="checkbox"
                                        id="justifikasiSwitch-1" name="manJustifikasi4">
                                    <label class="form-check-label" for="justifikasiSwitch-1"></label>
                                </div>
                            </div>
                            <div class="col-sm-12 root-cause-container" style="display: none;">
                                <div class="form-group">
                                    <label for="rootCause-1">Man Root Cause</label>
                                    <textarea id="rootCause-1" rows="2" placeholder="Man Root Cause" class="form-control"
                                        name="material_root_cause"></textarea>
                                </div>
                            </div>

                            <!-- Set 5 -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="EnvironmentWSBH">Environment WSBH <small
                                            class="text-danger">*</small></label>
                                    <textarea class="form-control @error('environmentWSBH') is-invalid @enderror" id="message-1" name="environmentWSBH"
                                        rows="2" placeholder="Insert Your Message"></textarea>
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
                                        rows="2" placeholder="Insert Your Message"></textarea>
                                    @error('environmentWAH')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="justifikasiSwitch-1">Man Justifikasi <small
                                        class="text-danger">*</small>:</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input justifikasiSwitch" type="checkbox"
                                        id="justifikasiSwitch-1" name="manJustifikasi5">
                                    <label class="form-check-label" for="justifikasiSwitch-1"></label>
                                </div>
                            </div>
                            <div class="col-sm-12 root-cause-container" style="display: none;">
                                <div class="form-group">
                                    <label for="rootCause-1">Man Root Cause</label>
                                    <textarea id="rootCause-1" rows="2" placeholder="Man Root Cause" class="form-control"
                                        name="environment_root_cause"></textarea>
                                </div>
                            </div>
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
                                        placeholder="Apa rencana penanggulangannya?"></textarea>
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
                                        placeholder="Siapa yang melakukannya?"></textarea>
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
                                        placeholder="Kenapa harus dilakukan?"></textarea>
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
                                        placeholder="Dimana penanggulangan tersebut dilakukan?"></textarea>
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
                                        placeholder="Kapan penanggulangan tersebut dilakukan?"></textarea>
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
                                        placeholder="Bagaimana caranya penanggulangan tersebut dilakukan?"></textarea>
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
                                        placeholder="quality"></textarea>
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
                                        placeholder="cost"></textarea>
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
                                        rows="2" placeholder="delivery"></textarea>
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
                                        placeholder="safety"></textarea>
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
                                        placeholder="morale"></textarea>
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
                                        rows="2" placeholder="productivity"></textarea>
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
                                        rows="2" placeholder="environment"></textarea>
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
                                    rows="2" placeholder="standarisasi"></textarea>
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
                                    rows="2" placeholder="Next Step"></textarea>
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
                                        name="totalBiaya" placeholder="Total Biaya">
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
                                        name="costSaving" placeholder="Total Keuntungan (cost saving)">
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
                            <div class="form-group">
                                <input type="file" class="form-control @error('lampiran') is-invalid @enderror"
                                    name="lampiran" placeholder="lampiran">
                                @error('lampiran')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                                                id="justifikasiSwitch-0" data-target=".root-cause-container"
                                                name="mp_info" value="enabled">
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
                                            <option value=""></option>
                                            <option value="Equipment">Equipment</option>
                                            <option value="Building">Building</option>
                                            <option value="Instrument">Instrument</option>
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
                                            <option value=""></option>
                                            <option value="Granulasi">Granulasi</option>
                                            <option value="Dryer">Dryer</option>
                                            <option value="Camas">Camas</option>
                                            <option value="Cetak">Cetak</option>
                                            <option value="Blistering">Blistering</option>
                                            <option value="Striping">Striping</option>
                                            <option value="Robotic Secondary Packaging">Robotic Secondary Packaging
                                            </option>
                                            <option value="Cartoning">Cartoning</option>
                                            <option value="Palletizer">Palletizer</option>
                                            <option value="Motor Coating Pan">Motor Coating Pan</option>
                                            <option value="Mesh Deduster">Mesh Deduster</option>
                                            <option value="Hot Air">Hot Air</option>
                                            <option value="Filling">Filling</option>
                                            <option value="Labelling">Labelling</option>
                                            <option value="Case Packer">Case Packer</option>
                                            <option value="Premix Tank">Premix Tank</option>
                                            <option value="Feed Hopper">Feed Hopper</option>
                                            <option value="Conveyor">Conveyor</option>
                                            <option value="Other">Other</option>
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
                                        <p>Dampak positif terhadap kualitas, OHSE, pengoperasian, perawatan, dll</p>
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
                                        <p>Jelaskan masukan atau catatan secara spesifik untuk standarisasi (URS). contoh :
                                            - Material part mesin yang kontak langsung dengan produk harus terbuat dari
                                            stainless steel 316 L. - Posisi tombol emergensi ditempatkan dekat area kerja
                                            Operator.</p>
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
                                                <p>Deskripsi desain komponen/bagian mesin</p>
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
                                                <p>Deskripsi desain komponen/bagian mesin</p>
                                        <textarea class="form-control @error('setelahPerubahan') is-invalid @enderror" id="message-1"
                                            name="setelahPerubahan" rows="2" placeholder="Jelaskan kejadian Setelah Perubahan"></textarea>
                                        @error('setelahPerubahan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-check form-switch form-check-custom form-check-solid">
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
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
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
