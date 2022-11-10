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
                        <table class="datatable-pemain table table-primary mg-b-0">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th class="wd-20">No</th>
                                    <!-- <th>Foto</th> -->
                                    <th>Kontingen / Pengda</th>
                                    <th>OFFICIAL</th>
                                    <th>BEREGU PUTRA</th>
                                    <th>BEREGU PUTRI</th>
                                    <th>VETERAN</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $list_kontingen = $this->Model_admin->get_list_pemain_beregu($id_event);
                                // echo '<pre>';
                                // print_r($list_kontingen->result_array());
                                // echo '</pre>';
                                foreach ($list_kontingen->result_array() as $R) {
                                    echo '<tr align="center">';
                                    echo "<td>" . $no . "</td>";
                                    echo "<td align='left'>" . $R['nama_satker'] . "</td>";
                                    $official = $R['total_official_blm'] + $R['total_official_sudah'];
                                    $putra = $R['total_putra_blm'] + $R['total_putra_sudah'];
                                    $putri = $R['total_putri_blm'] + $R['total_putri_sudah'];
                                    $veteran = $R['total_veteran_blm'] + $R['total_veteran_sudah'];
                                    $bg_official = 'bg-success';
                                    if ($official == '2' && $official ==  $R['total_official_sudah']) $bg_official = 'bg-success';
                                    if ($official < '2') $bg_official = 'bg-warning';
                                    if ($official == '0') $bg_official = 'bg-danger';
                                    $bg_putra = 'bg-success';
                                    if ($putra == '8' && $putra ==  $R['total_putra_sudah']) $bg_putra = 'bg-success';
                                    if ($putra < '8') $bg_putra = 'bg-warning';
                                    if ($putra == '0') $bg_putra = 'bg-danger';
                                    $bg_putri = 'bg-success';
                                    if ($putri == '6' && $putri ==  $R['total_putri_sudah']) $bg_putri = 'bg-success';
                                    if ($putri < '6') $bg_putri = 'bg-warning';
                                    if ($putri == '0') $bg_putri = 'bg-danger';
                                    $bg_veteran = 'bg-success';
                                    if ($veteran == '0') $bg_veteran = 'bg-danger';
                                    // if ($veteran ==  $R['total_veteran_sudah']) $veteran = 'bg-success';

                                    echo "<td align='center' class='" . $bg_official . "'>" . $official . "</td>";
                                    echo "<td align='center' class='" . $bg_putra . "'>" . $putra . "</td>";
                                    echo "<td align='center' class='" . $bg_putri . "'>" . $putri . "</td>";
                                    echo "<td align='center' class='" . $bg_veteran . "'>" . $veteran . "</td>";
                                    echo
                                    '<td>
                                        <a href="javascript:void(0)" data-id_kontingen="' . $R['id_kontingen'] . '" class="detil btn btn-xs btn-outline-primary btn-rounded" data-toggle="tooltip" data-placement="top" title="Detil"><i class="fas fa fa-play"></i></a>
                                        <a href="' . base_url('admin/data_pemain_export/Beregu/' . $R['id_kontingen']) . '" target="_blank" class="btn btn-xs btn-outline-success btn-rounded" data-toggle="tooltip" data-placement="top" title="Export Excell"><i class="far fa-file-excel"></i></a>';
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
            url: "<?php echo base_url(); ?>admin/data_pemain_detil_beregu",
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