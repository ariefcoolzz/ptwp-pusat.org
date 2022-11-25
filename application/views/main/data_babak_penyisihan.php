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
				<h4>Turnamen Tenis Beregu Ke-19 Piala Ketua Mahkamah Agung Republik Indonesia 2022</h4>
				<h1 class='text-white bg-danger p-2 blink'>Desclaimer<br><br>Apabila terdapat kekeliruan data akan diperbaiki kemudian dan yg berlaku yang ditangan wasit dan seksi pertandingan.</h1>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="input-group">
			<select class="form-control" id='beregu'>
				<option value='putra' selected>Putra</option>
				<option value='putri'>Putri</option>
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
	// $(document).ready(function() {
		// $("#id_kategori,#pool").on("change", function() {
			// // alert();skip();
			// proses($("#id_kategori").val(),$("#pool").val());
		// });
	// });
	
	// function proses(id_kategori,pool)
		// {
			// var form_data = new FormData();
			// form_data.append('id_kategori', id_kategori);
			// form_data.append('pool', pool);
			// $.ajax({
				// url: "<?php echo base_url(); ?>main/data_babak_penyisihan_rekap",
				// type: 'POST',
				// cache: false,
				// contentType: false,
				// processData: false,
				// data: form_data,
				// dataType: 'json',
				// success: function(json) {
					// if (json.status !== true) {
						// alert("Ada Kesalahan... !!!");
						// skip();
					// } else {
						// $("#konten").hide(300);
						// $("#konten").html(json.konten);
						// $("#konten").show(300);
					// }
				// }
			// });
		// }
	
	// proses($("#id_kategori").val(),$("#pool").val());
</script>

<script>
    $("#beregu,#pool").on('change', function() {
        load_data();
    });

    load_data();
    function load_data() {
        var form_data = new FormData();
        // form_data.append('id_panitia', $("#id_panitia").val());
        form_data.append('id_event', '2');
        form_data.append('beregu', $("#beregu").val());
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
                    alert();
                    skip();
                } else {
                    $("#konten").fadeOut(300);
                    $("#konten").html(json.konten_menu);
                    $("#konten").fadeIn(300);
                }
            }
        });
    }
</script>