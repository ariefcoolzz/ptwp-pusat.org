<script src="<?php echo base_url(); ?>assets/lib/jquery/jquery.min.js"></script>
<div class="content content-fixed content-auth">
    <div class="container">
        <div class="media align-items-stretch justify-content-center ht-100p">
            <form id="form_register" method="post">
                <div class="sign-wrapper mg-lg-r-50 mg-xl-r-60">
                    <div class="pd-t-20 wd-100p lh-1">
                        <div class="form-group">
                            <label>Nip <small class="tx-danger">(Harus 18 Digit)</small></label>
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
                            <label>Pengurus Daerah</label>
                            <select id='id_satker_parent' name='id_satker_parent' class="form-control">
                                <option></option>
                                <?php
                                $rekap = $this->basic->get_data_where('LevelSatker = 2', 'tmst_satker', 'UrutanTingkatBanding ASC');
                                $no = 0;
                                if ($rekap->num_rows()) {
                                    foreach ($rekap->result_array() as $R) {
                                        $no++;
                                        echo "<option value='$R[IdSatker]'>$R[NamaSatker]</option>";
                                    }
                                }
                                ?>
                            </select>
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
                        <button id="btn-simpan" type="submit" class="btn btn-brand-02 btn-block">Daftar</button>
                        <div class="divider-text">Atau</div>
                        <div class="tx-13 mg-t-20 tx-center">Sudah Mempunyai Akun? <a href="<?php echo base_url('admin'); ?>">Login</a></div>
                    </div>
                </div><!-- sign-wrapper -->
            </form>
            <div class="media-body pd-y-30 pd-lg-x-50 pd-xl-x-60 align-items-center d-none d-lg-flex pos-relative">
                <div class="mx-lg-wd-500 mx-xl-wd-550">
                    <img src="<?php echo base_url('assets/img/sign-up.png'); ?>" class="img-fluid" alt="">
                </div>
            </div><!-- media-body -->
        </div><!-- media -->
    </div><!-- container -->
</div><!-- content -->

<script>
    $("#form_register").submit(function(e) {
        // alert();skip();
        e.preventDefault();
        // var text = $("#btn-simpan").html();
        // $("#btn-simpan").html('<i class="fa fa-spinner fa-spin"></i> Sedang Memproses Data');
        var form_data = new FormData(this);
        $.ajax({
            url: "<?php echo base_url(); ?>register_simpan",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(json) {
                // alert(json.status);
                if (json.status !== true) {
                    alert("Maaf, Pendaftaran Gagal");
                } else {
                    // Swal.fire({
                    // icon: 'success',
                    // title: 'Simpan Data Berhasil',
                    // showConfirmButton: false,
                    // timer: 1000
                    // });
                    location.replace("<?php echo base_url(); ?>");
                }
            }
        });
    });
</script>