<?php 
// PRINT_R($_POST);DIE();
    $result = $this->Model_admin->model_tabel_babak_penyisihan_rekap($_POST);
    IF(!$result->num_rows()){
        echo "<h2 class='text-danger'>Maaf... Belum Ada Data Pertandingan</h2>";
    }else{
        $score = $this->Model_admin->model_tabel_babak_penyisihan_score($_POST);
        $no=0;
        echo "<table border='1' width='100%'>";
        echo "
                <tr>
                    <th>No.</th>
                    <th>Beregu</th>
                    <th>Pool</th>
                    <th> Nama Tim </th>";
                    foreach($result->result_array() as $S){
                        IF($S['beregu'] == 'putra'){
                            echo "<th colspan='5'> $S[nama_satker_singkat] </th>";
                        }
                        IF($S['beregu'] == 'putri'){
                            echo "<th colspan='3'> $S[nama_satker_singkat] </th>";
                        }
                    }
        echo "     
                    <th> Menang </th>
                    <th> Kalah </th>
                    <!-- <th colspan='3'> Set </th> -->
                    <th colspan='3'> Game </th>
                    <th> Peringkat </th>
                </tr>
            ";
        
        foreach($score->result_array() as $S){ //untuk  deklarasiin nilai
            $ik     = $S['id_kategori'];
            $iktA   = $S['id_kontingen_tim_A'];
            $iktB   = $S['id_kontingen_tim_B'];
            $score_tim_A[1][$ik][$iktA][$iktB] = $S['set1_tim_A']; // 1 = Set ke 1
            $score_tim_B[1][$ik][$iktA][$iktB] = $S['set1_tim_B']; // 1 = Set ke 1
            $score_tim_A[2][$ik][$iktA][$iktB] = $S['set2_tim_A']; // 2 = Set ke 2
            $score_tim_B[2][$ik][$iktA][$iktB] = $S['set2_tim_B']; // 2 = Set ke 2
            $score_tim_A[3][$ik][$iktA][$iktB] = $S['set3_tim_A']; // 3 = Set ke 3
            $score_tim_B[3][$ik][$iktA][$iktB] = $S['set3_tim_B']; // 3 = Set ke 3

            $score_tim_A[1][$ik][$iktB][$iktA] = $S['set1_tim_B']; // 1 = Set ke 1
            $score_tim_B[1][$ik][$iktB][$iktA] = $S['set1_tim_A']; // 1 = Set ke 1
            $score_tim_A[2][$ik][$iktB][$iktA] = $S['set2_tim_B']; // 2 = Set ke 2
            $score_tim_B[2][$ik][$iktB][$iktA] = $S['set2_tim_A']; // 2 = Set ke 2
            $score_tim_A[3][$ik][$iktB][$iktA] = $S['set3_tim_B']; // 3 = Set ke 3
            $score_tim_B[3][$ik][$iktB][$iktA] = $S['set3_tim_A']; // 3 = Set ke 3
            // echo "xxx $iktA $iktB $S[set1_tim_A] xxx<br>";
        }

        $jumlah_game_penyisihan_putra = $this->Model_admin->model_rule($_POST['id_event'], 'jumlah_game_penyisihan_putra');
        $jumlah_game_penyisihan_putri = $this->Model_admin->model_rule($_POST['id_event'], 'jumlah_game_penyisihan_putri');
        
        foreach($result->result_array() as $R){
            $jumlah = 0;
            $menang = 0;
            $kalah  = 0;

            $no++;
            echo "<tr valign='top'>";
                echo "<td rowspan='2'>".$no."</td>";
                echo "<td rowspan='2'>".$R['beregu']."</td>";
                echo "<td rowspan='2'>".$R['pool']."</td>";
                echo "<td rowspan='2'>".$R['nama_satker_singkat']."</td>";
                
                $iktA   = $R['id_kontingen'];
                foreach($result->result_array() as $L){
                    $iktB = $L['id_kontingen'];
                    // echo "$iktA $iktB<br>";
                    IF($L['beregu'] == 'putra'){
                        IF(ISSET($score_tim_B[1][1][$iktA][$iktB])) echo "<td> ".$score_tim_B[1][1][$iktA][$iktB]." </td>"; ELSE echo "<td>x</td>";
                        IF(ISSET($score_tim_B[1][2][$iktA][$iktB])) echo "<td> ".$score_tim_B[1][2][$iktA][$iktB]." </td>"; ELSE echo "<td>x</td>";
                        IF(ISSET($score_tim_B[1][3][$iktA][$iktB])) echo "<td> ".$score_tim_B[1][3][$iktA][$iktB]." </td>"; ELSE echo "<td>x</td>";
                        IF(ISSET($score_tim_B[1][4][$iktA][$iktB])) echo "<td> ".$score_tim_B[1][4][$iktA][$iktB]." </td>"; ELSE echo "<td>x</td>";
                        IF(ISSET($score_tim_B[1][5][$iktA][$iktB])) echo "<td> ".$score_tim_B[1][5][$iktA][$iktB]." </td>"; ELSE echo "<td>x</td>";

                        IF(ISSET($score_tim_A[1][1][$iktA][$iktB]) AND $score_tim_A[1][1][$iktA][$iktB] >= $jumlah_game_penyisihan_putra) $menang++; 
                        IF(ISSET($score_tim_A[1][2][$iktA][$iktB]) AND $score_tim_A[1][2][$iktA][$iktB] >= $jumlah_game_penyisihan_putra) $menang++; 
                        IF(ISSET($score_tim_A[1][3][$iktA][$iktB]) AND $score_tim_A[1][3][$iktA][$iktB] >= $jumlah_game_penyisihan_putra) $menang++; 
                        IF(ISSET($score_tim_A[1][4][$iktA][$iktB]) AND $score_tim_A[1][4][$iktA][$iktB] >= $jumlah_game_penyisihan_putra) $menang++; 
                        IF(ISSET($score_tim_A[1][5][$iktA][$iktB]) AND $score_tim_A[1][5][$iktA][$iktB] >= $jumlah_game_penyisihan_putra) $menang++; 

                        IF(ISSET($score_tim_A[1][1][$iktA][$iktB]) AND $score_tim_A[1][1][$iktA][$iktB] < $jumlah_game_penyisihan_putra) $kalah++; 
                        IF(ISSET($score_tim_A[1][2][$iktA][$iktB]) AND $score_tim_A[1][2][$iktA][$iktB] < $jumlah_game_penyisihan_putra) $kalah++; 
                        IF(ISSET($score_tim_A[1][3][$iktA][$iktB]) AND $score_tim_A[1][3][$iktA][$iktB] < $jumlah_game_penyisihan_putra) $kalah++; 
                        IF(ISSET($score_tim_A[1][4][$iktA][$iktB]) AND $score_tim_A[1][4][$iktA][$iktB] < $jumlah_game_penyisihan_putra) $kalah++; 
                        IF(ISSET($score_tim_A[1][5][$iktA][$iktB]) AND $score_tim_A[1][5][$iktA][$iktB] < $jumlah_game_penyisihan_putra) $kalah++; 
                    }
                    IF($L['beregu'] == 'putri'){
                        IF(ISSET($score_tim_A[1][6][$iktB][$iktA])) echo "<td> ".$score_tim_A[1][6][$iktB][$iktA]." </td>"; ELSE echo "<td>x</td>";
                        IF(ISSET($score_tim_A[1][7][$iktB][$iktA])) echo "<td> ".$score_tim_A[1][7][$iktB][$iktA]." </td>"; ELSE echo "<td>x</td>";
                        IF(ISSET($score_tim_A[1][8][$iktB][$iktA])) echo "<td> ".$score_tim_A[1][8][$iktB][$iktA]." </td>"; ELSE echo "<td>x</td>";

                        IF(ISSET($score_tim_A[1][6][$iktA][$iktB]) AND $score_tim_A[1][6][$iktA][$iktB] >= $jumlah_game_penyisihan_putri) $menang++; 
                        IF(ISSET($score_tim_A[1][7][$iktA][$iktB]) AND $score_tim_A[1][7][$iktA][$iktB] >= $jumlah_game_penyisihan_putri) $menang++; 
                        IF(ISSET($score_tim_A[1][8][$iktA][$iktB]) AND $score_tim_A[1][8][$iktA][$iktB] >= $jumlah_game_penyisihan_putri) $menang++; 

                        IF(ISSET($score_tim_A[1][6][$iktA][$iktB]) AND $score_tim_A[1][6][$iktA][$iktB] < $jumlah_game_penyisihan_putri) $kalah++; 
                        IF(ISSET($score_tim_A[1][7][$iktA][$iktB]) AND $score_tim_A[1][7][$iktA][$iktB] < $jumlah_game_penyisihan_putri) $kalah++; 
                        IF(ISSET($score_tim_A[1][8][$iktA][$iktB]) AND $score_tim_A[1][8][$iktA][$iktB] < $jumlah_game_penyisihan_putri) $kalah++; 
                    }
                }

                $jumlah = $menang + $kalah;

                $menang_persentase = ROUND($menang / $jumlah * 100,2);
                $kalah_persentase  = ROUND($kalah  / $jumlah * 100,2);
        $temp_menang[$iktA] = $menang_persentase;
                echo "<td rowspan='2'>$menang</td>";
                echo "<td rowspan='2'>$kalah</td>";
                echo "<td rowspan='2'>$menang_persentase%</td>";
                echo "<td rowspan='2'>$kalah_persentase%</td>";
                echo "<td rowspan='2'>100%</td>";
        echo "<td rowspan='2' id='peringkat_" . $iktA . "'></td>";
                // echo "<td rowspan='2'></td>";
                // echo "<td rowspan='2'></td>";
                // echo "<td rowspan='2'></td>";
            echo '</tr>';
            echo "<tr valign='top'>";
            foreach($result->result_array() as $L){
                $iktB = $L['id_kontingen'];
                IF($L['beregu'] == 'putra'){
                    IF(ISSET($score_tim_A[1][1][$iktA][$iktB])) echo "<td> ".$score_tim_A[1][1][$iktA][$iktB]." </td>"; ELSE echo "<td>x</td>";
                    IF(ISSET($score_tim_A[1][2][$iktA][$iktB])) echo "<td> ".$score_tim_A[1][2][$iktA][$iktB]." </td>"; ELSE echo "<td>x</td>";
                    IF(ISSET($score_tim_A[1][3][$iktA][$iktB])) echo "<td> ".$score_tim_A[1][3][$iktA][$iktB]." </td>"; ELSE echo "<td>x</td>";
                    IF(ISSET($score_tim_A[1][4][$iktA][$iktB])) echo "<td> ".$score_tim_A[1][4][$iktA][$iktB]." </td>"; ELSE echo "<td>x</td>";
                    IF(ISSET($score_tim_A[1][5][$iktA][$iktB])) echo "<td> ".$score_tim_A[1][5][$iktA][$iktB]." </td>"; ELSE echo "<td>x</td>";
                }
                IF($L['beregu'] == 'putri'){
                    IF(ISSET($score_tim_B[1][6][$iktB][$iktA])) echo "<td> ".$score_tim_B[1][6][$iktB][$iktA]." </td>"; ELSE echo "<td>x</td>";
                    IF(ISSET($score_tim_B[1][7][$iktB][$iktA])) echo "<td> ".$score_tim_B[1][7][$iktB][$iktA]." </td>"; ELSE echo "<td>x</td>";
                    IF(ISSET($score_tim_B[1][8][$iktB][$iktA])) echo "<td> ".$score_tim_B[1][8][$iktB][$iktA]." </td>"; ELSE echo "<td>x</td>";
                }
            }
            echo '</tr>';
            
        }
        echo "</table>";
}
                    arsort($temp_menang);
                    $i = 0;
                    $val_temp = null;
                    foreach ($temp_menang as $key => $val) {
                        if ($val !== $val_temp) $i++;
                        $val_temp = $val;
                        echo "<script>$('#peringkat_" . $key . "').html('" . $i . "');</script>";
                    }
?>
<script>
    $(".edit").on('click', function() {
        var form_data = new FormData();
        form_data.append('id_event', $("#list_event").val());
        form_data.append('id_pertandingan', $(this).data('id_pertandingan'));
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_babak_penyisihan_form",
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
                    $("#modal").modal('show');
                    $("#modal_judul").html("Edit Data Pertandingan");
                    $("#modal_isi").html(json.konten_menu);
                }
            }
        });
    });
</script>