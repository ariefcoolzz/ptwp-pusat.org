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
				<h4>Turnamen Tenis Beregu Ke-19 Piala Ketua Mahkamah Agung Republik Indonesia 2024</h4>
				<h1 class='text-white bg-danger p-2 blink'>Desclaimer<br><br>Apabila terdapat kekeliruan data akan diperbaiki kemudian dan yg berlaku yang ditangan wasit dan seksi pertandingan.</h1>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="input-group">
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
			<select class="form-control" id='pool'>
				<option value='all' selected>Semua Pool</option>
				<?php
					$jumlah_pool = 26; //sampai Z
					FOR($i=1;$i<=$jumlah_pool;$i++)
						{
							echo "<option value='".pool($i)."'>Pool ".pool($i)."</option>";
						}
				?>
			</select>
		</div>
	</div>
	<div class="table-responsive mg-t-20">
		<div class="container" id='konten'></div>
	</div>
</div>
<script>
	(function blink() {
		$('.blink').fadeOut(1000).fadeIn(3000, blink);
	})();

	$(document).ready(function() {
		$("#id_kategori_pemain,#pool").on("change", function() {
			proses();
		});
	});
	
	function proses()
		{
			var form_data = new FormData();
			form_data.append('id_kategori_pemain', $("#id_kategori_pemain").val());
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
		}
	
	proses();
</script>
