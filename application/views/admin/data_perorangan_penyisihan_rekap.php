<?php
UNSET($P);
$P['select'] = "X.*, 
    Y.kategori,
    IF(X.is_dharmayukti1_tim_A IS NULL, A1.nama_gelar, AK1.NamaAnggotaKeluarga) AS nama_pemain1_tim_A, 
    IF(X.is_dharmayukti2_tim_A IS NULL, A2.nama_gelar, AK2.NamaAnggotaKeluarga) AS nama_pemain2_tim_A,
    IF(X.is_dharmayukti1_tim_B IS NULL, B1.nama_gelar, BK1.NamaAnggotaKeluarga) AS nama_pemain1_tim_B, 
    IF(X.is_dharmayukti2_tim_B IS NULL, B2.nama_gelar, BK2.NamaAnggotaKeluarga) AS nama_pemain2_tim_B, 
";
$P['from'] = "data_perorangan_penyisihan AS X";
$P['join'][] = array("master_kategori_pemain AS Y", "X.id_kategori_pemain=Y.id_kategori", "LEFT");

$P['join'][] = array("data_pegawai_all AS A1", "X.id_pemain1_tim_A=A1.id_pegawai", "LEFT");
$P['join'][] = array("data_pegawai_all AS A2", "X.id_pemain2_tim_A=A2.id_pegawai", "LEFT");
$P['join'][] = array("tmst_keluarga AS AK1", "X.id_keluarga1_tim_A=AK1.IdAnggotaKeluarga", "LEFT");
$P['join'][] = array("tmst_keluarga AS AK2", "X.id_keluarga2_tim_A=AK2.IdAnggotaKeluarga", "LEFT");

$P['join'][] = array("data_pegawai_all AS B1", "X.id_pemain1_tim_B=B1.id_pegawai", "LEFT");
$P['join'][] = array("data_pegawai_all AS B2", "X.id_pemain2_tim_B=B2.id_pegawai", "LEFT");
$P['join'][] = array("tmst_keluarga AS BK1", "X.id_keluarga1_tim_B=BK1.IdAnggotaKeluarga", "LEFT");
$P['join'][] = array("tmst_keluarga AS BK2", "X.id_keluarga2_tim_B=BK2.IdAnggotaKeluarga", "LEFT");

$P['where'] = "X.id_event = '$_SESSION[id_event]' AND X.id_kategori_pemain = '$_POST[id_kategori_pemain]'";

// $P['echo'] = true;
$data = $this->Model_basic->select($P);
if(!$data->num_rows()) echo "<center>Belum Ada Data</center>";
else 
    {
        echo "<div class='table-responsive'>";
        echo "<table id='data-perorangan' class='table table-primary table-striped table-borderless table-hover'>
                <thead class='text-center align-middle'>
                    <tr>
                        <th>No.</th>
                        <th>Kategori</th>
                        <th>Pool</th>
                        <th>Urutan</th>
                        <th>Nama Pemain 1</th>
                        <th>Nama Pemain 2</th>
                    </tr>
                </thead>
                <tbody class='text-center'>";
        $no = 0;
        foreach($data->result_array() AS $R)
            {
                $no++;
                $nama_pemain_A = $R['nama_pemain1_tim_A'];
                if($R['nama_pemain2_tim_A'] != "") $nama_pemain_A .= "<br>".$R['nama_pemain2_tim_A'];
                $nama_pemain_B = $R['nama_pemain1_tim_B'];
                if($R['nama_pemain2_tim_B'] != "") $nama_pemain_B .= "<br>".$R['nama_pemain2_tim_B'];

                $idp = $R['id_pertandingan'];
                echo "
                        <tr>
                            <td>$no</td>
                            <td>$R[kategori]</td>
                            <td>$R[pool]</td>
                            <td>$R[urutan]</td>
                            <td>
                                $nama_pemain_A
                                <input type='number' maxlength=1 class='form-control text-center set_tim_A' id='tim_A_$idp' data-id_pertandingan='$idp' value='$R[set_tim_A]'>
                            </td>
                            <td>
                                $nama_pemain_B
                                <input type='number' maxlength=1 class='form-control text-center set_tim_B' id='tim_B_$idp' data-id_pertandingan='$idp' value='$R[set_tim_B]'>
                            </td>
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

    $(".set_tim_A,.set_tim_B").on('change', function() {
        var form_data = new FormData();
        var idp = $(this).data('id_pertandingan');
        form_data.append('id_pertandingan', idp);
        form_data.append('set_tim_A', $("#tim_A_"+idp).val());
        form_data.append('set_tim_B', $("#tim_B_"+idp).val());
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_perorangan_penyisihan_simpan",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(json) {
                if (json.status !== true) {
                    Swal.fire({
                        icon: 'error',
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
                        timer: 200
                    });
                } else {
                    // Swal.fire({
                    //     icon: 'success',
                    //     title: 'Simpan Data Berhasil',
                    //     showConfirmButton: false,
                    //     timer: 200
                    // });
                    // load_data();
                }
            }
        });
    });

    $('#data-perorangan').DataTable({
        ordering: false,
        paging:false,
        language: {
            searchPlaceholder: 'Pencarian...',
            sSearch: '',
            lengthMenu: '_MENU_ Berita/Halaman',
            // info: false
        }
    });
</script>
