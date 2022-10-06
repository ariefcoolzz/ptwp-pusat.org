<div class="table-responsive">
    <table class="datatable-user table table-primary table-striped mg-b-0 w-100">
        <thead class="thead-primary">
            <tr class="text-center text-uppercase">
                <th class="wd-20">No</th>
                <th>Foto</th>
                <th>Identitas</th>
                <th>Jenis Kelamin<br>Usia</th>
                <th>Kepengurusan</th>
                <th>Status</th>
                <th>File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            <?php
            $no = 1;
            $rekap = $this->Model_admin->get_data_user($_POST);
            if ($rekap->num_rows()) {
                foreach ($rekap->result_array() as $R) {
                    $nowa = $R['no_wa'];
                    if (SUBSTR($nowa, 0, 1) == '0') $nowa     = '62' . SUBSTR($nowa, 1);
                    $link_wa = "https://wa.me/" . $nowa;
                    echo '<tr data-id_user ="' . $R['id_user'] . '">';
                    echo "<td class='tx-center'>" . $no . "</td>";
                    if (!empty($R['FotoPegawai']) or !empty($R['FotoFormal'])) {
                        echo "<td class='align-center wd-100'><a href='" . cdn_foto($R['FotoPegawai'], $R['FotoFormal'], 200) . "' target='_blank'><center><img src='" . cdn_foto($R['FotoPegawai'], $R['FotoFormal']) . "' class='img-thumbnail d-block' style='width:85px;height:100px;'></center></a></td>";
                    } else {
                        echo "<td class='align-center wd-100'><center><img src='" . base_url('assets/profil/default.png') . "' class='img-thumbnail' style='width:85px;height:100px;'></center></td>";
                    }
                    echo "<td>
                            <div class='d-flex flex-column'>
                            <a class='tx-bolder'>" . $R['nama'] . "</a>
                            <a>" . nip_titik($R['nip']) . "</a>
                            <a>" . $R['jabatan'] . "</a>
                            <a>" . $R['nama_satker'] . "</a>
                            <div>" . $R['no_wa'] . " <span><a href='" . $link_wa . "' target='_blank' data-toggle='tooltip' data-placement='top' title='Kirim WA'><i class='fab fa-whatsapp tx-success'></i></a></span></div>
                            </div>
                        </td>";
                    echo "<td>
                            <div class='d-flex flex-column'>
                            <a class='tx-bolder'>" . $R['jenis_kelamin'] . "</a>
                            <a>" . $R['umur'] . " Tahun</a>
                            </div>
                        </td>";
                    echo "<td>
                            <div class='d-flex flex-column'>
                            <a class='tx-bolder'>" . $R['panitia'] . "</a>
                            <a>" . $R['nama_satker_parent'] . "</a>
                            </div>
                        </td>";
                    if ($R['aktif'])
                        echo '<td class="td_aktivasi">
                        <div class="custom-control custom-switch" role="button">
                            <input type="checkbox" class="custom-control-input aktivasi" data-no="' . $no . '" id="customSwitch_' . $no . '" checked>
                            <label class="custom-control-label" for="customSwitch_' . $no . '"><span class="badge badge-success">Aktif</span></label>
                        </div>
                        </td>';
                    else
                        echo '<td class="td_aktivasi">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input aktivasi" data-no="' . $no . '" id="customSwitch_' . $no . '">
                            <label class="custom-control-label" for="customSwitch_' . $no . '"><span class="badge badge-danger">Belum Aktif</span></label>
                        </div>
                        </td>';
                    echo "<td class='tx-center'>
                        <a href='" . base_url() . 'file_upload/dokumen/' . MD7($R['id_kontingen']) . ".pdf' target='_blank'  class='btn btn-xs btn-outline-primary btn-rounded' data-toggle='tooltip' data-placement='top' title='Dokumen'><i class='fas fa fa-file'></i></a>'
                        </td>";
                    echo '<td>';
                    echo '<div class="btn-group-vertical">';
                    echo '<button data-id_user="' . $R['id_user'] . '" class="hapus btn btn-xs btn-outline-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa fa-times"></i></button>';
                    echo '<button data-id_user="' . $R['id_user'] . '" class="edit  btn btn-xs btn-outline-warning btn-rounded" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa fa-edit"></i></button>';
                    echo "</div>";
                    echo "</td>";
                    echo "</tr>";
                    $no++;
                }
            }
            ?>
        </tbody>
    </table>
</div><!-- table-responsive -->
<script>
    $('[data-toggle="tooltip"]').tooltip();
    $('.datatable-user').DataTable({
        ordering: false,
        language: {
            searchPlaceholder: 'Pencarian...',
            sSearch: '',
            lengthMenu: '_MENU_ user/Halaman',
        }
    });
    $("#dt-table").on('change', '.aktivasi', function() {
        var ini = this;
        var check;
        if (this.checked) {
            check = '1';
        } else {
            check = '0';
        }
        var id_user = $(this).closest('tr').data('id_user');
        var nomor = $(this).data('no');

        var form_data = new FormData();
        form_data.append('id_user', id_user);
        form_data.append('aktif', check);
        form_data.append('nomor', nomor);
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_user_aktivasi",
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
                    var ono = $(ini).closest('tr').find('.td_aktivasi');
                    ono.html(json.konten_menu);
                }
            }
        });
    });

    $(document).ready(function() {
        $(".table").on('click', '.edit', function(e) {
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
    });

    $(document).ready(function() {
        $(".table").on('click', '.hapus', function(e) {
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