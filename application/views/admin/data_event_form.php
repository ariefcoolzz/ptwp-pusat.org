<?php
$txt_simpan = "SIMPAN";
if (isset($_POST['id_event'])) {
    $txt_simpan = "UPDATE";
    $R = $this->basic->get_data_where(array('id_event' => $_POST['id_event']), 'data_event')->row_array();
    // echo "<pre>";
    // print_r($data);die;
}
?>
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Event</li>
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
                            <!-- <div class="form-group">
                                <label class="control-label">Namaa :</label>
                                <input id='id_user' class='form-control' value="<?php if (isset($R)) echo $R['id_event']; ?>">
                            </div> -->
                            <div class="form-group">
                                <label class="control-label">Tanggal Mulai :</label>
                                <input id='tanggal_mulai' class='form-control' value="<?php if (isset($R)) echo $R['tanggal_mulai']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Tanggal Selesai :</label>
                                <input id='tanggal_selesai' class='form-control' value="<?php if (isset($R)) echo $R['tanggal_selesai']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nama :</label>
                                <input id='nama' class='form-control' value="<?php if (isset($R)) echo $R['nama']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Jenis Pertandingan :</label>
                                <input id='jenis_pertandingan' class='form-control' value="<?php if (isset($R)) echo $R['jenis_pertandingan']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Keterangan :</label>
                                <input id='keterangan' class='form-control' value="<?php if (isset($R)) echo $R['keterangan']; ?>">
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
        form_data.append('id_event', $("#id_event").val());
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_event_simpan",
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