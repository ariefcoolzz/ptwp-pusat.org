<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $judul; ?></li>
			</ol>
		</nav>
        <a href="#" onClick="tambah_pool(0,0)" id_pemain="0" class="btn-tambah btn btn-info btn-xs"><i class="fa fa-plus-circle"></i> Tambah Pool Baru</a>
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
								<th class="text-center">No.</th>
								<th class="text-center">Pool</th>
								<th class="text-center">TIM A</th>
								<th class="text-center">SKOR</th>
								<th class="text-center">TIM B</th>
								<th class="text-center">Lapangan</th>
								<th class="text-center">Waktu</th>
								</tr>
								</thead><tbody>';
								$data 	= $this->Model_admin->get_data_penyisihan($R['id_kategori']);
								$no = 0;
								if (COUNT($data->result_array())) {
									
									foreach ($data->result_array() as $T) {
										$no++;
										echo '<tr>';
										echo '<td class="text-center">'.$no.'</td>';
										echo '<td class="text-center">'.$T['pool'].'</td>';
										echo '<td class="text-center">'.$T['nama_tim_A'].'</td>';
										echo '<td class="text-center"><b>'.$T['set1_tim_A'].' - '.$T['set1_tim_B'].'</b></td>';
										echo '<td class="text-center">'.$T['nama_tim_B'].'</td>';
										echo '<td class="text-center">'.$T['lapangan'].'</td>';
										echo '<td class="text-center">'.format_tanggal('ddmmmmyyyy',$T['tanggal']).'<br>'.$T['waktu'].'</td>';
										echo '<td class="text-center"><a href="#" onClick="tambah_pool(' . $T['id_tim_A'] . ',' . $T['id_tim_B'] . ')" class="btn-tambah btn btn-xs btn-outline-success btn-rounded" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="#" onClick="hapus_pool(' . $T['id_tim_A'] . ',' . $T['id_tim_B'] . ')" class="btn btn-xs btn-outline-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa fa-times"></i></a></td></td>';
										echo '</tr>';
									}
								}
								echo '</tbody><tfoot class="bg-primary">
								<tr>
								<th colspan="7" class="text-white">Jumlah Pertandingan: '.$no.'</th>
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
	
    function tambah_pool(Tim_A,Tim_B) {
        //loader
        $(".title_loader").text("Sedang Memuat Halaman");
        $("#konten").html($("#loader_html").html());
        // $('.nav-item.active').removeClass('active');
        // $(this).closest('li.nav-item').addClass('active');
        //loader
        // skip();
        var form_data = new FormData();
        form_data.append('id_tim_A', Tim_A);
        form_data.append('id_tim_B', Tim_B);
        $.ajax({
            url: "<?php echo base_url(); ?>admin/form_data_pool",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(html) {
                if (html.status !== true) {
                    location.reload();
					} 
				else {
                    $("body").scrollTop('0px');
                    $("#konten").fadeOut(300);
                    $("#konten").html(html.konten_menu);
                    $("#konten").fadeIn(300);
					
				}
			}
		});
	}
	function hapus_pool(Tim_A,Tim_B) {
        //loader
        $(".title_loader").text("Sedang Memuat Halaman");
        $("#konten").html($("#loader_html").html());
        // $('.nav-item.active').removeClass('active');
        // $(this).closest('li.nav-item').addClass('active');
        //loader
        // skip();
        var form_data = new FormData();
        form_data.append('id_tim_A', Tim_A);
        form_data.append('id_tim_B', Tim_B);
        $.ajax({
            url: "<?php echo base_url(); ?>admin/hapus_data_pool",
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
					Swal.fire({
                        icon: 'success',
                        title: 'Data Berhasil Di Hapus',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    $("body").scrollTop('0px');
                    $("#konten").fadeOut(300);
                    $("#konten").html(html.konten_menu);
                    $("#konten").fadeIn(300);

                }
            }
        });
    }
	function hapus_pool(Tim_A,Tim_B) {
         Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus saja!',
            cancelButtonText: 'Batalkan saja!'
        }).then((result) => {
            if (result.isConfirmed) {
				var form_data = new FormData();
				form_data.append('id_tim_A', Tim_A);
				form_data.append('id_tim_B', Tim_B);
				$.ajax({
					url: "<?php echo base_url(); ?>admin/hapus_data_pool",
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
							Swal.fire({
								icon: 'success',
								title: 'Data Berhasil Di Hapus',
								showConfirmButton: false,
								timer: 1000
							});
							$("body").scrollTop('0px');
							$("#konten").fadeOut(300);
							$("#konten").html(html.konten_menu);
							$("#konten").fadeIn(300);

						}
					}
				});
			}else {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Aman...',
                    showConfirmButton: false,
                    timer: 2000
                });

            }
        });
    }
</script>