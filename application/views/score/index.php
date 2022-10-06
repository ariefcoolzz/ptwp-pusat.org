<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- <script src="<?php echo base_url(); ?>assets/lib/jquery/jquery.min.js"></script> -->

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/favicon.png">

    <title>SCORE PERTANDINGAN PTWP</title>
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
    <div id='konten'>
        <?php $this->load->view("score/score_rekap"); ?>
    </div>
</body>

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

<script>
    // $('#datatable').DataTable({
    // responsive: true,
    // language: {
    // searchPlaceholder: 'Pencarian...',
    // sSearch: '',
    // lengthMenu: '_MENU_ Jenis/Halaman',
    // }
    // });



    // $('[data-toggle="tooltip"]').tooltip();
</script>