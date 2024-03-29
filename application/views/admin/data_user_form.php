<?php
$txt_simpan = "SIMPAN";
if (isset($_POST['id_user'])) {
    $txt_simpan = "UPDATE";
    $R = $this->basic->get_data_where(array('id_user' => $_POST['id_user']), 'data_user')->row_array();
    // echo "<pre>";
    // print_r($data);die;
}
?>
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form User</li>
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
                            <div class="form-group d-none">
                                <label class="control-label">Nama :</label>
                                <input text='number' id='id_user' class='form-control' value="<?php if (isset($R)) echo $R['id_user']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Username :</label>
                                <input type='text' id='username' class='form-control' value="<?php if (isset($R)) echo $R['username']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Password :</label>
                                <input type='password' id='password' class='form-control' value="<?php if (isset($R)) echo $R['password']; ?>">
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
        form_data.append('id_user', $("#id_user").val());
        form_data.append('username', $("#username").val());
        form_data.append('password', $("#password").val());
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_user_simpan",
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