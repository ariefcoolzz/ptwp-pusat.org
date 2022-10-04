<style>
    .select2-container .select2-selection--single {
        height: 125px !important;
    }
</style>
<?php
$txt_simpan = "SIMPAN";
if (isset($_POST['id_pemain'])) {
    $txt_simpan = "UPDATE";
    $R = $this->basic->get_data_where(array('id_pemain' => $id_pemain), 'data_pemain')->row_array();
    // echo "<pre>";
    // print_r($data);die;
}
?>
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Pemain</li>
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
                                <input type='checkbox' id='is_dharmayukti'> Dharmayukti<br>
                                <label class="control-label">Nama :</label>
								<select name='id_pemain' id='id_pemain' class='form-control select_nama' style="height: 100px;">
                                </select>
                                <small class='text-danger'>Pemain Hanya bisa di wilayah Tingkat Bandingnya</small>
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
    $(".select_nama").select2({
        placeholder: 'Minimal 4 Karakter',
        templateResult: formatState,
        templateSelection: formatState,
        allowClear: true,
        ajax: { //bawaan nya > Kirim data method $_GET['q'];
            delay: 250, // wait 250 milliseconds before triggering the request
            url: "<?php echo base_url(); ?>admin/get_data_id_nama",
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

    $("#simpan").on('click', function() {
        $("#simpan").html('<i class="fa fa-spinner fa-spin"></i> Sedang Memproses Data');
        var form_data = new FormData();
        form_data.append('is_dharmayukti', $("#is_dharmayukti").is(":checked"));
        form_data.append('id_pemain', $("#id_pemain").val());
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