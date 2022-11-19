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
	<div class="row" style='border:0px solid green;'>
		<div class="col-6 form-group">
			<!-- <a href="javascript:void(0)" id='tambah' class="btn-tambah btn btn-primary"><i class="fa fa-plus-circle"></i> Data Pool</a> -->
			<a href="javascript:void(0)" id='generate' class="btn-drawing btn btn-danger"><i class="typcn typcn-arrow-repeat"></i> Generate Data Dari Pool</a>
		</div>
		<div class='col-6'>
			<select class="form-control float-right" id='beregu'>
				<option value='all' selected>Semua Regu</option>
				<option value='putra'>Beregu Putra</option>
				<option value='putri'>Beregu Putri</option>
			</select>
		</div>
		<div class='col-12' id="konten_menu"></div>
	</div>
</div>

<script>
	$('[data-toggle="tooltip"]').tooltip();

	$('.datatable-pemain').DataTable({
		language: {
			searchPlaceholder: 'Pencarian...',
			sSearch: '',
			lengthMenu: '_MENU_ Pemain/Halaman',
		}
	});

	$("#beregu").on('change', function() {
		load()
	});

	load();
	function load() {
		$(".title_loader").text("Sedang Memuat Halaman");
		$("#konten_menu").html($("#loader_html").html());
		var form_data = new FormData();
		form_data.append('id_event', $("#list_event").val());
		form_data.append('beregu', $("#beregu").val());
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
					$("#konten_menu").html(json.konten_menu);
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
							$("#konten_menu").html(json.konten_menu);
						}
					}
				});
			}
		}
	});
</script>