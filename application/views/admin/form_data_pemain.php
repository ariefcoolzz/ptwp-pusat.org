<?php
$txt_simpan = "SIMPAN";
if ($id_pemain) $txt_simpan = "UPDATE";
?>
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form id='form_konten' enctype="multipart/form-data">
                    <input type="hidden" name='id_pemain' value="<?php echo $id_pemain ?>">
                    <?php echo $this->session->flashdata('msg'); ?>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Nama :</label>
                                <input type="text" name='nama' class="form-control" value="<?php echo $nama ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Satuan Kerja</label>
                                <input type="text" name='satker' class="form-control" value="<?php echo $satker ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Upload Foto</label>
                                <input type="file" name='file_upload' class="form-control">
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <label class="control-label">Foto :</label>
                            <div class="form-group">
                                <?php 
                                if(!empty($foto_profil)){ ?>
                                <img src='<?php echo base_url('assets/profil/').$foto_profil; ?>' class="wd-150 rounded mg-r-20">
                                <?php }
                                else{ ?>
                                <img src='<?php echo base_url('assets/profil/default.png'); ?>' class="wd-150 rounded mg-r-20">
                                <?php }
                                ?>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row text-center mx-4 mt-3">
                        <div class="col-lg-12">
                            <button id="btn-simpan" type='submit' class="btn btn-outline-success btn-rounded"><i class="fa fa-save"></i> <?php echo $txt_simpan; ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $("#form_konten").submit(function(e) {
        e.preventDefault();
        $("#btn-simpan").html('<i class="fa fa-spinner fa-spin"></i> Sedang Memproses Data');
        var form_data = new FormData(this);
        $.ajax({
            url: "<?php echo base_url(); ?>admin/form_data_pemain_simpan",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(html) {
                if (html.status !== true) {
                    location.reload();
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Simpan Data Berhasil',
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
    });

    // tinyMCE.EditorManager.execCommand('mceAddEditor',true, '.mymce'); 
</script>