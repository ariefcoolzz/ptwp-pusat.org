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
        $no = 1;
        $list_pemain = $this->Model_admin->get_data_pemain($id_kontingen, false, true);
        foreach ($list_pemain->result_array() as $R) {
            echo '<tr align="center">';
            echo "<td>" . $no . "</td>";
            echo "<td align='left'>MANAJER/OFFICIAL</td>";
            echo "<td align='left'>" . $R['nama'] . "</td>";
            echo "<td align='left'>" . nip_titik($R['nip']) . "</td>";
            echo "<td align='left'>" . $R['jenis_kelamin'] . "</td>";
            echo "<td align='left'>" . $R['umur'] . "</td>";
            echo "<td align='left'>" . $R['jabatan'] . "</td>";
            echo "<td align='left'>" . $R['nama_satker'] . "</td>";
            echo "</tr>";
            $no++;
        }
        $list_pemain = $this->Model_admin->get_data_pemain($id_kontingen, "Pria", false);
        foreach ($list_pemain->result_array() as $R) {
            echo '<tr align="center">';
            echo "<td>" . $no . "</td>";
            echo "<td align='left'>BEREGU PUTRA</td>";
            echo "<td align='left'>" . $R['nama'] . "</td>";
            echo "<td align='left'>" . nip_titik($R['nip']) . "</td>";
            echo "<td align='left'>" . $R['jenis_kelamin'] . "</td>";
            echo "<td align='left'>" . $R['umur'] . "</td>";
            echo "<td align='left'>" . $R['jabatan'] . "</td>";
            echo "<td align='left'>" . $R['nama_satker'] . "</td>";
            echo "</tr>";
            $no++;
        }
        $list_pemain = $this->Model_admin->get_data_pemain($id_kontingen, "Wanita", false);
        foreach ($list_pemain->result_array() as $R) {
            if ($R['is_dharmayukti']) {
                echo '<tr align="center">';
                echo "<td>" . $no . "</td>";
                echo "<td align='left'>BEREGU PUTRI</td>";
                echo "<td align='left'>" . $R['nama_istri'] . "</td>";
                echo "<td align='left'>Dharmayukti</td>";
                echo "<td align='left'>Wanita</td>";
                echo "<td align='left'>-</td>";
                echo "<td align='left'>Istri " . $R['nama'] . "</td>";
                echo "<td align='left'>" . $R['jabatan'] . " <br>" . $R['nama_satker'] . "</td>";
                echo "</tr>";
            } else {
                echo '<tr align="center">';
                echo "<td>" . $no . "</td>";
                echo "<td align='left'>BEREGU PUTRI</td>";
                echo "<td align='left'>" . $R['nama'] . "</td>";
                echo "<td align='left'>" . nip_titik($R['nip']) . "</td>";
                echo "<td align='left'>" . $R['jenis_kelamin'] . "</td>";
                echo "<td align='left'>" . $R['umur'] . "</td>";
                echo "<td align='left'>" . $R['jabatan'] . "</td>";
                echo "<td align='left'>" . $R['nama_satker'] . "</td>";
                echo "</tr>";
            }
            $no++;
        }
        $list_pemain = $this->Model_admin->get_data_pemain($id_kontingen, false, false, true); // PARAMETER 4 IS VETERAN
        foreach ($list_pemain->result_array() as $R) {
            echo '<tr align="center">';
            echo "<td>" . $no . "</td>";
            echo "<td align='left'>VETERAN</td>";
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