@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Edit Data PKBM</h1>

    <div class="card shadow mb-4">
        <div class="card-body">

            <form action="{{ route('pkbm.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    <!-- NPSN -->
                    <div class="col-md-6 mb-3">
                        <label>NPSN</label>
                        <input type="text" name="npsn" class="form-control"
                            value="{{ old('npsn', $data->npsn) }}" required>
                    </div>

                    <!-- Nama -->
                    <div class="col-md-6 mb-3">
                        <label>Nama Lembaga</label>
                        <input type="text" name="nama_lembaga" class="form-control"
                            value="{{ old('nama_lembaga', $data->nama_lembaga) }}" required>
                    </div>

                    <!-- Pengelola -->
                    <div class="col-md-6 mb-3">
                        <label>Pengelola</label>
                        <input type="text" name="pengelola" class="form-control"
                            value="{{ old('pengelola', $data->pengelola) }}">
                    </div>

                    <!-- Telepon -->
                    <div class="col-md-6 mb-3">
                        <label>Telepon</label>
                        <input type="text" name="telepon" class="form-control"
                            value="{{ old('telepon', $data->telepon) }}">
                    </div>

                    <!-- Alamat -->
                    <div class="col-md-12 mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', $data->alamat) }}</textarea>
                    </div>

                </div>

                <hr>

                <h5 class="mb-3">Data Izin</h5>

                @php
                    $izin = $data->izin; 
                @endphp

                <div class="row">

                    <!-- No Sertifikat -->
                    <div class="col-md-6 mb-3">
                        <label>No Sertifikat</label>
                        <input type="text" name="no_sertifikat" class="form-control"
                            value="{{ old('no_sertifikat', $izin->no_sertifikat ?? '') }}">
                    </div>

                    <!-- Masa Berlaku -->
                    <div class="col-md-6 mb-3">
                        <label>Masa Berlaku</label>
                        <input type="date" name="masa_berlaku" class="form-control"
                            value="{{ old('masa_berlaku', $izin->masa_berlaku ?? '') }}">
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="aktif"
                                {{ (old('status', $izin->status ?? '') == 'aktif') ? 'selected' : '' }}>
                                Aktif
                            </option>
                            <option value="habis"
                                {{ (old('status', $izin->status ?? '') == 'habis') ? 'selected' : '' }}>
                                Habis
                            </option>
                            <option value="kadaluarsa"
                                {{ (old('status', $izin->status ?? '') == 'kadaluarsa') ? 'selected' : '' }}>
                                Kadaluarsa
                            </option>
                        </select>
                    </div>

                    <!-- Keterangan -->
                    <div class="col-md-12 mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control">{{ old('keterangan', $izin->keterangan ?? '') }}</textarea>
                    </div>

                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>

                    <a href="{{ route('pkbm.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection