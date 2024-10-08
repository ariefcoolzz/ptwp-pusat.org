<?php
// echo "<pre>";
// PRINT_R($_SESSION);
// echo "</pre>";
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
                    <p class="tx-color-03 tx-12 mg-b-0"><?php echo $panitia; ?></p>
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
                    < class="nav-item">< href="<?php echo base_url('admin'); ?>" class="nav-link"><i data-feather="pie-chart"></i> <span>Dashboard</span></a></li> */ ?>
                <?php if (IN_ARRAY($_SESSION['id_panitia'], array(0, 1))) { ?>
                    <li class="nav-label pt-3">Data Master</li>
                    <li class="nav-item"><a href="javascript:void(0)" menu_admin="data_user" class="menu_admin nav-link"><i data-feather="user"></i> <span>Data User (Panitia)</span></a></li>
                    <li class="nav-item"><a href="javascript:void(0)" menu_admin="data_event" class="menu_admin nav-link"><i data-feather="user"></i> <span>Data Event</span></a></li>
                    <li class="nav-item"><a href="javascript:void(0)" menu_admin="data_wasit" class="menu_admin nav-link"><i data-feather="user"></i> <span>Data Wasit</span></a></li>
                    <li class="nav-item"><a href="javascript:void(0)" menu_admin="data_lapangan" class="menu_admin nav-link"><i data-feather="user"></i> <span>Data Lapangan</span></a></li>
                    <li class="nav-label pt-3">Konten & Berita</li>
                    <li class="nav-item"><a href="javascript:void(0)" menu_admin="data_konten" class="menu_admin nav-link"><i data-feather="shopping-bag"></i> <span>Data Konten</span></a></li>
                    <li class="nav-item"><a href="javascript:void(0)" menu_admin="data_berita" class="menu_admin nav-link"><i data-feather="rss"></i> <span>Data Berita</span></a></li>

                <?php } ?>

                <?php if (IN_ARRAY($_SESSION['id_panitia'], array(2, 3, 7))) { ?>
                    <li class="nav-label pt-3">Konten & Berita</li>
                    <li class="nav-item"><a href="javascript:void(0)" menu_admin="data_berita" class="menu_admin nav-link"><i data-feather="rss"></i> <span>Data Berita</span></a></li>
                <?php } ?>
                <li class="nav-item"><a href="javascript:void(0)" menu_admin="data_sewa_mobil" class="menu_admin nav-link"><i data-feather="truck"></i> <span>Sewa Mobil</span></a></li>
                <li class="nav-item"><a href="javascript:void(0)" menu_admin="data_transparansi_keuangan" class="menu_admin nav-link"><i data-feather="dollar-sign"></i> <span>Laporan Keuangan</span></a></li>
                <!-- <li class="nav-label pt-3">Kejuaaraan / Event</li>
                <select id="set_id_event" class="filter form-control">
                    <?php
                    if ($set_id_event->num_rows() > 0) {
                        foreach ($set_id_event->result_array() as $R) {
                            $selected = '';
                            if ($R['is_aktif']) $selected = "selected";
                            echo '<option value="' . $R['id_event'] . '" ' . $selected . '>' . $R['nama'] . '</option>';
                        }
                    }
                    ?>
                </select> -->
                <?php if (IN_ARRAY($_SESSION['id_panitia'], array(0, 1))) { ?>
                    <li class="nav-label pt-3">Pemain & Tim</li>

                    <li class="nav-item"><a menu_admin="data_pemain" class="menu_admin nav-link"><i data-feather="user"></i> <span>Data Pemain</span></a></li>
                    <li class="nav-item"><a menu_admin="data_pemain_veteran" class="menu_admin nav-link"><i data-feather="user"></i> <span>Data Pemain Veteran</span></a></li>
                    <li class="nav-item"><a menu_admin="data_tim" class="menu_admin nav-link"><i data-feather="users"></i> <span>Data Tim</span></a></li>

                    <li class="nav-label pt-3">Pertandingan Beregu</li>
                    <li class="nav-item"><a menu_admin="data_pool" class="menu_admin nav-link"><i data-feather="share-2"></i> <span>Data Pool</span></a></li>
                    <li class="nav-item"><a menu_admin="data_babak_penyisihan" class="menu_admin nav-link"><i data-feather="share-2"></i> <span>Data Babak Penyisihan</span></a></li>
                    <li class="nav-item"><a menu_admin="tabel_babak_penyisihan" class="menu_admin nav-link"><span style="margin-left: 35px;">Tabel Babak Penyisihan</span></a></li>
                    <li class="nav-item"><a menu_admin="data_skema" class="menu_admin nav-link"><i data-feather="share-2"></i> <span>Data Skema</span></a></li>
                    <li class="nav-item"><a menu_admin="data_babak_final" class="menu_admin nav-link"><i data-feather="share-2"></i> <span>Data Babak Final</span></a></li>
                    <li class="nav-item"><a menu_admin="skema_babak_final" class="menu_admin nav-link"><span style="margin-left: 35px;">Skema Babak Final</span></a></li>

                    <li class="nav-label pt-3">Pertandingan Perorangan</li>
                    <li class="nav-item"><a menu_admin="data_perorangan_pool" class="menu_admin nav-link"><i data-feather="share-2"></i> <span>Data Pool</span></a></li>
                    <li class="nav-item"><a menu_admin="data_perorangan_penyisihan" class="menu_admin nav-link"><i data-feather="share-2"></i> <span>Data Babak Penyisihan</span></a></li>
                    <li class="nav-item"><a menu_admin="data_perorangan_gugur" class="menu_admin nav-link"><i data-feather="share-2"></i> <span>Data Sistem Gugur</span></a></li>
                <?php } ?>
                <?php if (IN_ARRAY($_SESSION['id_panitia'], array(2, 3))) { ?>

                    <li class="nav-item"><a menu_admin="data_pemain" class="menu_admin nav-link"><i data-feather="user"></i> <span>Data Pemain</span></a></li>
                    <li class="nav-item"><a menu_admin="data_pemain_veteran" class="menu_admin nav-link"><i data-feather="user"></i> <span>Data Pemain Veteran</span></a></li>
                    <li class="nav-item"><a menu_admin="data_pertandingan" class="menu_admin nav-link"><i data-feather="user"></i> <span>Data Pertandingan</span></a></li>
                <?php } ?>
                <!-- <?php if (IN_ARRAY($_SESSION['id_panitia'], array(0, 1, 2, 3))) { ?>
                    <li class="nav-label pt-3">Score</li>
                    <li class="nav-item"><a menu_admin="score_manage" class="menu_admin nav-link"><i data-feather="circle"></i> <span>Manage Score</span></a></li>
                    <li class="nav-item"><a menu_admin="score_share" class="menu_admin nav-link"><i data-feather="circle"></i> <span>Share Score</span></a></li>
                <?php } ?> -->
            </ul>
        </div>
    </aside>

    <div class="content ht-100v pd-0">
        <div class="content-header">
            <?php 
            UNSET($P);
            $P['from'] = "data_event AS A";
            $P['where'] = "A.id_event = '$_SESSION[id_event]'";
            // $P['die'] = true;
            $id_event = $this->Model_basic->select($P)->row_array()['id_event'];
            $event = $this->Model_basic->select($P)->row_array()['nama'];
            echo "<h4>Event Aktif > <b>$id_event: $event</b></h4>";
            ?>
            <nav class="nav mg-l-10">
                <a href="<?php echo base_url('') ?>" target="_blank" class="nav-link" data-toggle="tooltip" data-placement="left" title="Halaman Utama PTWP"><i data-feather="chrome" class="text-primary"></i></a>
            </nav>
        </div><!-- content-header -->

        <div class="content-body">
            <div id="konten" class="container-fluid pd-x-0">
                <?php echo $body; ?>
            </div>
        </div>

        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header pd-x-20 pd-sm-x-30 bg-primary">
                        <h5 class="modal_judul tx-white" id="modal_judul"> ................................ </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body modal_isi" id="modal_isi"> .................................. </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div>
                <span>&copy; 2021 PTWP-PUSAT.ORG </span>
                <!-- <span>Design by <a>ADIL</a></span> -->
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
<style>
    .menu_admin span {
        color: #c8c8c8;
        cursor: pointer;
    }
</style>
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
        // form_data.append('xxx', $('#xxx').val());
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