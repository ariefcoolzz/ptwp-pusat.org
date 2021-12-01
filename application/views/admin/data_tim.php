<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $judul; ?></li>
            </ol>
        </nav>
        <a href="#" onClick="tambah_tim(0)" id_pemain="0" class="btn-tambah btn btn-info btn-xs"><i class="fa fa-plus-circle"></i> Tambah Tim Baru</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php echo $this->session->flashdata('msg'); ?>
                <div data-label="MyTabPTWP" class="df-example">
    	<ul class="nav nav-tabs" id="myTab" role="tablist">
			<?php 
				foreach($kategori->result_array() as $R){
					$activ = '';
					if($R['id_kategori'] == 1) $activ = 'active';
					echo '<li class="nav-item">
						  <a class="nav-link '.$activ.'" id="'.$R['id_kategori'].'-tab" data-toggle="tab" href="#tab_'.$R['id_kategori'].'" role="tab" aria-controls="home" aria-selected="true">'.$R['kategori'].'</a>
						</li>';
				}
			?>
		 </ul>
		<div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="MyTabPTWP">
			<?php 
				foreach($kategori->result_array() as $R){
					$activ = '';
					if($R['id_kategori'] == 1) $activ = 'show active';
					echo '<div class="tab-pane fade '.$activ.'" id="tab_'.$R['id_kategori'].'" role="tabpanel" aria-labelledby="'.$R['id_kategori'].'-tab">';
					echo '<table class="datatable-pemain table">
							<thead>
								<tr>
									<th class="wd-10p text-center">No.</th>
									<th class="text-center">Nama</th>
									<th class="text-center">Kategori</th>
									<th class="text-center">Satuan Kerja</th>
									<th class="text-center">Aksi</th>
								</tr>
							</thead><tbody>';
					$data 	= $this->Model_admin->data_tim($R['id_kategori']);
					if (COUNT($data->result_array())) {
						$no = 0;
						foreach ($data->result_array() as $T) {
							$no++;
							echo '<tr>';
							echo '<td class="text-center">'.$no.'</td>';
							echo '<td>'.$T['nama_pasangan'].'</td>';
							echo '<td class="text-center">'.$T['kategori'].'</td>';
							echo '<td class="text-center">'.$T['nama_satker'].'</td>';
							echo '<td class="text-center"><a href="#" onClick="tambah_pemain(' . $T['id_tim'] . ')" id_tim="' . $T['id_tim'] . '" class="btn-tambah btn btn-xs btn-outline-success btn-rounded" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-xs btn-outline-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa fa-times"></i></a></td></td>';
							echo '</tr>';
						}
					}
					echo '</tbody><tfoot class="bg-primary">
							<tr>
								<th colspan="4" class="text-white">Jumlah Pemain: '.$no.'</th>
							</tr>
						  </tfoot></table>';
					echo '</div>';
				}
			?>
	 	</div>
     </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('[data-toggle="tooltip"]').tooltip();

    $('.datatable-pemain').DataTable({
        language: {
            searchPlaceholder: 'Pencarian...',
            sSearch: '',
            lengthMenu: '_MENU_ Pemain/Halaman',
        }
    });

    function tambah_tim(id_tim) {
        //loader
        $(".title_loader").text("Sedang Memuat Halaman");
        $("#konten").html($("#loader_html").html());
        // $('.nav-item.active').removeClass('active');
        // $(this).closest('li.nav-item').addClass('active');
        //loader
        // skip();
        var form_data = new FormData();
        form_data.append('id_tim', id_tim);
        $.ajax({
            url: "<?php echo base_url(); ?>admin/form_data_tim",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(html) {
                if (html.status !== true) {
                    location.reload();
                } else {
                    $("body").scrollTop('0px');
                    $("#konten").fadeOut(300);
                    $("#konten").html(html.konten_menu);
                    $("#konten").fadeIn(300);

                }
            }
        });
    }
</script>