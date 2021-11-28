<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/favicon.png">

  <title><?php echo $judul; ?></title>

  <!-- vendor css -->
  <link href="<?php echo base_url(); ?>assets/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">

  <!-- DashForge CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dashforge.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dashforge.landing.css">

</head>

<body class="home-body">
  <header class="navbar navbar-header navbar-header-fixed bd-b">
    <a href="<?php echo base_url() ?>" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
    <div class="navbar-brand">
      <a href="<?php echo base_url() ?>" class="df-logo">PTWP<span>Pusat</span></a>
    </div><!-- navbar-brand -->
    <div id="navbarMenu" class="navbar-menu-wrapper">
      <div class="navbar-menu-header">
        <a href="<?php echo base_url() ?>" class="df-logo">PTWP<span>Pusat</span></a>
        <a id="mainMenuClose" href=""><i data-feather="x"></i></a>
      </div><!-- navbar-menu-header -->
      <ul class="nav navbar-menu">
        <li class="nav-label pd-l-15 pd-lg-l-25 d-lg-none">Main Menu</li>
        <li class="nav-item">
          <a href="<?php echo base_url() ?>" class="nav-link"><i data-feather="home"></i> Beranda</a>
        </li>
        <li class="nav-item with-sub">
          <a href="#" class="nav-link"><i data-feather="info"></i> Tentang</a>
          <ul class="navbar-menu-sub">
            <li class="nav-sub-item"><a href="template/classic/app-calendar.html" class="nav-sub-link"><i data-feather="calendar"></i>Calendar</a></li>
            <li class="nav-sub-item"><a href="template/classic/app-chat.html" class="nav-sub-link"><i data-feather="message-square"></i>Chat</a></li>
            <li class="nav-sub-item"><a href="template/classic/app-contacts.html" class="nav-sub-link"><i data-feather="users"></i>Contacts</a></li>
            <li class="nav-sub-item"><a href="template/classic/app-file-manager.html" class="nav-sub-link"><i data-feather="file-text"></i>File Manager</a></li>
            <li class="nav-sub-item"><a href="template/classic/app-mail.html" class="nav-sub-link"><i data-feather="mail"></i>Mail</a></li>
          </ul>
        </li>
        <li class="nav-item"><a href="<?php echo base_url('main/pertandingan'); ?>" class="nav-link"><i data-feather="users"></i> Pertandingan</a></li>
        <li class="nav-item"><a href="<?php echo base_url('main/pengurus'); ?>" class="nav-link"><i data-feather="users"></i> Pengurus</a></li>
        <li class="nav-item"><a href="<?php echo base_url('main/livescore'); ?>" class="nav-link"><i data-feather="clipboard"></i> Livescore</a></li>
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
  <script src="<?php echo base_url(); ?>assets/lib/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/feather-icons/feather.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>

  <script src="<?php echo base_url(); ?>assets/js/dashforge.js"></script>
  <script>
    $(function() {
      'use strict'
      $('.img-caption').on('mouseover mouseout', function() {
        $(this).find('figcaption').toggleClass('op-0');
      });

    });
  </script>
</body>

</html>