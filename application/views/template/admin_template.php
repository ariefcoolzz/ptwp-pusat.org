<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/favicon.png">

    <title><?php echo $judul; ?> - PORTAL PERSATUAN TENIS WARGA PERADILAN (PTWP) PUSAT</title>

    <!-- vendor css -->
    <link href="<?php echo base_url(); ?>assets/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/typicons.font/typicons.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/prismjs/themes/prism-vs.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/lib/select2/css/select2.min.css" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dashforge.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dashforge.dashboard.css">

    <script src="<?php echo base_url(); ?>assets/lib/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/lib/feather-icons/feather.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/lib/prismjs/prism.js"></script>
    <script src="<?php echo base_url(); ?>assets/lib/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/lib/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/lib/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/lib/select2/js/select2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/dashforge.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/dashforge.aside.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/dashboard-one.js"></script>

</head>

<body>
    <aside class="aside aside-fixed">
        <div class="aside-header">
            <a href="../../index.html" class="aside-logo">dash<span>forge</span></a>
            <a href="" class="aside-menu-link">
                <i data-feather="menu"></i>
                <i data-feather="x"></i>
            </a>
        </div>
        <div class="aside-body">
            <div class="aside-loggedin">
                <div class="d-flex align-items-center justify-content-start">
                    <a href="" class="avatar"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></a>
                    <div class="aside-alert-link">
                        <a href="" class="new" data-toggle="tooltip" title="You have 2 unread messages"><i data-feather="message-square"></i></a>
                        <a href="" class="new" data-toggle="tooltip" title="You have 4 new notifications"><i data-feather="bell"></i></a>
                        <a href="" data-toggle="tooltip" title="Sign out"><i data-feather="log-out"></i></a>
                    </div>
                </div>
                <div class="aside-loggedin-user">
                    <a href="#loggedinMenu" class="d-flex align-items-center justify-content-between mg-b-2" data-toggle="collapse">
                        <h6 class="tx-semibold mg-b-0">Katherine Pechon</h6>
                        <i data-feather="chevron-down"></i>
                    </a>
                    <p class="tx-color-03 tx-12 mg-b-0">Administrator</p>
                </div>
                <div class="collapse" id="loggedinMenu">
                    <ul class="nav nav-aside mg-b-0">
                        <li class="nav-item"><a href="" class="nav-link"><i data-feather="edit"></i> <span>Edit Profile</span></a></li>
                        <li class="nav-item"><a href="" class="nav-link"><i data-feather="user"></i> <span>View Profile</span></a></li>
                        <li class="nav-item"><a href="" class="nav-link"><i data-feather="settings"></i> <span>Account Settings</span></a></li>
                        <li class="nav-item"><a href="" class="nav-link"><i data-feather="help-circle"></i> <span>Help Center</span></a></li>
                        <li class="nav-item"><a href="" class="nav-link"><i data-feather="log-out"></i> <span>Sign Out</span></a></li>
                    </ul>
                </div>
            </div><!-- aside-loggedin -->
            <ul class="nav nav-aside">
                <li class="nav-label">Dashboard</li>
                <li class="nav-item"><a href="<?php echo base_url('admin'); ?>" class="nav-link"><i data-feather="pie-chart"></i> <span>Dashboard</span></a></li>
                <li class="nav-label">Menu</li>
                <li class="nav-item with-sub">
                    <a href="" class="nav-link"><i data-feather="user"></i> <span>Profil</span></a>
                    <ul>
                        <li><a href="#">Sejarah</a></li>
                        <li><a href="#">Anggaran Dasar(AD)</a></li>
                        <li><a href="#">Anggaran Rumah Tangga<br>(ART)</a></li>
                        <li><a href="#">SK Panitia Kongres PTWP</a></li>
                        <li><a href="#">Peserta Kongres</a></li>
                        <li><a href="#">Tata Tertib Kongres</a></li>
                        <li><a href="#">Jadwal & Tempat</a></li>
                    </ul>
                </li>
                <li class="nav-item with-sub">
                    <a href="" class="nav-link"><i data-feather="file"></i> <span>Pertandingan</span></a>
                    <ul>
                        <li><a href="#">Technical Meeting</a></li>
                        <li><a href="#">Rundown Pertandingan</a></li>
                        <li><a href="#">Tempat & Jadwal</a></li>
                        <li><a href="#">Daftar Pemain</a></li>
                        <li><a href="#">Daftar Wasit</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside>

    <div class="content ht-100v pd-0">
        <div class="content-header">
            <div class="content-search">
                <i data-feather="search"></i>
                <input type="search" class="form-control" placeholder="Search...">
            </div>
            <nav class="nav">
                <a href="" class="nav-link"><i data-feather="help-circle"></i></a>
                <a href="" class="nav-link"><i data-feather="grid"></i></a>
                <a href="" class="nav-link"><i data-feather="align-left"></i></a>
            </nav>
        </div><!-- content-header -->

        <div class="content-body">
            <div class="container pd-x-0">
                <?php echo $body; ?>
            </div>
        </div>

        <footer class="footer">
            <div>
                <span>&copy; 2021 PTWP-PUSAT.ORG </span>
                <span>Design by <a href="#">Direktorat Jenderal Badan Peradilan Agama</a></span>
            </div>
            <div>
                <nav class="nav">
                    <a href="#" class="nav-link">Licenses</a>
                    <a href="#" class="nav-link">Change Log</a>
                    <a href="#" class="nav-link">Get Help</a>
                </nav>
            </div>
        </footer>

        <script>
            $(document).ready(function() {
                $('.nav-item.active').removeClass('active');
                $('a[href="' + location.pathname + location.search + '"]').closest('li.nav-item').addClass('active');
            });
        </script>
</body>

</html>