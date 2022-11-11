<?php 
$result = $this->Model_admin->model_data_babak_penyisihan_rekap($_POST);
IF($result->num_rows()) $R = $result->row_array();
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form id='form_konten' enctype="multipart/form-data">
                    <div class="row">
                        <table border='1'>
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
                                <td><input type='date' id='tanggal'></td>
                            </tr>
                            <tr>
                                <td>Waktu</td>
                                <td>
                                    <select class="form-control" id="waktu">
                                        <option></option>
                                        <?php
                                        FOR($j=6;$j<=24;$j++)
                                            {
                                                IF($j < 10) $jam = "0".$j; ELSE $jam = $j;
                                                FOR($m=0;$m<60;$m+=10)
                                                    {
                                                        IF($m < 10) $menit = "0".$m; ELSE $menit = $m;
                                                        echo "<option value='$jam:$menit'>$jam:$menit</option>";
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
                                    IF($lapangan->num_rows()) 
                                        {
                                            echo "<select class='form-control' id='id_lapangan'>";
                                            echo "<option></option>";
                                            FOREACH($lapangan->result_array() AS $L)
                                                {
                                                    echo "<option value='$L[id_lapangan]'>$L[lapangan]</option>";
                                                }
                                            echo "</select>";
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Pemain Tim A</td>
                                <td>
                                    <?php 
                                    $_POST['id_kontingen'] = $R['id_kontingen_tim_A'];
                                    $_POST['beregu'] = $R['beregu'];
                                    $pemain = $this->Model_admin->model_data_babak_penyisihan_pemain($_POST);
                                    IF($pemain->num_rows()) 
                                        {
                                            echo "<select class='form-control' id='nama_pemain_tim_A'>";
                                            echo "<option></option>";
                                            FOREACH($pemain->result_array() AS $P)
                                                {
                                                    echo "<option value='$P[nama]'>$P[nama]</option>";
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
                                    IF($pemain->num_rows()) 
                                        {
                                            echo "<select class='form-control' id='nama_pemain_tim_B'>";
                                            echo "<option></option>";
                                            FOREACH($pemain->result_array() AS $P)
                                                {
                                                    echo "<option value='$P[nama]'>$P[nama]</option>";
                                                }
                                            echo "</select>";
                                        }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="row text-center mx-4 mt-3">
                        <div class="col-lg-12">
                            <button id="btn-simpan" type='submit' class="btn btn-outline-success btn-rounded"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $("#form_konten").submit(function(e) {
        e.preventDefault();
        $("#btn-simpan").html('<i class="fa fa-spinner fa-spin"></i> Sedang Memproses Data');
        var form_data = new FormData(this);
        $.ajax({
            url: "<?php echo base_url(); ?>admin/form_data_pemain_simpan",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(html) {
                if (html.status !== true) {
                    location.reload();
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Simpan Data Berhasil',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    $("body").scrollTop('0px');
                    $("#konten").fadeOut(300);
                    $("#konten").html(html.konten_menu);
                    $("#konten").fadeIn(300);

                }
            }
        });
    });

    // tinyMCE.EditorManager.execCommand('mceAddEditor',true, '.mymce'); 
</script>