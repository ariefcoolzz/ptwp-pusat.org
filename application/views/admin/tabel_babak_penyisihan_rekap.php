<?php 
    $result = $this->Model_admin->model_tabel_babak_penyisihan_rekap($_POST);
    IF(!$result->num_rows()){
        echo "<h2 class='text-danger'>Maaf... Belum Ada Data Pertandingan</h2>";
    }else{
        $no=0;
        echo "<table border='1' width='100%'>";
        echo "
                <tr>
                    <th>No.</th>
                    <th>Pool</th>
                    <th> Nama Tim </th>
                    <th colspan='5'> Kontingen 1 </th>
                    <th colspan='5'> Kontingen 2 </th>
                    <th colspan='5'> Kontingen 3 </th>
                    <th colspan='5'> Kontingen 4 </th>
                    <th> Menang </th>
                    <th> Kalah </th>
                    <th colspan='3'> Set </th>
                    <th colspan='3'> Game </th>
                    <th> Peringkat </th>
                </tr>
            ";
        foreach($result->result_array() as $R){

            $no++;
            echo "<tr valign='top'>";
                echo "<td rowspan='2'>".$no."</td>";
                echo "<td rowspan='2'>".$R['pool']."</td>";
                echo "<td rowspan='2'>".$R['nama_satker']."</td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td rowspan='2'></td>";
                echo "<td rowspan='2'></td>";
                echo "<td rowspan='2'></td>";
                echo "<td rowspan='2'></td>";
                echo "<td rowspan='2'></td>";
                echo "<td rowspan='2'></td>";
                echo "<td rowspan='2'></td>";
                echo "<td rowspan='2'></td>";
                echo "<td rowspan='2'></td>";
            echo '</tr>';
            echo "<tr valign='top'>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
            echo '</tr>';
            
        }
        echo "</table>";
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