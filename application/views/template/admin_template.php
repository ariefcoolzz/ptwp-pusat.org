<?php
extract($_SESSION);
?>
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
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.css" rel="stylesheet" type="text/css">
    <!-- DashForge CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dashforge.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dashforge.dashboard.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skin.gradient1.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skin.cool.css">


</head>

<body>
    <aside class="aside aside-fixed">
        <div class="aside-header">
            <a href="<?php echo base_url('admin') ?>" class="aside-logo"><img class="ht-35 w-35" src="<?php echo base_url('assets/img/favicon.png'); ?>"> PTWP</a>
            <a href="" class="aside-menu-link">
                <i data-feather="menu"></i>
                <i data-feather="x"></i>
            </a>
        </div>
        <div class="aside-body ps">
            <div class="aside-loggedin">
                <div class="d-flex align-items-center justify-content-start">
                    <a href="" class="avatar avatar-online"><img src="<?php echo cdn_foto($_SESSION['FotoPegawai'], $_SESSION['FotoFormal']); ?>" class="rounded-circle" alt=""></a>
                    <div class="aside-alert-link">
                        <a href="<?php echo base_url(); ?>logout" data-toggle="tooltip" title="Keluar"><i data-feather="log-out"></i></a>
                    </div>
                </div>
                <div class="aside-loggedin-user">
                    <a href="#loggedinMenu" class="d-flex align-items-center justify-content-between mg-b-2" data-toggle="collapse">
                        <h6 class="tx-semibold mg-b-0"><?php echo $nama; ?></h6>
                        <i data-feather="chevron-down"></i>
                    </a>
                    <p class="tx-color-03 tx-12 mg-b-0"><?php echo level($level); ?></p>
                </div>
                <div class="collapse" id="loggedinMenu">
                    <ul class="nav nav-aside mg-b-0">
                        <li class="nav-item"><a href="" class="nav-link"><i data-feather="user"></i> <span>Profil</span></a></li>
                        <li class="nav-item"><a href="" class="nav-link"><i data-feather="edit"></i> <span>Ubah Profil</span></a></li>
                        <li class="nav-item"><a href="" class="nav-link"><i data-feather="lock"></i> <span>Ubah Password</span></a></li>
                        <li class="nav-item"><a href="<?php echo base_url(); ?>logout" class="nav-link"><i data-feather="log-out"></i> <span>Keluar</span></a></li>
                    </ul>
                </div>
            </div><!-- aside-loggedin -->
            <ul class="nav nav-aside">
                <?php /*
					<li class="nav-label">Dashboard</li>
                    <li class="nav-item"><a href="<?php echo base_url('admin'); ?>" class="nav-link"><i data-feather="pie-chart"></i> <span>Dashboard</span></a></li> */ ?>
                <li class="nav-label pt-3">Data Master</li>
                <li class="nav-item"><a href="javascript:void(0)" menu_admin="data_user" class="menu_admin nav-link"><i data-feather="user"></i> <span>Data User Pengurus</span></a></li>
                <li class="nav-item"><a href="javascript:void(0)" menu_admin="data_event" class="menu_admin nav-link"><i data-feather="user"></i> <span>Data Event</span></a></li>
                <li class="nav-item"><a href="javascript:void(0)" menu_admin="data_wasit" class="menu_admin nav-link"><i data-feather="user"></i> <span>Data Wasit</span></a></li>
                <li class="nav-item"><a href="javascript:void(0)" menu_admin="data_lapangan" class="menu_admin nav-link"><i data-feather="user"></i> <span>Data Lapangan</span></a></li>

                <li class="nav-label pt-3">Konten & Berita</li>
                <li class="nav-item"><a href="javascript:void(0)" menu_admin="data_konten" class="menu_admin nav-link"><i data-feather="shopping-bag"></i> <span>Data Konten</span></a></li>
                <li class="nav-item"><a href="javascript:void(0)" menu_admin="data_berita" class="menu_admin nav-link"><i data-feather="rss"></i> <span>Data Berita</span></a></li>

                <li class="nav-label pt-3">Pemain & Tim</li>
                <li class="nav-item"><a href="javascript:void(0)" menu_admin="data_pemain" class="menu_admin nav-link"><i data-feather="user"></i> <span>Data Pemain</span></a></li>
                <li class="nav-item"><a href="javascript:void(0)" menu_admin="data_tim" class="menu_admin nav-link"><i data-feather="user"></i> <span>Data Tim</span></a></li>

                <li class="nav-label pt-3">Pertandingan</li>
                <li class="nav-item"><a href="javascript:void(0)" menu_admin="data_babak_penyisihan" class="menu_admin nav-link"><i data-feather="user"></i> <span>Data Babak Penyisihan</span></a></li>
                <li class="nav-item"><a href="javascript:void(0)" menu_admin="data_turnamen" class="menu_admin nav-link"><i data-feather="user"></i> <span>Babak Turnamen</span></a></li>

                <li class="nav-label pt-3">Score</li>
                <li class="nav-item"><a href="javascript:void(0)" menu_admin="score_manage" class="menu_admin nav-link"><i data-feather="user"></i> <span>Manage Score</span></a></li>
                <li class="nav-item"><a href="javascript:void(0)" menu_admin="score_share" class="menu_admin nav-link"><i data-feather="user"></i> <span>Share Score</span></a></li>
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
                <a href="<?php echo base_url('') ?>" target="_blank" class="nav-link" data-toggle="tooltip" data-placement="left" title="Halaman Utama PTWP"><i data-feather="chrome" class="text-primary"></i></a>
            </nav>
        </div><!-- content-header -->

        <div class="content-body">
            <div id="konten" class="container-fluid pd-x-0">
                <?php echo $body; ?>
            </div>
        </div>

        <footer class="footer">
            <div>
                <span>&copy; 2021 PTWP-PUSAT.ORG </span>
                <span>Design by <a>ADIL</a></span>
            </div>
            <div>
                <nav class="nav">
                    <a href="#" class="nav-link">Licenses</a>
                    <a href="#" class="nav-link">Change Log</a>
                    <a href="#" class="nav-link">Get Help</a>
                </nav>
            </div>
        </footer>
    </div>


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
    <!-- append theme customizer -->
    <script src="<?php echo base_url(); ?>assets/lib/js-cookie/js.cookie.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/js/dashboard-one.js"></script> -->
    <!-- <script src="<?php echo base_url(); ?>assets/js/dashforge.settings.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/lib/tinymce/tinymce.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>

</body>
<div id="loader_html" class="container-fluid" style="display:none">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <h4 class="title_loader page-title m-0 text-center"></h4>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end page-title-box -->
        </div>
    </div>
    <!-- end page title -->
    <div class="row justify-content-center">
        <div class="col-xl-12 justify-content-center">
            <div class="card" style="border:none">
                <div class="justify-content-center mx-auto">
                    <div class="lds-dual-ring"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.nav-item.active').removeClass('active');
        $('a[href="' + location.pathname + location.search + '"]').closest('li.nav-item').addClass('active');
    });
    $(".menu_admin").on("click", function() {
        //loader
        $(".title_loader").text("Sedang Memuat Halaman");
        $("#konten").html($("#loader_html").html());
        $('.nav-item.active').removeClass('active');
        $(this).closest('li.nav-item').addClass('active');
        //loader
        // skip();
        var form_data = new FormData();
        // form_data.append('xxx', 'xxx');
        $.ajax({
            url: "<?php echo base_url(); ?>admin/" + $(this).attr('menu_admin'),
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(html) {
                if (html.status !== true) {
                    location.reload();
                } else {
                    $("body").scrollTop('0px');
                    $("#konten").fadeOut(300);
                    $("#konten").html(html.konten_menu);
                    $("#konten").fadeIn(300);

                }
            }
        });
    });
</script>

</html>