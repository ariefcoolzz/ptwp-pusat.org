<div class="row">
    <?php
    $tunggal_ganda = "";
    UNSET($P);
    $P['from'] = "master_kategori_pemain AS A";
    $P['where'] = "A.id_kategori = '$_POST[id_kategori_pemain]'";
    $data = $this->Model_basic->select($P);
    if($data->num_rows())
        {
            $tunggal_ganda = $data->row_array()['tunggal_ganda'];
        }

    $option = "";
    UNSET($P);
    $P['from'] = "data_pemain AS A";
    $P['join'][] = array("data_pegawai_all AS B", "A.id_pemain=B.id_pegawai", "LEFT");
    $P['where'] = "A.id_event = '$_SESSION[id_event]'";
    $data = $this->Model_basic->select($P);
    if($data->num_rows())
        {
            foreach($data->result_array() AS $R)
                {
                    $option .= "<option value='$R[id_pemain]'>$R[nama_gelar] | $R[nip] | $R[jabatan_lengkap] | $R[nama_satker]</option>";
                }
        }
    ?>
    <div class="col-5">
        <select class="form-control select2" id='id_pemain1_tim_A'>
            <option></option>
            <?php echo $option; ?>
        </select>
        <select class="form-control select2" id='id_pemain2_tim_A'>
            <option></option>
            <?php if($tunggal_ganda == "ganda")  echo $option; ?>
        </select>
    </div>
    <div class="col-5">
        <select class="form-control select2" id='id_pemain1_tim_B'>
            <option></option>
            <?php echo $option; ?>
        </select>
        
        <select class="form-control select2" id='id_pemain2_tim_B'>
            <option></option>
            <?php if($tunggal_ganda == "ganda")  echo $option; ?>
        </select>
    </div>
    <div class="col-2">
        <button class='btn bg-success w-100' id='simpan'>Simpan</button>
    </div>
</div>

<?php
UNSET($P);
$P['from'] = "data_babak_penyisihan AS A";
$P['where'] = "A.id_event = '$_SESSION[id_event]'";
$data = $this->Model_basic->select($P);
if(!$data->num_rows()) echo "<center>Belum Ada Data</center>";
else 
    {
        foreach($data->result_array() AS $R)
            {
                echo "<h1>POOL TIM REGU ...........</h1>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-primary table-striped table-borderless table-hover'>";
                echo "
                        <thead class='text-center align-middle'>
                        <tr>
                            <th>No.</th>
                            <th>Pool</th>
                            <th>Urutan</th>
                            <th>Nama Kontingen/Satker</th>
                        </tr>
                        </thead>
                        <tbody class='text-center'>
                    ";
            }
    }
?>
<script>
    $(".select2").select2();

    $("#simpan").on('click', function() {
        $("#simpan").html('<i class="fa fa-spinner fa-spin"></i> Sedang Memproses Data');
        var form_data = new FormData();
        form_data.append('id_kategori_pemain', "<?php echo $_POST['id_kategori_pemain']; ?>");
        form_data.append('pool', $("#pool").val());
        form_data.append('urutan', $("#urutan").val());
        form_data.append('id_pemain1_tim_A', $("#id_pemain1_tim_A").val());
        form_data.append('id_pemain2_tim_A', $("#id_pemain2_tim_A").val());
        form_data.append('id_pemain1_tim_B', $("#id_pemain1_tim_B").val());
        form_data.append('id_pemain2_tim_B', $("#id_pemain2_tim_B").val());
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_perorangan_pool_simpan",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(json) {
                if (json.status !== true) {
                    Swal.fire({
                        icon: 'success',
                        title: json.pesan,
                        showConfirmButton: false,
                        timer: 1000
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Simpan Data Berhasil',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    load_data();
                }
            }
        });
    });
</script>
