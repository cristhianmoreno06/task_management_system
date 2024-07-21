<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{ route('tracking.index') }}" class="logo logo-light">
        <span class="logo-lg">
            <img src="/images/logo.png" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="/images/logo-sm.png" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="{{ route('tracking.index') }}" class="logo logo-dark">
        <span class="logo-lg">
            <img src="/images/logo-dark.png" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="/images/logo-sm.png" alt="small logo">
        </span>
    </a>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <ul class="side-nav">
            <li class="side-nav-title">Menú</li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarTracking" aria-expanded="false"
                   aria-controls="sidebarMultiLevel" class="side-nav-link">
                    <i class="ri-alarm-warning-fill"></i>
                    <span> Rastreos </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarTracking">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a href="{{ route('tracking.index') }}" class="side-nav-link">
                                <i class="bi bi-truck"></i>
                                {{--<span class="badge bg-success float-end">9+</span>--}}
                                <span> Registro </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->
