<style>
    .select2-container .select2-selection--single {
        height: 125px !important;
    }
</style>
<?php
$id_kontingen = '514';
$kontingen = $this->Model_admin->get_data_kontingen($id_kontingen);
?>
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Pemain - <?php echo $kategori_pemain['kategori']; ?></li>
            </ol>
        </nav>

        <h5 class="text-center"> <?php echo $event['nama']; ?> </h5>
        <?php
        // if ($event['tanggal_selesai'] >= date('Y-m-d')) {
        $pendaftaran = false;
        if ($event['tanggal_selesai'] >= date('Y-m-d')) {
            $pendaftaran = true;
        } else {
            echo '<h4 class="text-danger">Pendaftaran Telah Berakhir</h4>';
        }
        ?>

        <?php
        if (IN_ARRAY($_SESSION['id_panitia'], array(0, 1))) { ?>
            <a href="<?php echo base_url('admin/data_pemain_veteran_export/' . $event['id_event']); ?>" target='_blank' id='tambah' class="btn-tambah btn btn-success"><i class="far fa-file-excel"></i> Export Excell</a>
        <?php } ?>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card mb-2">
            <div class="card-body">
                <?php echo $this->session->flashdata('msg'); 
                $list_veteran = $this->Model_admin->get_data_pemain_veteran();
                $tambah = true;
                if($list_veteran->num_rows() >= 128) $tambah = false;
                ?>
                <h5 class="text-center"> DATA PEMAIN VETERAN </h5>
                <?php 
                    if($tambah){
                        echo '<a href="javascript:void(0)" data-jenis="official" data-id_kategori="1" class="btn-tambah btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Data Pemain / TIM</a>';
                    }
                    else{
                        echo "<span class='text-danger'>Peserta sudah melebihi 64 TIM</span>";
                    }
                    ?>
                
                <div data-label="Example" class="df-example demo-table">
                    <div class="table-responsive">
                        <table class="datatable-pemain table table-bordered table-primary mg-b-0">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th class="wd-20">No</th>
                                    <!-- <th>Foto</th> -->
                                    <th>TIM</th>
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
                                $tim = 1;      
                                $tim_temp = 0;                         
                                foreach ($list_veteran->result_array() as $R) {
                                    
                                    

                                    echo '<tr align="center">';
                                    echo "<td>" . $no . "</td>";
                                    // if (!empty($R['FotoPegawai']) OR !empty($R['FotoFormal'])) {
                                    // echo "<td class='align-center'><a href='" . cdn_foto($R['FotoPegawai'], $R['FotoFormal'], 200) . "' data-lightbox='$R[nama_gelar]' data-title='$R[nama_gelar]'><center><img src='" . cdn_foto($R['FotoPegawai'], $R['FotoFormal']) . "' class='img-thumbnail d-block' style='width:70px;height:85px;'></center></a></td>";
                                    // } else {
                                    // echo "<td align='align-center'><img src='" . base_url('assets/profil/default.png') . "' class='img-thumbnail' style='width:55px;height:60px;'></td>";
                                    // }
                                    if($R['id_tim'] !== $tim_temp && $tim_temp !== 0){
                                        $tim++;
                                        echo "<td align='left' rowspan = '2'>".$tim."</td>";
                                    }
                                    else if($tim_temp == 0){
                                        echo "<td align='left' rowspan = '2'>".$tim."</td>";
                                    }        
                                    else{
                                        echo "<td align='left' style='display:none'></td>";
                                    }                             
                                    
                                    
                                    echo "<td align='left'>" . $R['nama'] . "</td>";
                                    echo "<td align='left'>" . ($R['nip']) . "</td>";
                                    echo "<td align='left'>" . $R['NomorHandphone'] . "</td>";
                                    echo "<td align='left'>" . $R['jenis_kelamin'] . "</td>";
                                    //echo "<td align='left'>" . $R['NomorHandphone'] . "</td>";
                                    echo "<td align='left'>" . $R['umur'] . "</td>";
                                    echo "<td align='left'>" . $R['jabatan'] . "</td>";
                                    echo "<td align='left'>" . $R['nama_satker'] . "</td>";
                                    if($R['user_created'] == $_SESSION['id_user'] or IN_ARRAY($_SESSION['id_panitia'], array(0, 1))){
                                        if($R['id_tim'] !== $tim_temp && $tim_temp !== 0){
                                            echo '<td align="left" rowspan = "2">
                                                <a href="javascript:void(0)" data-id_tim="' . $R['id_tim'] . '" class="hapus btn btn-xs btn-outline-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="Delete TIM"><i class="fas fa fa-times"></i></a>';
                                            echo "</td>";
                                        }
                                        else if($tim_temp == 0){
                                            echo '<td align="left" rowspan = "2">
                                                <a href="javascript:void(0)" data-id_tim="' . $R['id_tim'] . '" class="hapus btn btn-xs btn-outline-danger btn-rounded" data-toggle="tooltip" data-placement="top" title="Delete TIM"><i class="fas fa fa-times"></i></a>';
                                            echo "</td>";
                                        }        
                                        else{
                                            echo "<td align='left' style='display:none'></td>";
                                        }   
                                        
                                    }else{

                                        echo "<td></td>";
                                    }
                                    echo "</tr>";
                                    $no++;
                                    $tim_temp = $R['id_tim'];
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
<div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header pd-x-20 pd-sm-x-30 bg-primary">
                <h5 class="modal_judul tx-white" id="modal_tambah_judul"> Tambah Pemain </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal_isi" id="modal_tambah_isi">
                <form id='form_konten' enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label">Pemain 1 :</label>
                                <div id='div_id_pemain'>
                                    <select name='id_pemain' id='id_pemain' class='form-control select_nama' style="height: 100px;">
                                    </select>
                                </div>
                            </div>
                            <div id='biodata'></div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label">Pemain 2 :</label>
                                <div id='div_id_pemain'>
                                    <select name='id_pemain_2' id='id_pemain_2' class='form-control select_nama' style="height: 100px;">
                                    </select>
                                </div>
                            </div>
                            <div id='biodata'></div>
                        </div>
                        
                        <small class='text-danger ml-4'>Pemain Harus Pegawai Aktif dan Terdaftar di SIKEP MA RI, berusia minimal 60 dan maksimal 70 tahun</small>
                    </div>
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading tx-bolder">Pernyataan</h4>
                        <p class="text-justify">Saya setuju, seluruh data yang diinput ke dalam aplikasi ini adalah valid dan benar.
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
                form_data.append('id_tim', $(this).data('id_tim'));
                form_data.append('id_event', '<?php echo $id_event; ?>');
                $.ajax({
                    url: "<?php echo base_url(); ?>admin/hapus_data_tim_veteran",
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
            url: "<?php echo base_url(); ?>admin/get_data_id_nama_veteran",
            dataType: 'json',
            data: function(data) {
                return {
                    term: data.term,
                    _type: 'query',
                    q: data.term
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

        var id_pemain_1 = $("#id_pemain").val();
        var id_pemain_2 = $("#id_pemain_2").val();

        $("#simpan").html('<i class="fa fa-spinner fa-spin"></i> Sedang Memproses Data');
        var form_data = new FormData();
        form_data.append('id_pemain_1', id_pemain_1);
        form_data.append('id_pemain_2', id_pemain_2);
        form_data.append('id_event', '<?php echo $id_event; ?>');
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_pemain_veteran_simpan",
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