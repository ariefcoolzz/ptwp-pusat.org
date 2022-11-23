<div class="d-sm-flex align-items-center justify-content-between">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Skema</li>
            </ol>
        </nav>
        <div class="row">
            <div class="form-group ml-4">
                <select class="form-control" id='beregu'>
                    <option value='putra' selected>Putra</option>
                    <option value='putri'>Putri</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div id="konten_menu"></div>
    </div>
</div>

<script>
    load_data();

    $("#beregu").on('change', function() {
        load_data();
    });

    function load_data() {
        var form_data = new FormData();
        // form_data.append('id_panitia', $("#id_panitia").val());
        form_data.append('id_event', $("#list_event").val());
        form_data.append('beregu', $("#beregu").val());
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_skema_rekap",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(json) {
                if (json.status !== true) {
                    alert("");
                    skip();
                } else {
                    $("#konten_menu").fadeOut(300);
                    $("#konten_menu").html(json.konten_menu);
                    $("#konten_menu").fadeIn(300);
                }
            }
        });
    }
</script>