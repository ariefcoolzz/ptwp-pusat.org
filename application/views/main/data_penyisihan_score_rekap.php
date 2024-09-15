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

$P['where'] = "X.id_event = '$_SESSION[id_event]'";

// $P['echo'] = true;
$data = $this->Model_basic->select($P);
if(!$data->num_rows()) echo "<center>Belum Ada Data</center>";
else 
    {
        echo "<div class='container'>";
        echo "<div class='card mg-t-50'>";
        echo "<div class='card-body'>";
        echo "<div class='table-responsive'>";
        echo "<table id='data-penyisihan-score' class='table table-primary table-striped table-borderless table-hover'>
                <thead class='text-center align-middle'>
                    <tr>
                        <th>No.</th>
                        <th>Kategori</th>
                        <th>Pool</th>
                        <th>Urutan</th>
                        <th>Tim A</th>
                        <th>Tim B</th>
                    </tr>
                </thead>
                <tbody class='text-center'>";
        $no = 0;
        foreach($data->result_array() AS $R)
            {
                $no++;
                if($R['set_tim_A'] == 6 OR $R['set_tim_B'] == 6) $color_tr = "bg-warning"; else $color_tr = "";

                if($R['set_tim_A'] == 6) $color = 'text-success'; else $color = 'text-danger';
                if($R['set_tim_A'] == "") $color = "";
                $nama_pemain_A = "<div class='$color'>";
                $nama_pemain_A.= $R['nama_pemain1_tim_A'];
                if($R['nama_pemain2_tim_A'] != "") $nama_pemain_A .= "<br>".$R['nama_pemain2_tim_A'];
                $nama_pemain_A.= "<h1 class='$color'>$R[set_tim_A]</h1>";
                $nama_pemain_A.= "</div>";
                
                if($R['set_tim_B'] == 6) $color = 'text-success'; else $color = 'text-danger';
                if($R['set_tim_B'] == "") $color = "";
                $nama_pemain_B = "<div class='$color'>";
                $nama_pemain_B.= $R['nama_pemain1_tim_B'];
                if($R['nama_pemain2_tim_B'] != "") $nama_pemain_B .= "<br>".$R['nama_pemain2_tim_B'];
                $nama_pemain_B.= "<h1 class='$color'>$R[set_tim_B]</h1>";
                $nama_pemain_B.= "</div>";

                $idp = $R['id_pertandingan'];
                echo "
                        <tr class='$color_tr'>
                            <td>$no</td>
                            <td>$R[kategori]</td>
                            <td>$R[pool]</td>
                            <td>$R[urutan]</td>
                            <td>
                                $nama_pemain_A
                            </td>
                            <td>
                                $nama_pemain_B
                            </td>
                        </tr>
                    ";
            }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
?>
<script>
    $('#data-penyisihan-score').DataTable({
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