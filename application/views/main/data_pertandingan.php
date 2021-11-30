<div class="content content-fixed">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-style1 mg-b-0">
			<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Beranda</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?php echo $judul; ?></li>
		</ol>
	</nav>
	<div class="table-responsive mg-t-30">
		<h3>DATA PERTANDINGAN</h3>
		<table class='table table-primary table-border'>
			<thead>
				<tr class='text-center'>
					<th class="wd-10">No.</th>
					<th class="wd-150">Tanggal</th>
					<th class="wd-100">Waktu</th>
					<th class="wd-20">Lapangan</th>
					<th colspan='3' class="wd-400">Score</th>
					<th class="wd-250">Detail</th>
				</tr>
			</thead>
			<?php

			$data 	= $this->Model_main->model_data_pertandingan();
			if (COUNT($data->result_array())) {
				$no = 0;
				foreach ($data->result_array() as $R) {
					$no++;
					$id_data_point = $R['id_data_point'];
					
					// $nip_tim_A = EXPLODE("<br>","<br>".$R['nip_tim_A']);
					// $nip_tim_B = EXPLODE("<br>","<br>".$R['nip_tim_B']);
			?>
					<tr class='text-center'>
						<td class="align-middle"><?php echo $no; ?></td>
						<td class="align-middle"><?php echo $R['tanggal']; ?></td>
						<td class="align-middle"><?php echo $R['waktu']; ?></td>
						<td class="align-middle"><a class="badge badge-warning"><?php echo $R['lapangan']; ?></a></td>
						<td class="align-middle">
							<div class="img-group">
								<img src="<?php echo base_url(); ?>assets/img/default.png" class="img wd-60 ht-50 rounded-circle" data-toggle="tooltip" data-placement="left" title="Pemain 1" alt="">
								<img src="<?php echo base_url(); ?>assets/img/default.png" class="img wd-60 ht-50 rounded-circle" data-toggle="tooltip" data-placement="right" title="Pemain 2" alt="">
							</div>
							<?php echo $R['nama_tim_A']; ?>
							<br>
							<a class="text-white badge badge-pill badge-primary"><?php echo $R['score_tim_A']; ?></a>
						</td>
						<td class="align-middle">Lawan</td>
						<td class="align-middle">
							<div class="img-group">	
								<img src="<?php echo base_url(); ?>assets/img/default.png" class="img wd-60 ht-50 rounded-circle" data-toggle="tooltip" data-placement="left" title="Pemain 1" alt="">
								<img src="<?php echo base_url(); ?>assets/img/default.png" class="img wd-60 ht-50 rounded-circle" data-toggle="tooltip" data-placement="right" title="Pemain 2" alt="">
							</div>
							<br>
							<?php echo $R['nama_tim_B']; ?>
							<br>
							<a class="text-white badge badge-pill badge-primary"><?php echo $R['score_tim_B']; ?></a>
						</td>
						<td class="align-middle">
							<div class='data_pertandingan_point text-center badge badge-success' id_data_point='<?php echo $id_data_point; ?>'>Tampilkan</div>
							<div id='data_pertandingan_point<?php echo $id_data_point; ?>' style='display:none;'></div>
						</td>
					</tr>
			<?php
				}
			}
			?>
			<tfoot>
				<tr>
					<th colspan='7' class="text-dark">Jumlah Pertandingan: <?php echo $no; ?></th>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
<style>
	.data_pertandingan_point {
		cursor: pointer;
	}
</style>
<script>
	$('[data-toggle="tooltip"]').tooltip();

	$(document).ready(function() {
		$(".data_pertandingan_point").on("click", function() {
			// alert();skip();
			if ($(this).text() == 'Tampilkan') {
				$(this).text('Sembunyikan');
			} else {
				$(this).text('Tampilkan');
			}

			var id_data_point = $(this).attr('id_data_point');
			var form_data = new FormData();
			form_data.append('id_data_point', id_data_point);
			$.ajax({
				url: "<?php echo base_url(); ?>main/data_pertandingan_point",
				type: 'POST',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				dataType: 'json',
				success: function(json) {
					if (json.status !== true) {
						alert("Ada Kesalahan... !!!");
						skip();
					} else {
						$("#data_pertandingan_point" + id_data_point).html(json.konten);
						$("#data_pertandingan_point" + id_data_point).toggle(300);
					}
				}
			});
		});
	});
</script>