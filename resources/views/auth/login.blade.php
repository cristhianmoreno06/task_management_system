<!DOCTYPE html>
<html lang="en">

<head>
    <title> Task Management </title>
    @include('layouts.shared/head-css', ['mode' => $mode ?? '', 'demo' => $demo ?? ''])
</head>

<body class="authentication-bg position-relative">
<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-8 col-lg-10">
                <div class="card overflow-hidden">
                    <div class="row g-0">
                        <div class="col-lg-6 d-none d-lg-block p-2">
                            <img src="/images/auth-img.jpg" alt="" class="img-fluid rounded h-100" style="object-fit: cover;">
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex flex-column h-100">
                                <div class="auth-brand p-4">
                                    <a href="#" class="logo-light">
                                        <img src="/images/logo.png" alt="logo" height="22">
                                    </a>
                                    <a href="#" class="logo-dark">
                                        <img src="/images/logo-dark.png" alt="dark logo" height="22">
                                    </a>
                                </div>
                                <div class="p-4 my-auto">
                                    <h4 class="fs-20">Iniciar sesión</h4>
                                    <p class="text-muted mb-3">Introduzca su dirección de correo electrónico y contraseña para acceder a la cuenta.</p>

                                    <!-- form -->
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        @if (sizeof($errors) > 0)
                                            @foreach ($errors->all() as $error)
                                                <p class="text-danger">{{ $error }}</p>
                                            @endforeach
                                        @endif

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Dirección de correo electrónico</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Ingresa tu email">
                                        </div>
                                        <div class="mb-3">
                                            <a href="{{ route('password.request') }}" class="text-muted float-end"><small>¿Ha olvidado su contraseña?</small></a>
                                            <label for="password" class="form-label">Contraseña</label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Ingresa tu contraseña">
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">Recuérdame</label>
                                            </div>
                                        </div>
                                        <div class="mb-0 text-start">
                                            <button class="btn btn-soft-primary w-100" type="submit"><i class="ri-login-circle-fill me-1"></i> <span class="fw-bold">Iniciar sesión</span> </button>
                                        </div>

                                        <div class="text-center mt-4">
                                            <p class="text-muted fs-16">Iniciar sesión con</p>
                                            <div class="d-flex gap-2 justify-content-center mt-3">
                                                <a href="javascript: void(0);" class="btn btn-soft-primary"><i
                                                        class="ri-facebook-circle-fill"></i></a>
                                                <a href="javascript: void(0);" class="btn btn-soft-danger"><i
                                                        class="ri-google-fill"></i></a>
                                                <a href="javascript: void(0);" class="btn btn-soft-info"><i
                                                        class="ri-twitter-fill"></i></a>
                                                <a href="javascript: void(0);" class="btn btn-soft-dark"><i
                                                        class="ri-github-fill"></i></a>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- end form-->
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <p class="text-dark-emphasis">¿No tiene una cuenta? <a href="{{ route('register') }}" class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b>Regístrese</b></a>
                </p>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<footer class="footer footer-alt fw-medium">
        <span class="text-dark">
            <script>document.write(new Date().getFullYear())</script> © Task Management - Hecho por <b>Cristhian Moreno</b>
        </span>
</footer>

@include('layouts.shared/footer-scripts')

</body>

</html>
