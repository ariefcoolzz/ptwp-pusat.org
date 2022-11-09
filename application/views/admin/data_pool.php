<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Pool</li>
            </ol>
        </nav>
        <div class="row">
            <div class="form-group ml-4">
                <a href="javascript:void(0)" id='tambah' class="btn-tambah btn btn-primary"><i class="fa fa-plus-circle"></i> Data Pool</a>
                <a href="javascript:void(0)" id='drawing' class="btn-drawing btn btn-danger"><i class="fa fa-plus-circle"></i> Drawing</a>
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div data-label="Example" class="df-example demo-table" id="konten_menu">

                </div><!-- df-example -->
            </div>
        </div>
    </div>
</div>
<script>
    load_data();
    $(".filter").on('change', function() {
        load_data();
    });

    function load_data() {
        var form_data = new FormData();
        // form_data.append('id_panitia', $("#id_panitia").val());
        // form_data.append('aktif', $("#is_aktif").val());
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_pool_rekap",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(json) {
                if (json.status !== true) {
                    alert();
                    skip();
                } else {
                    $("#konten_menu").html(json.konten_menu);
                }
            }
        });
    }

    $("#drawing").on('click', function() {
        //loader
        
        $(".title_loader").text("Sedang Memuat Halaman");
        $("#konten_menu").html($("#loader_html").html());
        // $('.nav-item.active').removeClass('active');
        // $(this).closest('li.nav-item').addClass('active');
        //loader
        // skip();
        var form_data = new FormData();
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_drawing",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(json) {
                if (json.status !== true) {
                    location.reload();
                } else {
                    $("body").scrollTop('0px');
                    $("#konten_menu").html(json.konten_menu);

                }
            }
        });
    });
</script>