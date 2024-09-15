
<div class="card">
	<div class="card-body">
			
	<div class="row mt-3 mb-3" style='border:0px solid green;'>
        <div class="col">
            <select class="form-control" id='id_kategori_pemain'>
                <option></option>
                <?php 
                UNSET($P);
                $P['from'] = "master_kategori_pemain AS A";
                $P['where'] = "A.id_event = '$_SESSION[id_event]'";
                // $P['die'] = true;
                $data = $this->Model_basic->select($P);
                if($data->num_rows()) 
                    {
                        foreach($data->result_array() AS $R)   
                            {
                                echo "<option value='$R[id_kategori]'>$R[kategori]</option>";
                            }
                    }
                ?>
            </select>
        </div>
        <div class="col">
            <select class="form-control" id='per'>
                <option value='all'>Semua Per</option>
                <option value='32'>Per 32 Final</option>
                <option value='16'>Per 16 Final</option>
                <option value='8' selected>Per 8 Final</option>
                <option value='4'>Per 4 Final</option>
                <option value='2'>Semi Final</option>
                <option value='1'>Semi Final</option>
            </select>
        </div> 
	</div>
	<div class='row'>
		<div class='col-12' id="konten_menu"></div>
	</div>
</div>

<script>
	$(".select2").select2();

	$("#id_kategori_pemain,#per").on('change', function() {
		load();
	});

	// load();
	function load() {

		var form_data = new FormData();
		form_data.append('id_kategori_pemain', $("#id_kategori_pemain").val());
		form_data.append('per', $("#per").val());
		$.ajax({
			url: "<?php echo base_url(); ?>admin/data_perorangan_gugur_rekap",
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

	// $("#generate").on('click', function() {
	// 	if (confirm("Apakah Benar Anda Ingin Generate ???")) {
	// 		if (confirm("Apakah Anda benar benar yakin ???")) {
	// 			var form_data = new FormData();
	// 			$.ajax({
	// 				url: "<?php echo base_url(); ?>admin/data_perorangan_gugur_generate",
	// 				type: 'POST',
	// 				cache: false,
	// 				contentType: false,
	// 				processData: false,
	// 				data: form_data,
	// 				dataType: 'json',
	// 				success: function(json) {
	// 					if (json.status !== true) {
	// 						location.reload();
	// 					} else {
	// 						$("body").scrollTop('0px');
	// 						$("#konten_menu").hide(300);
	// 						$("#konten_menu").html(json.konten_menu);
	// 						$("#konten_menu").show(300);
	// 					}
	// 				}
	// 			});
	// 		}
	// 	}
	// });
</script>