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
				<tr class='text-center valign-center'>
					<th class="wd-10">No.</th>
					<th class="wd-100">Tanggal</th>
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
			?>
					<tr class='text-center'>
						<td><?php echo $no; ?></td>
						<td><?php echo $R['tanggal']; ?></td>
						<td><?php echo $R['waktu']; ?></td>
						<td class="badge badge-warning"><?php echo $R['lapangan']; ?></td>
						<td><?php echo $R['nama_tim_A']; ?><br><a class="text-white badge badge-pill badge-primary"><?php echo $R['score_tim_A']; ?></a></td>
						<td>Lawan</td>
						<td><?php echo $R['nama_tim_B']; ?><br><a class="text-white badge badge-pill badge-primary"><?php echo $R['score_tim_B']; ?></a></td>
						<td>
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
					<th colspan='7'>Jumlah Pertandingan: <?php echo $no; ?></th>
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