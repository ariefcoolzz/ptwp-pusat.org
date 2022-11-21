<div class="d-sm-flex align-items-center justify-content-between">
	<div>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb breadcrumb-style1 mg-b-10">
				<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo $judul; ?></li>
			</ol>
		</nav>
	</div>
</div>
<div class="card">
	<div class="card-body">
	<a href="javascript:void(0)" id='generate' class="btn-drawing btn btn-danger"><i class="typcn typcn-arrow-repeat"></i> Generate Data Dari Pool</a>
			
	<div class="row mt-3 mb-3" style='border:0px solid green;'>
		<div class='col-6'>
			<select class="form-control select2" id='beregu'>
				<option value='all' selected>Semua Regu</option>
				<option value='putra'>Beregu Putra</option>
				<option value='putri'>Beregu Putri</option>
			</select>
		</div>
		<div class='col-6'>
			<select class="form-control select2" id='pool'>
				<option value='all' selected>Semua Pool</option>
				<?php
					$jumlah_pool = 26; //sampai Z
					FOR($i=1;$i<=$jumlah_pool;$i++)
						{
							echo "<option value='".pool($i)."'>Pool ".pool($i)."</option>";
						}
				?>
			</select>
		</div>
	</div>
	<div class="row mt-3 mb-3" style='border:0px solid green;'>
		<div class='col-6'>
			<select class="form-control select2" id='id_kontingen_tim_A'>
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
		<div class='col-6'>
			<select class="form-control select2" id='id_kontingen_tim_B'>
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
	<div class='row'>
		<div class='col-12' id="konten_menu"></div>
	</div>
</div>

<script>
	$(".select2").select2();
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

	load();
	function load() {
		$(".title_loader").text("Sedang Memuat Halaman");
		$("#konten_menu").html($("#loader_html").html());
		var form_data = new FormData();
		form_data.append('id_event', $("#list_event").val());
		form_data.append('beregu', $("#beregu").val());
		form_data.append('pool', $("#pool").val());
		form_data.append('id_kontingen_tim_A', $("#id_kontingen_tim_A").val());
		form_data.append('id_kontingen_tim_B', $("#id_kontingen_tim_B").val());
		$.ajax({
			url: "<?php echo base_url(); ?>admin/data_babak_penyisihan_rekap",
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

	$("#generate").on('click', function() {
		if (confirm("Apakah Benar Anda Ingin Generate ???")) {
			if (confirm("Apakah Anda benar benar yakin ???")) {
				$(".title_loader").text("Sedang Memuat Halaman");
				$("#konten_menu").html($("#loader_html").html());
				var form_data = new FormData();
				form_data.append('id_event', $("#list_event").val());
				$.ajax({
					url: "<?php echo base_url(); ?>admin/data_babak_penyisihan_generate",
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
		}
	});
</script>