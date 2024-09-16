<div  class='mg-t-100'>
<?php
$id_event = $this->Model_basic->get_event_aktif();

UNSET($P);
$P['from'] = "master_kategori_pemain AS X";
$P['where'] = "X.id_event = '$id_event'";
$data = $this->Model_basic->select($P);
if($data->num_rows()) 
    {
        foreach($data->result_array() AS $K)
{
    echo "<center><h1>$K[kategori]</h1></center>";
UNSET($P);
$P['select'] = "X.*, 
    Y.kategori,
    A.nama_pemain AS nama_pemain_tim_A, 
    B.nama_pemain AS nama_pemain_tim_B
";
$P['from'] = "data_perorangan_gugur AS X";
$P['join'][] = array("master_kategori_pemain AS Y", "X.id_kategori_pemain=Y.id_kategori", "LEFT");
$P['join'][] = array("view_tim AS A", "A.id_tim=X.id_tim_A", "LEFT");
$P['join'][] = array("view_tim AS B", "B.id_tim=X.id_tim_B", "LEFT");

$P['where'] = "X.id_event = '$id_event' AND X.id_kategori_pemain = '$K[id_kategori]'";

// $P['echo'] = true;
$data = $this->Model_basic->select($P);
if($data->num_rows())
    {
        foreach($data->result_array() AS $R){
            EXTRACT($R);
            $C[$per][$urutan] = $R['nama_pemain_tim_A'] . " <span class='badge bg-primary'><h4>$set_tim_A</h4></span><br> VS <br>" . $R['nama_pemain_tim_B']. " <span class='badge bg-primary'><h4>$set_tim_B</h4></span>";
        }
    }
?>
<?php $urutan = 8; ?>
<div class='container'>
    <div class='card'>
    <div class='card-body'>
    <table border='1' width='100%'>
        <?php 
        for($v=1;$v<=$urutan;$v++)
            {
                if(!ISSET($C[8][$v])) $C[8][$v] = ""; 
                if(!ISSET($C[4][$v])) $C[4][$v] = ""; 
                if(!ISSET($C[2][$v])) $C[2][$v] = ""; 
                if(!ISSET($C[1][$v])) $C[1][$v] = ""; 

                echo "<tr align='center'>";
                echo "<td width=25%><h4>".$C[8][$v]."</h4></td>";
                if($v % 2 == 1) echo "<td width=25% rowspan='2'><h4>".$C[4][$v]."</h4></td>";
                if($v % 4 == 1) echo "<td width=25% rowspan='4'><h4>".$C[2][$v]."</h4></td>";
                if($v % 8 == 1) echo "<td width=25% rowspan='8'><h4>".$C[1][$v]."</h4></td>";
                echo "</tr>";
            }
        UNSET($C);
        ?>
    </table>
    </div>
    </div>
</div>
<br>
<br>
<br>
<?php } } ?>

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