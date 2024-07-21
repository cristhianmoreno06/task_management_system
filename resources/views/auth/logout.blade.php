<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.shared/title-meta', ['title' => 'Logout'])
    @include('layouts.shared/head-css', ['mode' => $mode ?? '', 'demo' => $demo ?? ''])
</head>

<body class="authentication-bg">

<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-8 col-lg-10">
                <div class="card overflow-hidden">
                    <div class="row g-0">
                        <div class="col-lg-6 d-none d-lg-block p-2">
                            <img src="/images/auth-img.jpg" alt="" class="img-fluid rounded h-100">
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex flex-column h-100">
                                <div class="auth-brand p-4">
                                    <a href="{{ route('login') }}" class="logo-light">
                                        <img src="/images/logo.png" alt="logo" height="22">
                                    </a>
                                    <a href="{{ route('login') }}" class="logo-dark">
                                        <img src="/images/logo-dark.png" alt="dark logo" height="22">
                                    </a>
                                </div>
                                <div class="p-4 my-auto">
                                    <div class="my-auto">
                                        <!-- title-->
                                        <div class="text-center">
                                            <h4 class="mt-0 fs-20">Ups! Tu sesión ha expirado por inactividad !</h4>
                                            <p class="text-muted mb-4">Por favor ingresa nuevamente para continuar.</p>
                                        </div>

                                        <!-- Logout icon -->
                                        <div class="logout-icon m-auto">
                                            <img src="/images/svg/shield.gif" alt="" class="img-fluid">
                                        </div>
                                        <!-- end logout-icon-->
                                    </div>
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
                <p class="text-dark-emphasis">Volver al <a href="{{ route('login') }}" class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b>Log In</b></a></p>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<footer class="footer footer-alt fw-medium">
        <span class="text-dark-emphasis">
            <script>document.write(new Date().getFullYear())</script> © Task Management - Hecho por <b>Cristhian Moreno</b>
        </span>
</footer>

@include('layouts.shared/footer-scripts')
</body>

</html>
