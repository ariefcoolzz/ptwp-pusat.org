<?php
$no = 1;
$rekap = $this->Model_admin->model_data_pool_rekap($_POST);
if ($rekap->num_rows()) {
    echo "<h1>POOL TIM REGU " . STRTOUPPER($_POST['beregu']) . "</h1>";
    echo "<div class='table-responsive'>";
    echo "<table class='table table-primary table-striped table-borderless table-hover'>";
    echo "
            <thead class='text-center align-middle'>
            <tr>
                <th>No.</th>
                <th>Pool</th>
                <th>Urutan</th>
                <th>Nama Kontingen/Satker</th>
            </tr>
            </thead>
            <tbody class='text-center'>
        ";

    $satker = $this->Model_admin->model_tmst_satker();
    if ($satker->num_rows()) {
        $option_satker = "";
        foreach ($satker->result_array() as $S) {
            $option_satker .= "<option value='$S[IdSatker]'>$S[NamaSatker]</option>";
        }
    }
    $no = 0;
    foreach ($rekap->result_array() as $R) {
        $no++;
        echo "
                <tr>
                    <td class='tx-bold'>$no</td>
                    <td>$R[pool]</td>
                    <td>$R[urutan]</td>
                    <td class='text-left'>
                        <select class='w-50 form-control select2 id_kontingen' id='id_kontingen$no' 
                            data-id_event='$R[id_event]'  
                            data-pool='$R[pool]' 
                            data-urutan='$R[urutan]'
                            data-beregu='$R[beregu]'
                        >
                            <option value=''> -------------------- Bye -------------------- </option>
                            $option_satker
                        </select>
                        <script>
                            $('#id_kontingen$no').val('$R[id_kontingen]');
                        </script>
                    </td>
                </tr>
            ";
    }
    echo "</tbody></table></div>";
}
?>
<script>
    $(".select2").select2();

    $(".id_kontingen").on("change", function() {
        var form_data = new FormData();
        form_data.append('id_event', $(this).data('id_event'));
        form_data.append('pool', $(this).data('pool'));
        form_data.append('urutan', $(this).data('urutan'));
        form_data.append('beregu', $(this).data('beregu'));
        form_data.append('id_kontingen', $(this).val());
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_pool_set_kontingen",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(json) {
                if (json.status !== true) {
                    alert("Ada Kesalahan... !!!");
                    skip();
                } else {
                    alert("Kontingen Berhasil Di SET");
                }
            }
        });
    });
</script>