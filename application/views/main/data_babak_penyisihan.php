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
		
		<font id='form_pool'><?php $this->load->view('./main/@select_pool.php'); ?></font>
		</h4>
		<div id='konten'></div>
    </div>
</div>
<script>
$(document).ready(function() {
	$("#id_kategori,#pool").on("change", function() {
		// alert();skip();
		
		var form_data = new FormData();
		form_data.append('id_kategori', $("#id_kategori").val());
		form_data.append('pool', $("#pool").val());
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
	});
});
</script>