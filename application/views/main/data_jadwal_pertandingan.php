<div class="content content-fixed">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-style1 mg-b-0">
			<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Beranda</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?php echo $judul; ?></li>
		</ol>
	</nav>
	<hr class="mg-y-40">
	<h4 id="section1" class="mg-b-10">DATA PEMAIN TOURNAMEN KETUA MA PTWP</h4>
	<?php
	$data 	= $this->Model_main->model_data_jadwal_pertandingan_babak_penyisihan();
	if (COUNT($data->result_array())) {
		$no = 0;
		?>
		Babak Penyisihan
		<table class="table table-bordered">
			<tr>
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
			<?php
			foreach ($data->result_array() as $R) {
				$no++;
				?>
				<tr>
					<td class="text-center align-middle"><?php echo $no; ?></td>
					<td class="text-center align-middle"><?php echo format_tanggal('wddmmmmyyyy',$R['tanggal']); ?></td>
					<td class="align-middle"><?php echo $R['waktu']; ?></td>
					<td class="align-middle"><?php echo $R['kategori']; ?></td>
					<td class="align-middle"><?php echo $R['pool']; ?></td>
					<td class="align-middle"><?php echo $R['urutan']; ?></td>
					<td class="align-middle"><?php echo $R['lapangan']; ?></td>
					<td class="align-middle"><?php echo $R['nama_tim_A']; ?></td>
					<td class="align-middle"><?php echo $R['nama_tim_B']; ?></td>
					<td class="align-middle"><?php echo $R['set1_tim_A']; ?></td>
					<td class="align-middle"><?php echo $R['set1_tim_B']; ?></td>
				</tr>
			<?php
			}
			?>
		</table>
		<br>
		<?php
	}
	
	$data 	= $this->Model_main->model_data_jadwal_pertandingan_babak_final();
	if (COUNT($data->result_array())) {
		$no = 0;
		?>
		Babak Final
		<table class="table table-bordered">
			<tr>
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
			<?php
			foreach ($data->result_array() as $R) {
				$no++;
				?>
				<tr>
					<td class="text-center align-middle"><?php echo $no; ?></td>
					<td class="text-center align-middle"><?php echo format_tanggal('wddmmmmyyyy',$R['tanggal']); ?></td>
					<td class="align-middle"><?php echo $R['waktu']; ?></td>
					<td class="align-middle"><?php echo $R['kategori']; ?></td>
					<td class="align-middle"><?php echo $R['per']; ?></td>
					<td class="align-middle"><?php echo $R['urutan']; ?></td>
					<td class="align-middle"><?php echo $R['lapangan']; ?></td>
					<td class="align-middle"><?php echo $R['nama_tim_A']; ?></td>
					<td class="align-middle"><?php echo $R['nama_tim_B']; ?></td>
					<td class="align-middle"><?php echo $R['set1_tim_A']; ?></td>
					<td class="align-middle"><?php echo $R['set1_tim_B']; ?></td>
				</tr>
			<?php
			}
			?>
		</table>
		<?php
	}
?>
</div>