<?php 
// PRINT_R($_POST);
$rekap = $this->Model_admin->model_tmst_satker();
if ($rekap->num_rows()) {
    $no=0;
    $p=1;
    $jk=0;
    foreach ($rekap->result_array() as $R) {
       
        IF($jk >= $_POST['jumlah_kontingen'])
        {
            $jk=0;
            $p++;
            echo "<br>";
        }
        ELSE
            {
                $no++;
                $jk++;
               
               
                echo $no.". ";
                echo pool($p)." : ";
                echo "$jk : ";
                echo "$R[NamaSatker]<br>";
            }
    }
}
?>