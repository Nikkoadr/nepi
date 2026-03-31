@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Tambah Data PKBM</h1>

    <div class="card shadow mb-4">
        <div class="card-body">

            <form action="{{ route('pkbm.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>NPSN</label>
                        <input type="text" name="npsn"
                            class="form-control @error('npsn') is-invalid @enderror"
                            value="{{ old('npsn') }}">
                        @error('npsn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Nama Lembaga</label>
                        <input type="text" name="nama_lembaga"
                            class="form-control @error('nama_lembaga') is-invalid @enderror"
                            value="{{ old('nama_lembaga') }}">
                        @error('nama_lembaga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Pengelola</label>
                        <input type="text" name="pengelola"
                            class="form-control @error('pengelola') is-invalid @enderror"
                            value="{{ old('pengelola') }}">
                        @error('pengelola')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Telepon</label>
                        <input type="text" name="telepon"
                            class="form-control @error('telepon') is-invalid @enderror"
                            value="{{ old('telepon') }}">
                        @error('telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat"
                            class="form-control @error('alamat') is-invalid @enderror"
                            rows="3">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <hr>

                <h5 class="mb-3">Data Izin</h5>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>No Sertifikat</label>
                        <input type="text" name="no_sertifikat"
                            class="form-control @error('no_sertifikat') is-invalid @enderror"
                            value="{{ old('no_sertifikat') }}">
                        @error('no_sertifikat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Masa Berlaku</label>
                        <input type="date" name="masa_berlaku"
                            class="form-control @error('masa_berlaku') is-invalid @enderror"
                            value="{{ old('masa_berlaku') }}">
                        @error('masa_berlaku')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
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