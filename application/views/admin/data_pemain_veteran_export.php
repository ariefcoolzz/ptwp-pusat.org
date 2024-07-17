<table border='1'>
    <h2>
        <center>DATA SELURUH PEMAIN VETERAN</center>
        <center><?php echo strtoupper($event['nama']); ?></center>
    </h2>
    <thead style='background-color: #424858;'>
        <tr>
            <th>NO.</th>
            <th>TIM</th>
            <th>Nama</th>
            <th>Nip</th>
            <th>Jenis Kelamin</th>
            <th>Usia</th>
            <th>Tanggal Lahir</th>
            <th>Jabatan</th>
            <th>Satuan Kerja</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // echo '<pre>';
        // print_r($pemain->row_array());
        // echo '</pre>';
        // die();
        $no = 1;
        $jenis_event = $event['jenis_pertandingan'];

        // echo '<pre>';
        // print_r($pemain->result_array());
        // echo '</pre>';
        // die();
        $tim = 1;
        $tim_temp = 0;
        foreach ($pemain->result_array() as $R) {

            $nama = $R['nama'];
            $nip = nip_titik($R['nip']);
            $usia = $R['umur'];
            $jenis_kelamin = $R['jenis_kelamin'];
            $tgl_lahir = format_tanggal("ddmmyyyy", $R['tgl_lahir']);
            $jabatan = $R['jabatan'];
            if ($R['is_dharmayukti']) {
                $nip = 'Dharmayukti';
                $nama = $R['nama_istri'];
                $tgl_lahir = format_tanggal("ddmmyyyy", $R['tgl_lahir_pasangan']);
                $usia = $R['usia_pasangan'];
                $jenis_kelamin = 'Wanita';
                $jabatan = "Istri " . $R['nama'];
            }
            echo '<tr align="center">';
            echo "<td>" . $no . "</td>";
            if($R['id_tim'] !== $tim_temp && $tim_temp !== 0){
                $tim++;
                echo "<td align='left' rowspan = '2'>".$tim."</td>";
            }
            else if($tim_temp == 0){
                echo "<td align='left' rowspan = '2'>".$tim."</td>";
            }        
            else{
                // echo "<td align='left' style='display:none'></td>";
            }                             
            $tim_temp = $R['id_tim'];
            echo "<td align='left'>" . $nama . "</td>";
            echo "<td align='left'>" . $nip . "</td>";
            echo "<td align='left'>" . $jenis_kelamin . "</td>";
            echo "<td align='left'>" . $usia . "</td>";
            echo "<td align='left'>" . $tgl_lahir . "</td>";
            echo "<td align='left'>" . $jabatan . "</td>";
            echo "<td align='left'>" . $R['nama_satker'] . "</td>";
            echo "</tr>";
            $no++;
        }
        ?>
    </tbody>