<style>
    .select2-container .select2-selection--single {
        height: 125px !important;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="card mb-2">
            <div class="card-body">
                <?php echo $this->session->flashdata('msg'); ?>
                <!-- <h5 class="text-center"> DATA PEMAIN / OFFICIAL PIALA BEREGU </h5> -->
                <h5 class="text-center"> <?php echo $event['nama']; ?> </h5>
                <a href="<?php echo base_url('admin/data_pemain_export_all/' . $event['id_event']) ?>" target="_blank" class="btn btn-xs btn-success btn-rounded"><i class="far fa-file-excel"></i> EXPORT ALL DATA</a>
                <div data-label="Example" class="df-example demo-table">
                    <div class="table-responsive">
                        <table class="datatable-pemain table table-bordered table-primary mg-b-0">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th class="wd-20">No</th>
                                    <!-- <th>Foto</th> -->
                                    <th>Kontingen / Pengda</th>
                                    <th>Official</th>
                                    <th>Peserta Konggres</th>
                                    <?php
                                    $kategori = $this->Model_admin->get_kategori_pemain($event['id_event']);
                                    foreach ($kategori->result_array() as $D) {
                                        echo '<th>' . $D['kategori'] . '</th>';
                                    }
                                    ?>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $list_kontingen = $this->Model_admin->get_list_kontingen_perorangan($id_event);
                                $kategori = $this->Model_admin->get_kategori_pemain($id_event);
                                foreach ($list_kontingen->result_array() as $R) {
                                    $id_kontingen = $R['id_kontingen'];
                                    $new_array[$id_kontingen] = $R;
                                    $new_array[$id_kontingen][1] = $R['total_official'];
                                    $new_array[$id_kontingen][2] = $R['total_peserta_konggres'];
                                    foreach ($kategori->result_array() as $D) {
                                        $id_kategori = $D['id_kategori'];
                                        $new_array[$id_kontingen][$id_kategori] = 0;
                                    }
                                }
                                $all_pemain = $this->Model_admin->get_list_pemain_all($id_event);

                                foreach ($all_pemain->result_array() as $D) {
                                    $id_kontingen = $D['id_kontingen'];
                                    $id_kategori = $D['id_kategori'];
                                    if($id_kategori) $new_array[$id_kontingen][$id_kategori]++;
                                }
                                // echo '<pre>';
                                // print_r($list_kontingen->result_array());
                                // echo '</pre>';
                                foreach ($new_array as $R) {
                                    echo '<tr align="center">';
                                    echo "<td>" . $no . "</td>";
                                    echo "<td align='left'>" . $R['nama_satker'] . "</td>";
                                    $official = $R[1];
                                    $bg_official = 'bg-success';
                                    if ($official == '2') $bg_official = 'bg-success';
                                    if ($official < '2') $bg_official = 'bg-warning';
                                    if ($official == '0') $bg_official = 'bg-danger';
                                    $total_peserta_konggres = $R[2];
                                    $bg_total_peserta_konggres = 'bg-success';
                                    if ($total_peserta_konggres == '1') $bg_total_peserta_konggres = 'bg-success';
                                    if ($total_peserta_konggres < '1') $bg_total_peserta_konggres = 'bg-danger';
                                    // if ($veteran ==  $R['total_veteran_sudah']) $veteran = 'bg-success';

                                    echo "<td align='center' class='" . $bg_official . "'>" . $official . "</td>";
                                    echo "<td align='center' class='" . $bg_total_peserta_konggres . "'>" . $total_peserta_konggres . "</td>";
                                    foreach($kategori->result_array() as $K){
                                        $id_kategori = $K['id_kategori'];
                                        $maks = 1;
                                        if($K['tunggal_ganda'] == 'ganda') $maks = 2;
                                        $bg = 'bg-danger';
                                        if($R[$id_kategori] > 0 && $R[$id_kategori] < $maks)
                                        $bg = 'bg-warning';
                                        else if($R[$id_kategori] == $maks)
                                        $bg = 'bg-success';
                                        echo "<td align='center' class='" . $bg . "'>" . $R[$id_kategori] . "</td>";
                                    }
                                    echo
                                    '<td>
                                        <a href="javascript:void(0)" data-id_kontingen="' . $R['id_kontingen'] . '" class="detil btn btn-xs btn-outline-primary btn-rounded" data-toggle="tooltip" data-placement="top" title="Detil"><i class="fas fa fa-play"></i></a>
                                        <a href="' . base_url('admin/data_pemain_export/Perorangan/' . $R['id_kontingen'].'/'.$id_event) . '" target="_blank" class="btn btn-xs btn-outline-success btn-rounded" data-toggle="tooltip" data-placement="top" title="Export Excell"><i class="far fa-file-excel"></i></a>';
                                    echo "</td>";
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
    $(document).ready(function() {
        $("#card_tambah").hide();
    });
    $('[data-toggle="tooltip"]').tooltip();

    $('.datatable-pemain').DataTable({
        pageLength: '100',
        language: {
            searchPlaceholder: 'Pencarian...',
            sSearch: '',
            lengthMenu: '_MENU_ Kontingen/Halaman',
            // info: false
        }
    });
    // $("#card_tambah").hide();
    $("#tambah").on('click', function() {
        $("#card_tambah").toggle();
    });
    $("#tambah_lama").on('click', function() {
        //loader
        $(".title_loader").text("Sedang Memuat Halaman");
        $("#konten").html($("#loader_html").html());
        // $('.nav-item.active').removeClass('active');
        // $(this).closest('li.nav-item').addClass('active');
        //loader
        // skip();
        var form_data = new FormData();
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_pemain_form",
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

    $(".detil").on('click', function() {
        var form_data = new FormData();
        form_data.append('id_kontingen', $(this).data('id_kontingen'));
        form_data.append('id_event', '<?php echo $id_event; ?>');
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_pemain_detil_perorangan",
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
</script>