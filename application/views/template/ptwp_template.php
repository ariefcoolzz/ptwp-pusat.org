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
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
  <link href="<?php echo base_url(); ?>assets/lib/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/lib/select2/css/select2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.css" rel="stylesheet" type="text/css">

  <!-- DashForge CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dashforge.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skin.gradient1.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dashforge.dashboard.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dashforge.landing.css">
  <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skin.cool.css"> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link href="<?php echo base_url(); ?>assets/css/aos.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" /> -->

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
  <!-- <script src="https://unpkg.com/aos@next/dist/aos.js"></script> -->
  <script src="<?php echo base_url(); ?>assets/js/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>

</head>

<body class="page-profile">
  <header class="navbar navbar-header navbar-header-fixed">
    <a href="<?php echo base_url('') ?>" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
    <div class="navbar-brand">
      <a href="<?php echo base_url('') ?>" class="df-logo"><img class="ht-35 w-35" src="<?php echo base_url('assets/img/favicon.png'); ?>"> PTWP</a>
    </div><!-- navbar-brand -->
    <div id="navbarMenu" class="navbar-menu-wrapper">
      <div class="navbar-menu-header">
        <a href="<?php echo base_url('') ?>" class="df-logo"><img class="ht-35 w-35" src="<?php echo base_url('assets/img/favicon.png'); ?>"> PTWP</a>
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
                <!-- <li class="nav-label mg-t-20">Gallery Kegiatan</li>
                <li class="nav-sub-item"><a href="<?php echo base_url('#') ?>" class="nav-sub-link"><i data-feather="camera"></i> Galeri Kongres PTWP</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('#') ?>" class="nav-sub-link"><i data-feather="camera"></i> Galeri Pembukaan PTWP</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('#') ?>" class="nav-sub-link"><i data-feather="camera"></i> Galeri Penutupan PTWP</a></li> -->
                <li class="nav-label mg-t-20">Hymne PTWP</li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/hymne_ptwp') ?>" class="nav-sub-link"><i data-feather="heart"></i> Hymne PTWP</a></li>
                <li class="nav-label mg-t-20">Keuangan</li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/surat_pemberitahuan_virtual_account_ptwp') ?>" class="nav-sub-link"><i data-feather="dollar-sign"></i> Virtual Akun</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/laporan_keuangan') ?>" class="nav-sub-link"><i data-feather="dollar-sign"></i> Laporan Keuangan</a></li>
              </ul>
              <ul>
                <li class="nav-label">Pengurus Pusat</li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/struktur_organisasi') ?>" class="nav-sub-link"><i data-feather="check-square"></i> Struktur Organisasi</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/profil_pengurus') ?>" class="nav-sub-link"><i data-feather="check-square"></i> Profil Pengurus</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/program_kerja') ?>" class="nav-sub-link"><i data-feather="check-square"></i> Program Kerja</a></li>
                <!-- <li class="nav-sub-item"><a href="<?php echo base_url('main/page/galeri_kegiatan') ?>" class="nav-sub-link"><i data-feather="check-square"></i> Galeri Kegiatan</a></li> -->
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/daftar_anggota') ?>" class="nav-sub-link"><i data-feather="check-square"></i> Daftar Anggota</a></li>
                <li class="nav-label mg-t-20">Pengurus Daerah</li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/struktur_organisasi_daerah') ?>" class="nav-sub-link"><i data-feather="check-square"></i> Struktur Organisasi</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/profil_pengurus_daerah') ?>" class="nav-sub-link"><i data-feather="check-square"></i> Profil Pengurus</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/program_kerja_daerah') ?>" class="nav-sub-link"><i data-feather="check-square"></i> Program Kerja</a></li>
                <!-- <li class="nav-sub-item"><a href="<?php echo base_url('main/page/galeri_kegiatan_daerah') ?>" class="nav-sub-link"><i data-feather="check-square"></i> Galeri Kegiatan</a></li> -->
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/daftar_anggota_daerah') ?>" class="nav-sub-link"><i data-feather="check-square"></i> Daftar Anggota</a></li>
              </ul>
            </div>
          </div><!-- nav-sub -->
        </li>
        <li class="nav-item with-sub">
          <a href="#" class="nav-link"><i data-feather="users"></i> Pertandingan</a>
          <div class="navbar-menu-sub">
            <div class="d-lg-flex">
              <ul>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/technical_meeting'); ?>" class="nav-sub-link"><i data-feather="check-circle"></i> Technical Meeting</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/rundown_pertandingan'); ?>" class="nav-sub-link"><i data-feather="check-circle"></i> Rundown Pertandingan</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/simtem_undian_IX'); ?>" class="nav-sub-link"><i data-feather="check-circle"></i> Simtem Undian</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/tempat_jadwal'); ?>" class="nav-sub-link"" class=" nav-sub-link"><i data-feather="check-circle"></i> Tempat & Jadwal</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/data_pemain'); ?>" class="nav-sub-link"><i data-feather="check-circle"></i> Daftar Pemain</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/data_wasit_piala_kma_tahun_2022'); ?>" class="nav-sub-link"><i data-feather="check-circle"></i> Daftar Wasit</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/daftar_lapangan'); ?>" class="nav-sub-link"" class=" nav-sub-link"><i data-feather="check-circle"></i> Daftar Lapangan</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/akomodasi_semarang'); ?>" class="nav-sub-link"" class=" nav-sub-link"><i data-feather="check-circle"></i> Akomodasi</a></li>
                <li class="nav-label mg-t-20">Pertandingan</li>
                <?php /* <li class="nav-sub-item"><a href="<?php echo base_url('main/data_pertandingan'); ?>" class="nav-sub-link"><i data-feather="check-circle"></i> Data Pertandingan</a></li> */ ?>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/pedoman_pertandingan_xii'); ?>" class="nav-sub-link"><i data-feather="check-circle"></i> Pedoman Pertandingan</a></li>
                <!--<li class="nav-sub-item"><a href="<?php echo base_url('main/data_jadwal_pertandingan'); ?>" class="nav-sub-link"><i data-feather="check-circle"></i> Jadwal Pertandingan</a></li>-->
                <li class="nav-sub-item"><a href="<?php echo base_url('main/data_penyisihan_file'); ?>" class="nav-sub-link"><i data-feather="check-circle"></i> Data Babak Penyisihan</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/data_babak_penyisihan'); ?>" class="nav-sub-link"><i data-feather="check-circle"></i> Babak Penyisihan</a></li>
                <!--<li class="nav-sub-item"><a href="<?php echo base_url('main/data_skema_pertandingan'); ?>" class="nav-sub-link"><i data-feather="check-circle"></i> Skema Pertandingan</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/data_babak_final/8'); ?>" class="nav-sub-link"><i data-feather="check-circle"></i> Babak Perdelapan Final</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/data_babak_final/4'); ?>" class="nav-sub-link"><i data-feather="check-circle"></i> Babak Perempat Final</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/data_babak_final/2'); ?>" class="nav-sub-link"><i data-feather="check-circle"></i> Babak Semi Final</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/data_babak_final/1'); ?>" class="nav-sub-link"><i data-feather="check-circle"></i> Babak Final</a></li>-->
              </ul>
            </div>
          </div><!-- nav-sub -->
        </li>
        <li class="nav-item with-sub">
          <a href="#" class="nav-link"><i data-feather="users"></i> Kongres</a>
          <div class="navbar-menu-sub">
            <div class="d-lg-flex">
              <ul>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/sk_panitia_kongres_ptwp') ?>" class="nav-sub-link"><i data-feather="check-circle"></i> SK Panitia Kongres PTWP</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/jadwal_tempat_kongres_ptwp') ?>" class="nav-sub-link"><i data-feather="check-circle"></i> Jadwal & Tempat</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/peserta_kongres') ?>" class="nav-sub-link"><i data-feather="check-circle"></i> Peserta Kongres</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/tata_tertib_kongres') ?>" class="nav-sub-link"><i data-feather="check-circle"></i> Tata Tertib Kongres</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/page/buku_panduan_kongres') ?>" class="nav-sub-link"><i data-feather="check-circle"></i> Buku Panduan Kongres</a></li>
              </ul>
            </div>
          </div><!-- nav-sub -->
        </li>
        <li class="nav-item with-sub">
          <a href="#" class="nav-link"><i data-feather="rss"></i> Berita</a>
          <div class="navbar-menu-sub">
            <div class="d-lg-flex">
              <ul>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/berita_ptwp_pusat') ?>" class="nav-sub-link"><i data-feather="rss"></i>Berita PTWP Pusat</a></li>
                <li class="nav-sub-item"><a href="<?php echo base_url('main/berita_ptwp_daerah') ?>" class="nav-sub-link"><i data-feather="rss"></i> Berita PTWP Daerah</a></li>
              </ul>
            </div>
          </div><!-- nav-sub -->
        </li>
        <li class="nav-item"><a href="<?php echo base_url('main/page/galeri') ?>" class="nav-link"><i data-feather="image"></i> Galeri</a></li>
        <li class="nav-item"><a href="<?php echo base_url('main/page/kontak') ?>" class="nav-link"><i data-feather="phone-call"></i> Kontak</a></li>
      </ul>
    </div><!-- navbar-menu-wrapper -->
    <div class="navbar-right">
      <a href="https://www.youtube.com/channel/UCucjQaYC0Sf60-paJeEPA7Q" target="_blank" class="btn btn-social"><i class="fab fa-youtube"></i></a>
      <a href="https://www.instagram.com/ptwp.pusat/" target="_blank" class="btn btn-social"><i class="fab fa-instagram"></i></a>
      <!-- <a href="#" class="btn btn-social"><i class="fab fa-facebook"></i></a> -->
    </div><!-- navbar-right -->
  </header><!-- navbar -->

  <?php echo $body; ?>


  <a href="https://api.whatsapp.com/send?phone=6281281419338&amp;text=Halo%20Admin,%20saya%20mau%20tanya%20tentang%20PTWP%20Pusat" class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
  </a>
  <footer class="footer">
    <div>
      <span>&copy; 2021 PTWP-PUSAT.ORG </span>
      <!-- <span>Design By <a href="#">TIM GERCEP GANIS</a></span> -->
    </div>
    <div>
      <nav class="nav">
        <li><span>Telepon:</span> (021) 3843348 - 3843459 - 3845793 - 3457624 <span>Pesawat:</span> 324 |
          <span>Email:</span> ptwp.pusat2021@gmail.com
        </li>
      </nav>
    </div>
  </footer>


  <div class="modal fade" id="popup_streaming" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-body pd-20 pd-sm-40">
          <a href="" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </a>
          <div class="tx-center">
            <h4 id="judul_popup_streaming">...:JUDUL:...</h4>
            <div class="modal-body" id="isi_popup_streaming">
              ............................................
            </div>
          </div>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->


  <script>
    $(".close,.fade").on("click", function() {
      $("#judul_popup_streaming").html("");
      $("#isi_popup_streaming").html("");
    });

    AOS.init();

    $('[data-toggle="tooltip"]').tooltip();
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

  <!--Start of Tawk.to Script-->
  <script type="text/javascript">
    var Tawk_API = Tawk_API || {},
      Tawk_LoadStart = new Date();
    (function() {
      var s1 = document.createElement("script"),
        s0 = document.getElementsByTagName("script")[0];
      s1.async = true;
      s1.src = 'https://embed.tawk.to/619f25886bb0760a4944472c/1flaql84v';
      s1.charset = 'UTF-8';
      s1.setAttribute('crossorigin', '*');
      s0.parentNode.insertBefore(s1, s0);
    })();
  </script>
  <!--End of Tawk.to Script-->

</body>

</html>