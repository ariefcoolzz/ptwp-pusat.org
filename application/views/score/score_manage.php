<div class="content-bd content-fixed tx-center">
	<div class="container mg-y-30">
		<?php
		$function_model = "score_rekap_" . $jenis;
		$rekap = $this->Model_score->$function_model($key);
		if ($rekap->num_rows()) {
			$R = $rekap->row_array();
		?>
			<div class="card">
				<div class="card-header d-flex flex-column align-items-center text-uppercase">
					<a>Event: <?php echo $R['id_event']; ?></a>
					<a>Kategori: <?php echo $R['kategori']; ?></a>
					<?php
					if ($jenis == 'final') {
						if ($R['per'] == 1) echo "Final";
						else {
					?>Per: <?php echo $R['per']; ?> Final<?php
														}
													}
															?>
					<?php if ($jenis == 'penyisihan') { ?>Pool: <?php echo $R['pool']; ?><?php } ?>

					<a>Tanggal: <?php echo format_tanggal("wddmmmmyyyy", $R['tanggal']); ?> Jam <?php echo $R['waktu']; ?></a>
					<a>Lapangan: <?php echo $R['lapangan']; ?></a>
					<a>Nama: ... VS ...</a>

					<a>Set</a>
					<select id='set' class="form-control col-2">
						<option value='0'>Pilih</option>
						<option value='1'>Satu</option>
						<option value='2'>Dua</option>
						<option value='3'>Tiga</option>
					</select>
				</div>
				<div class="card-body d-flex flex-column align-items-center">
					<div class="h3 tx-bolder bd-b">Game</div>
					<div class="row no-gutters wd-300">
						<div class="col-6">
							<button data-tipe='game' data-tim='A' data-aksi='+' class='tombol wd-100 btn btn-lg btn-success'><i class="fa fa-plus-circle"></i> Tambah</button>
						</div>
						<div class="col-6">
							<button data-tipe='game' data-tim='B' data-aksi='+' class='tombol wd-100 btn btn-lg btn-success'><i class="fa fa-plus-circle"></i> Tambah</button>
						</div>
					</div>
					<div class="row no-gutters wd-300 mg-t-10">
						<div class="col-6">
							<div id='game_tim_A' class='tombol wd-100 tx-40 badge'></div>
						</div>
						<div class="col-6">
							<div id='game_tim_B' class='tombol wd-100 tx-40 badge'></div>

						</div>
					</div>
					<div class="row no-gutters wd-300 mg-t-10">
						<div class="col-6">
							<button data-tipe='game' data-tim='A' data-aksi='-' class='tombol wd-100 btn btn-lg btn-danger'><i class="fa fa-minus-circle"></i> Kurang</button>
						</div>
						<div class="col-6">
							<button data-tipe='game' data-tim='B' data-aksi='-' class='tombol wd-100 btn btn-lg btn-danger'><i class="fa fa-minus-circle"></i> Kurang</button>
						</div>
					</div>
					<div class="h3 tx-bolder bd-b mg-t-30">Score</div>
					<div class="row no-gutters wd-300">
						<div class="col-6">
							<button data-tipe='game' data-tim='A' data-aksi='+' class='tombol wd-100 btn btn-lg btn-success'><i class="fa fa-plus"></i> Tambah</button>
						</div>
						<div class="col-6">
							<button data-tipe='game' data-tim='B' data-aksi='+' class='tombol wd-100 btn btn-lg btn-success'><i class="fa fa-plus"></i> Tambah</button>
						</div>
					</div>
					<div class="row no-gutters wd-300 mg-t-10">
						<div class="col-6">
							<div id='game_tim_A' class='tombol wd-100 tx-40 badge'></div>
						</div>
						<div class="col-6">
							<div id='game_tim_B' class='tombol wd-100 tx-40 badge'></div>

						</div>
					</div>
					<div class="row no-gutters wd-300 mg-t-10">
						<div class="col-6">
							<button data-tipe='game' data-tim='A' data-aksi='-' class='tombol wd-100 btn btn-lg btn-danger'><i class="fa fa-minus"></i> Kurang</button>
						</div>
						<div class="col-6">
							<button data-tipe='game' data-tim='B' data-aksi='-' class='tombol wd-100 btn btn-lg btn-danger'><i class="fa fa-minus"></i> Kurang</button>
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
	$("#set").on("change", function() {
		var form_data = new FormData();
		form_data.append('jenis', "<?php echo $jenis; ?>");
		form_data.append('key', "<?php echo $key; ?>");
		form_data.append('set', $(this).val());
		$.ajax({
			url: "<?php echo base_url(); ?>score/manage_set",
			type: 'POST',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			dataType: 'json',
			success: function(json) {
				// alert(json.konten_button);
				$("#game_tim_A").text(json.game_tim_A);
				$("#game_tim_B").text(json.game_tim_B);
			}
		});
	});

	$(".tombol").on("click", function() {
		if ($("#set").val() == '0') {
			alert("Maaf... Set Harus Dipilih Terlebih Dahulu... !!!");
			skip();
		}
		var form_data = new FormData();
		form_data.append('jenis', "<?php echo $jenis; ?>");
		form_data.append('key', "<?php echo $key; ?>");
		form_data.append('set', $("#set").val());
		form_data.append('tipe', $(this).data('tipe'));
		form_data.append('tim', $(this).data('tim'));
		form_data.append('aksi', $(this).data('aksi'));
		$.ajax({
			url: "<?php echo base_url(); ?>score/manage_tombol",
			type: 'POST',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			dataType: 'json',
			success: function(json) {
				if (json.status === true) {
					$("#game_tim_A").text(json.game_tim_A);
					$("#game_tim_B").text(json.game_tim_B);
				}
			}
		});
	});
</script>