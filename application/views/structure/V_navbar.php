<style>
    .item-menu {
        cursor: pointer;
    }

    .btn-menu-nav {
        background-color: transparent !important;
        border: 0px;
        color: #fff;
    }
    
    .custom-dropdown-menu {
        padding: 1.2rem 0;
    }

    .custom-dropdown-menu .list-down-menu {
        padding: 0 0.75rem;
    }

    .custom-dropdown-menu:before {
        content: unset !important;
    }

    .dropdown:not(.dropdown-hover) .custom-dropdown-menu {
        margin-top: 3.5rem !important;
        font-size: 14px !important;
        line-height: 2rem !important;
        border: #fff;
    }

    .custom-dropdown-menu .dropdown-item:hover {
        background-color: #F3F6F9;
        color: #6993FF;
    }

    .dropdown.item-menu:has(> .custom-dropdown-menu.show) {
        background-color: #1a84c6;
    }
    
	.dropdown-menu li {
		position: relative;
	}

	.dropdown-menu .submenu-left { 
		right: 100%; left: auto;
	}

	.dropdown-menu > li:hover { background-color: #f1f1f1; }
	.dropdown-menu > li:hover > .submenu, .menu-item-hover .submenu{
		display: block !important;
        opacity: 1 !important;
        z-index: 99999999999;
	}

    @media (min-width: 992px) {
        .dropdown:not(.dropdown-hover) .submenu.dropdown-menu {
            right: unset !important;
            left: 16.75rem !important;
            margin: unset !important;
            padding: 1.25rem 0 !important;
            margin-top: unset !important;
            width: 14rem;
            font-size: 14px;
        }
    }

    .submeny {
        line-height: 2rem !important;
    }

    .submenu.dropdown-menu li {
        padding: 0 1.5rem;
        list-style-position: inside;
        list-style-type: circle;
    }
    
    .submenu.dropdown-menu li {
        list-style-type: disc;
        color: #B5B5C3;
    }
    
    .submenu.dropdown-menu li a {
        display: contents;
    }

    .submenu.dropdown-menu li:hover > a {
        color: #6993FF;
    }
    
    .list-down-menu a i {
        float: right;
        padding: 10px 0;
        color: #B5B5C3;
    }

    .navbar-vertical.navbar-expand-xs {
        max-width: 70vw !important;
    }

    .navbar-vertical.bg-white .navbar-nav>.nav-item .nav-link.active {
        background-color: #F3F6F9;
        color: #6993FF;
        border: unset;
        border-radius: unset;
    }
    .navbar-vertical.navbar-expand-xs .navbar-nav .nav-link {
        margin: unset;
        padding: 1rem;
    }

    #donasi-collapse .navbar-nav .nav-item {
        padding: 0 20px;
    }

    .g-sidenav-show:not(.rtl) .sidenav {
        transform: translateX(-70vw);
    }
    .g-sidenav-show.g-sidenav-pinned .sidenav {
        transform: translateX(0);
    }

    .menu-nav-side.nav-link{
        background-color: #F3F6F9 !important;
        color: #6993FF !important;
        border: unset;
        border-radius: unset;
    }

    .menu-nav-side.nav-link.collapsed{
        background-color: unset !important;
        color: #67748e !important;
        border: unset;
        border-radius: unset;
    }

    .collapse.show .nav-link{
        background-color: #F3F6F9;
        color: #6993FF;
        border: unset;
        border-radius: unset;
    }

    .collapse.show .nav-link.collapsed{
        background-color: unset;
        color: #67748e;
        border: unset;
        border-radius: unset;
    }

    .navbar-vertical.navbar-expand-xs .navbar-collapse {
        height: 95vh;
    }
</style>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 position-absolute w-100" id="background-body"></div>
    <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 d-lg-none d-xl-none" id="sidenav-main">
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?= ($this->uri->segment(1) == 'dashboard' || empty($this->uri->segment(1))) ? 'active' : '' ?>" href="<?= base_url('dashboard') ?>">
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="menu-nav-side nav-link collapsed" data-bs-toggle="collapse" href="#donasi-collapse" role="button" aria-expanded="false" aria-controls="donasi-collapse">
                        <span class="nav-link-text ms-1">Donasi</span>
                    </a>
                    <div class="collapse" id="donasi-collapse">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="<?= base_url('donasi/list') ?>">
                                    <span class="nav-link-text ms-1">Daftar Donasi</span>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link collapsed" data-bs-toggle="collapse" href="#konter-collapse" role="button" aria-expanded="false" aria-controls="konter-collapse">
                                    <span class="nav-link-text ms-1">Konter</span>
                                </a>
                                <div class="collapse list-sub-nav" id="konter-collapse" data-parent="#donasi-collapse">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link collapsed" href="<?= base_url('donasi/counter/list') ?>">
                                                <span class="nav-link-text ms-1">&bull;&nbsp;&nbsp;&nbsp; Daftar Konter</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link collapsed" href="<?= base_url('donasi/counter/new') ?>">
                                                <span class="nav-link-text ms-1">&bull;&nbsp;&nbsp;&nbsp; Input</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link collapsed" href="<?= base_url('donasi/counter/collect') ?>">
                                                <span class="nav-link-text ms-1">&bull;&nbsp;&nbsp;&nbsp; Collect</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link collapsed" href="<?= base_url('donasi/counter/recap') ?>">
                                                <span class="nav-link-text ms-1">&bull;&nbsp;&nbsp;&nbsp; Rekapan Konter</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link collapsed" data-bs-toggle="collapse" href="#confirm-collapse" role="button" aria-expanded="false" aria-controls="confirm-collapse">
                                    <span class="nav-link-text ms-1">Konfirmasi Donasi</span>
                                </a>
                                <div class="collapse list-sub-nav" id="confirm-collapse" data-parent="#donasi-collapse">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link collapsed" href="">
                                                <span class="nav-link-text ms-1">&bull;&nbsp;&nbsp;&nbsp; List</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link collapsed" href="">
                                                <span class="nav-link-text ms-1">&bull;&nbsp;&nbsp;&nbsp; Input</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link collapsed" data-bs-toggle="collapse" href="#rekap-collapse" role="button" aria-expanded="false" aria-controls="rekap-collapse">
                                    <span class="nav-link-text ms-1">Rekapan</span>
                                </a>
                                <div class="collapse list-sub-nav" id="rekap-collapse" data-parent="#donasi-collapse">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link collapsed" href="<?= base_url('donasi/recap') ?>">
                                                <span class="nav-link-text ms-1">&bull;&nbsp;&nbsp;&nbsp; Rekap Donasi</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link collapsed" href="<?= base_url('dashboard') ?>">
                                                <span class="nav-link-text ms-1">&bull;&nbsp;&nbsp;&nbsp; Rekap Collector</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="<?= base_url('dashboard') ?>">
                                    <span class="nav-link-text ms-1">Interaksi Donasi (Coming Soon)</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($this->uri->segment(1) == 'donatur') ? 'active' : '' ?>" href="<?= base_url('donatur/new') ?>">
                        <span class="nav-link-text ms-1">Donatur</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($this->uri->segment(1) == 'checker') ? 'active' : '' ?>" href="<?= base_url('checker') ?>">
                        <span class="nav-link-text ms-1">Checker</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    
    <main class="main-content position-relative border-radius-lg">
        <!-- Navbar -->
        <div class="d-none d-lg-flex justify-content-between align-items-start p-4">
            <div class="d-flex">
                <div class="mx-2 text-light py-2 px-3 border-radius-lg item-menu <?= ($this->uri->segment(1) == 'dashboard' || empty($this->uri->segment(1))) ? 'active' : '' ?>"><a class="text-light" href="<?= base_url('dashboard') ?>" style="text-decoration:none"><b>Dashboard</b></a></div>
                <div class="dropdown mx-2 text-light py-2 px-3 border-radius-lg item-menu  <?= ($this->uri->segment(1) == 'donasi') ? 'active' : ''?>">
                    <button class="btn-menu-nav" id="dropdownMenuDonasi" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Donasi
                    </button>
                    <div class="dropdown-menu custom-dropdown-menu" aria-labelledby="dropdownMenuDonasi">
                        <li class="list-down-menu">
                            <a class="dropdown-item" href="<?= base_url('donasi/list') ?>">Daftar Donasi</a>
                        </li>
                        <li class="list-down-menu">
                            <a class="dropdown-item" href="#">
                                Konter
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </a>

                            <ul class="submenu dropdown-menu">
                                <li><a class="dropdown-item" href="<?= base_url('donasi/counter/list') ?>">Daftar Konter</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('donasi/counter/new') ?>">Input</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('donasi/counter/collect') ?>">Collect</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('donasi/counter/recap') ?>">Rekapan Konter</a></li>
                            </ul>
                        </li>
                        <li class="list-down-menu">
                            <a class="dropdown-item" href="#">
                                Konfirmasi Donasi
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </a>
                            <ul class="submenu dropdown-menu">
                                <li><a class="dropdown-item" href="#">List</a></li>
                                <li><a class="dropdown-item" href="#">Input</a></li>
                            </ul>
                        </li>
                        <li class="list-down-menu">
                            <a class="dropdown-item" href="#">
                                Rekapan
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </a>
                            <ul class="submenu dropdown-menu">
                                <li><a class="dropdown-item" href="<?= base_url('donasi/recap') ?>">Rekap Donasi</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('dashboard') ?>">Rekap Collector</a></li>
                            </ul>
                        </li>
                        <li class="list-down-menu">
                            <a class="dropdown-item" href="<?= base_url('dashboard') ?>">Interaksi Donasi (Coming Soon)</a>
                        </li>
                    </div>
                </div>
                <div class="mx-2 text-light py-2 px-3 border-radius-lg item-menu  <?= ($this->uri->segment(1) == 'donatur') ? 'active' : ''?>"><a class="text-light" href="<?= base_url('donatur/new') ?>" style="text-decoration:none"><b>Donatur</b></a></div>
                <div class="mx-2 text-light py-2 px-3 border-radius-lg item-menu  <?= ($this->uri->segment(1) == 'checker') ? 'active' : ''?>"><a class="text-light" href="<?= base_url('checker') ?>" style="text-decoration:none"><b>Checker</b></a></div>
                <!-- <div class="mx-2 text-light py-2 px-3 border-radius-lg item-menu"><b>Kurban</b></div> -->
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
                            <ul class="dropdown-menu dropdown-menu-end px-2 pt-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
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

        <script>
            $(document).ready(function() {
                var hideSubMenu;

                $(document).on("mouseenter", ".list-down-menu", function() {
                    $('.submenu').removeClass("show");
                    $('.menu-item-hover').removeClass("menu-item-hover");
                    clearTimeout(hideSubMenu);

                    $(this).addClass("menu-item-hover");
                    $(this).find(".submenu").addClass("show");
                });

                $(document).on("mouseleave", ".dropdown-menu", function() {
                    hideSubMenu = setTimeout(() => {
                        $('.menu-item-hover').removeClass("menu-item-hover");
                        $('.submenu').removeClass("show");
                    }, 500);
                });
            });
        </script>