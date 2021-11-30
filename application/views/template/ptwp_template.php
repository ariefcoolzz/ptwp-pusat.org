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
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dashforge.landing.css">

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

</head>

<body class="home-body">
  <header class="navbar navbar-header navbar-header-fixed bd-b-0">
    <a href="<?php echo base_url('') ?>" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
    <div class="navbar-brand">
      <a href="<?php echo base_url('') ?>" class="df-logo">PTWP<span>Pusat</span></a>
    </div><!-- navbar-brand -->
    <div id="navbarMenu" class="navbar-menu-wrapper">
      <div class="navbar-menu-header">
        <a href="<?php echo base_url('') ?>" class="df-logo">PTWP<span>Pusat</span></a>
        <a id="mainMenuClose" href=""><i data-feather="x"></i></a>
      </div><!-- navbar-menu-header -->
      <ul class="nav navbar-menu">
        <li class="nav-label pd-l-15 pd-lg-l-25 d-lg-none">Main Menu</li>
        <li class="nav-item">
          <a href="<?php echo base_url() ?>" class="nav-link"><i data-feather="home"></i> Beranda</a>
        </li>
        <li class="nav-item with-sub">
          <a href="" class="nav-link"><i data-feather="info"></i> Profil</a>
          <div class="navbar-menu-sub">
            <div class="d-lg-flex">
              <ul>
                <li class="nav-label">Sejarah</li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/sejarah') ?>" class="nav-sub-link"><i data-feather="book"></i> Sejarah</a></li>
                <li class="nav-label mg-t-20">AD/ART Organisasi</li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/anggaran_dasar') ?>" class="nav-sub-link"><i data-feather="dollar-sign"></i> Anggaran Dasar(AD)</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/anggaran_rumah_tangga') ?>" class="nav-sub-link"><i data-feather="dollar-sign"></i> Anggaran Rumah Tangga(ART)</a></li>
                <li class="nav-label mg-t-20">Kongres PTWP</li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="check-circle"></i> SK Panitia Kongres PTWP</a></li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="check-circle"></i> Jadwal & Tempat</a></li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="check-circle"></i> Peserta Kongres</a></li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="check-circle"></i> Tata Tertib Kongres</a></li>
              </ul>
              <ul>
                <li class="nav-label">Pengurus Pusat</li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="check-square"></i> Struktur Organisasi</a></li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="check-square"></i> Profil Pengurus</a></li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="check-square"></i> Program Kerja</a></li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="check-square"></i> Galeri Kegiatan</a></li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="check-square"></i> Daftar Anggota</a></li>
                <li class="nav-label mg-t-20">Pengurus Daerah</li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="check-square"></i> Struktur Organisasi</a></li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="check-square"></i> Profil Pengurus</a></li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="check-square"></i> Program Kerja</a></li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="check-square"></i> Galeri Kegiatan</a></li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="check-square"></i> Daftar Anggota</a></li>
              </ul>
              <ul>
                <li class="nav-label">Gallery Kegiatan</li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="camera"></i> Galeri Kongres PTWP</a></li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="camera"></i> Galeri Pembukaan PTWP</a></li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="camera"></i> Galeri Penutupan PTWP</a></li>
                <li class="nav-label mg-t-20">Hymne PTWP</li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="heart"></i> Hymne PTWP</a></li>
              </ul>
            </div>
          </div><!-- nav-sub -->
        </li>
        <li class="nav-item with-sub">
          <a href="#" class="nav-link"><i data-feather="users"></i> Pertandingan</a>
          <div class="navbar-menu-sub">
            <div class="d-lg-flex">
              <ul>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="check-circle"></i> Technical Meeting</a></li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="check-circle"></i> Rundown Pertandingan</a></li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="check-circle"></i> Tempat & Jadwal</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/data_pemain'); ?>" class="nav-sub-link"><i data-feather="check-circle"></i> Daftar Pemain</a></li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="check-circle"></i> Daftar Wasit</a></li>
                <li class="nav-label mg-t-20">Pertandingan</li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/data_pertandingan'); ?>" class="nav-sub-link"><i data-feather="check-circle"></i> Babak Penyisihan</a></li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="check-circle"></i> Pertandingan Perdelapan Final</a></li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="check-circle"></i> Pertandingan Perempat Final</a></li>
                <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="check-circle"></i> Pertandingan Final</a></li>
              </ul>
            </div>
          </div><!-- nav-sub -->
        </li>
        <li class="nav-item"><a href="#" class="nav-link"><i data-feather="rss"></i> Berita Kegiatan</a></li>
        <li class="nav-item"><a href="#" class="nav-link"><i data-feather="video"></i> Live Streaming</a></li>
        <li class="nav-item"><a href="<?php echo base_url('main/kontak') ?>" class="nav-link"><i data-feather="phone-call"></i> Kontak</a></li>
      </ul>
    </div><!-- navbar-menu-wrapper -->
    <div class="navbar-right">
      <a href="#" class="btn btn-social"><i class="fab fa-youtube"></i></a>
      <a href="#" class="btn btn-social"><i class="fab fa-instagram"></i></a>
      <a href="#" class="btn btn-social"><i class="fab fa-facebook"></i></a>
    </div><!-- navbar-right -->
  </header><!-- navbar -->

  <?php echo $body; ?>

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

    $(function() {
      'use strict'
      $('.img-caption').on('mouseover mouseout', function() {
        $(this).find('figcaption').toggleClass('op-0');
      });
    });
  </script>
</body>

</html>