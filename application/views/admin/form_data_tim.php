<?php
$txt_simpan = "SIMPAN";
if ($id_tim) $txt_simpan = "UPDATE";
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
                    <?php echo $this->session->flashdata('msg'); ?>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Kategori :</label>
                                <select id="kategori" name="kategori" class="form-control">
                                <?php 
                                    foreach($kategori->result_array() as $R){
                                        $selected = '';
                                        if($R['id_kategori'] == 1) $activ = 'selected';
                                        echo '<option value="'.$R['id_kategori'].'">'.$R['kategori'].'</option>';
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Pemain 1</label>
                                <select name="id_pemain1" class="pilih_tim form-control">
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Pemain 2</label>
                                <select name="id_pemain2" class="pilih_tim form-control">
                                </select>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <label class="control-label">Log :</label>
                            <div id="log">
                                
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
    get_tim();
    $(".pilih_tim").select2({
			placeholder: "Silahkan Pilih Nama TIM"
		});
    $("#form_konten").submit(function(e) {
        e.preventDefault();
        var text = $("#btn-simpan").html();
        $("#btn-simpan").html('<i class="fa fa-spinner fa-spin"></i> Sedang Memproses Data');
        var form_data = new FormData(this);
        $.ajax({
            url: "<?php echo base_url(); ?>admin/form_data_tim_simpan",
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
                    $("#log").append(html.konten_menu);
                    $("#btn-simpan").html(text);
                    get_tim();
                }
            }
        });
    });
    function get_tim(){
        var kategori = $('#kategori option:selected').val();
        var form_data = new FormData();
        form_data.append('kategori', kategori);
        // console.log(kategori);
        $.ajax({
            url: "<?php echo base_url(); ?>admin/get_nama_pemain_tim",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(html) {
                if (html.status !== true) {
                    location.reload();
                } 
                else 
                {
                    $(".pilih_tim").html(html.konten_menu);
                    $(".pilih_tim").select2({
                        placeholder: "Silahkan Pilih Nama TIM"
                    });                    
                }
            }
        });
    }
    $('#kategori').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        get_tim();
    });
	
    // tinyMCE.EditorManager.execCommand('mceAddEditor',true, '.mymce'); 
</script>