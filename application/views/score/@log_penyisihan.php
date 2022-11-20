<?php 
$get_point_and_game = $this->Model_score->get_point_and_game($jenis, $id_pertandingan);
if ($get_point_and_game->num_rows()) {
    echo "<table border='1' width='100%'>";
    FOREACH($get_point_and_game->result_array() AS $R)
        {
            IF($R['point_tim_A'] == "Game") $bg_A = 'bg-success'; ELSE $bg_A = '';
            IF($R['point_tim_B'] == "Game") $bg_B = 'bg-success'; ELSE $bg_B = '';
            echo "
                    <tr>
                        <td>Game Ke: $R[game]</td>
                        <td class='text-right $bg_A'>$R[point_tim_A]</td>
                        <td class='text-right $bg_B'>$R[point_tim_B]</td>
                    </tr>
                ";
        }
    echo "</table>";
}
?>