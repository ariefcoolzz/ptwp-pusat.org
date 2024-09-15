<?php
die("belum selesai");
$id_event = $this->Model_basic->get_event_aktif();
UNSET($P);
// $P['select'] = "";
$P['select'] = "X.*, A.id_tim,A.nama_pemain AS nama_pemain_tim_A, B.nama_pemain AS nama_pemain_tim_B";
$P['from'] = "data_perorangan_penyisihan AS X";
$P['join'][] = array("view_tim AS A", "A.id_tim=X.id_tim_A", "LEFT");
$P['join'][] = array("view_tim AS B", "B.id_tim=X.id_tim_B", "LEFT");
$P['where'] = array("A.id_event" => $_SESSION['id_event']); 
$P['order_by'] = "A.id_kategori_pemain ASC, A.pool ASC, A.urutan ASC";
$data = $this->Model_basic->select($P);
if($data->num_rows()) {
    foreach ($data->result_array() as $R) { 
        $pool = $R['pool']; 
        $idtA = $R['id_pemain1_tim_A']; 
        $idtB = $R['id_pemain1_tim_B']; 
        $C[$pool][$idtA][$idtB]['A'] = $R['set_tim_A'];
        $C[$pool][$idtA][$idtB]['B'] = $R['set_tim_B'];
    }
}

UNSET($P);
$P['select'] = "X.*, A.nama_pemain,";
$P['from'] = "data_perorangan_pool AS X";
$P['join'][] = array("view_tim AS A", "A.id_tim=X.id_tim", "LEFT");
$P['where'] = "X.id_event = '$id_event' AND X.id_kategori_pemain = '$_POST[id_kategori_pemain]'";
$P['group_by'] = "X.pool";
$P['order_by'] = "X.pool ASC";
// $P['die'] = true;
$data = $this->Model_basic->select($P);
if(!$data->num_rows()) echo "Belum Ada Data";
else  
{
    foreach ($data->result_array() as $R) { 
        $no = 0;
        UNSET($P);
            $P['select'] = "X.*, CONCAT(A1.nama_gelar,'<br>',AK1.NamaAnggotaKeluarga,IFNULL(A2.nama_gelar,''),'<br>',IFNULL(AK2.NamaAnggotaKeluarga,'')) AS data_pemain";
            $P['from'] = "data_perorangan_pool AS X";
            
            $P['where'] = "X.id_event = '$R[id_event]' AND X.id_kategori_pemain = '$R[id_kategori_pemain]' AND X.pool='$R[pool]'";
            $P['group_by'] = "X.pool";
            $P['order_by'] = "X.pool ASC";
            $dataD = $this->Model_basic->select($P);
            if($dataD->num_rows()) 
                {
                    echo "<div class='mb-3'>";
                    echo "<h4 class='text-center mt-2'>POOL ".$R['pool']."</h4>";
                        
                    echo "<table id='table' class='table table-primary table-bordered table-hover'>";
                    echo "
                            <thead>
                                <tr>
                                    <th>Pool</th>
                                    <th>Urutan</th>
                                    <th>Pemain</th>
                                    ";
                    foreach ($dataD->result_array() as $H) {
                        echo "<th>$H[data_pemain]</th>";
                    }
                    echo "
                                    <th>Score</th>
                                    <th>Persentase</th>
                                    <th>Peringkat</th>
                            </tr>
                            </thead>
                            <tbody>
                        ";

            
                foreach ($dataD->result_array() as $D) { 
                    EXTRACT($D);
                    echo "
                            <tr>
                                <td>$pool</td>
                                <td>$urutan</td>
                                <td>$data_pemain</td>";
                    echo "";
                    echo " 
                            </tr>
                    ";
                }
        }
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    echo "<hr>";

}