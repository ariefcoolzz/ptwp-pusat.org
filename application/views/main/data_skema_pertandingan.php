<div class="content content-fixed">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-0">
            <li class="breadcrumb-item"><a href="#">Menu</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $judul; ?></li>
        </ol>
    </nav>
    <div class="table-responsive">
        <h2>TURNAMEN TENIS PERORANGAN PIALA KMA 2021</h2>
        <h4 class="text-center mg-t-20">
		<select id='id_kategori'>
		<?php 
		$kategori = $this->basic->get_data('master_kategori_pemain'); 
		foreach($kategori->result_array() as $R){
			echo "<option value='".MD7($R['id_kategori'])."'>$R[kategori]</option>";
		}	
		?>
		</select>
		
		</h4>
		<div id='konten'></div>
    </div>
</div>
<script>
$(document).ready(function() {
	$("#id_kategori").on("change", function() {
		// alert();skip();
		proses($("#id_kategori").val());
	});
	
	function proses(id_kategori)
		{
			// alert(id_kategori);
			var form_data = new FormData();
			form_data.append('id_kategori', id_kategori);
			
			$.ajax({
				url: "<?php echo base_url(); ?>main/data_skema_pertandingan_rekap",
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
	proses($("#id_kategori").val());
});
</script>