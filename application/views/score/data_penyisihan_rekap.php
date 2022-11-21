<?php
// PRINT_R($_SESSION);
// DIE();
$result = $this->Model_score->model_data_penyisihan_rekap($_POST);
if (!$result->num_rows()) {
    echo "<h2 class='text-danger'>Maaf... Belum Ada Data Pertandingan</h2>";
} else {
    $no = 0;
    echo "<div class='table-responsive'>";
    echo "<table id='datatable' class='table table-primary table-striped table-borderless table-hover w-100'>";
    echo "
        <thead class='text-center align-middle'>
                <tr>
                    <th>No.</th>
                    <th class='d-none d-lg-table-cell'> Beregu </th>
                    <th class='d-none d-lg-table-cell'> Pool </th>
                    <th class='d-none d-lg-table-cell'> Urutan </th>
                    <th> Kategori </th>
                    <th class='d-none d-lg-table-cell'> Kontingen Tim A </th>
                    <th class='d-none d-lg-table-cell'> Kontingen Tim B </th>
                    <th> Tim A </th>
                    <th> Tim B </th>
                    <th> Tanggal<br>Waktu </th>
                    <th> Lapangan </th>
                    <th> Action </th>
                </tr>
        </thead>
        <tbody>
            ";
    foreach ($result->result_array() as $R) {
        $key     = MD7($R['id_pertandingan']);

        $tim_A = nama_singkat($R['nama_pemain_tim_A']) . "<br>" . if_null($R['set1_tim_A']);
        $tim_B = nama_singkat($R['nama_pemain_tim_B']) . "<br>" . if_null($R['set1_tim_B']);

        if ($R['set1_tim_A'] < 8) $classA = "";
        else $classA = "class='bg-success'";
        if ($R['set1_tim_B'] < 8) $classB = "";
        else $classB = "class='bg-success'";

        $no++;
        echo "<tr class='tx-center'>";
        echo '<td>' . $no . '</td>';
        echo '<td class="d-none d-lg-table-cell">' . $R['beregu'] . '</td>';
        echo '<td class="d-none d-lg-table-cell">' . $R['pool'] . '</td>';
        echo '<td class="d-none d-lg-table-cell">' . $R['urutan'] . '</td>';
        echo '<td>' . $R['kategori'] . '</td>';
        echo '<td class="d-none d-lg-table-cell">' . $R['kontingen_tim_A'] . '</td>';
        echo '<td class="d-none d-lg-table-cell">' . $R['kontingen_tim_B'] . '</td>';
        echo "<td $classA>$tim_A</td>";
        echo "<td $classB>$tim_B</td>";
        echo '<td>' . format_tanggal('ddmmyyyy', $R['tanggal']) . '<br>' . $R['waktu'] . '</td>';
        echo '<td>' . $R['lapangan'] . '</td>';
        echo "<td>
                <div class='btn-group-vertical'>
                    <button class='btn mb-1 btn-sm btn-warning edit' data-id_pertandingan='$R[id_pertandingan]'>Edit</button>
					<button class='btn mb-1 btn-sm btn-success share' data-key='$key'>Share Score</button>
					<button class='btn mb-1 btn-sm btn-primary manage' data-key='$key'>Manage Score</button>
                </div>
            </td>";

        // echo '<td class="text-center"><a href="#" onClick="tambah_pool(' . $R['id_tim_A'] . ',' . $R['id_tim_B'] . ')" class="btn-tambah btn btn-xs btn-outline-success btn-rounded" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a>
        // <a href="#" onClick="hapus_pool(' . $R['id_tim_A'] . ',' . $R['id_tim_B'] . ')" class="btn btn-xs btn-outline-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa fa-times"></i></a></td></td>';
        echo '</tr>';
    }
    echo "</tbody></table></div>";
}
?>
<script>
    $('#datatable').DataTable({
        responsive: true,
        ordering: false,
        paging: false,
        language: {
            searchPlaceholder: 'Pencarian...',
            sSearch: '',
            lengthMenu: '_MENU_ wasit/Halaman',
        }
    });

    $(".table").on('click', '.edit', function(e) {
        var form_data = new FormData();
        form_data.append('id_event', $("#list_event").val());
        form_data.append('id_pertandingan', $(this).data('id_pertandingan'));
        $.ajax({
            url: "<?php echo base_url(); ?>score/data_penyisihan_form",
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

    $(".table").on('click', '.share', function(e) {
        var jenis = "penyisihan";
        var key = $(this).data('key');
        var link = "<?php echo base_url(); ?>score/share/" + jenis + '/' + key;
        window.open(link, '_blank');
    });

    $(".table").on('click', '.manage', function(e) {
        var jenis = "penyisihan";
        var key = $(this).data('key');
        var link = "<?php echo base_url(); ?>score/manage/" + jenis + '/' + key;
        window.open(link, '_blank');
    });
</script>