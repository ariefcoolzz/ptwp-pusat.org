	<table>
		<tr align='center'>
			<th>Set</th>
			<th>Point Tim A</th>
			<th>Point Tim B</th>
		</tr>
		<?php
		$score_A = 0;
		$score_B = 0;
		$data 	= $this->Model_main->model_data_pertandingan_point($id_data_point);
		if (COUNT($data->result_array())) {
			$no = 0;
			foreach ($data->result_array() as $R) {
				$no++;
				IF($R['id_point_tim_A'] == 5) $score_A++; 
				IF($R['id_point_tim_B'] == 5) $score_B++; 
				?>
				<tr align='center'>
					<td class="p-1"><?php echo $R['set']; ?></td>
					<td class="p-1"><?php echo $R['point_tim_A']; ?></td>
					<td class="p-1"><?php echo $R['point_tim_B']; ?></td>
				</tr>
				<?php
			}
		}
		?>
		<tr align='center'>
			<th>Score</th>
			<th><?php echo $score_A; ?></th>
			<th><?php echo $score_B; ?></th>
		</tr>
	</table>
</div>