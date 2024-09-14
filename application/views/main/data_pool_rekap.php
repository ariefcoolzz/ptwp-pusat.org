<?php
$_SESSION['id_event'] = $this->Model_basic->get_event_aktif();
UNSET($P);
// $P['select'] = "";
$P['from'] = "data_perorangan_pool AS A";
$P['where'] = "A.id_event = '$_SESSION[id_event]' AND A.id_kategori_pemain = '$_POST[id_kategori_pemain]'";
$P['group_by'] = "A.pool";
$P['order_by'] = "A.pool ASC";
// $P['die'] = true;
$data = $this->Model_basic->select($P);
if(!$data->num_rows()) echo "Belum Ada Data";
else  
{
    foreach ($data->result_array() as $R) { 
    $no = 0;
    echo "<div class='badge'>";
    echo "<h4 class='text-center mt-2'>POOL ".$R['pool']."</h4>";
    echo "<table id='table' class='table table-primary table-bordered table-hover'>";
    echo "
            <thead>
                <tr>
                    <th>Pool</th>
                    <th>Urutan</th>
                    <th>Pemain</th>
                    <th>Satker</th>
                </tr>
            </thead>
            <tbody>
        ";
        
    UNSET($P);
    // $P['select'] = "";
    $P['select'] = "A.*, CONCAT(B.nama_gelar,'<br>',IFNULL(C.nama_gelar,'')) AS data_pemain, CONCAT(B.nama_satker,'<br>',IFNULL(C.nama_satker,'')) AS satker_pemain";
    $P['from'] = "data_perorangan_pool AS A";
    $P['join'][] = array("data_pegawai_all AS B", "A.id_pemain1=B.id_pegawai", "LEFT");
    $P['join'][] = array("data_pegawai_all AS C", "A.id_pemain2=C.id_pegawai", "LEFT");
    $P['where'] = "A.id_event = '$_SESSION[id_event]' AND A.id_kategori_pemain = '$_POST[id_kategori_pemain]' AND A.pool = '$R[pool]'";
    $P['order_by'] = "A.urutan ASC";
    // $P['die'] = true;
    $dataD = $this->Model_basic->select($P);
    if($dataD->num_rows()) {
        foreach ($dataD->result_array() as $D) { 
            EXTRACT($D);
            echo "
                    <tr>
                        <td>$pool</td>
                        <td>$urutan</td>
                        <td>$data_pemain</td>
                        <td>$satker_pemain</td>
                    </tr>
            ";
        }
    }

    // foreach ($data->result_array() as $R) { 
    //     echo "
    //             <tr>
    //                 <td>$R[pool]</td>
    //                 <td>$R[urutan]</td>
    //                 <td>$R[nama_pemain]</td>
    //             </tr>
    //     ";
    // }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
}
}