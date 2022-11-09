
<?php
$no = 1;
$rekap = $this->Model_admin->model_pool_rekap();
if ($rekap->num_rows()) {
    foreach ($rekap->result_array() as $R) {

        echo "
                $R[pool]<br>
                $R[urutan]<br>
                $R[nama_kontingen]<br>
            ";
    }
}
?>
      