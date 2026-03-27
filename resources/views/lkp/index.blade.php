@extends('layouts.app')
@section('title', 'Data LKP')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Lembaga Kursus dan Pelatihan</h1>

    <!-- Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                Data Lembaga Kursus dan Pelatihan
            </h6>

            <a href="{{ route('lkp.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Lembaga
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered" id="datatable" width="100%">
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
                            <td>{{ $item->nama_lembaga }}</td>
                            <td>{{ $item->pengelola }}</td>
                            <td>{{ $item->izin->no_sertifikat ?? '-' }}</td>
                            <td>{{ $item->izin->masa_berlaku ?? '-' }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->telepon }}</td>

                            <!-- STATUS BADGE -->
                            <td>
                                @php $status = $item->izin->status ?? null; @endphp

                                @if($status == 'aktif')
                                    <span class="badge badge-success">Aktif</span>
                                @elseif($status == 'kadaluarsa')
                                    <span class="badge badge-danger">Kadaluarsa</span>
                                @elseif($status == 'habis')
                                    <span class="badge badge-warning">Habis</span>
                                @else
                                    <span class="badge badge-secondary">-</span>
                                @endif
                            </td>

                            <!-- AKSI -->
                            <td>
                                <a href="{{ route('lkp.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('lkp.destroy', $item->id) }}"
                                      method="POST"
                                      class="d-inline form-delete">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" class="btn btn-danger btn-sm btn-delete">
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

<!-- SWEETALERT2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {

    // DataTable
    $('#datatable').DataTable();

    // =========================
    // DELETE CONFIRM
    // =========================
    $('.btn-delete').click(function() {
        let form = $(this).closest('form');

        Swal.fire({
            title: 'Yakin hapus data?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74a3b',
            cancelButtonColor: '#858796',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // =========================
    // NOTIFIKASI SUCCESS
    // =========================
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false
        });
    @endif

});
</script>

@endpush