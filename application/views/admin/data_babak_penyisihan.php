<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $judul; ?></li>
			</ol>
		</nav>
		
	</div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
				<div class='col-12'>
					<!-- <span id='tambah' class="btn btn-success btn-xs"><i class="fa fa-plus-circle"></i> Tambah Data Babak Penyisihan</span> -->
					<span id='generate' class="btn btn-warning btn-xs float-left"><i class="fa fa-plus-circle"></i> Generate Data Dari Pool</span>
				</div>
				<div id='konten_menu'></div>
			</div>
		</div>
	</div>
</div>
<!-- <div class="modal fade" id="modal_nilai" tabindex="-1" role="dialog" aria-labelledby="modal_nilai_title" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content tx-14">
			<div class="modal-header">
				<h6 class="modal-title" id="modal_nilai_title">Perhitungan Skor Pertandingan</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modal_body" style="background-color:#e2eeff">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div> -->
<script>
    $('[data-toggle="tooltip"]').tooltip();
	
    $('.datatable-pemain').DataTable({
        language: {
            searchPlaceholder: 'Pencarian...',
            sSearch: '',
            lengthMenu: '_MENU_ Pemain/Halaman',
		}
	});
	
	load();
	function load()
		{
			$(".title_loader").text("Sedang Memuat Halaman");
			$("#konten_menu").html($("#loader_html").html());
			var form_data = new FormData();
			form_data.append('id_event', $("#list_event").val());
			$.ajax({
				url: "<?php echo base_url(); ?>admin/data_babak_penyisihan_rekap",
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
						$("#konten_menu").html(json.konten_menu);
					}
				}
			});
		}

	$("#generate").on('click', function() {
        if(confirm("Apakah Benar Anda Ingin Generate ???"))
			{
				if(confirm("Apakah Anda benar benar yakin ???"))
					{
						$(".title_loader").text("Sedang Memuat Halaman");
						$("#konten_menu").html($("#loader_html").html());
						var form_data = new FormData();
						form_data.append('id_event', $("#list_event").val());
						$.ajax({
							url: "<?php echo base_url(); ?>admin/data_babak_penyisihan_generate",
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
									$("#konten_menu").html(json.konten_menu);
								}
							}
						});
					}
			}
    });
</script>