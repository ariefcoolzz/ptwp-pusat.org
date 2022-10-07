<?php
$txt_simpan = "SIMPAN";
if (isset($_POST['id_wasit'])) {
    $txt_simpan = "UPDATE";
    $R = $this->basic->get_data_where(array('id_wasit' => $_POST['id_wasit']), 'data_wasit')->row_array();
}
?>
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form wasit</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form id='form_konten' enctype="multipart/form-data">
                    <input type='hidden' id='id_wasit' class='form-control' value="<?php if (isset($R)) echo $R['id_wasit']; ?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Nama :</label>
                                <input type='text' id='nama' class='form-control' value="<?php if (isset($R)) echo $R['nama']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">NIP :</label>
                                <input type='text' id='nip' class='form-control' value="<?php if (isset($R)) echo $R['nip']; ?>">
                            </div>
                            <div id='biodata'></div>
                        </div>
                    </div>
                    <div class="row text-center mx-4 mt-3">
                        <div class="col-lg-12">
                            <span id='simpan' class="btn btn-outline-success btn-rounded"><i class="fa fa-save"></i> <?php echo $txt_simpan; ?></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $("#simpan").on('click', function() {
        $("#simpan").html('<i class="fa fa-spinner fa-spin"></i> Sedang Memproses Data');
        var form_data = new FormData();
        form_data.append('id_wasit', $("#id_wasit").val());
        form_data.append('nama', $("#nama").val());
        form_data.append('nip', $("#nip").val());
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_wasit_simpan",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(json) {
                if (json.status !== true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Simpan Data Gagal',
                        showConfirmButton: false,
                        timer: 1000
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Simpan Data Berhasil',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    $("body").scrollTop('0px');
                    $("#konten").fadeOut(300);
                    $("#konten").html(json.konten_menu);
                    $("#konten").fadeIn(300);
                }
            }
        });
    });

    // tinyMCE.EditorManager.execCommand('mceAddEditor',true, '.mymce'); 
</script>