<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistem Informasi Perizinan - Dinas Pendidikan Kota Cirebon</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                DISPENDIK CIREBON
            </a>

            <div class="ms-auto">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-light btn-sm">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">
                            Login
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-light btn-sm">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="py-5 bg-light text-center">
        <div class="container">
            <h1 class="fw-bold display-6">
                SISTEM INFORMASI MANAJEMEN PERIZINAN OPERASIONAL LEMBAGA PAUD, PNF, DAN KESETARAAN DI DINAS PENDIDIKAN KOTA CIREBON BERBASIS WEB
            </h1>

            <p class="mt-4 text-muted">
                Sistem ini dirancang untuk mempermudah proses pengajuan, verifikasi, dan monitoring perizinan operasional lembaga pendidikan secara digital, transparan, dan efisien.
            </p>

            <a href="#layanan" class="btn btn-primary mt-3">
                Lihat Layanan
            </a>
        </div>
    </section>

    <!-- LAYANAN -->
    <section id="layanan" class="py-5">
        <div class="container">
            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Pengajuan Perizinan</h5>
                            <p class="card-text">
                                Lembaga dapat mengajukan izin operasional secara online tanpa harus datang langsung ke kantor dinas.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Verifikasi & Validasi</h5>
                            <p class="card-text">
                                Petugas dinas dapat melakukan verifikasi dokumen dan validasi data secara terpusat.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Monitoring & Laporan</h5>
                            <p class="card-text">
                                Monitoring status perizinan serta laporan dapat diakses secara realtime dan transparan.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- TENTANG -->
    <section class="py-5 bg-light text-center">
        <div class="container">
            <h2 class="fw-bold">Tentang Sistem</h2>
            <p class="mt-3 text-muted">
                Sistem Informasi ini dikembangkan untuk meningkatkan kualitas pelayanan publik di lingkungan Dinas Pendidikan Kota Cirebon, khususnya dalam pengelolaan perizinan lembaga PAUD, PNF, dan pendidikan kesetaraan.
            </p>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-primary text-white text-center py-3">
        <small>
            © {{ date('Y') }} Dinas Pendidikan Kota Cirebon | Laravel v{{ Illuminate\Foundation\Application::VERSION }}
        </small>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>