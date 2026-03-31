<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login - Sistem Perizinan</title>

    <!-- SB Admin 2 CSS -->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/img/logo_disdik.png') }}" type="image/x-icon">

</head>

<body class="bg-gradient-primary">

<div class="container">

    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">

                    <div class="row">
                        <!-- IMAGE -->
                        <div class="col-lg-6 d-none d-lg-block" style="background: url('{{ asset('assets/img/logo_disdik.png') }}'); background-position: center; background-size: contain; background-repeat: no-repeat;"></div>
                        
                        <!-- FORM -->
                        <div class="col-lg-6">
                            <div class="p-5">

                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">
                                        <b>SISTEM INFORMASI MANAJEMEN PERIZINAN</b>
                                    </h1>
                                    <p class="mb-4 small text-muted">
                                        Dinas Pendidikan Kota Cirebon
                                    </p>
                                </div>

                                <form method="POST" action="{{ route('login') }}" class="user">
                                    @csrf

                                    <!-- EMAIL -->
                                    <div class="form-group">
                                        <input type="email"
                                            class="form-control form-control-user @error('email') is-invalid @enderror"
                                            name="email"
                                            value="{{ old('email') }}"
                                            placeholder="Masukkan Email..."
                                            required autofocus>

                                        @error('email')
                                            <small class="text-danger d-block mt-1">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>

                                    <!-- PASSWORD -->
                                    <div class="form-group">
                                        <input type="password"
                                            class="form-control form-control-user @error('password') is-invalid @enderror"
                                            name="password"
                                            placeholder="Password"
                                            required>

                                        @error('password')
                                            <small class="text-danger d-block mt-1">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>

                                    <!-- REMEMBER -->
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox"
                                                class="custom-control-input"
                                                id="remember"
                                                name="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="remember">
                                                Remember Me
                                            </label>
                                        </div>
                                    </div>

                                    <!-- BUTTON -->
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>

                                </form>

                                {{-- <hr> --}}

                                <!-- FORGOT -->
                                {{-- @if (Route::has('password.request'))
                                <div class="text-center">
                                    <a class="small" href="{{ route('password.request') }}">
                                        Lupa Password?
                                    </a>
                                </div>
                                @endif --}}

                                <!-- REGISTER -->
                                @if (Route::has('register'))
                                <div class="text-center">
                                    <a class="small" href="{{ route('register') }}">
                                        Buat Akun!
                                    </a>
                                </div>
                                @endif

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- JS -->
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

</body>
</html>