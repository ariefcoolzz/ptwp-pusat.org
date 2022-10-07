<?php
$txt_simpan = "SIMPAN";
if (isset($_POST['id_lapangan'])) {
    $txt_simpan = "UPDATE";
    $R = $this->basic->get_data_where(array('id_lapangan' => $_POST['id_lapangan']), 'master_lapangan')->row_array();
}
?>
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Lapangan</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form id='form_konten' enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">ID Lapangan :</label>
                                <input type='text' id='id_lapangan' class='form-control' value="<?php if (isset($R)) echo $R['id_lapangan']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Lapangan :</label>
                                <input type='text' id='lapangan' class='form-control' value="<?php if (isset($R)) echo $R['lapangan']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Jenis Lapangan :</label>
                                <select id='jenis' class='form-control'>
                                    <option value='0' <?php if (isset($R) and $R['jenis'] == '0') echo "selected"; ?>>In Door</option>
                                    <option value='1' <?php if (isset($R) and $R['jenis'] == '1') echo "selected"; ?>>Out Door</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Alamat :</label>
                                <input type='text' id='alamat' class='form-control' value="<?php if (isset($R)) echo $R['alamat']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Longitude :</label>
                                <input type='text' id='longitude' class='form-control' value="<?php if (isset($R)) echo $R['longitude']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Latitude :</label>
                                <input type='text' id='latitude' class='form-control' value="<?php if (isset($R)) echo $R['latitude']; ?>">
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
        form_data.append('id_lapangan', $("#id_lapangan").val());
        form_data.append('lapangan', $("#lapangan").val());
        form_data.append('jenis', $("#jenis").val());
        form_data.append('alamat', $("#alamat").val());
        form_data.append('longitude', $("#longitude").val());
        form_data.append('latitude', $("#latitude").val());
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_lapangan_simpan",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(json) {
                if (json.status !== true) {
                    Swal.fire({
                        icon: 'error',
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