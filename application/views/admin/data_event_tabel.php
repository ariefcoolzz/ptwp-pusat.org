<div class="table-responsive">
    <table class="datatable-user table table-primary mg-b-0">
        <thead class="thead-primary">
            <tr class="text-center">
                <th class="wd-20">No</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Nama</th>
                <!-- <th>Jenis Kelamin</th> -->
                <th>Is Aktif</th>
                <th>Jenis Pertandingan</th>
                <th>Keterangan</th>
                <!-- <th>Satuan Kerja</th>
                <th>Status</th> -->
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $rekap = $this->Model_admin->get_data_event($_POST);
            if ($rekap->num_rows()) {
                foreach ($rekap->result_array() as $R) {
                    echo '<tr align="center" data-id_event ="' . $R['id_event'] . '">';
                    echo "<td>" . $no . "</td>";
                    // if (!empty($R['FotoPegawai']) or !empty($R['FotoFormal'])) {
                    //     echo "<td class='align-center'><a href='" . cdn_foto($R['FotoPegawai'], $R['FotoFormal'], 200) . "' data-lightbox='$R[nama_gelar]' data-title='$R[nama_gelar]'><center><img src='" . cdn_foto($R['FotoPegawai'], $R['FotoFormal']) . "' class='img-thumbnail d-block' style='width:70px;height:85px;'></center></a></td>";
                    // } else {
                    //     echo "<td align='align-center'><img src='" . base_url('assets/profil/default.png') . "' class='img-thumbnail' style='width:55px;height:60px;'></td>";
                    // }
                    echo "<td align='left'>" . $R['tanggal_mulai'] . "</td>";
                    // echo "<td align='left'>" . nip_titik($R['nip']) . "</td>";
                    echo "<td align='left'>" . $R['tanggal_selesai'] . "</td>";
                    echo "<td align='left'>" . $R['nama'] . "</td>";
                    echo "<td align='left'>" . $R['is_aktif'] . "</td>";
                    echo "<td align='left'>" . $R['jenis_pertandingan'] . "</td>";
                    echo "<td align='left'>" . $R['keterangan'] . "</td>";
                    // if ($R['aktif'])
                    //     echo '<td class="td_aktivasi">
                    //     <div class="custom-control custom-switch">
                    //         <input type="checkbox" class="custom-control-input aktivasi" data-no="' . $no . '" id="customSwitch_' . $no . '" checked>
                    //         <label class="custom-control-label" for="customSwitch_' . $no . '"><span class="badge badge-success">Aktif</span></label>
                    //     </div>
                    //     </td>';
                    // else
                    //     echo '<td class="td_aktivasi">
                    //     <div class="custom-control custom-switch">
                    //         <input type="checkbox" class="custom-control-input aktivasi" data-no="' . $no . '" id="customSwitch_' . $no . '">
                    //         <label class="custom-control-label" for="customSwitch_' . $no . '"><span class="badge badge-danger">Belum Aktif</span></label>
                    //     </div>
                    //     </td>';
                    echo '<td>';
                    echo '<span data-id_event="' . $R['id_event'] . '" class="hapus btn btn-xs btn-outline-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa fa-times"></i></span>';
                    echo '<span data-id_event="' . $R['id_event'] . '" class="edit  btn btn-xs btn-outline-warning btn-rounded" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa fa-edit"></i></span>';
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
    $('.datatable-event').DataTable({
        language: {
            searchPlaceholder: 'Pencarian...',
            sSearch: '',
            lengthMenu: '_MENU_ event/Halaman',
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
        var id_event = $(this).closest('tr').data('id_event');
        var nomor = $(this).data('no');

        var form_data = new FormData();
        form_data.append('id_event', id_event);
        form_data.append('aktif', check);
        form_data.append('nomor', nomor);
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_event_aktivasi",
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
	
	 $(".edit").on('click', function() {
        //loader
        $(".title_loader").text("Sedang Memuat Halaman");
        $("#konten").html($("#loader_html").html());
        // $('.nav-item.active').removeClass('active');
        // $(this).closest('li.nav-item').addClass('active');
        //loader
        // skip();
        var form_data = new FormData();
        form_data.append('id_event', $(this).data('id_event'));
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_event_form",
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

    $(".hapus").on('click', function() {
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
                form_data.append('id_event', $(this).data('id_event'));
                $.ajax({
                    url: "<?php echo base_url(); ?>admin/data_event_hapus",
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
</script>