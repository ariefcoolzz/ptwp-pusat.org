<table border='1'>
    <h2>
        <center>DATA PEMAIN <?php echo strtoupper($kontingen['nama_kontingen']); ?></center>
    </h2>
    <thead style='background-color: #424858;'>
        <tr>
            <th>NO.</th>
            <th>KELOMPOK</th>
            <th>Nama</th>
            <th>Nip</th>
            <th>Jenis Kelamin</th>
            <th>Usia</th>
            <th>Jabatan</th>
            <th>Satuan Kerja</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $kat_pemain = array(); //untuk perorangan
        foreach ($kategori_pemain->result_array() as $R) {
            $id_kategori = $R['id_kategori'];
            $kat_pemain[$id_kategori] = $R;
        }
        $no = 1;
        $list_pemain = $this->Model_admin->get_data_pemain_new($id_kontingen);
        foreach ($list_pemain->result_array() as $R) {
            $kelompok = '';
            $id_kategori = $R['id_kategori'];
            if ($R['is_official'] == 1) $kelompok = 'MANAJER/OFFICIAL';
            else if ($R['is_official'] == 2) $kelompok = 'Peserta Konggres';
            else if ($id_kategori !== 0) $kelompok = $kat_pemain[$id_kategori]['kategori'];

            echo '<tr align="center">';
            echo "<td>" . $no . "</td>";
            echo "<td align='left'>".$kelompok."</td>";
            echo "<td align='left'>" . $R['nama'] . "</td>";
            echo "<td align='left'>" . nip_titik($R['nip']) . "</td>";
            echo "<td align='left'>" . $R['jenis_kelamin'] . "</td>";
            echo "<td align='left'>" . $R['umur'] . "</td>";
            echo "<td align='left'>" . $R['jabatan'] . "</td>";
            echo "<td align='left'>" . $R['nama_satker'] . "</td>";
            echo "</tr>";
            $no++;
        }
        ?>
    </tbody>