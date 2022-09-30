<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $judul; ?></li>
            </ol>
        </nav>
        <a href="#" onClick="tambah_pemain(0)" id_pemain="0" class="btn-tambah btn btn-info btn-xs"><i class="fa fa-plus-circle"></i> Pemain Baru</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php echo $this->session->flashdata('msg'); ?>
                <div data-label="Example" class="df-example demo-table">
                    <div class="table-responsive">
                        <table class="datatable-pemain table table-primary mg-b-0">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th class="wd-20">No</th>
                                    <!-- <th>Foto</th> -->
                                    <th>Nama</th>
                                    <th>Nip</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Usia</th>
                                    <th>Jabatan</th>
                                    <th>Satuan Kerja</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($list_pemain->result_array() as $R) {
                                    echo '<tr align="center">';
                                    echo "<td>" . $no . "</td>";
                                    // if (!empty($R['FotoPegawai']) OR !empty($R['FotoFormal'])) {
                                        // echo "<td class='align-center'><a href='" . cdn_foto($R['FotoPegawai'], $R['FotoFormal'], 200) . "' data-lightbox='$R[nama_gelar]' data-title='$R[nama_gelar]'><center><img src='" . cdn_foto($R['FotoPegawai'], $R['FotoFormal']) . "' class='img-thumbnail d-block' style='width:70px;height:85px;'></center></a></td>";
                                    // } else {
                                        // echo "<td align='align-center'><img src='" . base_url('assets/profil/default.png') . "' class='img-thumbnail' style='width:55px;height:60px;'></td>";
                                    // }
                                    echo "<td align='left'>" . $R['nama'] . "</td>";
                                    echo "<td align='left'>" . nip_titik($R['nip']) . "</td>";
                                    echo "<td align='left'>" . $R['jenis_kelamin'] . "</td>";
                                    echo "<td align='left'>" . $R['umur'] . "</td>";
                                    echo "<td align='left'>" . $R['jabatan'] . "</td>";
                                    echo "<td align='left'>" . $R['nama_satker'] . "</td>";
                                    echo '<td>
                                        <div class="btn-group">
                                        <a href="#" onClick="tambah_pemain(' . $R['id_pemain'] . ')" id_pemain="' . $R['id_pemain'] . '" class="btn-tambah btn btn-xs btn-outline-success btn-rounded" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="#" onClick="hapus_pemain(' . $R['id_pemain'] . ')" class="btn btn-xs btn-outline-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa fa-times"></i></a></td>';
                                    echo "</div>";
                                    echo "</tr>";
                                    $no++;
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

    $('.datatable-pemain').DataTable({
        language: {
            searchPlaceholder: 'Pencarian...',
            sSearch: '',
            lengthMenu: '_MENU_ Pemain/Halaman',
        }
    });

    function tambah_pemain(id_pemain) {
        //loader
        $(".title_loader").text("Sedang Memuat Halaman");
        $("#konten").html($("#loader_html").html());
        // $('.nav-item.active').removeClass('active');
        // $(this).closest('li.nav-item').addClass('active');
        //loader
        // skip();
        var form_data = new FormData();
        form_data.append('id_pemain', id_pemain);
        $.ajax({
            url: "<?php echo base_url(); ?>admin/form_data_pemain",
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
    function hapus_pemain(id_pemain) {
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
				form_data.append('id_pemain', id_pemain);
				$.ajax({
					url: "<?php echo base_url(); ?>admin/hapus_data_pemain",
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