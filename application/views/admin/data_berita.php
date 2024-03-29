<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $judul; ?></li>
            </ol>
        </nav>
        <a href="#" id="btn-tambah" id_konten="0" class="btn-tambah btn btn-primary"><i class="fa fa-plus-circle"></i> Berita Baru</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php echo $this->session->flashdata('msg'); ?>
                <div>
                    <div class="table-responsive">
                        <table id="tabel_berita" class="datatable-pemain table table-primary table-striped mg-b-0">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Judul Konten / Page</th>
                                    <th>Informasi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($list_konten->result_array() as $R) {
                                    echo '<tr>';
                                    echo "<td>" . $no . "</td>";
                                    echo "<td align='center'>" . $R['id'] . "</td>";
                                    echo "<td align='left'>" . $R['judul'] . " <br> <smal class='tx-gray-600'><i> alias : " . $R['alias'] . "</i></smal></td>";
                                    echo "<td>
                                    " . format_tanggal('ddmmmmyyyyhis', $R['date_created']) . "
                                    <br>Creator : " . $R['nama'] . "
                                    <br>" . $R['panitia'] . " - " . $R['nama_satker'] . "</td>";
                                    if ($R['is_publish']) {
                                        echo '<td><span class="badge badge-success">Dipublikasikan</span></td>';
                                    } else {
                                        echo '<td><span class="badge badge-danger">Tidak Dipublikasikan</span></td>';
                                    }
                                    echo '<td>
                                        <div class="btn-group">
                                        <span style="cursor:pointer" id_konten="' . $R['id'] . '" class="btn-edit btn btn-xs btn-outline-success btn-rounded" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-pencil-alt" ></i></span>
                                        <span style="cursor:pointer" id_konten="' . MD7($R['id']) . '" class="btn-hapus btn btn-xs btn-outline-danger btn-rounded" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa fa-times" ></i></span></td>';
                                    echo "</div></td>";
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
    $('#tabel_berita').DataTable({
        ordering: false,
        language: {
            searchPlaceholder: 'Pencarian...',
            sSearch: '',
            lengthMenu: '_MENU_ Berita/Halaman',
            // info: false
        }
    });

    $('[data-toggle="tooltip"]').tooltip();
    $(document).ready(function() {
        $("#btn-tambah").on('click', function(e) {
            //loader
            $(".title_loader").text("Sedang Memuat Halaman");
            $("#konten").html($("#loader_html").html());
            // $('.nav-item.active').removeClass('active');
            // $(this).closest('li.nav-item').addClass('active');
            //loader
            // skip();

            var form_data = new FormData();
            form_data.append('id_konten', $(this).attr('id_konten'));
            $.ajax({
                url: "<?php echo base_url(); ?>admin/form_data_berita",
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
        });
        $("table").on('click', '.btn-edit', function(e) {
            //loader
            $(".title_loader").text("Sedang Memuat Halaman");
            $("#konten").html($("#loader_html").html());
            // $('.nav-item.active').removeClass('active');
            // $(this).closest('li.nav-item').addClass('active');
            //loader
            // skip();

            var form_data = new FormData();
            form_data.append('id_konten', $(this).attr('id_konten'));
            $.ajax({
                url: "<?php echo base_url(); ?>admin/form_data_berita",
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
        });
    });

    $(document).ready(function() {
        $(".table").on('click', '.btn-hapus', function(e) {
            e.preventDefault();
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
                    form_data.append('id_konten', $(this).attr('id_konten'));
                    $.ajax({
                        url: "<?php echo base_url(); ?>admin/hapus_data_konten",
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        data: form_data,
                        dataType: 'json',
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(html) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Berhasil Di Delete...',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            $("body").scrollTop('0px');
                            $("#konten").fadeOut(300);
                            $("#konten").html(html.konten_menu);
                            $("#konten").fadeIn(300);
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Data Aman...',
                        showConfirmButton: false,
                        timer: 2000
                    });

                }
            });
        });
    });
</script>