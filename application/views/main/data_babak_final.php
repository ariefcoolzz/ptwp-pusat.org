<div class="content content-fixed">
	<div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
		<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
			<div>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb breadcrumb-style1 mg-b-10">
						<li class="breadcrumb-item"><a href="#">Pertandingan</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo $judul; ?></li>
					</ol>
				</nav>
				<h4>TURNAMEN TENIS PERORANGAN PIALA KMA 2021</h4>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="text-center">
			<select id='id_kategori' class="form-control">
				<?php
				$kategori = $this->basic->get_data('master_kategori_pemain');
				foreach ($kategori->result_array() as $R) {
					echo "<option value='" . MD7($R['id_kategori']) . "'>$R[kategori]</option>";
				}
				?>
			</select>
		</div>
		<div class="table-responsive mg-t-20">
			<div id='konten'></div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		var per = "<?php echo MD7($per); ?>";
		$("#id_kategori").on("change", function() {
			// alert();skip();
			proses($("#id_kategori").val(), per);
		});

		function proses(id_kategori, per) {
			// alert(id_kategori);
			var form_data = new FormData();
			form_data.append('id_kategori', id_kategori);
			form_data.append('per', per);

			$.ajax({
				url: "<?php echo base_url(); ?>main/data_babak_final_rekap",
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
						$("#konten").hide(300);
						$("#konten").html(json.konten);
						$("#konten").show(300);
					}
				}
			});
		}
		proses($("#id_kategori").val(), per);
	});
</script>