@extends('layouts.app')
@section('title', 'Notifikasi Izin')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">
        Notifikasi Izin Lembaga
    </h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Data Izin Hampir Habis & Kadaluarsa
            </h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered" id="datatable" width="100%">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>Nama Lembaga</th>
                            <th>Jenis</th>
                            <th>No Sertifikat</th>
                            <th>Masa Berlaku</th>
                            <th>Status</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->lembaga->nama_lembaga ?? '-' }}</td>

                        <td>
                            {{ $item->lembaga->jenis->nama ?? '-' }}
                        </td>

                        <td>{{ $item->no_sertifikat ?? '-' }}</td>

                        <td>{{ $item->masa_berlaku }}</td>
                        <td>
                            @php
                                $today = \Carbon\Carbon::today();
                            @endphp

                            @if($item->masa_berlaku < $today)
                                <span class="badge badge-danger">Kadaluarsa</span>
                            @elseif($item->masa_berlaku <= $today->copy()->addDays(30))
                                <span class="badge badge-warning">Hampir Habis</span>
                            @else
                                <span class="badge badge-success">Aktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ $item->lembaga->edit_route }}"
                               class="btn btn-warning btn-sm"
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>


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