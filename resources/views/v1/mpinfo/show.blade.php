@extends('layouts.theme.master')
@section('title')
    Mp Info Detail
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">@yield('title')</h5>
                    <p class="mt-0">
                        Show Detail MP Info Report
                    </p>
                </div>
                <div class="card-body table-card">
                    <div class="root-cause-container">
                        <!-- Row 1: Kategori and Section Mesin -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="KategoriMPInfo">Kategori MP Info<small
                                            class="text-danger">*</small></label>
                                    <select class="form-select @error('kategoriMPInfo') is-invalid @enderror" disabled
                                        aria-label="Default select example" id="kategoriMPInfo" name="kategoriMPInfo">
                                        <option value=""></option>
                                        <option {{ $data->ketegori == 'Equipment' ? 'selected' : null }} value="Equipment">
                                            Equipment</option>
                                        <option {{ $data->ketegori == 'Building' ? 'selected' : null }} value="Building">
                                            Building</option>
                                        <option {{ $data->ketegori == 'Instrument' ? 'selected' : null }}
                                            value="Instrument">Instrument</option>
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
                                    <input type="text" class="form-control @error('sectionMesin') is-invalid @enderror"
                                        name="sectionMesin" placeholder="Isi section Mesin MP Info"
                                        value="{{ $data->section_mesin }}" readonly disabled>
                                    @error('sectionMesin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @php
                            // Daftar jenis mesin
                            $mesinList = [
                                'Granulasi',
                                'Dryer',
                                'Camas',
                                'Cetak',
                                'Blistering',
                                'Striping',
                                'Robotic Secondary Packaging',
                                'Cartoning',
                                'Palletizer',
                                'Motor Coating Pan',
                                'Mesh Deduster',
                                'Hot Air',
                                'Filling',
                                'Labelling',
                                'Case Packer',
                                'Premix Tank',
                                'Feed Hopper',
                                'Conveyor',
                                'Other',
                            ];
                        @endphp

                        <!-- Row 2: Jenis Mesin -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="JenisMesin">Jenis Mesin<small
                                            class="text-danger">*</small></label>
                                    <select class="form-select @error('jenisMesin') is-invalid @enderror" disabled
                                        aria-label="Default select example" id="jenisMesin" name="jenisMesin">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($mesinList as $mesin)
                                            <option value="{{ $mesin }}"
                                                {{ $data->jenis_mesin == $mesin ? 'selected' : '' }}>
                                                {{ $mesin }}
                                            </option>
                                        @endforeach
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
                                            class="text-danger">*</small></label> <br>
                                    <small>Dampak positif terhadap kualitas, OHSE, pengoperasian, perawatan, dll</small>
                                    <textarea class="form-control @error('alasan') is-invalid @enderror" id="message-1" name="alasan" rows="2"
                                        readonly disabled placeholder="Jelaskanalasan MP INFO ">{!! $data->alasan !!}</textarea>
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
                                            class="text-danger">*</small></label> <br>
                                    <small>Jelaskan masukan atau catatan secara spesifik untuk standarisasi (URS). contoh :
                                        - Material part mesin yang kontak langsung dengan produk harus terbuat dari
                                        stainless steel 316 L. - Posisi tombol emergensi ditempatkan dekat area kerja
                                        Operator.</small>
                                    <textarea class="form-control @error('infoDetail') is-invalid @enderror" id="message-1" name="infoDetail" rows="2"
                                        disabled readonly placeholder="Deskripsi secara detail MP Info">{!! $data->detail !!}</textarea>
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
                                            class="text-danger">*</small></label> <br>
                                    <small>Deskripsi desain komponen/bagian mesin</small>
                                    <textarea class="form-control @error('sebelumPerubahan') is-invalid @enderror" id="message-1" name="sebelumPerubahan"
                                        disabled readonly rows="2" placeholder="Jelaskan kejadian Sebelum Perubahan">{!! $data->sebelumPerubahan !!}</textarea>
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
                                            class="text-danger">*</small></label> <br>
                                    <small>Deskripsi desain komponen/bagian mesin</small>
                                    <textarea class="form-control @error('setelahPerubahan') is-invalid @enderror" id="message-1" name="setelahPerubahan"
                                        disabled readonly rows="2" placeholder="Jelaskan kejadian Setelah Perubahan">{!! $data->setelahPerubahan !!}</textarea>
                                    @error('setelahPerubahan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
