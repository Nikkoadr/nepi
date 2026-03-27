<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Register - Sistem Perizinan</title>

    <!-- SB Admin 2 -->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/img/logo_disdik.png') }}" type="image/x-icon">

</head>

<body class="bg-gradient-primary">

<div class="container">

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
                                Buat Akun
                            </h1>
                            <p class="small text-muted mb-4">
                                Sistem Perizinan - Dinas Pendidikan Kota Cirebon
                            </p>
                        </div>

                        <form method="POST" action="{{ route('register') }}" class="user">
                            @csrf

                            <!-- NAME -->
                            <div class="form-group">
                                <input type="text"
                                    class="form-control form-control-user @error('name') is-invalid @enderror"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="Nama Lengkap"
                                    required autofocus>

                                @error('name')
                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <!-- EMAIL -->
                            <div class="form-group">
                                <input type="email"
                                    class="form-control form-control-user @error('email') is-invalid @enderror"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Email Address"
                                    required>

                                @error('email')
                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <!-- PASSWORD -->
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password"
                                        class="form-control form-control-user @error('password') is-invalid @enderror"
                                        name="password"
                                        placeholder="Password"
                                        required>
                                </div>

                                <div class="col-sm-6">
                                    <input type="password"
                                        class="form-control form-control-user"
                                        name="password_confirmation"
                                        placeholder="Ulangi Password"
                                        required>
                                </div>
                            </div>

                            @error('password')
                                <small class="text-danger d-block mb-2">
                                    {{ $message }}
                                </small>
                            @enderror

                            <!-- BUTTON -->
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>

                        </form>

                        <hr>

                        <!-- LOGIN -->
                        <div class="text-center">
                            <a class="small" href="{{ route('login') }}">
                                Sudah punya akun? Login!
                            </a>
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