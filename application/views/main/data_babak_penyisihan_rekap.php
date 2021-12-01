<?php
for ($h = 1; $h <= 26; $h++) {
	if (isset($_POST['pool']) and $_POST['pool'] != MD7("0")) {
		$data 	= $this->Model_main->model_data_babak_penyisihan($_POST['id_kategori'], $_POST['pool']);
	} else {
		$data 	= $this->Model_main->model_data_babak_penyisihan($_POST['id_kategori'], MD7(pool($h)));
	}

	if (COUNT($data->result_array())) {
		$no = 0;
?>
		<h4 id='nama_pool'></h4>
		<script>
			$("#nama_pool").html($("#pool option:selected").text());
		</script>
		<table class="table table-bordered">

			<tr>
				<td>No</td>
				<td>Nama</td>
				<?php
				$jumlah_pemain_pool = 0;
				foreach ($data->result_array() as $R) {
					$jumlah_pemain_pool++;
					// echo "v".$jumlah_pemain_pool." = ".$R['id_tim_A'];
					$id_tim_B[$jumlah_pemain_pool] = $R['id_tim_A'];
					echo "<td class='ht-50' colspan='1'>$R[nama_tim_A]</td>";
				}
				?>
				<td>Match</td>
				<td>Win</td>
				<td>Lost</td>
				<td colspan="3">Games</td>
				<td>Rank</td>
			</tr>


			<?php
			$rank = array();
			foreach ($data->result_array() as $R) {
				$no++;
				$win_set	= 0;
				$lost_set 	= 0;

				$win_game	= 0;
				$lost_game	= 0;
				$persentase	= 0;

				$kolom_score_A = "";
				$kolom_score_B = "";

				for ($jpp = 1; $jpp <= $jumlah_pemain_pool; $jpp++) {
					if ($jpp == $R['urutan'])
						$kolom_score_A .= "<td rowspan='2' colspan='1' class='bg-primary'></td>";
					else {
						$get_score_A[$jpp] = $this->Model_main->model_data_babak_penyisihan_get_score($R['id_kategori'], $R['pool'], $R['id_tim_A'], $id_tim_B[$jpp]);
						// echo "<td>$R[id_tim_A],".($id_tim_B[$jpp])." = $get_score_A[$jpp]</td>";
						$win_game += $get_score_A[$jpp];
						$kolom_score_A .= "<td class='text-center'>$get_score_A[$jpp]</td>";
					}
				}

				for ($jpp = 1; $jpp <= $jumlah_pemain_pool; $jpp++) {
					$get_score_B[$jpp] = $this->Model_main->model_data_babak_penyisihan_get_score($R['id_kategori'], $R['pool'], $id_tim_B[$jpp], $R['id_tim_A']);
					if ($jpp != $R['urutan']) {
						// echo "<td>$id_tim_B[$jpp],$R[id_tim_A] = $get_score_B[$jpp]</td>";
						$lost_game += $get_score_B[$jpp];
						$kolom_score_B .= "<td class='text-center'>$get_score_B[$jpp]</td>";
					}
				}

				for ($jpp = 1; $jpp <= $jumlah_pemain_pool; $jpp++) {
					if ($jpp != $R['urutan'] and $get_score_A[$jpp] > $get_score_B[$jpp]) $win_set++;
					if ($jpp != $R['urutan'] and $get_score_A[$jpp] < $get_score_B[$jpp]) $lost_set++;
				}

				if (($win_game + $lost_game) > 0) $persentase = ROUND(($win_game / ($win_game + $lost_game)) * 100, 2);
				$rank[$no] 	= $persentase;
			?>
				<tr>
					<td class="text-center align-middle" rowspan="2"><?php echo $R['urutan']; ?></td>
					<td class="align-middle" rowspan="2"><?php echo $R['nama_tim_A']; ?></td>
					<?php echo $kolom_score_A; ?>
					<td class="text-center align-middle" rowspan="2"><?php echo $jumlah_pemain_pool - 1; ?></td>
					<td class="text-center align-middle" rowspan="2"><?php echo $win_set; ?></td>
					<td class="text-center align-middle" rowspan="2"><?php echo $lost_set; ?></td>
					<td>Win</td>
					<td><?php echo $win_game; ?></td>
					<td class="text-center align-middle" rowspan="2"><?php echo $persentase; ?>%</td>
					<td class="text-center align-middle" rowspan="2">
						<div id='rank_<?php echo $R['pool']; ?>_<?php echo $no; ?>'></div>
					</td>
				</tr>
				<tr>
					<?php echo $kolom_score_B; ?>
					<td>Lost</td>
					<td><?php echo $lost_game; ?></td>
				</tr>
			<?php
			}
			?>
		</table>
		<br>
		<?php ASORT($rank); ?>
		<?php
		$i = 0;
		foreach ($rank as $key => $value) {
			$i++;
			if (($win_game + $lost_game) > 0) echo "<script>$('#rank_$R[pool]_$i').html(" . (($no - $key) + 1) . ");</script>";
		}
		?>
		<?php // PRINT_R($rank); 
		?>
<?php
	}
	if (isset($_POST['pool']) and $_POST['pool'] != MD7("0")) break; //Kalo Cuma 1 dari post di brek, biar gak looping
}
?>