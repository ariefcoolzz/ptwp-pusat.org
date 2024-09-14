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
    $P['join'][] = array("tmst_keluarga AS K", "A.id_keluarga=K.IdAnggotaKeluarga", "LEFT");
    $P['where'] = "A.id_event = '$_SESSION[id_event]'";
    $data = $this->Model_basic->select($P);
    if($data->num_rows())
        {
            foreach($data->result_array() AS $R)
                {
                    $dharmayukti = "";
                    if($R['is_dharmayukti'] != "") $dharmayukti = " | ".$R['NamaAnggotaKeluarga'];
                    $option .= "<option value='$R[id_pemain]'>$R[nama_gelar] | $R[nip] | $R[jabatan_lengkap] | $R[nama_satker] | $R[nama_satker_parent] $dharmayukti</option>";
                }
        }
    ?>
    <div class="col-10">
        <select class="form-control select2" id='id_pemain1'>
            <option></option>
            <?php echo $option; ?>
        </select>
        <select class="form-control select2" id='id_pemain2'>
            <option></option>
            <?php if($tunggal_ganda == "ganda")  echo $option; ?>
        </select>
    </div>
    <?php /* 
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
    */ ?>
    <div class="col-2">
        <button class='btn bg-success w-100' id='simpan'>Simpan</button>
    </div>
</div>

<?php
UNSET($P);
$P['select'] = "A.*, B.nama_gelar AS nama_pemain1, C.nama_gelar AS nama_pemain2";
$P['from'] = "data_perorangan_pool AS A";
$P['join'][] = array("data_pegawai_all AS B", "A.id_pemain1=B.id_pegawai", "LEFT");
$P['join'][] = array("data_pegawai_all AS C", "A.id_pemain2=C.id_pegawai", "LEFT");
$P['where'] = "A.id_event = '$_SESSION[id_event]' AND A.id_kategori_pemain = '$_POST[id_kategori_pemain]'";

// $P['echo'] = true;
$data = $this->Model_basic->select($P);
if(!$data->num_rows()) echo "<center>Belum Ada Data</center>";
else 
    {
        echo "<div class='table-responsive'>";
        echo "<table class='table table-primary table-striped table-borderless table-hover'>
                <thead class='text-center align-middle'>
                    <tr>
                        <th>No.</th>
                        <th>Pool</th>
                        <th>Urutan</th>
                        <th>Nama Pemain 1</th>
                        <th>Nama Pemain 2</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class='text-center'>";
        $no = 0;
        foreach($data->result_array() AS $R)
            {
                $no++;
                echo "
                        <tr>
                            <td>$no</td>
                            <td>$R[pool]</td>
                            <td>$R[urutan]</td>
                            <td>$R[nama_pemain1]</td>
                            <td>$R[nama_pemain2]</td>
                            <td><button class='hapus btn bg-danger' 
                                data-id_kategori_pemain='$R[id_kategori_pemain]'  
                                data-pool='$R[pool]'
                                data-urutan='$R[urutan]'
                            >Hapus</td>
                        </tr>
                    ";
            }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
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
        form_data.append('id_pemain1', $("#id_pemain1").val());
        form_data.append('id_pemain2', $("#id_pemain2").val());
        // form_data.append('id_pemain1_tim_B', $("#id_pemain1_tim_B").val());
        // form_data.append('id_pemain2_tim_B', $("#id_pemain2_tim_B").val());
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

    $(".hapus").on('click', function() {
        var form_data = new FormData();
        form_data.append('id_kategori_pemain', "<?php echo $_POST['id_kategori_pemain']; ?>");
        form_data.append('pool', $(this).data('pool'));
        form_data.append('urutan', $(this).data('urutan'));
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_perorangan_pool_hapus",
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
