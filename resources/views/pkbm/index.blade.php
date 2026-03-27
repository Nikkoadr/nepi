@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data PKBM</h1>

    <!-- Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Lembaga PKBM</h6>
            <a href="{{ route('pkbm.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Lembaga
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>NPSN</th>
                            <th>Nama Lembaga</th>
                            <th>Pengelola</th>
                            <th>No Sertifikat</th>
                            <th>Masa Berlaku</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Status</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->npsn }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->pengelola }}</td>
                            <td>{{ $item->izin->no_sertifikat ?? '-' }}</td>
                            <td>{{ $item->izin->masa_berlaku ?? '-' }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->telepon }}</td>
                            <td>
                                @if(optional($item->izin)->status == 'Aktif')
                                    <span class="badge badge-success">Aktif</span>
                                @elseif(optional($item->izin)->status == 'Kadaluarsa')
                                    <span class="badge badge-danger">Kadaluarsa</span>
                                @else
                                    <span class="badge badge-secondary">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('pkbm.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('pkbm.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus data?')" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#datatable').DataTable();
});
</script>
@endpush