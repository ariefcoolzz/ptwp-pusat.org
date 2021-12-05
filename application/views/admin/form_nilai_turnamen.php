<?php 
	$setA = 'set'.$set.'_tim_A';
	$setB = 'set'.$set.'_tim_B';
?>
<div class="row">
	<div class="col-sm">
		<ul class="list-group list-group-flush tx-13">
			<li class="list-group-item d-flex">
				<div class="img-group">
					<img src="<?php echo base_url();?>assets/img/default.png" class="img wd-60 ht-60 rounded-circle" alt="">
				</div>
				<div class="pd-20">
					<p class="tx-medium mg-b-0"><?php echo $nama_tim_A; ?> </p>
				</div>
				<div class="mx-auto align-self-center">
					<div class="row mb-1"><button type="button" tim_kat="A" tim="<?php echo $id_tim_A; ?>" jenis="tambah" class="btn-nilai btn btn-success btn-icon">
						<i class="far fa-plus-square"></i>
					</button> </div>
					<div class="row mb-1"><button type="button" tim_kat="A" tim="<?php echo $id_tim_A; ?>" jenis="kurang" class="btn-nilai btn btn-danger btn-icon">
						<i class="far fa-minus-square"></i>
					</button> </div>
				</div>
			</li>
		</ul>
	</div>
	<div class="col-sm text-center">
		<div class="row">
			<div class="col-sm">
				<H1 class="pt-4" id="<?php echo $id_tim_A; ?>"><?php echo $$setA; ?></H1>
			</div>
			<div class="col-sm">
				<a class="tx-bold">VS</a>
				<br><input type="date" id='tanggal' class="form-control" value="<?php echo tanggal_dp($tanggal); ?>">				
				<br><input type="time" id='waktu' class="form-control" value="<?php echo $waktu; ?>">						
				<br>
				<select id="lapangan" class="pilih_tim form-control">
					<?php 
						
						
						$lap = $this->basic->get_data('master_lapangan');
						foreach($lap->result_array() as $D){
							$selected = '';
							if($id_lapangan == $D['id_lapangan']) $selected = 'selected';
							echo "<option value='".$D['id_lapangan']."' $selected>Lapangan ".$D['lapangan']."</option>";
						}
					?>
				</select>
			</div>
			
			<div class="col-sm">
				<H1 class="pt-4" id="<?php echo $id_tim_B; ?>"><?php echo $$setB; ?></H1>
			</div>
		</div>
	</div>
	<div class="col-sm">
		<ul class="list-group list-group-flush tx-13">
			<li class="list-group-item d-flex">
				<div class="img-group">
					<img src="<?php echo base_url();?>assets/img/default.png" class="img wd-60 ht-60 rounded-circle" alt="">
				</div>
				<div class="pd-20">
					<p class="tx-medium mg-b-0"><?php echo $nama_tim_B; ?> </p>
				</div>
				<div class="mx-auto align-self-center">
					<div class="row mb-1"><button type="button" tim_kat="B" tim="<?php echo $id_tim_B; ?>" jenis="tambah" class="btn-nilai btn btn-success btn-icon">
						<i class="far fa-plus-square"></i>
					</button> </div>
					<div class="row mb-1"><button type="button" tim_kat="B" tim="<?php echo $id_tim_B; ?>" jenis="kurang" class="btn-nilai btn btn-danger btn-icon">
						<i class="far fa-minus-square"></i>
					</button> </div>
				</div>
			</li>
		</ul>
	</div>
</div>
<script>
	var id_tim_A = '<?php echo $id_tim_A; ?>';
	var id_tim_B = '<?php echo $id_tim_B; ?>';
	var set = '<?php echo $set; ?>';
	$('.btn-nilai').on('click', function (e) {
		
		
		var jenis = $(this).attr('jenis');
		var tim_kat = $(this).attr('tim_kat');
		
		var tim = $(this).attr('tim');
		var skor = $("#"+tim).text();
		console.log(tim);
		console.log(jenis);
		console.log(skor);
		if(skor == '0' && jenis == 'kurang'){
			Swal.fire({
				icon: 'danger',
				title: 'SKOR TIDAK BOLEH KURANG DARI 0',
				showConfirmButton: false,
				timer: 2000
			});			
			return;
		}
		
		var form_data = new FormData();
        form_data.append('id_tim_A', id_tim_A);
        form_data.append('id_tim_B', id_tim_B);
        form_data.append('set', set);
        form_data.append('tim', tim);
        form_data.append('jenis', jenis);
        form_data.append('tim_kat', tim_kat);
        form_data.append('skor',skor);
		$.ajax({
            url: "<?php echo base_url(); ?>admin/set_nilai_turnamen",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(html) {
                if (html.status !== true) {
                    Swal.fire({
                        icon: 'danger',
                        title: html.msg,
                        showConfirmButton: false,
                        timer: 1000
					});
				} 
                else 
                {
                    $("#"+tim).text(html.skor_akhir)                  
				}
			}
		});
	});
	var form_komponen = new FormData();
	form_komponen.append('id_tim_A', id_tim_A);
    form_komponen.append('id_tim_B', id_tim_B);
	
	$('#lapangan').on('change', function (e) {
		form_komponen.append('lapangan', this.value);
		ubah_komponen();
    });
	$('#tanggal').on('keyup', function (e) {
		form_komponen.append('tanggal', this.value);
		ubah_komponen();
    });
	$('#waktu').on('keyup', function (e) {
		form_komponen.append('waktu', this.value);
		ubah_komponen();
    });
	function ubah_komponen(){
		// console.log(form_komponen);
		$.ajax({
            url: "<?php echo base_url(); ?>admin/set_komponen_turnamen",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_komponen,
            dataType: 'json',
            success: function(html) {
                if (html.status !== true) {
                    Swal.fire({
                        icon: 'danger',
                        title: html.msg,
                        showConfirmButton: false,
                        timer: 1000
					});
				} 
			}
		});
	};
	
    // tinyMCE.EditorManager.execCommand('mceAddEditor',true, '.mymce'); 
</script>