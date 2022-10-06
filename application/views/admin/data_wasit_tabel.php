<div class="table-responsive">
    <table class="datatable-wasit table table-primary table-striped mg-b-0">
        <thead class="thead-primary">
            <tr class="text-center">
                <th class="wd-20">No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $rekap = $this->Model_admin->get_data_wasit($_POST);
            if ($rekap->num_rows()) {
                foreach ($rekap->result_array() as $R) {
                    echo '<tr align="center" data-id_wasit ="' . $R['id_wasit'] . '">';
                    echo "<td>" . $no . "</td>";
                    echo "<td align='left'>" . $R['nama'] . "</td>";
                    echo "<td>" . $R['nip'] . "</td>";
                    echo '<td>';
                    echo '<div class="btn-group-vertical">';
                    echo '<a href="javascript:void(0)" data-id_wasit="' . $R['id_wasit'] . '" class="hapus btn btn-xs btn-outline-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa fa-times"></i></a href="javascript:void(0)">';
                    echo '<a href="javascript:void(0)" data-id_wasit="' . $R['id_wasit'] . '" class="edit  btn btn-xs btn-outline-warning btn-rounded" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa fa-edit"></i></a href="javascript:void(0)">';
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
    $("#dt-table").on('change', '.aktivasi', function() {
        var ini = this;
        var check;
        if (this.checked) {
            check = '1';
        } else {
            check = '0';
        }
        var id_wasit = $(this).closest('tr').data('id_wasit');
        var nomor = $(this).data('no');

        var form_data = new FormData();
        form_data.append('id_wasit', id_wasit);
        form_data.append('aktif', check);
        form_data.append('nomor', nomor);
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_wasit_aktivasi",
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

    $(".table").on('click', '.edit', function(e) {
        $(".title_loader").text("Sedang Memuat Halaman");
        $("#konten").html($("#loader_html").html());
        var form_data = new FormData();
        form_data.append('id_wasit', $(this).data('id_wasit'));
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_wasit_form",
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
                form_data.append('id_wasit', $(this).data('id_wasit'));
                $.ajax({
                    url: "<?php echo base_url(); ?>admin/data_wasit_hapus",
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