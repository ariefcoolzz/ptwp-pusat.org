<?php
$data 	= $this->Model_main->model_data_babak_penyisihan($_POST['id_kategori'],$_POST['pool']);
if (COUNT($data->result_array())) {
	$no = 0;
	?>
	<table border='1' width='100%'>
	
			<tr>
				<td>No</td>
				<td>Nama</td>
				<?php 
				$jumlah_pemain_pool = 0;
				foreach ($data->result_array() as $R) {
					$jumlah_pemain_pool++;
					// echo "v".$jumlah_pemain_pool." = ".$R['id_tim_A'];
					$id_tim_B[$jumlah_pemain_pool] = $R['id_tim_A'];
					echo "<td colspan='1'>$R[nama_tim_A]</td>";
				}
				?>
				<td>Match</td>
				<td>Win</td>
				<td>Lost</td>
				<td colspan="3">Games</td>
				<td>Rank</td>
			</tr>
	
		
			<?php
				$rank = ARRAY();
				foreach ($data->result_array() as $R) {
				$no++;
				$win_set	= 0;
				$lose_set 	= 0;
				
				$win_game	= 0;
				$lose_game	= 0;
				
				$kolom_score_A = "";
				$kolom_score_B = "";
				
				FOR($jpp=1;$jpp<=$jumlah_pemain_pool;$jpp++)
					{
						IF($jpp == $R['urutan'])
							$kolom_score_A .= "<td rowspan='2' colspan='1' class='bg-primary'></td>";
						ELSE
							{
								$get_score_A[$jpp] = $this->Model_main->model_data_babak_penyisihan_get_score($R['id_kategori'],$R['pool'],$R['id_tim_A'],$id_tim_B[$jpp]);
								// echo "<td>$R[id_tim_A],".($id_tim_B[$jpp])." = $get_score_A[$jpp]</td>";
								$win_game += $get_score_A[$jpp];
								$kolom_score_A .= "<td>$get_score_A[$jpp]</td>";
							}
					}
					
				FOR($jpp=1;$jpp<=$jumlah_pemain_pool;$jpp++)
					{
						$get_score_B[$jpp] = $this->Model_main->model_data_babak_penyisihan_get_score($R['id_kategori'],$R['pool'],$id_tim_B[$jpp],$R['id_tim_A']);
						IF($jpp != $R['urutan']) 
							{
								// echo "<td>$id_tim_B[$jpp],$R[id_tim_A] = $get_score_B[$jpp]</td>";
								$lose_game += $get_score_B[$jpp];
								$kolom_score_B .= "<td>$get_score_B[$jpp]</td>";
							}
					}
				
				FOR($jpp=1;$jpp<=$jumlah_pemain_pool;$jpp++)
					{				
						IF($jpp != $R['urutan'] AND $get_score_A[$jpp] > $get_score_B[$jpp]) $win_set++;	
						IF($jpp != $R['urutan'] AND $get_score_A[$jpp] < $get_score_B[$jpp]) $lose_set++;	
					}
				
				$persentase = ROUND(($win_game / ($win_game+$lose_game)) * 100, 2);
				$rank[$no] 	= $persentase;
					?>
					<tr>
						<td rowspan="2"><?php echo $R['urutan']; ?></td>
						<td rowspan="2"><?php echo $R['nama_tim_A']; ?></td>
						<?php echo $kolom_score_A; ?>
						<td rowspan="2"><?php echo $jumlah_pemain_pool-1; ?></td>
						<td rowspan="2"><?php echo $win_set; ?></td>
						<td rowspan="2"><?php echo $lose_set; ?></td>
						<td>Win</td>
						<td><?php echo $win_game; ?></td>
						<td rowspan="2"><?php echo $persentase; ?>%</td>
						<td rowspan="2"><div id='rank<?php echo $no; ?>'>iii</div></td>
					</tr>
					<tr>
						<?php echo $kolom_score_B; ?>
						<td>Lose</td>
						<td><?php echo $lose_game; ?></td>
					</tr>
					<?php
				}
			?>
	</table>
	<?php ASORT($rank); ?>
	<?php 
	$i=0;
	foreach($rank as $key => $value) 
		{
			$i++;
			echo "<script>$('#rank$i').html(".(($no-$key)+1).");</script>";
		}
	?>
	<?php // PRINT_R($rank); ?>
	<?php 
}
?>