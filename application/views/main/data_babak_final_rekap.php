<?php
$data 	= $this->Model_main->model_data_babak_final($_POST['id_kategori'],$_POST['per']);
if (COUNT($data->result_array())) {
	$no = 0;
	?>
	<table border='1' width='100%'>
		<tr>
			<td>No</td>
			<td>Tim A</td>
			<td>Tim B</td>
			<td>Tanggal</td>
			<td>Waktu</td>
			<td>Lapangan</td>
		</tr>
		<?php
			foreach ($data->result_array() as $R) {
			$no++;
			?>
			<tr>
				<td><?php echo $R['urutan']; ?></td>
				<td>
					<?php echo $R['nama_tim_A']; ?><br>
					<?php echo $R['set1_tim_A']; ?>
				</td>
				<td>
					<?php echo $R['nama_tim_B']; ?><br>
					<?php echo $R['set1_tim_B']; ?>
				</td>
				<td><?php echo $R['tanggal']; ?></td>
				<td><?php echo $R['waktu']; ?></td>
				<td><?php echo $R['lapangan']; ?></td>
			</tr>
			<?php
			}
		?>
	</table>
	
	<?php 
}
?>