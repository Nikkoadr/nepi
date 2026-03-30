<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 12px; 
            color: #333;
        }
        .header { 
            text-align: center; 
            border-bottom: 3px solid #000; 
            padding-bottom: 10px; 
            margin-bottom: 20px; 
            position: relative;
        }
        .header img { 
            width: 80px; 
            position: absolute; 
            left: 20px; /* Jarak logo dari kiri */
            top: 0;
        }
        .header h3, .header h2, .header p { 
            margin: 2px 0; 
        }
        .header h2 {
            text-transform: uppercase;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 20px; 
        }
        table th, table td { 
            border: 1px solid #000; 
            padding: 5px; 
        }
        table th { 
            background-color: #f2f2f2; 
        }
        .text-center { 
            text-align: center; 
        }
        .text-danger { 
            color: red; 
        }
        .bg-danger-light {
            background-color: #ffe6e6 !important;
        }
        .footer { 
            width: 250px; 
            float: right; 
            text-align: center; 
            margin-top: 40px; 
        }
        @media print {
            @page { margin: 20mm; }
        }
    </style>
</head>
<body onload="window.print()">
    <!-- Bagian Kop Surat (Sesuaikan Teks Instansi Jika Diperlukan) -->
    <div class="header">
        <img src="{{ asset('assets/img/logo_disdik.png') }}" alt="Logo">
        <h2>PEMERINTAH KOTA CIREBON</h2>
        <h3>DINAS PENDIDIKAN DAN KEBUDAYAAN</h3>
        <p>Jl. Brigjen Dharsono By Pass No. 7, Sunyaragi, Kesambi, Kota Cirebon, Jawa Barat 45132, Telp. (0231) 486579</p>
    </div>

    <!-- Judul Laporan -->
    <h3 class="text-center" style="margin-bottom: 20px;">{{ strtoupper($title) }}</h3>

    <!-- Tabel Data Rekapitulasi -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NPSN</th>
                <th>Nama Lembaga</th>
                <th>Jenis</th>
                <th>Pengelola</th>
                <th>Sertifikat</th>
                <th>Masa Berlaku</th>
                <th>Status Izin</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
                @php $status = $item->izin->status ?? null; @endphp
                <!-- Beri class warna terang (abu-abu/pink cerah) jika izin habis/kadaluarsa agar menonjol -->
                <tr class="{{ in_array($status, ['habis', 'kadaluarsa']) ? 'bg-danger-light' : '' }}">
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->npsn }}</td>
                    <td>{{ $item->nama_lembaga }}</td>
                    <td>{{ $item->jenisLembaga->nama ?? '-' }}</td>
                    <td>{{ $item->pengelola }}</td>
                    <td>{{ $item->izin->no_sertifikat ?? '-' }}</td>
                    <td>{{ $item->izin->masa_berlaku ? \Carbon\Carbon::parse($item->izin->masa_berlaku)->format('d-m-Y') : '-' }}</td>
                    <td class="{{ in_array($status, ['habis', 'kadaluarsa']) ? 'text-danger' : '' }} font-weight-bold">
                        {{ $status ? strtoupper($status) : '-' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data yang sesuai dengan kriteria filter.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Bagian Footer Tanda Tangan -->
    <div class="footer">
        <p>Kota Contoh, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p><strong>KEPALA DINAS</strong></p>
        <br><br><br><br>
        <p style="text-decoration: underline; font-weight: bold; margin-bottom: 0;">Satria Wibawa</p>
        <p>NIP. 1234567800</p>
    </div>

    <!-- Clearfix untuk printout yang rapi -->
    <div style="clear: both;"></div>
</body>
</html>
