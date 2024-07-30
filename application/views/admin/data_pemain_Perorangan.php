<style>
    .select2-container .select2-selection--single {
        height: 125px !important;
    }
</style>
<?php
$kontingen = $this->Model_admin->get_data_kontingen($id_kontingen);
?>
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Pemain - <?php echo $kontingen['nama_kontingen']; ?></li>
            </ol>
        </nav>

        <h5 class="text-center"> <?php echo $event['nama']; ?> </h5>
        <?php
        // if ($event['tanggal_selesai'] >= date('Y-m-d')) {
        $pendaftaran = false;
        if ('2024-12-11' >= date('Y-m-d')) {
            $pendaftaran = true;
        } else {
            echo '<h4 class="text-danger">Pendaftaran Telah Berakhir</h4>';
        }
        ?>

        <?php
        if (IN_ARRAY($_SESSION['id_panitia'], array(0, 1))) { ?>
            <a href="<?php echo base_url('admin/data_pemain_export/Beregu/' . $id_kontingen); ?>" target='_blank' id='tambah' class="btn-tambah btn btn-success"><i class="far fa-file-excel"></i> Export Excell</a>
        <?php } ?>
    </div>
</div>
<div class="row mb-4" id="card_tambah">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card mb-2">
            <div class="card-body">
                <?php echo $this->session->flashdata('msg'); 
                $list_official = $this->Model_admin->get_data_non_pemain($id_kontingen, 1);
                $tambah = true;
                if($list_official->num_rows() >= 2) $tambah = false;
                ?>
                <h5 class="text-center"> DATA MANAJER / OFFICIAL </h5>
                <?php 
                    if($tambah){
                        echo '<a href="javascript:void(0)" data-jenis="official" data-id_kategori="1" class="btn-tambah btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Official</a>';
                    }
                    ?>
                
                <div data-label="Example" class="df-example demo-table">
                    <div class="table-responsive">
                        <table class="datatable-pemain table table-primary mg-b-0">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th class="wd-20">No</th>
                                    <!-- <th>Foto</th> -->
                                    <th>Nama</th>
                                    <th>Nip</th>
                                    <th>No Handphone</th>
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
                                foreach ($list_official->result_array() as $R) {
                                    echo '<tr align="center">';
                                    echo "<td>" . $no . "</td>";
                                    // if (!empty($R['FotoPegawai']) OR !empty($R['FotoFormal'])) {
                                    // echo "<td class='align-center'><a href='" . cdn_foto($R['FotoPegawai'], $R['FotoFormal'], 200) . "' data-lightbox='$R[nama_gelar]' data-title='$R[nama_gelar]'><center><img src='" . cdn_foto($R['FotoPegawai'], $R['FotoFormal']) . "' class='img-thumbnail d-block' style='width:70px;height:85px;'></center></a></td>";
                                    // } else {
                                    // echo "<td align='align-center'><img src='" . base_url('assets/profil/default.png') . "' class='img-thumbnail' style='width:55px;height:60px;'></td>";
                                    // }
                                    echo "<td align='left'>" . $R['nama'] . "</td>";
                                    echo "<td align='left'>" . ($R['nip']) . "</td>";
                                    echo "<td align='left'>" . $R['NomorHandphone'] . "</td>";
                                    echo "<td align='left'>" . $R['jenis_kelamin'] . "</td>";
                                    //echo "<td align='left'>" . $R['NomorHandphone'] . "</td>";
                                    echo "<td align='left'>" . $R['umur'] . "</td>";
                                    echo "<td align='left'>" . $R['jabatan'] . "</td>";
                                    echo "<td align='left'>" . $R['nama_satker'] . "</td>";
                                    echo '<td>
                                        <a href="javascript:void(0)" data-id_pemain="' . $R['id_user'] . '" data-jenis="official" data-id_kategori="1" class="hapus btn btn-xs btn-outline-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa fa-times"></i></a>';
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
        <div class="card mb-2">
            <div class="card-body">
                <?php echo $this->session->flashdata('msg'); 
                $list_official = $this->Model_admin->get_data_non_pemain($id_kontingen, 2);
                $tambah = true;
                if($list_official->num_rows() >= 4) $tambah = false;
                ?>
                <h5 class="text-center"> DATA PESERTA KONGGRESS </h5>
                <?php 
                    if($tambah){
                        echo '<a href="javascript:void(0)" data-jenis="official" data-id_kategori="2" class="btn-tambah btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Peserta Konggress</a>';
                    }
                    ?>
                
                <div data-label="Example" class="df-example demo-table">
                    <div class="table-responsive">
                        <table class="datatable-pemain table table-primary mg-b-0">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th class="wd-20">No</th>
                                    <!-- <th>Foto</th> -->
                                    <th>Nama</th>
                                    <th>Nip</th>
                                    <th>No Handphone</th>
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
                                foreach ($list_official->result_array() as $R) {
                                    echo '<tr align="center">';
                                    echo "<td>" . $no . "</td>";
                                    // if (!empty($R['FotoPegawai']) OR !empty($R['FotoFormal'])) {
                                    // echo "<td class='align-center'><a href='" . cdn_foto($R['FotoPegawai'], $R['FotoFormal'], 200) . "' data-lightbox='$R[nama_gelar]' data-title='$R[nama_gelar]'><center><img src='" . cdn_foto($R['FotoPegawai'], $R['FotoFormal']) . "' class='img-thumbnail d-block' style='width:70px;height:85px;'></center></a></td>";
                                    // } else {
                                    // echo "<td align='align-center'><img src='" . base_url('assets/profil/default.png') . "' class='img-thumbnail' style='width:55px;height:60px;'></td>";
                                    // }
                                    echo "<td align='left'>" . $R['nama'] . "</td>";
                                    echo "<td align='left'>" . ($R['nip']) . "</td>";
                                    echo "<td align='left'>" . $R['NomorHandphone'] . "</td>";
                                    echo "<td align='left'>" . $R['jenis_kelamin'] . "</td>";
                                    //echo "<td align='left'>" . $R['NomorHandphone'] . "</td>";
                                    echo "<td align='left'>" . $R['umur'] . "</td>";
                                    echo "<td align='left'>" . $R['jabatan'] . "</td>";
                                    echo "<td align='left'>" . $R['nama_satker'] . "</td>";
                                    echo '<td>
                                        <a href="javascript:void(0)" data-id_pemain="' . $R['id_user'] . '" data-jenis="official" data-id_kategori="2" class="hapus btn btn-xs btn-outline-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa fa-times"></i></a>';
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
        <?php
        foreach ($kategori_pemain->result_array() as $K) {
            $list_pemain = $this->Model_admin->get_data_pemain_new($id_kontingen, $K['id_kategori']);
            $tambah = true;
            if($K['tunggal_ganda'] == 'tunggal' && $list_pemain->num_rows() >= 1) $tambah = false;
            if($K['tunggal_ganda'] == 'ganda' && $list_pemain->num_rows() >= 2) $tambah = false;
            // echo '<pre>';
            // print_r($K);
            // print_r($list_pemain->num_rows());
            // echo '</pre>';

        ?>
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="text-center"> <?php echo strtoupper($K['kategori']); ?> </h5>
                    <?php 
                    if($tambah){
                        echo '<a href="javascript:void(0)" data-jenis="pemain" data-id_kategori="'.$K['id_kategori'].'" data-jns_kelamin="'.$K['beregu'].'" class="btn-tambah btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Pemain</a>';
                    }
                    ?>
                    
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
                                        if ($R['is_dharmayukti']) {
                                            echo '<tr align="center">';
                                            echo "<td>" . $no . "</td>";
                                            // if (!empty($R['FotoPegawai']) OR !empty($R['FotoFormal'])) {
                                            // echo "<td class='align-center'><a href='" . cdn_foto($R['FotoPegawai'], $R['FotoFormal'], 200) . "' data-lightbox='$R[nama_gelar]' data-title='$R[nama_gelar]'><center><img src='" . cdn_foto($R['FotoPegawai'], $R['FotoFormal']) . "' class='img-thumbnail d-block' style='width:70px;height:85px;'></center></a></td>";
                                            // } else {
                                            // echo "<td align='align-center'><img src='" . base_url('assets/profil/default.png') . "' class='img-thumbnail' style='width:55px;height:60px;'></td>";
                                            // }
                                            echo "<td align='left'>" . $R['nama_istri'] . "</td>";
                                            echo "<td align='left'>Dharmayukti</td>";
                                            echo "<td align='left'>Wanita</td>";
                                            echo "<td align='left'>-</td>";
                                            echo "<td align='left'>Istri " . $R['nama'] . "</td>";
                                            echo "<td align='left'>" . $R['jabatan'] . " <br>" . $R['nama_satker'] . "</td>";
                                            echo '<td>
                                            <span data-id_pemain="' . $R['id_pemain'] . '" class="hapus btn btn-xs btn-outline-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa fa-times"></i></span>';
                                            echo "</td>";
                                            echo "</tr>";
                                        } else {
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
                                            <a href="javascript:void(0)" data-id_pemain="' . $R['id_pemain'] . '" data-jenis="pemain" data-id_kategori="'.$K['id_kategori'].'" class="hapus btn btn-xs btn-outline-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa fa-times"></i></a>';
                                            echo "</td>";
                                            echo "</tr>";
                                        }

                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div><!-- table-responsive -->
                    </div><!-- df-example -->
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header pd-x-20 pd-sm-x-30 bg-primary">
                <h5 class="modal_judul tx-white" id="modal_tambah_judul"> Tambah Pemain / Official </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal_isi" id="modal_tambah_isi">
                <form id='form_konten' enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <div id="dharmayukti_box"><input class="filter" type='checkbox' id='is_dharmayukti' value='1'> Dharmayukti</div>
                            <div class="form-group">
                                <label class="control-label">Nama :</label>
                                <div id='div_id_pemain'>
                                    <select name='id_pemain' id='id_pemain' class='form-control select_nama' style="height: 100px;">
                                    </select>
                                </div>
                                <small class='text-danger'>Pemain Hanya bisa di wilayah Tingkat Bandingnya</small>
                            </div>
                            <div id='biodata'></div>
                        </div>
                    </div>
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading tx-bolder">Pernyataan</h4>
                        <p class="text-justify">Saya setuju, seluruh data yang diinput ke dalam aplikasi ini adalah valid dan benar serta telah disetujui oleh <b>Ketua Umum Pengurus PTWP Dearah</b> masing-masing.
                            Apabila data yang diinput tidak benar, maka <b>Pengurus Daerah</b> terkait bersedia menerima sanksi yang ditetapkan oleh <b>Pengurus PTWP Pusat</b></p>
                        <hr>
                        <div class="tx-center">
                            <input type="checkbox" id="is_setuju"> Setuju
                        </div>
                    </div>
                    <div class="row text-center mx-4 mt-3">
                        <div class="col-lg-12">
                            <span id='simpan' class="btn btn-outline-success btn-rounded"><i class="fa fa-save"></i> SIMPAN</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var jenis = '';
    var id_kategori = 0;

    $(document).ready(function() {
        $("#card_tambah").hide();
    });
    $('[data-toggle="tooltip"]').tooltip();

    $('.datatable-pemain').DataTable({
        "paging": false,
        language: {
            searchPlaceholder: 'Pencarian...',
            sSearch: '',
            lengthMenu: '_MENU_ Pemain/Halaman',
            // info: false
        }
    });
    // $("#card_tambah").hide();
    $(".btn-tambah").on('click', function() {
        jenis = $(this).data('jenis');
        const jns_kelamin = $(this).data('jns_kelamin');
        id_kategori = $(this).data('id_kategori');
        $('#modal_tambah_judul').html($(this).html());
        if (jns_kelamin == 'putri') {
            $('#dharmayukti_box').show();
        } else {
            $('#dharmayukti_box').hide();
        }
        $(".select_nama").val('').trigger('change');
        $("#is_dharmayukti").prop('checked', false);
        $('.modal').modal('hide');
        $('#modal_tambah').modal('show');
    });
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
                form_data.append('id_pemain', $(this).data('id_pemain'));
                form_data.append('jenis', $(this).data('jenis'));
                form_data.append('id_kategori', $(this).data('id_kategori'));
                form_data.append('id_event', '<?php echo $id_event; ?>');
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

    // BATAS PINDAHAN SIMPAN FORM
    $(".select_nama").select2({
        dropdownParent: $("#modal_tambah"),
        placeholder: 'Minimal 4 Karakter',
        templateResult: formatState,
        templateSelection: formatState,
        allowClear: true,
        dropdownAutoWidth: true,
        ajax: { //bawaan nya > Kirim data method $_GET['q'];
            delay: 250, // wait 250 milliseconds before triggering the request
            url: "<?php echo base_url(); ?>admin/get_data_id_nama",
            dataType: 'json',
            data: function(data) {
                var is_dharmayukti = 0;
                const is_veteran = 0;
                if ($('#is_dharmayukti').is(":checked") == true) {
                    is_dharmayukti = 1;
                }
                return {
                    term: data.term,
                    _type: 'query',
                    q: data.term,
                    dharmayukti: is_dharmayukti,
                    veteran: is_veteran
                };
            }
            // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
        }
    });

    $(".select_nama_dharmayukti").select2({
        placeholder: 'Minimal 4 Karakter',
        templateResult: formatState,
        templateSelection: formatState,
        allowClear: true,
        ajax: { //bawaan nya > Kirim data method $_GET['q'];
            delay: 250, // wait 250 milliseconds before triggering the request
            url: "<?php echo base_url(); ?>admin/get_data_id_nama_dharmayukti",
            dataType: 'json'
            // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
        }
    });

    function formatState(state) {

        if (!state.id) {
            return state.text;
        }
        var $state = $('' + state.text + '');
        return $state;
    }

    $("#div_id_pemain_dharmayukti").hide();
    // $("#is_dharmayukti").on('click', function() {
    //     // alert($(this).is(":checked"));
    //     if ($(this).is(":checked") == true) {
    //         $("#div_id_pemain").hide();
    //         $("#div_id_pemain_dharmayukti").show();
    //     } else {
    //         $("#div_id_pemain").show();
    //         $("#div_id_pemain_dharmayukti").hide();
    //     }
    // });
    $(".filter").on('click', function() {
        $(".filter").not(this).prop('checked', false);
    });
    $("#simpan").hide();
    $("#is_setuju").on('click', function() {
        // alert($(this).is(":checked"));
        if ($(this).is(":checked") == true) {
            $("#simpan").show();
        } else {
            $("#simpan").hide();
        }
    });

    $("#simpan").on('click', function() {

        var id_pemain = $("#id_pemain").val();
        var is_dharmayukti = 0;
        var is_official = 0;
        var is_veteran = 0;
        if ($("#is_dharmayukti").is(":checked") == true) {
            is_dharmayukti = 1;
        }
        if (jenis == 'official') {
            is_official = true;
        }
        if ($("#is_veteran").is(":checked") == true) {
            is_veteran = 1;
        }

        $("#simpan").html('<i class="fa fa-spinner fa-spin"></i> Sedang Memproses Data');
        var form_data = new FormData();
        form_data.append('id_kontingen', '<?php echo $id_kontingen; ?>');
        form_data.append('id_kategori', id_kategori);
        form_data.append('is_dharmayukti', is_dharmayukti);
        form_data.append('id_pemain', id_pemain);
        form_data.append('is_official', is_official);
        form_data.append('is_veteran', is_veteran);
        form_data.append('id_event', '<?php echo $id_event; ?>');
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_pemain_simpan",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(json) {
                if (json.status !== true) {
                    $("#simpan").html('Simpan').prop("disabled", false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Peringatan',
                        html: "<div style='text-align:justify;'>" + json.pesan + "</div>"
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Simpan Data Berhasil',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    $("body").scrollTop('0px');
                    $('.modal').modal('hide');
                    $(document.body).removeClass('modal-open');
                    $('.modal-backdrop').remove();

                    $("#konten").fadeOut(300);
                    $("#konten").html(json.konten_menu);
                    $("#konten").fadeIn(300);
                }
            }
        });
    });
</script>