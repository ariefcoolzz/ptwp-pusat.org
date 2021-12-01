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
                                    <th scope="col">No</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Satuan Kerja</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($list_pemain->result_array() as $R) {
                                    echo '<tr align="center">';
                                    echo "<td>" . $no . "</td>";
                                    if(!empty($R['foto_profil'])){
                                         echo "<td align='left'><img src='".base_url('assets/profil/').$R['foto_profil']."' class='img-thumbnail' style='width:55px;height:60px;'></td>";
                                    }
                                    else{
                                         echo "<td align='left'><img src='".base_url('assets/profil/default.png')."' class='img-thumbnail' style='width:55px;height:60px;'></td>";
                                    }
                                    echo "<td align='left'>" . $R['nama'] . "</td>";
                                    echo "<td align='left'>" . $R['satker'] . "</td>";
                                    echo '<td>
                                        <div class="btn-group">
                                        <a href="#" onClick="tambah_pemain(' . $R['id_pemain'] . ')" id_pemain="' . $R['id_pemain'] . '" class="btn-tambah btn btn-xs btn-outline-success btn-rounded" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-xs btn-outline-danger btn-rounded"><i class="fas fa fa-times" data-toggle="tooltip" data-placement="top" title="Delete"></i></a></td>';
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

    $('[data-toggle="tooltip"]').tooltip();
</script>