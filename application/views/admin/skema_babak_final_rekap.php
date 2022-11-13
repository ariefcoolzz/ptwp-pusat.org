Rombak DB nya dulu... Sesuaikan Event 2
<br>
<table border='1' width='100%'>
<?php 
    $jk = 16; //jk = jumlah kontingen
    FOR($a=1;$a<=$jk;$a++)
        {
            echo "<tr>";
                echo "<td>per 8</td>";
                    IF($a % 2 == 1) echo "<td rowspan='2'>per 4</td>";
                        IF($a % 4 == 1) echo "<td rowspan='4'>semi final</td>";
                            IF($a % 8 == 1) echo "<td rowspan='8'>final</td>";
                                IF($a % 16 == 1) echo "<td rowspan='16'>Juara</td>";
            echo "</tr>";
        }    
?>
</table>