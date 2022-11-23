<?php
$satker = $this->Model_admin->model_tmst_satker();
if ($satker->num_rows()) {
    $option = "<option></option>";
    foreach ($satker->result_array() as $S) {
        $option .= "<option value='$S[IdSatker]'>$S[NamaSatker]</option>";
    }
}
$jumlah_putra = 16;
echo "<table border='1' width='100%'>";
FOR($a=1;$a <= $jumlah_putra * 2; $a++)
    {
        echo "<tr>";
        echo "<td><select class='form-control id_kontingen'>$option</select></td>";
            IF($a % 2 == 1) echo "<td rowspan='2'><select class='form-control id_kontingen'>$option</select></td>";
                IF($a % 4 == 1) echo "<td rowspan='4'><select class='form-control id_kontingen'>$option</select></td>";
                    IF($a % 8 == 1) echo "<td rowspan='8'><select class='form-control id_kontingen'>$option</select></td>";
                        IF($a % 16 == 1) echo "<td rowspan='16'><select class='form-control id_kontingen'>$option</select></td>";
                            IF($a % 32 == 1) echo "<td rowspan='32'><select class='form-control id_kontingen'>$option</select></td>";
        echo "</tr>";
    }
echo "</table>";
?>