<div class="col my-3">
    <button class="btn btn-sm btn-success mb-3" id='copy'>Copy Ke Table Data Pool</button>
    <br>
    <?php
    // PRINT_R($_POST);
    $rekap = $this->Model_admin->model_tmst_satker();
    if ($rekap->num_rows()) {
        $no = 0;
        $p = 1;
        $jk = 0;
        $data_batch = array();
        foreach ($rekap->result_array() as $R) {

            if ($jk >= $_POST['jumlah_kontingen']) {
                $jk = 0;
                $p++;
                echo "<br><hr />";
            } else {
                $no++;
                $jk++;


                echo $no . ". ";
                echo pool($p) . " : ";
                echo "$jk : ";
                echo "$R[NamaSatker]<br>";

                ARRAY_PUSH($data_batch, array('pool' => pool($p), 'urutan' => $jk, 'id_kontingen' => $R['IdSatker']));
            }
        }
        // PRINT_R($data_batch);
        // DIE();
        $data_batch = JSON_ENCODE($data_batch, TRUE);
    }
    ?>
</div>
<script>
    $("#copy").on('click', function() {
        //loader
        if (confirm("Apakah Benar Anda Ingin Men Draw ???")) {
            if (confirm("Apakah Anda benar benar yakin ???")) {
                $(".title_loader").text("Sedang Memuat Halaman");
                $("#konten_menu").html($("#loader_html").html());
                var form_data = new FormData();
                form_data.append('data_batch', JSON.stringify(<?php echo $data_batch; ?>));
                $.ajax({
                    url: "<?php echo base_url(); ?>admin/data_drawing_copy",
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
                            $("body").scrollTop('0px');
                            $("#konten_menu").html(json.konten_menu);

                        }
                    }
                });
            }
        }
    });
</script>