<?php
$satker = $this->Model_main->model_tmst_satker();
if ($satker->num_rows()) {
    $option = "<option></option>";
    foreach ($satker->result_array() as $S) {
        $option .= "<option value='$S[IdSatker]'>$S[nama_satker_singkat]</option>";
    }
}

if ($_POST['beregu'] == "putra") $jumlah = 32;
if ($_POST['beregu'] == "putri") $jumlah = 16;
if ($_POST['beregu'] == "veteran") $jumlah = 32;

$K[0] = "B";
$K[1] = "A";

echo "<h3 class='tx-uppercase'>Babak Final " . $_POST['beregu'] . "</h3>";
echo "<table id='table' class='table table-bordered table-striped'>";
$b = 1;
$c = 1;
$d = 1;
$e = 1;
if ($jumlah == 32) echo "<tr class='bg-primary text-white tx-bold tx-uppercase tx-center'><td>Per-16</td><td>Per-8</td><td>Per-4</td><td>Semi Final</td><td>Final</td><td>Pemenang</td></tr>";
if ($jumlah == 16) echo "<tr class='bg-primary text-white tx-bold tx-uppercase tx-center'><td>Per-8</td><td>Per-4</td><td>Semi Final</td><td>Final</td><td>Pemenang</td></tr>";

for ($a = 1; $a <= $jumlah; $a++) {

    echo "<tr>";
    $per    = $jumlah / 2;
    $urutan = CEIL($a / 2);
    $tim    = $K[$a % 2];
    echo "<td><span id='C-$per-$urutan-$tim'><i class='badge badge-danger tx-bold'>Umpire</i></span></td>";

    $per    = $jumlah / 4;
    $urutan = CEIL($a / 4);
    if ($a % 2 == 1) {
        if (!isset($t[$per])) $t[$per] = 0;
        $t[$per]++;
        $tim    = $K[$t[$per] % 2];
        echo "<td rowspan='2' style='vertical-align: middle;width:16.67%;' class='bg-light'><span class='' id='C-$per-$urutan-$tim'><i class='badge badge-danger tx-bold'>Umpire</i></span></td>";
        $b++;
    }

    $per    = $jumlah / 8;
    $urutan = CEIL($a / 8);
    if ($a % 4 == 1) {
        if (!isset($t[$per])) $t[$per] = 0;
        $t[$per]++;
        $tim    = $K[$t[$per] % 2];
        echo "<td rowspan='4' style='vertical-align: middle;width:16.67%;'><span class='d-flex justify-content-between align-items-center' id='C-$per-$urutan-$tim'><i class='badge badge-danger tx-bold'>Umpire</i></span></td>";
        $c++;
    }

    $per    = $jumlah / 16;
    $urutan = CEIL($a / 16);
    if ($a % 8 == 1) {
        if (!isset($t[$per])) $t[$per] = 0;
        $t[$per]++;
        $tim    = $K[$t[$per] % 2];
        echo "<td rowspan='8' style='vertical-align: middle;width:16.67%;'><span class='' id='C-$per-$urutan-$tim'><i class='badge badge-danger tx-bold'>Umpire</i></span></td>";
        $d++;
    }

    $per    = $jumlah / 32;
    $urutan = CEIL($a / 32);
    if ($a % 16 == 1) {
        if (!isset($t[$per])) $t[$per] = 0;
        $t[$per]++;
        $tim    = $K[$t[$per] % 2];
        echo "<td rowspan='16' style='vertical-align: middle;width:16.67%;'><span class='' id='C-$per-$urutan-$tim'><i class='badge badge-danger tx-bold'>Umpire</i></span></td>";
        $e++;
    }

    $per    = $jumlah / 64;
    $urutan = CEIL($a / 64);
    if ($a % 32 == 1) {
        if (!isset($t[$per])) $t[$per] = 0;
        $t[$per]++;
        $tim    = $K[$t[$per] % 2];
        echo "<td rowspan='32' style='vertical-align: middle;width:16.67%;'><span class='d-flex justify-content-between align-items-center' id='C-$per-$urutan-$tim'><i class='badge badge-danger tx-bold'>Umpire</i></span></td>";
    }

    echo "</tr>";
}
echo "</table>";

function pemenang($jumlah)
{
    return "<td rowspan='$jumlah'>xxx</td>";
}

if ($_POST['beregu'] == "veteran") {
    $skema = $this->Model_main->model_data_skema_veteran($_POST);
    if ($skema->num_rows()) {
        foreach ($skema->result_array() as $R) {
            $per = $R['per'];
            $urutan = $R['urutan'];
            $satkerA = "<i class='text-danger'>Umpire</i>";
            $satkerB = "<i class='text-danger'>Umpire</i>";
            if ($R['id_kontingen_tim_A']) {
                $satkerA = '<div class="d-flex justify-content-between align-items-center"><div class="">' . nama_singkat($R['nama_pemain_tim_A']) . '</div><div class="">' . $R['satker_A'] . '</div><div class="">' . $R['set1_tim_A'] . '</div></div>';
            }
            if ($R['id_kontingen_tim_B']) {
                $satkerB = '<div class="d-flex justify-content-between align-items-center"><div class="">' . nama_singkat($R['nama_pemain_tim_B']) . '</div><div class="">' . $R['satker_B'] . '</div><div class="">' . $R['set1_tim_B'] . '</div></div>';
            }
            echo "<script>
                var satkerA = '$satkerA';
                var satkerB = '$satkerB';
                    $('#C-$per-$urutan-A').html(satkerA);
                    $('#C-$per-$urutan-B').html(satkerB);
                </script>";
        }
    }
} else {
    $skema = $this->Model_main->model_data_skema($_POST);
    if ($skema->num_rows()) {
        foreach ($skema->result_array() as $R) {
            $per = $R['per'];
            $urutan = $R['urutan'];
            $satkerA = "<i class='text-danger'>Umpire</i>";
            $satkerB = "<i class='text-danger'>Umpire</i>";
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
}
