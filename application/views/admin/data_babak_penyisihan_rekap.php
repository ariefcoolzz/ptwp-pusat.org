<?php 
    $result = $this->Model_admin->model_data_babak_penyisihan_rekap($_POST);
    IF(!$result->num_rows()){
        echo "<h2 class='text-danger'>Maaf... Belum Ada Data Pertandingan</h2>";
    }else{
        $no=0;
        echo "<table border='1' width='100%'>";
        echo "
                <tr>
                    <th>No.</th>
                    <th> Beregu </th>
                    <th> Pool </th>
                    <th> Urutan </th>
                    <th> Kategori </th>
                    <th> Kontingen Tim A </th>
                    <th> Kontingen Tim B </th>
                    <th> Tanggal </th>
                    <th> Waktu </th>
                    <th> Lapangan </th>
                    <th> Nama Tim A </th>
                    <th> Nama Tim B </th>
                    <th> Score </th>
                    <th> Action </th>
                </tr>
            ";
        foreach($result->result_array() as $R){
            $no++;
            echo '<tr>';
            echo '<td>'.$no.'</td>';
            echo '<td>'.$R['beregu'].'</td>';
            echo '<td>'.$R['pool'].'</td>';
            echo '<td>'.$R['urutan'].'</td>';
            echo '<td>'.$R['kategori'].'</td>';
            echo '<td>'.$R['kontingen_tim_A'].'</td>';
            echo '<td>'.$R['kontingen_tim_B'].'</td>';
            echo '<td>'.$R['tanggal'].'</td>';
            echo '<td>'.$R['waktu'].'</td>';
            echo '<td>'.$R['lapangan'].'</td>';
            echo '<td>'.$R['nama_tim_A'].'</td>';
            echo '<td>'.$R['nama_tim_B'].'</td>';
            echo '<td>abc abc</td>';
            echo "<td>
                    <span class='btn btn-warning edit' data-id_pertandingan='$R[id_pertandingan]'>Edit</span>
                </td>";

            // echo '<td class="text-center"><a href="#" onClick="tambah_pool(' . $R['id_tim_A'] . ',' . $R['id_tim_B'] . ')" class="btn-tambah btn btn-xs btn-outline-success btn-rounded" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a>
            // <a href="#" onClick="hapus_pool(' . $R['id_tim_A'] . ',' . $R['id_tim_B'] . ')" class="btn btn-xs btn-outline-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa fa-times"></i></a></td></td>';
            echo '</tr>';
        }
        echo "</table>";
    }
?>