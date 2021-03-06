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
		<div class="input-group">
			<select id='id_kategori' class="form-control">
				<?php
				$kategori = $this->basic->get_data('master_kategori_pemain');
				foreach ($kategori->result_array() as $R) {
					echo "<option value='" . MD7($R['id_kategori']) . "'>$R[kategori]</option>";
				}
				?>
			</select>
			<span id='form_pool'><?php $this->load->view('./main/@select_pool.php'); ?></span>
		</div>
	</div>
	<div class="table-responsive mg-t-20">
		<div class="container" id='konten'></div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$("#id_kategori,#pool").on("change", function() {
			// alert();skip();
			proses($("#id_kategori").val(),$("#pool").val());
		});
	});
	
	function proses(id_kategori,pool)
		{
			var form_data = new FormData();
			form_data.append('id_kategori', id_kategori);
			form_data.append('pool', pool);
			$.ajax({
				url: "<?php echo base_url(); ?>main/data_babak_penyisihan_rekap",
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
	
	proses($("#id_kategori").val(),$("#pool").val());
</script>