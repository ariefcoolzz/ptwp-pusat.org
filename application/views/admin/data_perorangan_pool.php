<div class='card'>
<div class='card-header'>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Pool</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col">
            <select class="form-control" id='id_kategori_pemain'>
                <option></option>
                <?php 
                UNSET($P);
                $P['from'] = "master_kategori_pemain AS A";
                $P['where'] = "A.id_event = '$_SESSION[id_event]'";
                // $P['die'] = true;
                $data = $this->Model_basic->select($P);
                if($data->num_rows()) 
                    {
                        foreach($data->result_array() AS $R)   
                            {
                                echo "<option value='$R[id_kategori]'>$R[kategori]</option>";
                            }
                    }
                ?>
            </select>
        </div>
        <div class="col">
            <select class="form-control" id='pool'>
                <option></option>
                <?php 
                for($p=1;$p<=26;$p++)
                    {
                        echo "<option value='".pool($p)."'>Pool ".pool($p)."</option>";
                    }
                ?>
            </select>
        </div>   
        <div class="col">
            <select class="form-control" id='urutan'>
                <option></option>
                <?php 
                for($u=1;$u<=10;$u++)
                    {
                        echo "<option value='".$u."'>Urutan ".$u."</option>";
                    }
                ?>
            </select>
        </div>
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

    $("#id_kategori_pemain").on('change', function() {
        load_data();
    });

    function load_data() {
        var form_data = new FormData();
        form_data.append('id_kategori_pemain', $("#id_kategori_pemain").val());
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_perorangan_pool_rekap",
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
                    $("#konten_menu").fadeOut(300);
                    $("#konten_menu").html(json.konten_menu);
                    $("#konten_menu").fadeIn(300);
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