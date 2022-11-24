<?php $this->load->view("score/@header"); ?>
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
						else { ?>Per: <?php echo $R['per']; ?> Final<?php }
					}
					?>
					<?php if ($jenis == 'penyisihan') { ?>Pool: <?php echo $R['pool']; ?><?php } ?>

					<a>Tanggal: <?php echo format_tanggal("wddmmmmyyyy", $R['tanggal']); ?> Jam <?php echo $R['waktu']; ?></a>
					<a>Lapangan: <?php echo $R['lapangan']; ?></a>
					<a>Nama: <?php echo $R['nama_pemain_tim_A']; ?> VS <?php echo $R['nama_pemain_tim_B']; ?></a>
					<select id='set' class="form-control col-sm-12 col-lg-4">
						<option value='0'>Pilih SET</option>
						<option value='1'>Satu</option>
						<option value='2'>Dua</option>
						<option value='3'>Tiga</option>
					</select>
				</div>
				<div id='manage_tombol' style='display:none;'>
				<div class="card-body d-flex flex-column align-items-center">
					<div class="h3 tx-bolder bd-b">Game</div>
					<div class="row no-gutters wd-300">
						<div class="col-6">
							<button data-tipe='game' data-tim='A' data-aksi='+' class='tombol_game wd-100 btn btn-lg btn-success'><i class="fa fa-plus-circle"></i> <br>Tambah</button>
						</div>
						<div class="col-6">
							<button data-tipe='game' data-tim='B' data-aksi='+' class='tombol_game wd-100 btn btn-lg btn-success'><i class="fa fa-plus-circle"></i> <br>Tambah</button>
						</div>
					</div>
					<div class="row no-gutters wd-300 mg-t-10">
						<div class="col-6">
							<div id='game_tim_A' class='wd-100 tx-40 badge'></div>
						</div>
						<div class="col-6">
							<div id='game_tim_B' class='wd-100 tx-40 badge'></div>

						</div>
					</div>
					<div class="row no-gutters wd-300 mg-t-10">
						<div class="col-6">
							<button data-tipe='game' data-tim='A' data-aksi='-' class='tombol_game wd-100 btn btn-lg btn-danger'><i class="fa fa-minus-circle"></i> Kurang</button>
						</div>
						<div class="col-6">
							<button data-tipe='game' data-tim='B' data-aksi='-' class='tombol_game wd-100 btn btn-lg btn-danger'><i class="fa fa-minus-circle"></i> Kurang</button>
						</div>
					</div>
					<select id='game' class="form-control col-sm-12 col-lg-4 mt-3 mb-3">
						<option value='0'>Pilih Game</option>
						<?php 
						FOR($ke=1;$ke<=15;$ke++) // 8 vs 7
							{
								echo "<option value='$ke'>Game Ke: ".($ke)."</option>";
							}
						?>
					</select>
					<div id='manage_tombol_point' style='display:none;'>
						<select id='kategori' class="form-control col-sm-12 col-lg-4 mt-3 mb-3">
							<option value='point'>Point</option>
							<option value='tie_break'>Tie Break</option>
						</select>
						<div class="row no-gutters wd-300 mg-t-10">
							<div class="col-6">
								<button data-tipe='point' data-tim='A' data-aksi='+' class='tombol_point wd-100 btn btn-lg btn-success'><i class="fa fa-plus-circle"></i> Tambah</button>
							</div>
							<div class="col-6">
								<button data-tipe='point' data-tim='B' data-aksi='+' class='tombol_point wd-100 btn btn-lg btn-success'><i class="fa fa-plus-circle"></i> Tambah</button>
							</div>
						</div>
						<div class="row no-gutters wd-300 mg-t-10">
							<div class="col-6">
								<div id='point_tim_A' class='wd-100 tx-40 badge'></div>
							</div>
							<div class="col-6">
								<div id='point_tim_B' class='wd-100 tx-40 badge'></div>

							</div>
						</div>
						<div class="row no-gutters wd-300 mg-t-10">
							<div class="col-6">
								<button data-tipe='point' data-tim='A' data-aksi='-' class='tombol_point wd-100 btn btn-lg btn-danger'><i class="fa fa-minus"></i> Kurang</button>
							</div>
							<div class="col-6">
								<button data-tipe='point' data-tim='B' data-aksi='-' class='tombol_point wd-100 btn btn-lg btn-danger'><i class="fa fa-minus"></i> Kurang</button>
							</div>
						</div>
						<div class="row no-gutters wd-300 mg-t-10">
							<div class="col-12">
							<span data-tipe='point' data-tim='' data-aksi='reset' class='reset_point btn btn-lg btn-warning'><i class="fa fa-minus"></i> Reset Point</span>
							<span data-tipe='point' data-tim='' data-aksi='hapus' class='hapus_point btn btn-lg btn-secondary'><i class="fa fa-minus"></i> Hapus Point</span>
							</div>
						</div>

						<div id='log_penyisihan' class='mt-3 ml-auto mr-auto'>
							<?php 
								$this->load->view('score/@log_penyisihan', $R); 
							?>
						</div>
					</div>
					
				</div>
				</div>
			</div>
		<?php
		}
		?>
	</div>
</div>
<?php $this->load->view("score/@footer"); ?>
<script>
	$("#set").on("change", function() {
		// alert($(this).val());
		if($(this).val() == '0') 
			{ 
				$("#manage_tombol").fadeOut(300); 
				skip(); 
			}
		else
			{ 
				$("#manage_tombol").fadeOut(300); 
				$("#manage_tombol").fadeIn(300); 
			}
		
		$("#game").val('0'); //diset untuk memilih lagi
		$("#manage_tombol_point").fadeOut(); //diset untuk memilih lagi
		
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

	$("#game").on("change", function() {
		// alert($(this).val());
		if($(this).val() == '0') 
			{ 
				$("#manage_tombol_point").fadeOut(300); 
				skip(); 
			}
		else
			{ 
				$("#manage_tombol_point").fadeOut(300); 
				$("#manage_tombol_point").fadeIn(300); 
			}
		
		var form_data = new FormData();
		form_data.append('jenis', "<?php echo $jenis; ?>");
		form_data.append('key', "<?php echo $key; ?>");
		form_data.append('set', $("#set").val());
		form_data.append('game', $(this).val());
		$.ajax({
			url: "<?php echo base_url(); ?>score/manage_point",
			type: 'POST',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			dataType: 'json',
			success: function(json) {
				// alert(json.konten_button);
				$("#point_tim_A").text(json.point_tim_A);
				$("#point_tim_B").text(json.point_tim_B);
			}
		});
	});

	$(".tombol_game").on("click", function() {
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
			url: "<?php echo base_url(); ?>score/manage_tombol_game",
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

	$(".tombol_point").on("click", function() {
		if ($("#set").val() == '0') {
			alert("Maaf... Set Harus Dipilih Terlebih Dahulu... !!!");
			skip();
		}
		if ($("#game").val() == '0') {
			alert("Maaf... Game Ke Harus Dipilih Terlebih Dahulu... !!!");
			skip();
		}
		var form_data = new FormData();
		form_data.append('jenis', "<?php echo $jenis; ?>");
		form_data.append('key', "<?php echo $key; ?>");
		form_data.append('set', $("#set").val());
		form_data.append('game', $("#game").val());
		form_data.append('tipe', $(this).data('tipe'));
		form_data.append('tim', $(this).data('tim'));
		form_data.append('aksi', $(this).data('aksi'));
		form_data.append('kategori', $("#kategori").val());
		$.ajax({
			url: "<?php echo base_url(); ?>score/manage_tombol_point",
			type: 'POST',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			dataType: 'json',
			success: function(json) {
				if (json.status === true) {
					$("#point_tim_A").text(json.point_tim_A);
					$("#point_tim_B").text(json.point_tim_B);

					$("#log_penyisihan").html(json.log_penyisihan);
				}
			}
		});
	});

	$(".reset_point").on("click", function() {
		var form_data = new FormData();
		form_data.append('jenis', "<?php echo $jenis; ?>");
		form_data.append('key', "<?php echo $key; ?>");
		form_data.append('set', $("#set").val());
		form_data.append('game', $("#game").val());
		form_data.append('tipe', $(this).data('tipe'));
		form_data.append('aksi', $(this).data('aksi'));
		$.ajax({
			url: "<?php echo base_url(); ?>score/manage_reset_point",
			type: 'POST',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			dataType: 'json',
			success: function(json) {
				if (json.status === true) {
					$("#point_tim_A").text(json.point_tim_A);
					$("#point_tim_B").text(json.point_tim_B);

					$("#log_penyisihan").html(json.log_penyisihan);
				}
			}
		});
	});

	$(".hapus_point").on("click", function() {
		var form_data = new FormData();
		form_data.append('jenis', "<?php echo $jenis; ?>");
		form_data.append('key', "<?php echo $key; ?>");
		form_data.append('set', $("#set").val());
		form_data.append('game', $("#game").val());
		form_data.append('tipe', $(this).data('tipe'));
		form_data.append('aksi', $(this).data('aksi'));
		$.ajax({
			url: "<?php echo base_url(); ?>score/manage_hapus_point",
			type: 'POST',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			dataType: 'json',
			success: function(json) {
				if (json.status === true) {
					$("#point_tim_A").text(json.point_tim_A);
					$("#point_tim_B").text(json.point_tim_B);

					$("#log_penyisihan").html(json.log_penyisihan);
				}
			}
		});
	});


</script>