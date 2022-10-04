<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data User</li>
            </ol>
        </nav>
        <span id='tambah' class="btn-tambah btn btn-info btn-xs"><i class="fa fa-plus-circle"></i> Data User Pengurus</span>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div data-label="Example" class="df-example demo-table">
                    <div class="table-responsive">
                        <table class="datatable-user table table-primary mg-b-0">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th class="wd-20">No</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Nip</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Usia</th>
                                    <th>Jabatan</th>
                                    <th>Satuan Kerja</th>
                                    <th>Kepengurusan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
								$rekap = $this->basic->get_data('view_user');
                                IF($rekap->num_rows()){
									foreach ($rekap->result_array() as $R) {
										echo '<tr align="center">';
										echo "<td>" . $no . "</td>";
										if (!empty($R['FotoPegawai']) OR !empty($R['FotoFormal'])) {
											echo "<td class='align-center'><a href='" . cdn_foto($R['FotoPegawai'], $R['FotoFormal'], 200) . "' data-lightbox='$R[nama_gelar]' data-title='$R[nama_gelar]'><center><img src='" . cdn_foto($R['FotoPegawai'], $R['FotoFormal']) . "' class='img-thumbnail d-block' style='width:70px;height:85px;'></center></a></td>";
										} else {
											echo "<td align='align-center'><img src='" . base_url('assets/profil/default.png') . "' class='img-thumbnail' style='width:55px;height:60px;'></td>";
										}
										echo "<td align='left'>" . $R['nama'] . "</td>";
										echo "<td align='left'>" . nip_titik($R['nip']) . "</td>";
										echo "<td align='left'>" . $R['jenis_kelamin'] . "</td>";
										echo "<td align='left'>" . $R['umur'] . "</td>";
										echo "<td align='left'>" . $R['jabatan'] . "</td>";
										echo "<td align='left'>" . $R['nama_satker'] . "</td>";
										echo "<td align='left'>" . $R['panitia'] . "</td>";
										echo '<td>';
										echo '<span data-id_user="'.$R['id_user'].'" class="hapus btn btn-xs btn-outline-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa fa-times"></i></span>';
										echo '<span data-id_user="'.$R['id_user'].'" class="edit  btn btn-xs btn-outline-warning btn-rounded" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa fa-edit"></i></span>';
										echo "</td>";
										echo "</tr>";
										$no++;
									}
                                }
                                ?>
                            </tbody>
                        </table>
                    </div><!-- table-responsive -->
                </div><!-- df-example -->
            </div>
        </div>
    </div>
</div>
<script>
    $('[data-toggle="tooltip"]').tooltip();

    $('.datatable-user').DataTable({
        language: {
            searchPlaceholder: 'Pencarian...',
            sSearch: '',
            lengthMenu: '_MENU_ user/Halaman',
        }
    });

    $("#tambah").on('click', function(){
        //loader
        $(".title_loader").text("Sedang Memuat Halaman");
        $("#konten").html($("#loader_html").html());
        // $('.nav-item.active').removeClass('active');
        // $(this).closest('li.nav-item').addClass('active');
        //loader
        // skip();
        var form_data = new FormData();
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_user_form",
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
                    $("#konten").fadeOut(300);
                    $("#konten").html(json.konten_menu);
                    $("#konten").fadeIn(300);

                }
            }
        });
    });
    
	$(".edit").on('click', function(){
        //loader
        $(".title_loader").text("Sedang Memuat Halaman");
        $("#konten").html($("#loader_html").html());
        // $('.nav-item.active').removeClass('active');
        // $(this).closest('li.nav-item').addClass('active');
        //loader
        // skip();
        var form_data = new FormData();
		form_data.append('id_user', $(this).data('id_user'));
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_user_form",
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
                    $("#konten").fadeOut(300);
                    $("#konten").html(json.konten_menu);
                    $("#konten").fadeIn(300);

                }
            }
        });
    });
	
    $(".hapus").on('click', function(){
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
				form_data.append('id_user', $(this).data('id_user'));
				$.ajax({
					url: "<?php echo base_url(); ?>admin/data_user_hapus",
					type: 'POST',
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,
					dataType: 'json',
					success: function(html) {
						if (html.status !== true) {
							Swal.fire({
								icon: 'error',
								title: 'Data Gagal Di Hapus',
								showConfirmButton: false,
								timer: 1000
							});
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
    });
    
</script>