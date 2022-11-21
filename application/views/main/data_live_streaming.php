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


<div class="content bg-indigo mg-0">
    <div class="divider-text">
        <h4 class="text-white">Hasil Pertandingan (Data Dummy)</h4>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="text-uppercase">Live Score</h3>
            <a href="<?php echo base_url('main/data_babak_penyisihan'); ?>" class="btn btn-sm btn-outline-primary tx-bold">All Score</a>
        </div>
        <div class="card-body">
            <div class='row'>
                <?php
                    $result = $this->Model_main->get_data_where($_POST);
                    if (!$result->num_rows()) {
                        foreach ($result->result_array() as $R) {
                            ?>
                                <div class='col-lg-2'>
                                    Lapangan 
                                    xxx xxx xxx xxx
                                </div>
                                <div class='col-lg-2'>
                                    xxx xxx xxx xxx
                                </div>
                                <div class='col-lg-2'>
                                    xxx xxx xxx xxx
                                </div>
                                <div class='col-lg-2'>
                                    xxx xxx xxx xxx
                                </div>
                                <div class='col-lg-2'>
                                    xxx xxx xxx xxx
                                </div>
                                <div class='col-lg-2'>
                                    xxx xxx xxx xxx
                                </div>
                            <?php 
                        }
                    }
                ?>
            </div>
        </div>
    </div>
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