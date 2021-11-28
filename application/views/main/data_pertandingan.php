<div class="content content-fixed">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-0">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#"><?php echo $judul; ?></a></li>
        </ol>
    </nav>
</div>
<div class="content">
	<div class="table-responsive">
		<table class='table table-striped'>
			<h4 class="header-title btn-sm btn-dark">DATA PERTANDINGAN</h4>
			<div class="dropdown-divider" style="border-color: seagreen;"></div>
			<tr align='center'>
				<th>No.</th>
				<th>Tanggal</th>
				<th>Waktu</th>
				<th>Lapangan</th>
				<th colspan='2'>Score</th>
				<th>Detail Point & Score</th>
			</tr>
			<?php
				
				$data 	= $this->Model_main->model_data_pertandingan();
				if (COUNT($data->result_array())) {
					$no = 0;
					foreach ($data->result_array() as $R) {
						$no++;
						$id_data_point = $R['id_data_point'];
					?>
					<tr align='center'>
						<td class="p-1"><?php echo $no; ?></td>
						<td class="p-1"><?php echo $R['tanggal']; ?></td>
						<td class="p-1"><?php echo $R['waktu']; ?></td>
						<td class="p-1"><?php echo $R['lapangan']; ?></td>
						<td class="p-1"><?php echo $R['nama_tim_A']; ?><br><?php echo $R['score_tim_A']; ?></td>
						<td class="p-1"><?php echo $R['nama_tim_B']; ?><br><?php echo $R['score_tim_B']; ?></td>
						<td class="p-1">
							<div class='data_pertandingan_point' id_data_point='<?php echo $id_data_point; ?>'>Tampilkan</div>
							<div id='data_pertandingan_point<?php echo $id_data_point; ?>' style='display:none;'></div>
						</td>
					</tr>
					<?php
					}
				}
			?>
			<tr>
				<th colspan='7'>Jumlah Pertandingan: <?php echo $no; ?></th>
			</tr>
		</table>
	</div>
</div>
<style>
	.data_pertandingan_point {
	cursor:pointer;
	}
</style>
<script>
	$(document).ready(function() {
		$(".data_pertandingan_point").on("click", function() {
			// alert();skip();
			if($(this).text() == 'Tampilkan') 
			{ $(this).text('Sembunyikan'); }
			else
			{ $(this).text('Tampilkan'); }
			
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
					$("#data_pertandingan_point"+id_data_point).html(json.konten);
					$("#data_pertandingan_point"+id_data_point).toggle(300);
				}
			}
			});
		});
	});
</script>
