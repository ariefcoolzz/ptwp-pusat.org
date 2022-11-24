<div class="content content-fixed">
	<div class="container pd-x-0 pd-lg-x-0 pd-xl-x-0">
		<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
			<div>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb breadcrumb-style1 mg-b-10">
						<li class="breadcrumb-item"><a href="<?php echo base_url('score'); ?>">Score</a></li>
						<li class="breadcrumb-item active" aria-current="page">Penyisihan</li>
					</ol>
				</nav>
			</div>
		</div>
		<div class="card">
			<div class="card-header tx-center tx-uppercase">
				<h3>Babak Penyisihan</h3>
			</div>
			<div class="card-body">
				<div class="row mt-3 mb-3" style='border:0px solid green;'>
					<div class='col-lg-6 col-sm-12'>
						<select class="form-control select_regu" id='beregu'>
							<option value='' selected>Pilih Regu </option>
							<option value='putra'>Beregu Putra</option>
							<option value='putri'>Beregu Putri</option>
							<option value='all'>Semua Regu</option>
						</select>
					</div>
					<div class='col-lg-6 col-sm-12'>
						<select class="form-control select_pool" id='pool'>
							<option value='all' selected>Semua Pool</option>
							<?php
							$jumlah_pool = 26; //sampai Z
							for ($i = 1; $i <= $jumlah_pool; $i++) {
								echo "<option value='" . pool($i) . "'>Pool " . pool($i) . "</option>";
							}
							?>
						</select>
					</div>
				</div>
				<div class="row mt-3 mb-3" style='border:0px solid green;'>
					<div class='col-lg-6 col-sm-12'>
						<select class="form-control select_a" id='id_kontingen_tim_A'>
							<option value='all'>Semua Kontingen A</option>
							<?php
							$result = $this->Model_admin->model_data_pool_kontingen_group();
							if ($result->num_rows()) {
								foreach ($result->result_array() as $R) {
									echo "<option value='$R[id_kontingen]'>$R[nama_satker]</option>";
								}
							}
							?>
						</select>
					</div>
					<div class='col-lg-6 col-sm-12'>
						<select class="form-control select_b" id='id_kontingen_tim_B'>
							<option value='all'>Semua Kontingen B</option>
							<?php
							$result = $this->Model_admin->model_data_pool_kontingen_group();
							if ($result->num_rows()) {
								foreach ($result->result_array() as $R) {
									echo "<option value='$R[id_kontingen]'>$R[nama_satker]</option>";
								}
							}
							?>
						</select>
					</div>
				</div>
				<?php
				if (isset($_SESSION['beregu'])) echo "<script>$('#beregu').val('$_SESSION[beregu]');</script>";
				if (isset($_SESSION['pool'])) echo "<script>$('#pool').val('$_SESSION[pool]');</script>";
				if (isset($_SESSION['id_kontingen_tim_A'])) echo "<script>$('#beregu').val('$_SESSION[id_kontingen_tim_A]');</script>";
				if (isset($_SESSION['id_kontingen_tim_B'])) echo "<script>$('#beregu').val('$_SESSION[id_kontingen_tim_B]');</script>";
				?>
				<div class='row'>
					<div class='col-12' id="konten_menu"></div>
				</div>
			</div>

			<div id="loader_html" class="container-fluid" style="display:none">
				<div class="row">
					<div class="col-lg-12">
						<div class="page-title-box">
							<div class="row align-items-center">
								<div class="col-md-12">
									<h4 class="title_loader page-title m-0 text-center"></h4>
								</div>
								<!-- end col -->
							</div>
							<!-- end row -->
						</div>
						<!-- end page-title-box -->
					</div>
				</div>
				<!-- end page title -->
				<div class="row justify-content-center">
					<div class="col-xl-12 justify-content-center">
						<div class="card" style="border:none">
							<div class="justify-content-center mx-auto">
								<div class="lds-dual-ring"></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
					<div class="modal-content">
						<div class="modal-header pd-x-20 pd-sm-x-30 bg-primary">
							<h5 class="modal_judul tx-white" id="modal_judul"> ................................ </h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body modal_isi" id="modal_isi"> .................................. </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$('.select_regu').select2();
	$('.select_pool').select2();
	$('.select_a').select2();
	$('.select_b').select2();

	$('[data-toggle="tooltip"]').tooltip();

	$('.datatable-pemain').DataTable({
		language: {
			searchPlaceholder: 'Pencarian...',
			sSearch: '',
			lengthMenu: '_MENU_ Pemain/Halaman',
		}
	});

	$("#beregu,#pool,#id_kontingen_tim_A,#id_kontingen_tim_B").on('change', function() {
		load();
	});

	if ($("#beregu").val() != "") {
		load();
	}

	function load() {
		if ($("#beregu").val() == '') {
			alert("Silahkan Pilih Regu Terlebih Dahulu... !!!");
			skip();
		}

		$(".title_loader").text("Sedang Memuat Halaman");
		$("#konten_menu").html($("#loader_html").html());
		var form_data = new FormData();
		form_data.append('id_event', '2');
		form_data.append('beregu', $("#beregu").val());
		form_data.append('pool', $("#pool").val());
		form_data.append('id_kontingen_tim_A', $("#id_kontingen_tim_A").val());
		form_data.append('id_kontingen_tim_B', $("#id_kontingen_tim_B").val());
		$.ajax({
			url: "<?php echo base_url(); ?>score/data_penyisihan_rekap",
			type: 'POST',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			dataType: 'json',
			success: function(json) {
				if (json.status !== true) {
					location.reload();
				} else {
					$("body").scrollTop('0px');
					$("#konten_menu").hide(300);
					$("#konten_menu").html(json.konten_menu);
					$("#konten_menu").show(300);
				}
			}
		});
	}
</script>