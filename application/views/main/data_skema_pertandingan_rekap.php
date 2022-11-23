<?php
$satker = $this->Model_main->model_tmst_satker();
if ($satker->num_rows()) {
    $option = "<option></option>";
    foreach ($satker->result_array() as $S) {
        $option .= "<option value='$S[IdSatker]'>$S[nama_satker_singkat]</option>";
    }
}

if ($_POST['beregu'] == "putra") $jumlah = 32;
else $jumlah = 16;

$K[0] = "B";
$K[1] = "A";

echo "<div class='row'>";
echo "<table id='table' class='table table-success table-bordered'>";
$b = 1;
$c = 1;
$d = 1;
$e = 1;
if ($jumlah == 32) echo "<tr><td>Per-32</td><td>Per-16</td><td>Per-8</td><td>Semi Final</td><td>Final</td><td>Pemenang</td></tr>";
if ($jumlah == 16) echo "<tr><td>Per-16</td><td>Per-8</td><td>Semi Final</td><td>Final</td><td>Pemenang</td></tr>";

for ($a = 1; $a <= $jumlah; $a++) {

    echo "<tr>";
    $per    = $jumlah / 2;
    $urutan = CEIL($a / 2);
    $tim    = $K[$a % 2];
    echo "<td>$a. <span id='C-$per-$urutan-$tim'>--Belum ditentukan--</span></td>";

    $per    = $jumlah / 4;
    $urutan = CEIL($a / 4);
    if ($a % 2 == 1) {
        if (!isset($t[$per])) $t[$per] = 0;
        $t[$per]++;
        $tim    = $K[$t[$per] % 2];
        echo "<td rowspan='2' style='vertical-align: middle;'>$b. <span id='C-$per-$urutan-$tim'>--Belum ditentukan--</span></td>";
        $b++;
    }

    $per    = $jumlah / 8;
    $urutan = CEIL($a / 8);
    if ($a % 4 == 1) {
        if (!isset($t[$per])) $t[$per] = 0;
        $t[$per]++;
        $tim    = $K[$t[$per] % 2];
        echo "<td rowspan='4' style='vertical-align: middle;'>$c. <span id='C-$per-$urutan-$tim'>--Belum ditentukan--</span></td>";
        $c++;
    }

    $per    = $jumlah / 16;
    $urutan = CEIL($a / 16);
    if ($a % 8 == 1) {
        if (!isset($t[$per])) $t[$per] = 0;
        $t[$per]++;
        $tim    = $K[$t[$per] % 2];
        echo "<td rowspan='8' style='vertical-align: middle;'>$d. <span id='C-$per-$urutan-$tim'>--Belum ditentukan--</span></td>";
        $d++;
    }

    $per    = $jumlah / 32;
    $urutan = CEIL($a / 32);
    if ($a % 16 == 1) {
        if (!isset($t[$per])) $t[$per] = 0;
        $t[$per]++;
        $tim    = $K[$t[$per] % 2];
        echo "<td rowspan='16' style='vertical-align: middle;'>$e. <span id='C-$per-$urutan-$tim'>--Belum ditentukan--</span></td>";
        $e++;
    }

    $per    = $jumlah / 64;
    $urutan = CEIL($a / 64);
    if ($a % 32 == 1) {
        if (!isset($t[$per])) $t[$per] = 0;
        $t[$per]++;
        $tim    = $K[$t[$per] % 2];
        echo "<td rowspan='32' style='vertical-align: middle;'>$a. <span id='C-$per-$urutan-$tim'>--Belum ditentukan--</span></td>";
    }

    echo "</tr>";
}
echo "</table>";

function pemenang($jumlah)
{
    return "<td rowspan='$jumlah'>xxx</td>";
}


$skema = $this->Model_main->model_data_skema($_POST);
if ($skema->num_rows()) {
    foreach ($skema->result_array() as $R) {
        $per = $R['per'];
        $urutan = $R['urutan'];
        $satkerA = '--Belum ditentukan--';
        $satkerB = '--Belum ditentukan--';
        if ($R['id_kontingen_tim_A']) {
            $satkerA = $R['satker_A'];
        }
        if ($R['id_kontingen_tim_B']) {
            $satkerB = $R['satker_B'];
        }
        echo "<script>
                $('#C-$per-$urutan-A').text('$satkerA');
                $('#C-$per-$urutan-B').text('$satkerB');
            </script>";
    }
}
