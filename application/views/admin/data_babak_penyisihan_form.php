<?php
$result = $this->Model_admin->model_data_babak_penyisihan_rekap($_POST);
if ($result->num_rows()) $R = $result->row_array();
?>
<div class="row">
    <div class="col-lg">
        <input type='hidden' id='id_pertandingan'>
        <table class="table table-borderless table-striped">
            <tr>
                <td>Event</td>
                <td><?php echo $R['id_event']; ?></td>
            </tr>
            <tr>
                <td>Beregu</td>
                <td><?php echo $R['beregu']; ?></td>
            </tr>
            <tr>
                <td>Pool</td>
                <td><?php echo $R['pool']; ?></td>
            </tr>
            <tr>
                <td>Urutan</td>
                <td><?php echo $R['urutan']; ?></td>
            </tr>
            <tr>
                <td>Kategori</td>
                <td><?php echo $R['kategori']; ?></td>
            </tr>
            <tr>
                <td>Kontingen Tim A</td>
                <td><?php echo $R['kontingen_tim_A']; ?></td>
            </tr>
            <tr>
                <td>Kontingen Tim B</td>
                <td><?php echo $R['kontingen_tim_B']; ?></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td><input type='date' class="form-control" id='tanggal'></td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td>
                    <select class="form-control" id="waktu">
                        <option></option>
                        <?php
                        for ($j = 6; $j <= 24; $j++) {
                            if ($j < 10) $jam = "0" . $j;
                            else $jam = $j;
                            for ($m = 0; $m < 60; $m += 10) {
                                if ($m < 10) $menit = "0" . $m;
                                else $menit = $m;
                                echo "<option value='$jam:$menit:00'>$jam:$menit</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Lapangan</td>
                <td>
                    <?php
                    $lapangan = $this->Model_admin->model_master_lapangan($_POST);
                    if ($lapangan->num_rows()) {
                        echo "<select class='form-control' id='id_lapangan'>";
                        echo "<option></option>";
                        foreach ($lapangan->result_array() as $L) {
                            echo "<option value='$L[id_lapangan]'>$L[lapangan]</option>";
                        }
                        echo "</select>";
                    }
                    ?>
                </td>
            </tr>
        </table>
    </div>
    <div class='col-lg'>
        <table class="table table-borderless table-striped">
            <tr>
                <td>Pemain Tim A</td>
                <td>
                    <?php
                    $_POST['id_kontingen'] = $R['id_kontingen_tim_A'];
                    $_POST['beregu'] = $R['beregu'];
                    $pemain = $this->Model_admin->model_data_babak_penyisihan_pemain($_POST);
                    if ($pemain->num_rows()) {
                        echo "<select class='form-control' id='id_pemain1_tim_A'>";
                        echo "<option></option>";
                        foreach ($pemain->result_array() as $P) {
                            echo "<option value='$P[id_pemain]'>$P[nama]</option>";
                        }
                        echo "</select>";

                        echo "<select class='form-control' id='id_pemain2_tim_A' style='display:none;'>";
                        echo "<option></option>";
                        foreach ($pemain->result_array() as $P) {
                            echo "<option value='$P[id_pemain]'>$P[nama]</option>";
                        }
                        echo "</select>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Pemain Tim B</td>
                <td>
                    <?php
                    $_POST['id_kontingen'] = $R['id_kontingen_tim_B'];
                    $_POST['beregu'] = $R['beregu'];
                    $pemain = $this->Model_admin->model_data_babak_penyisihan_pemain($_POST);
                    if ($pemain->num_rows()) {
                        echo "<select class='form-control' id='id_pemain1_tim_B'>";
                        echo "<option></option>";
                        foreach ($pemain->result_array() as $P) {
                            echo "<option value='$P[id_pemain]'>$P[nama]</option>";
                        }
                        echo "</select>";

                        echo "<select class='form-control' id='id_pemain2_tim_B' style='display:none;'>";
                        echo "<option></option>";
                        foreach ($pemain->result_array() as $P) {
                            echo "<option value='$P[id_pemain]'>$P[nama]</option>";
                        }
                        echo "</select>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Game Set 1 Tim A</td>
                <td><input type='number' id='set1_tim_A' class='form-control'></td>
            </tr>
            <tr>
                <td>Game Set 1 Tim B</td>
                <td><input type='number' id='set1_tim_B' class='form-control'></td>
            </tr>
            <tr>
                <td>Game Set 2 Tim A</td>
                <td><input type='number' id='set2_tim_A' class='form-control'></td>
            </tr>
            <tr>
                <td>Game Set 2 Tim B</td>
                <td><input type='number' id='set2_tim_B' class='form-control'></td>
            </tr>
            <tr>
                <td>Game Set 3 Tim A</td>
                <td><input type='number' id='set3_tim_A' class='form-control'></td>
            </tr>
            <tr>
                <td>Game Set 3 Tim B</td>
                <td><input type='number' id='set3_tim_B' class='form-control'></td>
            </tr>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button id="simpan" class="btn btn-outline-success btn-rounded"><i class="fa fa-save"></i> Simpan</button>
</div>
<?php
// PRINT_R($R);
if (isset($R)) {
    if ($R['tunggal_ganda'] == "ganda") {
        echo "<script>";
        echo "$('#id_pemain2_tim_A').show();";
        echo "$('#id_pemain2_tim_B').show();";
        echo "</script>";
    }
    $E_A = EXPLODE(',', $R['id_pemain_tim_A']);
    $E_B = EXPLODE(',', $R['id_pemain_tim_B']);
    echo "<script>";
    echo "$('#id_pertandingan').val('$R[id_pertandingan]');";
    echo "$('#tanggal').val('$R[tanggal]');";
    echo "$('#waktu').val('$R[waktu]');";
    echo "$('#id_lapangan').val('$R[id_lapangan]');";
    if (isset($E_A[0])) echo "$('#id_pemain1_tim_A').val('$E_A[0]');";
    if (isset($E_A[1])) echo "$('#id_pemain2_tim_A').val('$E_A[1]');";
    if (isset($E_B[0])) echo "$('#id_pemain1_tim_B').val('$E_B[0]');";
    if (isset($E_B[1])) echo "$('#id_pemain2_tim_B').val('$E_B[1]');";
    echo "$('#set1_tim_A').val('$R[set1_tim_A]');";
    echo "$('#set1_tim_B').val('$R[set1_tim_B]');";
    echo "$('#set2_tim_A').val('$R[set2_tim_A]');";
    echo "$('#set2_tim_B').val('$R[set2_tim_B]');";
    echo "$('#set3_tim_A').val('$R[set3_tim_A]');";
    echo "$('#set3_tim_B').val('$R[set3_tim_B]');";
    echo "</script>";
}
?>

<script>
    $("#simpan").on("click", function() {
        $(".title_loader").text("Sedang Memuat Halaman");
        $("#konten_menu").html($("#loader_html").html());
        var form_data = new FormData();
        form_data.append('id_pertandingan', $("#id_pertandingan").val());
        form_data.append('id_event', $("#list_event").val());
        form_data.append('tanggal', $("#tanggal").val());
        form_data.append('waktu', $("#waktu").val());
        form_data.append('id_lapangan', $("#id_lapangan").val());
        form_data.append('id_pemain1_tim_A', $("#id_pemain1_tim_A").val());
        form_data.append('id_pemain2_tim_A', $("#id_pemain2_tim_A").val());
        form_data.append('id_pemain1_tim_B', $("#id_pemain1_tim_B").val());
        form_data.append('id_pemain2_tim_B', $("#id_pemain2_tim_B").val());
        form_data.append('set1_tim_A', $("#set1_tim_A").val());
        form_data.append('set1_tim_B', $("#set1_tim_B").val());
        form_data.append('set2_tim_A', $("#set2_tim_A").val());
        form_data.append('set2_tim_B', $("#set2_tim_B").val());
        form_data.append('set3_tim_A', $("#set3_tim_A").val());
        form_data.append('set3_tim_B', $("#set3_tim_B").val());
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_babak_penyisihan_simpan",
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
                    $("#modal").modal('hide');
                    $("#konten_menu").hide(300);
                    $("#konten_menu").html(json.konten_menu);
                    $("#konten_menu").show(300);
                }
            }
        });
    });

    // tinyMCE.EditorManager.execCommand('mceAddEditor',true, '.mymce'); 
</script>