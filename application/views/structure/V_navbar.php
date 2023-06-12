<style>
    .item-menu {
        cursor:pointer;
    }
</style>
<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 position-absolute w-100" id="background-body"></div>
    <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 d-lg-none d-xl-none d-block" id="sidenav-main">
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="./pages/dashboard.html">
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <div class="nav-link d-flex justify-content-between align-items-center" class="">
                        <div class="w-100">
                            <a href="./pages/dashboard.html">
                                <span class="nav-link-text ms-1">Donasi</span>
                            </a>
                        </div>
                        <div class="px-3">
                            <i class="fa fa-chevron-right" style="font-size:8px;"></i>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="nav-link d-flex justify-content-between align-items-center" class="">
                        <div class="w-100">
                            <a href="./pages/dashboard.html">
                                <span class="nav-link-text ms-1">Donatur</span>
                            </a>
                        </div>
                        <div class="px-3">
                            <i class="fa fa-chevron-right" style="font-size:8px;"></i>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="nav-link d-flex justify-content-between align-items-center" class="">
                        <div class="w-100">
                            <a href="./pages/dashboard.html">
                                <span class="nav-link-text ms-1">Kurban</span>
                            </a>
                        </div>
                        <div class="px-3">
                            <i class="fa fa-chevron-right" style="font-size:8px;"></i>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </aside>
    
    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        <div class="d-none d-lg-flex justify-content-between align-items-start p-4">
            <div class="d-flex">
                <div class="mx-2 text-light py-2 px-3 border-radius-lg item-menu active"><b>Dashboard</b></div>
                <div class="mx-2 text-light py-2 px-3 border-radius-lg item-menu"><b>Donasi</b></div>
                <div class="mx-2 text-light py-2 px-3 border-radius-lg item-menu"><b>Donatur</b></div>
                <div class="mx-2 text-light py-2 px-3 border-radius-lg item-menu"><b>Kurban</b></div>
            </div>
            <div>
                <span class="text-light mx-1">Hi, <?= $this->session->userdata('nama_user') ?></span> <a href="<?= base_url('login/logout') ?>" class="btn btn-success mb-0">Sign Out</a>
            </div>
        </div>
        <nav class="navbar navbar-main navbar-expand-lg shadow-none px-2" id="navbarBlur" data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 justify-content-end" id="navbar">
                    <ul class="navbar-nav justify-content-end">
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                  <i class="sidenav-toggler-line bg-white"></i>
                                  <i class="sidenav-toggler-line bg-white"></i>
                                  <i class="sidenav-toggler-line bg-white"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item dropdown d-xl-none px-3 pe-2 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user cursor-pointer"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end  px-2 pt-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                                <li class="">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">Hi,</span> <?= $this->session->userdata("nama_user") ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="">
                                    <div class="text-end">
                                        <a href="<?= base_url('login/logout') ?>" class="btn btn-info">Sign Out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
              </div>
          </div>
    </nav>
    <!-- End Navbar -->