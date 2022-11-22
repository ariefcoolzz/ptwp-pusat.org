<div class="d-sm-flex align-items-center justify-content-between">
	<div>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb breadcrumb-style1 mg-b-10">
				<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
				<li class="breadcrumb-item active" aria-current="page">Data Babak Final</li>
			</ol>
		</nav>
	</div>
</div>
<div class="card">
	<div class="card-body">
	<!-- <a id='generate' class="btn-drawing btn btn-danger"><i class="typcn typcn-arrow-repeat"></i> Generate Data Template Final</a> -->
			
	<div class="row mt-3 mb-3" style='border:0px solid green;'>
		<div class='col-6'>
			<select class="form-control select2" id='beregu'>
				<option value='all' selected>Semua Regu</option>
				<option value='putra'>Beregu Putra</option>
				<option value='putri'>Beregu Putri</option>
			</select>
		</div>
		<div class='col-6'>
            <select class="form-control select2" id='per'>
				<option value='all' selected>Semua</option>
				<option value='16'>Per enam belas Final</option>
				<option value='8'>Perdelapan Final</option>
				<option value='4'>Perempat Final</option>
				<option value='2'>Semi Final</option>
				<option value='1'>Final</option>
			</select>
		</div>
	</div>
	<div class='row'>
		<div class='col-12' id="konten_menu"></div>
	</div>
</div>

<script>
	$(".select2").select2();

	$("#beregu,#per").on('change', function() {
		load();
	});

	load();
	function load() {
		$(".title_loader").text("Sedang Memuat Halaman");
		$("#konten_menu").html($("#loader_html").html());
		var form_data = new FormData();
		form_data.append('id_event', $("#list_event").val());
		form_data.append('beregu', $("#beregu").val());
		form_data.append('per', $("#per").val());
		$.ajax({
			url: "<?php echo base_url(); ?>admin/data_babak_final_rekap",
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
					url: "<?php echo base_url(); ?>admin/data_babak_final_generate",
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