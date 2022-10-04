<div class="table-responsive">
    <table class="datatable-user table table-primary mg-b-0">
        <thead class="thead-primary">
            <tr class="text-center">
                <th class="wd-20">No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Nip</th>
                <th>Jenis Kelamin</th>
                <th>Usia</th>
                <th>Jabatan</th>
                <th>Kepengurusan</th>
                <th>Satuan Kerja</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $rekap = $this->Model_admin->get_data_user($_POST);
            if ($rekap->num_rows()) {
                foreach ($rekap->result_array() as $R) {
                    echo '<tr align="center">';
                    echo "<td>" . $no . "</td>";
                    if (!empty($R['FotoPegawai']) or !empty($R['FotoFormal'])) {
                        echo "<td class='align-center'><a href='" . cdn_foto($R['FotoPegawai'], $R['FotoFormal'], 200) . "' data-lightbox='$R[nama_gelar]' data-title='$R[nama_gelar]'><center><img src='" . cdn_foto($R['FotoPegawai'], $R['FotoFormal']) . "' class='img-thumbnail d-block' style='width:70px;height:85px;'></center></a></td>";
                    } else {
                        echo "<td align='align-center'><img src='" . base_url('assets/profil/default.png') . "' class='img-thumbnail' style='width:55px;height:60px;'></td>";
                    }
                    echo "<td align='left'>" . $R['nama'] . "</td>";
                    echo "<td align='left'>" . nip_titik($R['nip']) . "</td>";
                    echo "<td align='left'>" . $R['jenis_kelamin'] . "</td>";
                    echo "<td align='left'>" . $R['umur'] . "</td>";
                    echo "<td align='left'>" . $R['jabatan'] . "</td>";
                    echo "<td align='left'>" . $R['panitia'] . "</td>";
                    echo "<td align='left'>" . $R['nama_satker'] . "</td>";
                    if ($R['aktif'])
                        echo "<td align='center'><span class='badge badge-success'>Aktif</span></td>";
                    else
                        echo "<td align='center'><span class='badge badge-danger'>Belum Aktif</span></td>";
                    echo '<td>';
                    echo '<span data-id_user="' . $R['id_user'] . '" class="hapus btn btn-xs btn-outline-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa fa-times"></i></span>';
                    echo '<span data-id_user="' . $R['id_user'] . '" class="edit  btn btn-xs btn-outline-warning btn-rounded" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa fa-edit"></i></span>';
                    echo "</td>";
                    echo "</tr>";
                    $no++;
                }
            }
            ?>
        </tbody>
    </table>
</div><!-- table-responsive -->
<script>
    $('.datatable-user').DataTable({
        language: {
            searchPlaceholder: 'Pencarian...',
            sSearch: '',
            lengthMenu: '_MENU_ user/Halaman',
        }
    });
</script>