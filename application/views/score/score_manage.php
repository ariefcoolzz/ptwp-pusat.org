<center>
<?php
	$function_model = "score_rekap_".$jenis;
	$rekap = $this->Model_score->$function_model($key);
	IF($rekap->num_rows())
		{
			$R = $rekap->row_array();
			?>
			Event: <?php echo $R['id_event']; ?><br>
			Kategori: <?php echo $R['kategori']; ?><br>
			<?php 
				IF($jenis == 'final') 
					{ 
						IF($R['per'] == 1) echo "Final";
						ELSE
							{ 
								?>Per: <?php echo $R['per']; ?> Final<?php
							}
					} 
			?>
			<?php IF($jenis == 'penyisihan') { ?>Pool: <?php echo $R['pool']; ?><?php } ?>
			<br>
			Tanggal: <?php echo format_tanggal("wddmmmmyyyy",$R['tanggal']); ?> Jam <?php echo $R['waktu']; ?><br>
			Lapangan: <?php echo $R['lapangan']; ?><br>
			Nama: ... VS ...<br>
			<hr>
			Set 
			<select id='set'>
				<option value='0'>Pilih</option>
				<option value='1'>Satu</option>
				<option value='2'>Dua</option>
				<option value='3'>Tiga</option>
			</select>
			<hr>
			
			<div>Game</div>
			<div data-tipe='game' data-tim='A' data-aksi='+' class='tombol wd-100 ht-100 badge bg-success'>
				Tambah
			</div>
			<div data-tipe='game' data-tim='B' data-aksi='+' class='tombol wd-100 ht-100 badge bg-success'>
				Tambah
			</div>
			<br>
			<div id='game_tim_A' class='tombol wd-100 tx-40 badge'></div>
			<div id='game_tim_B' class='tombol wd-100 tx-40 badge'></div>
			<br>
			<div data-tipe='game' data-tim='A' data-aksi='-' class='tombol wd-100 ht-50 badge bg-danger'>
				Kurang
			</div>
			<div data-tipe='game' data-tim='B' data-aksi='-' class='tombol wd-100 ht-50 badge bg-danger'>
				Kurang
			</div>
			
			
			<hr>
			<div>Score</div>
			<div class='tombol wd-100 ht-100 badge bg-success'>
				Tambah
			</div>
			<div class='tombol wd-100 ht-100 badge bg-success'>
				Tambah
			</div>
			<br>
			<div class='tombol wd-100 ht-50 badge'>
				Nama Tim A
			</div>
			<div class='wd-100 ht-50 badge'>
				Nama Tim B
			</div>
			<br>
			<div class='tombol wd-100 badge'>
				<h1>0</h1>
			</div>
			<div class='wd-100 ht-50 badge'>
				<h1>0</h1>
			</div>
			<br>
			<div class='tombol wd-100 ht-50 badge bg-danger'>
				Kurang
			</div>
			<div class='tombol wd-100 ht-50 badge bg-danger'>
				Kurang
			</div>
			<?php
		}
?>
</center>

<script>
	$("#set").on("change", function() {
        var form_data = new FormData();
		form_data.append('jenis', "<?php echo $jenis; ?>");
		form_data.append('key',   "<?php echo $key; ?>");
		form_data.append('set',   $(this).val());
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
		if($("#set").val() == '0') { alert("Maaf... Set Harus Dipilih Terlebih Dahulu... !!!"); skip(); }
        var form_data = new FormData();
		form_data.append('jenis', "<?php echo $jenis; ?>");
		form_data.append('key',   "<?php echo $key; ?>");
		form_data.append('set',  $("#set").val());
		form_data.append('tipe', $(this).data('tipe'));
		form_data.append('tim',  $(this).data('tim'));
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
				if(json.status === true)
					{
						$("#game_tim_A").text(json.game_tim_A);
						$("#game_tim_B").text(json.game_tim_B);
					}
			}
		});
    });
</script>