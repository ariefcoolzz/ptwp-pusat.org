<table border='1'>
    <h2>
        <center>DATA SELURUH PEMAIN</center>
        <center><?php echo strtoupper($event['nama']); ?></center>
    </h2>
    <thead style='background-color: #424858;'>
        <tr>
            <th>NO.</th>
            <th>KONTINGEN</th>
            <th>KELOMPOK</th>
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
        $kat_pemain = array(); //untuk perorangan
        foreach ($kategori_pemain->result_array() as $R) {
            $id_kategori = $R['id_kategori'];
            $kat_pemain[$id_kategori] = $R;
        }
        // echo '<pre>';
        // print_r($pemain->result_array());
        // echo '</pre>';
        // die();
        foreach ($pemain->result_array() as $R) {
            $kelompok = '';
            if ($jenis_event == 'Beregu') {
                $kelompok = 'BEREGU PUTRA';
                if ($R['is_dharmayukti'] or $R['jenis_kelamin'] == 'Wanita') $kelompok = 'BEREGU PUTRI';
                if ($R['is_official']) $kelompok = 'MANAJER/OFFICIAL';
                if ($R['is_veteran']) $kelompok = 'VETERAN';
            } else {
                $id_kategori = $R['id_kategori'];
                if ($R['is_official'] == 1) $kelompok = 'MANAJER/OFFICIAL';
                else if ($R['is_official'] == 2) $kelompok = 'Peserta Konggres';
                else if ($id_kategori !== 0) $kelompok = $kat_pemain[$id_kategori]['kategori'];
            }
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
            echo "<td align='left'>" . $R['nama_kontingen'] . "</td>";
            echo "<td align='left'>" . $kelompok . "</td>";
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