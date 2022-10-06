<script src="<?php echo base_url(); ?>assets/lib/jquery/jquery.min.js"></script>

<link href="<?php echo base_url(); ?>assets/lib/select2/css/select2.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/lib/select2/js/select2.min.js"></script>


<div class="content content-fixed content-auth">
    <div class="container">
        <div class="media d-flex flex-column flex-lg-row justify-content-center ht-100p">
            <form id="form_register" method="post" enctype="multipart/form-data">
                <div class="sign-wrapper mg-lg-r-50 mg-xl-r-60">
                    <div class="pd-t-20 wd-400 lh-1">
                        <div class="form-group">
                            <label>Nip <small class="tx-danger">(Jika Non Pegawai Nip Tidak Usah Diisi, Jika Pegawai Nip Harus 18 Digit)</small></label>
                            <input type="text" class="form-control" placeholder='198701262006041002' maxlength='18' id='nip' name='nip'>
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between mg-b-5">
                                <label class="mg-b-0-f">Nama</label>
                            </div>
                            <input type="text" class="form-control" placeholder="Dika Andrian" id='nama' name='nama'>
                        </div>
                        <div class="form-group">
                            <label>No. WA</label>
                            <input type="text" class="form-control" placeholder='081298078787' id='no_wa' name='no_wa'>
                        </div>
                        <div class="form-group">
                            <label>Panitia <small class="tx-danger">(admin berhak merubah jabatan panitia anda sewaktu waktu)</small></label>
                            <select id='id_panitia' name='id_panitia' class="form-control">
                                <option></option>
                                <?php
                                $rekap = $this->basic->get_data('master_panitia');
                                $no = 0;
                                if ($rekap->num_rows()) {
                                    foreach ($rekap->result_array() as $R) {
                                        $no++;
                                        if ($R['id_panitia'] > 0) echo "<option value='$R[id_panitia]'>$R[panitia]</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kontingen Pengurus Daerah</label>
                            <select id='id_kontingen' name='id_kontingen' class="form-control select2 wd-400">
                                <option></option>
                                <?php
                                $rekap = $this->basic->get_data_where("(IdSatker = 920 OR LevelSatker = 2) AND IsAktif = 'Y'", 'tmst_satker', 'UrutanTingkatBanding ASC');
                                $no = 0;
                                if ($rekap->num_rows()) {
                                    foreach ($rekap->result_array() as $R) {
                                        $no++;
                                        echo "<option value='$R[IdSatker]'>$R[IdSatker] $R[NamaSatker]</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between mg-b-5">
                                <label class="mg-b-0-f">File SK Pengurus Daerah<small class="tx-danger"> (File yang di-ijinkan .pdf dan maksimal 2MB)</small></label>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file_upload" name="file_upload">
                                <label class="custom-file-label" for="customFile">Unggah File Pendukung</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between mg-b-5">
                                <label class="mg-b-0-f">Username</label>
                            </div>
                            <input type="text" class="form-control" placeholder="Username" id='username' name='username'>
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between mg-b-5">
                                <label class="mg-b-0-f">Password</label>
                            </div>
                            <input type="password" class="form-control" placeholder="Password" id='password' name='password'>
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between mg-b-5">
                                <label class="mg-b-0-f">Konfirmasi Password</label>
                            </div>
                            <input type="password" class="form-control" placeholder="Konfirmasi Password" id='password_confirm' name='password_confirm'>
                        </div>
                        <div>
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading tx-bolder">Pernyataan</h4>
                                <p class="text-justify">Saya setuju, seluruh data yang diinput ke dalam aplikasi ini adalah valid dan benar serta telah disetujui oleh <b>Ketua Umum Pengurus PTWP Daerah</b> masing-masing.
                                    Apabila data yang diinput tidak benar, maka <b>Pengurus Daerah</b> terkait bersedia menerima sanksi yang ditetapkan oleh <b>Pengurus PTWP Pusat</b></p>
                                <hr>
                                <div class="tx-center">
                                    <input type="checkbox" id="is_setuju"> Setuju
                                </div>
                            </div>
                        </div>
                        <button id="btn-simpan" type="submit" class="btn btn-brand-02 btn-block">Daftar</button>
                        <div class="divider-text">Atau</div>
                        <div class="tx-13 mg-t-20 tx-center">Sudah Mempunyai Akun? <a href="<?php echo base_url('admin'); ?>">Login</a></div>
                    </div>
                </div><!-- sign-wrapper -->
            </form>
            <div class="media-body pd-y-30 pd-lg-x-50 pd-xl-x-60 d-lg-flex pos-relative">
                <div class="wd-400">
                    <img src="<?php echo base_url('assets/img/sign-up.png'); ?>" class="img-fluid wd-400" alt="">
                    <div class="card">
                        <div class="sticky-top card-header d-flex align-items-center justify-content-between">
                            <h6 class="mg-b-0">Daftar Pengurus</h6>
                        </div>
                        <ul class="list-group list-group-flush tx-13 scrollbar-sm pos-relative" id="scroll">
                            <?php
                            $rekap = $this->basic->get_data('view_user');
                            $no = 0;
                            if ($rekap->num_rows()) {
                                foreach ($rekap->result_array() as $R) {
                                    $no++;
                                    if ($R['aktif'] == "1") {
                                        $validasi = "<small class='badge bg-success tx-12 text-light mg-b-0'><i class='icon ion-md-checkmark'></i> Sudah Divalidasi</small>";
                                    } elseif ($R['aktif'] == "0") {
                                        $validasi = "<small class='badge bg-danger tx-12 text-light mg-b-0'><i class='icon ion-md-close'></i> Belum Divalidasi</small>";
                                    };
                                    // if ($R['id_panitia'] > 0) echo "$R[nama] $R[panitia] $R[nama_satker_parent] $R[aktif]<br>";
                                    if ($R['id_panitia'] > 0) echo "
                                     <li class='list-group-item d-flex pd-sm-x-20'>
                                            <div class='pd-sm-l-11 d-flex flex-column'>
                                            <p class='tx-medium mg-b-0'>$R[nama]</p>
                                            <small class='tx-12 tx-color-03 mg-b-0'>$R[panitia]</small>
                                            <small class='tx-12 tx-color-03 mg-b-0'>$R[nama_satker_kontingen]</small>
                                            </div>
                                        <div class='mg-l-auto text-right'>
                                            $validasi
                                        </div>
                                    </li>
                                    ";
                                }
                            }
                            ?>
                        </ul>
                    </div><!-- card -->
                </div>
            </div><!-- media-body -->
        </div><!-- media -->
    </div><!-- container -->
</div><!-- content -->


<script>
    const scroll = new PerfectScrollbar('#scroll', {
        suppressScrollX: true
    });

    $('select').select2({
        theme: 'bootstrap4',
    });

    $("#nip").on("keyup", function() {
        register_get_pegawai($(this).val());
    });

    $("#nip").on("change", function() {
        register_get_pegawai($(this).val());
    });

    function register_get_pegawai(nip) {
        // alert($(this).val().length);
        if (nip.length == '18') {
            var form_data = new FormData();
            form_data.append('nip', nip);
            $.ajax({
                url: "<?php echo base_url(); ?>register_get_pegawai",
                type: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                dataType: 'json',
                success: function(json) {
                    $("#nama").val(json.nama);
                    $("#nama").attr("readonly", "readonly");
                    $("#no_wa").val(json.no_wa);
                    $("#no_wa").attr("readonly", "readonly");
                    $("#id_satker_parent").val(json.id_satker_parent);
                    $("#id_satker_parent").attr("readonly", "readonly");
                }
            });
        }
    }

    $("#form_register").submit(function(e) {
        // alert();skip();
        e.preventDefault();
        var form = $(this);
        // var text = $("#btn-simpan").html();
        // $("#btn-simpan").html('<i class="fa fa-spinner fa-spin"></i> Sedang Memproses Data');
        // var form_data = new FormData(this);
        $.ajax({
            url: "<?php echo base_url(); ?>register_simpan",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            dataType: 'json',
            success: function(json) {
                // alert(json.status);
                if (json.status !== true) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Peringatan... !!!',
                        html: "<div style='text-align:justify;'>" + json.pesan + "</div>",
                        // footer: '<a href="">Why do I have this issue?</a>'
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Simpan Data Berhasil',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    location.replace("<?php echo base_url(); ?>login");
                }
            }
        });
    });

    $("#btn-simpan").prop('disabled', true);
    $("#is_setuju").on('click', function() {
        // alert($(this).is(":checked"));
        if ($(this).is(":checked") == true) {
            $("#btn-simpan").removeAttr('disabled');
        } else {
            $("#btn-simpan").prop('disabled', true);
        }
    });
</script>