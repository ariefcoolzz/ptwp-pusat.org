<?php
$data 	= $this->Model_main->model_data_babak_final($_POST['id_kategori'], $_POST['per']);
if (COUNT($data->result_array())) {
	$no = 0;
?>
	<table class="table table-striped table-primary">
		<thead>
			<tr>
				<td>No</td>
				<td class="text-center" colspan="6">Pertandingan</td>
			</tr>
		</thead>
		<?php
		foreach ($data->result_array() as $R) {
			$no++;
		?>
			<tr>
				<td class="align-middle"><?php echo $R['urutan']; ?></td>
				<td class="align-middle">
					<ul class="list-group list-group-flush tx-13">
						<li class="list-group-item d-flex pd-sm-x-20">
							<div class="img-group">
								<img src="<?php echo base_url() ?>assets/img/default.png" class="img wd-60 ht-60 rounded-circle" alt="">
							</div>
							<div class="pd-20">
								<p class="tx-medium mg-b-0"><?php echo $R['nama_tim_A']; ?></p>
							</div>
							<div class="mg-l-auto d-flex align-self-center">
								<nav class="nav nav-icon-only">
									<a class="nav-link"><?php echo $R['set1_tim_A']; ?></a>
								</nav>
							</div>
						</li>
					</ul>
				</td>
				<td class="text-center">
					<a class="tx-bold">VS</a>
					<br><?php echo format_tanggal('wddmmmmyyyy', $R['tanggal']); ?>
					<br><?php echo $R['waktu']; ?>
					<br>
					<h6 class="badge badge-primary">Lapangan <?php echo $R['lapangan']; ?></h6>
				</td>
				<td class="align-middle text-right">
					<ul class="list-group list-group-flush tx-13">
						<li class="list-group-item d-flex pd-sm-x-20">
							<div class="img-group">
								<img src="<?php echo base_url() ?>assets/img/default.png" class="img wd-60 ht-60 rounded-circle" alt="">
							</div>
							<div class="pd-20">
								<p class="tx-medium mg-b-0"><?php echo $R['nama_tim_B']; ?></p>
							</div>
							<div class="mg-l-auto d-flex align-self-center">
								<nav class="nav nav-icon-only">
									<a class="nav-link"><?php echo $R['set1_tim_B']; ?></a>
								</nav>
							</div>
						</li>
					</ul>
				</td>

			</tr>
		<?php
		}
		?>
	</table>

<?php
}
?>