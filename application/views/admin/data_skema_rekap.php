<?php
$satker = $this->Model_admin->model_tmst_satker();
if ($satker->num_rows()) {
    $option = "<option></option>";
    foreach ($satker->result_array() as $S) {
        $option .= "<option value='$S[IdSatker]'>$S[nama_satker_singkat]</option>";
    }
}

IF($_POST['beregu'] == "putra") $jumlah = 32; ELSE $jumlah = 16; 

$K[0] = "B";
$K[1] = "A";

echo "<div class='row'>";
echo "<table border='1' width='100%'>";
FOR($a=1;$a <= $jumlah; $a++)
    {
        
        echo "<tr>";
            $per    = 16; 
            $urutan = CEIL($a / 2);
            $tim    = $K[$a % 2];
                            echo "<td><select               id='C-$per-$urutan-$tim' class='id_kontingen ' data-per='$per' data-urutan='$urutan' data-tim='$tim'>$option</select></td>";

            $per    = 8; 
            $urutan = CEIL($a / 4);
            IF($a % 2 == 1) 
                {
                    IF(!ISSET($t[$per])) $t[$per] = 0;
                    $t[$per]++;
                    $tim    = $K[$t[$per] % 2];
                    echo "<td rowspan='2'  ><select id='C-$per-$urutan-$tim' class='id_kontingen  ' data-per='$per' data-urutan='$urutan' data-tim='$tim'>$option</select></td>";
                }

            $per    = 4; 
            $urutan = CEIL($a / 8);
            IF($a % 4 == 1) 
                {
                    IF(!ISSET($t[$per])) $t[$per] = 0;
                    $t[$per]++;
                    $tim    = $K[$t[$per] % 2];
                    echo "<td rowspan='4'  ><select id='C-$per-$urutan-$tim' class='id_kontingen  ' data-per='$per' data-urutan='$urutan' data-tim='$tim'>$option</select></td>";
                }

            $per    = 2; 
            $urutan = CEIL($a / 16);
            IF($a % 8 == 1) 
                {
                    IF(!ISSET($t[$per])) $t[$per] = 0;
                    $t[$per]++;
                    $tim    = $K[$t[$per] % 2];
                    echo "<td rowspan='8'  ><select id='C-$per-$urutan-$tim' class='id_kontingen  ' data-per='$per' data-urutan='$urutan' data-tim='$tim'>$option</select></td>";
                }

            $per    = 1; 
            $urutan = CEIL($a / 32);
            IF($a % 16 == 1) 
                {
                    IF(!ISSET($t[$per])) $t[$per] = 0;
                    $t[$per]++;
                    $tim    = $K[$t[$per] % 2];
                    echo "<td rowspan='16'><select id='C-$per-$urutan-$tim' class='id_kontingen  ' data-per='$per' data-urutan='$urutan' data-tim='$tim'>$option</select></td>";
                }

            $per    = 0; 
            $urutan = CEIL($a / 64);
            IF($a % 32 == 1) 
                {
                    IF(!ISSET($t[$per])) $t[$per] = 0;
                    $t[$per]++;
                    $tim    = $K[$t[$per] % 2];
                    IF($a % 32 == 1) echo "<td rowspan='32'><select id='C-$per-$urutan-$tim' class='id_kontingen  ' data-per='$per' data-urutan='$urutan' data-tim='$tim'>$option</select></td>";
                }
        echo "</tr>";
    }
echo "</table>";


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