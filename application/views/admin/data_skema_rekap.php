<?php
$satker = $this->Model_admin->model_tmst_satker();
if ($satker->num_rows()) {
    $option = "<option></option>";
    foreach ($satker->result_array() as $S) {
        $option .= "<option value='$S[IdSatker]'>$S[nama_satker_singkat]</option>";
    }
}

IF($_POST['beregu'] == "putra") $jumlah = 32; 
IF($_POST['beregu'] == "putri") $jumlah = 16; 
IF($_POST['beregu'] == "veteran") $jumlah = 32; 

echo "<div class='row'>";
echo "<table border='1' width='100%'>";
FOR($a=1;$a <= $jumlah; $a++)
    {
        echo "<tr>";
            $j = $jumlah;
            WHILE($j >= 1)
                { 
                    echo rowspan($option,$a,$jumlah,$j);
                    $j = $j / 2;
                }
        echo "</tr>";
    }
echo "</table>";



function rowspan($option,$a,$jumlah,$peserta)
    {
        $K[0] = "B";
        $K[1] = "A";
        
        $hasil  = "";
        $baris  = $jumlah / $peserta;
        $per    = $peserta / 2;
        $urutan = CEIL($a / ($jumlah / $per));
        
        
        IF(!ISSET($t[$per])) $t[$per] = 0;
        $t[$per]++;
        
        IF($jumlah == $peserta)
            {
                $tim    = $K[$a % 2];
                $hasil .= "<td rowspan='$baris'><select id='C-$per-$urutan-$tim' class='id_kontingen  ' data-per='$per' data-urutan='$urutan' data-tim='$tim'>$option</select><span id='S-$per-$urutan-$tim'></span></td>";
            }
        ELSE IF(($a % $baris) == 1) 
            {
                IF($peserta == 1)
                    {
                        $hasil .= "<td rowspan='$jumlah'><div id='pemenang' class='badge bg-success'>Pemenang</div></td>";
                    }
                    else
                    {
                        $tim = $K[(CEIL($a / $baris) % 2)];
                        $hasil .= "<td rowspan='$baris'><select id='C-$per-$urutan-$tim' class='id_kontingen  ' data-per='$per' data-urutan='$urutan' data-tim='$tim'>$option</select><span id='S-$per-$urutan-$tim'></td>";
                    }
            }
        return $hasil;
    }


$skema = $this->Model_admin->model_data_skema($_POST);
if ($skema->num_rows()) {
    $option = "<option></option>";
    foreach ($skema->result_array() as $R) {
        $per = $R['per'];
        $urutan = $R['urutan'];
        $id_kontingen_tim_A = $R['id_kontingen_tim_A'];
        $id_kontingen_tim_B = $R['id_kontingen_tim_B'];

        echo "<script>
                $('#C-$per-$urutan-A').val('$id_kontingen_tim_A');
                $('#C-$per-$urutan-B').val('$id_kontingen_tim_B');
            </script>";
    }
}

$final = $this->Model_admin->model_data_babak_final_rekap($_POST);
if ($final->num_rows()) {
    // PRINT_R($final->result_array());
    $option = "<option></option>";
    foreach ($final->result_array() as $R) {
        $per = $R['per'];
        $urutan = $R['urutan'];
        
        IF(!ISSET($S[$per][$urutan]['A'])) $S[$per][$urutan]['A'] = 0;
        IF(!ISSET($S[$per][$urutan]['B'])) $S[$per][$urutan]['B'] = 0;

        IF($R['set1_tim_A'] >= '8') $S[$per][$urutan]['A']++; 
        IF($R['set1_tim_B'] >= '8') $S[$per][$urutan]['B']++; 

        echo "<script>
                $('#S-$per-$urutan-A').text('".$S[$per][$urutan]['A']."');
                $('#S-$per-$urutan-B').text('".$S[$per][$urutan]['B']."');
            </script>";
    }
}
?>
<style>
    .select2{
        /* width:100% !important; */
        /* width:250px; */
    }
    .id_kontingen{
        width:100%;
    }
</style>
<script>
    $(".select2").select2();

    $(".id_kontingen").on('change', function() {
        // alert($(this).data('tim'));skip();
        var form_data = new FormData();
        form_data.append('id_event', $("#list_event").val());
        form_data.append('beregu', "<?php echo $_POST['beregu']; ?>");
        form_data.append('per', $(this).data('per'));
        form_data.append('urutan', $(this).data('urutan'));
        form_data.append('id_kontingen_tim_'+$(this).data('tim'), $(this).val());

        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_skema_simpan",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(json) {
                if (json.status !== true) {
                    alert('Tidak Berhasil Di Input... !!!');
                }
            }
        });
    });
</script>