<?php
// PRINT_R($_POST);DIE();
$result = $this->Model_admin->model_data_babak_final_rekap($_POST);
if (!$result->num_rows()) {
    echo "<h2 class='text-danger'>Maaf... Belum Ada Data Pertandingan</h2>";
} else {
    $no = 0;
    echo "<div class='table-responsive'>";
    echo "<table id='datatable' class='table table-primary table-striped table-borderless table-hover'>";
    echo "
        <thead class='text-center align-middle'>
                <tr>
                    <th>No.</th>
                    <th> Beregu </th>
                    <th> Per </th>
                    <th> Urutan </th>
                    <th> Kontingen Tim A </th>
                    <th> Kontingen Tim B </th>
                    <th> Kategori </th>
                    <th> Tanggal </th>
                    <th> Waktu </th>
                    <th> Lapangan </th>
                    <th> Tim A </th>
                    <th> Tim B </th>
                    <th> Action </th>
                </tr>
        </thead>
        <tbody>
            ";
    $jumlah_menang_A = 0;
    $jumlah_menang_B = 0;
    foreach ($result->result_array() as $R) {

        IF($R['per'] == 1)
            {
                $tim_A = $R['nama_pemain_tim_A'] . "<br>" . if_null($R['set1_tim_A']). ' - '.if_null($R['set2_tim_A']). ' - '.if_null($R['set3_tim_A']);
                $tim_B = $R['nama_pemain_tim_B'] . "<br>" . if_null($R['set1_tim_B']). ' - '.if_null($R['set2_tim_B']). ' - '.if_null($R['set3_tim_B']);
            }
        else {    
                $tim_A = $R['nama_pemain_tim_A'] . "<br>" . if_null($R['set1_tim_A']);
                $tim_B = $R['nama_pemain_tim_B'] . "<br>" . if_null($R['set1_tim_B']);
            }

        if ($R['set1_tim_A'] >= 8) $jumlah_menang_A++;
        if ($R['set1_tim_B'] >= 8) $jumlah_menang_B++;

        if ($R['set2_tim_A'] >= 8) $jumlah_menang_A++;
        if ($R['set2_tim_B'] >= 8) $jumlah_menang_B++;

        if ($R['set3_tim_A'] >= 8) $jumlah_menang_A++;
        if ($R['set3_tim_B'] >= 8) $jumlah_menang_B++;

        IF($jumlah_menang_A >= 2)  $classA = "class='bg-success'"; else $classA = ""; 
        IF($jumlah_menang_B >= 2)  $classB = "class='bg-success'"; else $classB = ""; 

        $jumlah_menang_A = 0;
        $jumlah_menang_B = 0;

        $no++;
        echo "<tr valign='top'>";
        echo '<td>' . $no . '</td>';
        echo '<td>' . $R['beregu'] . '</td>';
        echo '<td>' . $R['per'] . '</td>';
        echo '<td>' . $R['urutan'] . '</td>';
        echo '<td>' . $R['kontingen_tim_A'] . '</td>';
        echo '<td>' . $R['kontingen_tim_B'] . '</td>';
        echo '<td>' . $R['kategori'] . '</td>';
        echo '<td>' . format_tanggal('ddmmmmyyyy',$R['tanggal']) . '</td>';
        echo '<td>' . $R['waktu'] . '</td>';
        echo '<td>' . $R['lapangan'] . '</td>';
        echo "<td align='center' $classA>$tim_A</td>";
        echo "<td align='center' $classB>$tim_B</td>";
        echo "<td>
                    <button class='btn btn-sm btn-warning edit' data-id_pertandingan='$R[id_pertandingan]'><i class='fa fa-edit'></i> Edit</button>
                </td>";
        echo '</tr>';
        
    }
    echo "</tbody></table></div>";
}
?>
<script>
    $('#datatable').DataTable({
        ordering: false,
        paging: false,
        language: {
            searchPlaceholder: 'Pencarian...',
            sSearch: '',
            lengthMenu: '_MENU_ wasit/Halaman',
        }
    });

    $(".edit").on('click', function() {
        var form_data = new FormData();
        form_data.append('id_event', $("#list_event").val());
        form_data.append('id_pertandingan', $(this).data('id_pertandingan'));
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_babak_final_form",
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