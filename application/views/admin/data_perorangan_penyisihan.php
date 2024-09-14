
<div class="card">
	<div class="card-body">
	<a href="javascript:void(0)" id='generate' class="btn-drawing btn btn-danger"><i class="typcn typcn-arrow-repeat"></i> Generate Data Dari Pool</a>
			
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
            <select class="form-control" id='pool'>
                <option value=''>Semua Pool</option>
                <?php 
                for($p=1;$p<=26;$p++)
                    {
                        echo "<option value='".pool($p)."'>Pool ".pool($p)."</option>";
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

	$("#id_kategori_pemain").on('change', function() {
		load();
	});

	// load();
	function load() {

		var form_data = new FormData();
		form_data.append('id_kategori_pemain', $("#id_kategori_pemain").val());
		$.ajax({
			url: "<?php echo base_url(); ?>admin/data_perorangan_penyisihan_rekap",
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
				var form_data = new FormData();
				$.ajax({
					url: "<?php echo base_url(); ?>admin/data_perorangan_penyisihan_generate",
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