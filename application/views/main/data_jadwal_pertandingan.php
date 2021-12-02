<div class="content content-fixed">
	<div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
		<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
			<div>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb breadcrumb-style1 mg-b-10">
						<li class="breadcrumb-item"><a href="#">Pertandingan</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo $judul; ?></li>
					</ol>
				</nav>
				<h4>TURNAMEN TENIS PERORANGAN PIALA KMA 2021</h4>
			</div>
		</div>
	</div>
	<div class="container">
		<?php
		$data 	= $this->Model_main->model_data_jadwal_pertandingan_babak_penyisihan();
		if (COUNT($data->result_array())) {
			$no = 0;
		?>
			<div class="card bd">
				<div class="card-body">
					<div class="card-title">
						<h4>Babak Penyisihan</h4>
						<div class="table-responsive pd-5">
							<table id="datatable-babak-penyisihan" class="table table-striped table-primary">
								<thead>
									<tr class="text-center">
										<td>No</td>
										<td>Tanggal</td>
										<td>Waktu</td>
										<td>Kategori</td>
										<td>Pool</td>
										<td>Urutan</td>
										<td>Lapangan</td>
										<td>Nama Tim A</td>
										<td>Nama Tim B</td>
										<td>Score Tim A</td>
										<td>Score Tim B</td>
									</tr>
								</thead>
								<?php
								foreach ($data->result_array() as $R) {
									$no++;
								?>
									<tr>
										<td class="text-center align-middle"><?php echo $no; ?></td>
										<td class="text-center align-middle"><?php echo format_tanggal('wddmmmmyyyy', $R['tanggal']); ?></td>
										<td class="text-center align-middle"><?php echo $R['waktu']; ?></td>
										<td class="text-center align-middle"><?php echo $R['kategori']; ?></td>
										<td class="text-center align-middle"><?php echo $R['pool']; ?></td>
										<td class="text-center align-middle"><?php echo $R['urutan']; ?></td>
										<td class="text-center align-middle"><?php echo $R['lapangan']; ?></td>
										<td class="text-center align-middle"><?php echo $R['nama_tim_A']; ?></td>
										<td class="text-center align-middle"><?php echo $R['nama_tim_B']; ?></td>
										<td class="text-center align-middle"><?php echo $R['set1_tim_A']; ?></td>
										<td class="text-center align-middle"><?php echo $R['set1_tim_B']; ?></td>
									</tr>
								<?php
								}
								?>
							</table>
						</div>
					</div>
				</div>
			</div>
			<br>
		<?php
		}

		$data 	= $this->Model_main->model_data_jadwal_pertandingan_babak_final();
		if (COUNT($data->result_array())) {
			$no = 0;
		?>
			<div class="card bd">
				<div class="card-body">
					<div class="card-title">
						<h4>Babak Final</h4>
						<div class="table-responsive pd-5">
							<table id="datatable-babak-final" class="table table-striped table-primary">
								<thead>
									<tr class="text-center">
										<td>No</td>
										<td>Tanggal</td>
										<td>Waktu</td>
										<td>Kategori</td>
										<td>Per Final</td>
										<td>Urutan</td>
										<td>Lapangan</td>
										<td>Nama Tim A</td>
										<td>Nama Tim B</td>
										<td>Score Tim A</td>
										<td>Score Tim B</td>
									</tr>
								</thead>
								<?php
								foreach ($data->result_array() as $R) {
									$no++;
								?>
									<tr>
										<td class="text-center align-middle"><?php echo $no; ?></td>
										<td class="text-center align-middle"><?php echo format_tanggal('wddmmmmyyyy', $R['tanggal']); ?></td>
										<td class="text-center align-middle"><?php echo $R['waktu']; ?></td>
										<td class="text-center align-middle"><?php echo $R['kategori']; ?></td>
										<td class="text-center align-middle"><?php echo $R['per']; ?></td>
										<td class="text-center align-middle"><?php echo $R['urutan']; ?></td>
										<td class="text-center align-middle"><?php echo $R['lapangan']; ?></td>
										<td class="text-center align-middle"><?php echo $R['nama_tim_A']; ?></td>
										<td class="text-center align-middle"><?php echo $R['nama_tim_B']; ?></td>
										<td class="text-center align-middle"><?php echo $R['set1_tim_A']; ?></td>
										<td class="text-center align-middle"><?php echo $R['set1_tim_B']; ?></td>
									</tr>
								<?php
								}
								?>
							</table>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
		?>
	</div>

</div>
<script>
	$('#datatable-babak-penyisihan').DataTable({
		language: {
			searchPlaceholder: 'Pencarian...',
			sSearch: '',
			lengthMenu: '_MENU_ Pemain/Halaman',
		}
	});
	$('#datatable-babak-final').DataTable({
		language: {
			searchPlaceholder: 'Pencarian...',
			sSearch: '',
			lengthMenu: '_MENU_ Pemain/Halaman',
		}
	});
</script>