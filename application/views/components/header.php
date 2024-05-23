<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?= $title; ?> - Doctor Information System</title>
        <link rel="icon" href="<?= base_url() ?>assets/images/icon/doctor.png">
        <link href="<?= base_url()?>assets/css/style.min.css" rel="stylesheet" />
        <link href="<?= base_url()?>assets/css/styles.css" rel="stylesheet" />
        <link href="<?= base_url()?>assets/css/default.css" rel="stylesheet" />
        <link href="<?= base_url()?>assets/css/toastr.min.css" rel="stylesheet" />
        <link href="<?= base_url()?>assets/css/datatables.min.css" rel="stylesheet">
        <link href="<?= base_url()?>assets/css/sweetalert2.min.css" rel="stylesheet">
        <script data-search-pseudo-elements="" defer="" src="<?= base_url()?>assets/js/all.min.js"></script>
        <script src="<?= base_url()?>assets/js/feather.min.js"></script>
        <script>
            let $url = '<?= base_url(); ?>';
        </script>
    </head>
    <body class="nav-fixed">
        <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
            <!-- Sidenav Toggle Button-->
            <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
            <!-- Navbar Brand-->
            <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="<?= base_url()?>dashboard">Doctor Info System</a>
            <!-- Navbar Search Input-->
            <form class="form-inline me-auto d-none d-lg-block me-3">
                <div class="input-group input-group-joined input-group-solid">
                    <input class="form-control pe-0" type="search" placeholder="Search" aria-label="Search" />
                    <div class="input-group-text"><i data-feather="search"></i></div>
                </div>
            </form>
            <!-- Navbar Items-->
            <ul class="navbar-nav align-items-center ms-auto">
                <!-- User Dropdown-->
                <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="<?= base_url(); ?>assets/images/icon/user.png" /></a>
                    <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                        <h6 class="dropdown-header d-flex align-items-center">
                            <img class="dropdown-user-img" src="<?= base_url(); ?>assets/images/icon/user.png" />
                            <div class="dropdown-user-details">
                                <div class="dropdown-user-details-name"><?= $this->session->userdata('name'); ?></div>
                            </div>
                        </h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url() ?>account">
                            <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                            Account
                        </a>
                        <a class="dropdown-item" href="<?= base_url() ?>logout">
                            <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sidenav shadow-right sidenav-light">
                    <div class="sidenav-menu">
                        <div class="nav accordion" id="accordionSidenav">
                            <!-- Sidenav Menu Heading (Menu)-->
                            <div class="sidenav-menu-heading">Menu</div>
                            <!-- Sidenav Accordion (Dashboard)-->
                            <a class="nav-link collapsed" href="<?= base_url()?>dashboard">
                                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                Dashboards
                            </a>
                            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="nav-link-icon"><i data-feather="list"></i></div>
                                Doctors
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" data-bs-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                                    <a class="nav-link" href="<?= base_url() ?>doctor/new">Add Doctor</a>
                                    <a class="nav-link" href="<?= base_url() ?>doctor/list">All Doctors</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapsePagesUsers" aria-expanded="false" aria-controls="collapsePages">
                                <div class="nav-link-icon"><i data-feather="users"></i></div>
                                Users
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePagesUsers" data-bs-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                                    <a class="nav-link" href="<?= base_url() ?>user/new">Add User</a>
                                    <a class="nav-link" href="<?= base_url() ?>user/list">All Users</a>
                                </nav>
                            </div>
                            <!-- <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapsePagesReports" aria-expanded="false" aria-controls="collapsePages">
                                <div class="nav-link-icon"><i data-feather="printer"></i></div>
                                Reports
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePagesReports" data-bs-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                                    <a class="nav-link" href="<?= base_url() ?>report/upcoming">Upcoming Expiry</a>
                                    <a class="nav-link" href="<?= base_url() ?>report/recently">Recently Expired</a>
                                </nav>
                            </div> -->
                        </div>
                    </div>
                    <!-- Sidenav Footer-->
                    <div class="sidenav-footer">
                        <div class="sidenav-footer-content">
                            <div class="sidenav-footer-subtitle">Logged in as:</div>
                            <div class="sidenav-footer-title"><?= $this->session->userdata('username'); ?></div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                   