<div class="table-responsive">
    <table class="datatable-wasit table table-primary table-striped mg-b-0">
        <thead class="thead-primary">
            <tr class="text-center">
                <th class="wd-20">No</th>
                <th>Event</th>
                <th>Lapangan</th>
                <th>Jenis Lapangan</th>
                <th>Alamat Lapangan</th>
                <th>Koordinat Lapangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $rekap = $this->Model_admin->get_data_lapangan($_POST);
            if ($rekap->num_rows()) {
                foreach ($rekap->result_array() as $R) {
                    echo '<tr align="center" data-id_lapangan ="' . $R['id_lapangan'] . '">';
                    echo "<td>" . $no . "</td>";
                    echo "<td align='left'>" . ($R['id_event']) . "</td>";
                    echo "<td align='left'>" . $R['lapangan'] . "</td>";
                    echo "<td align='left'>" . jenis_lapangan($R['jenis']) . "</td>";
                    echo "<td align='left'>" . $R['alamat'] . "</td>";
                    // echo "<td align='left'>" . $R['longitude'], $R['latitude'] . "</td>";
                    echo '<td align="center"> <a href="http://www.google.com/maps/place/' . $R['longitude'] . ', ' . $R['latitude'] . '" target="_blank">' . $R['longitude'] . ', ' . $R['latitude'] . '</a></td>';
                    echo '<td>';
                    echo '<div class="btn-group-vertical">';
                    echo '<a href="javascript:void(0)" data-id_lapangan="' . $R['id_lapangan'] . '" class="hapus btn btn-xs btn-outline-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa fa-times"></i></a href="javascript:void(0)">';
                    echo '<a href="javascript:void(0)" data-id_lapangan="' . $R['id_lapangan'] . '" class="edit  btn btn-xs btn-outline-warning btn-rounded" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa fa-edit"></i></a href="javascript:void(0)">';
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
    $('.datatable-wasit').DataTable({
        ordering: false,
        language: {
            searchPlaceholder: 'Pencarian...',
            sSearch: '',
            lengthMenu: '_MENU_ wasit/Halaman',
        }
    });

    $(".table").on('click', '.edit', function(e) {
        $(".title_loader").text("Sedang Memuat Halaman");
        $("#konten").html($("#loader_html").html());
        var form_data = new FormData();
        form_data.append('id_lapangan', $(this).data('id_lapangan'));
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_lapangan_form",
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
                form_data.append('id_lapangan', $(this).data('id_lapangan'));
                $.ajax({
                    url: "<?php echo base_url(); ?>admin/data_lapangan_hapus",
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