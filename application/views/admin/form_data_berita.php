<?php
$txt_simpan = "SIMPAN";
if ($id) $txt_simpan = "UPDATE";

$is_pusat = false;
if (IN_ARRAY($_SESSION['id_panitia'], array(0, 1))) $is_pusat = true;
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
                    <input type="hidden" name='id' value="<?php echo $id ?>">

                    <?php echo $this->session->flashdata('msg'); ?>

                    <div class="row">
                        <div class="col-lg-10">
                            <div class="form-group">
                                <label class="control-label">Judul Konten :</label>
                                <input type="text" name='judul' class="form-control" value="<?php echo $judul ?>">
                            </div>
                        </div>
                        <?php if ($is_pusat) { ?>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="control-label">Publish:</label>

                                    <select name='is_publish' class='form-control'>
                                        <option value='1' <?php if (isset($is_publish) and $is_publish == 1) echo "selected"; ?>>Publish</option>
                                        <option value='0' <?php if (isset($is_publish) and $is_publish == 0) echo "selected"; ?>>Not Publish</option>
                                    </select>

                                </div>
                            </div>
                        <?php }
                        ?>

                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Alias :</label>
                                <input type="text" name='alias' class="form-control" value="<?php echo $alias ?>">
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <?php
                            if ($is_pusat) { ?>
                                <div class="form-group">
                                    <label class="control-label">Kategori Berita</label>
                                    <select id="cat_ID" name="cat_id" class="filter form-control">
                                        <option value="1" <?php if (isset($cat_id) and $cat_id == 1) echo "selected"; ?>>Berita PTWP PUSAT</option>
                                        <option value="3" <?php if (isset($cat_id) and $cat_id == 3) echo "selected"; ?>>Berita PTWP Daerah</option>
                                    </select>
                                </div>
                            <?php } else { ?>
                                <input type="hidden" name='cat_id' value="3">
                            <?php }
                            ?>

                        </div>

                    </div>
                    <?php if (!$is_pusat) {

                        if (!empty($id)) {
                            echo "<p>Tanggal Pembuatan : " . format_tanggal('ddmmmmyyyyhis', $date_created) . " | Status : ";
                            if ($is_publish) echo "<span class='badge badge-success'>Diterbitkan</span> </p>";
                            else echo "<span class='badge badge-danger'>Belum Diterbitkan</span> </p>";
                            echo "<input type='hidden' name='is_publish' value='" . $is_publish . "'>";
                        }
                    }
                    ?>
                    <div class="col-lg-12 text-center">
                        <textarea class="mymce" name="isi"><?php echo $isi ?></textarea>
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
    tinymce.init({
        selector: ".mymce",
        theme: "silver",
        height: 700,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table directionality emoticons template paste"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
        images_upload_url: "<?php echo base_url('admin/upload_file') ?>",
        // relative_urls : false,
        // remove_script_host : false,
        // document_base_url : 'https://ptwp-pusat.org' // PENGATURAN UNTUK DI SERVER
    });
    $("#form_konten").submit(function(e) {
        e.preventDefault();
        $("#btn-simpan").html('<i class="fa fa-spinner fa-spin"></i> Sedang Memproses Data');
        var form_data = new FormData(this);
        var isi = tinymce.activeEditor.getContent();
        // var isi = ed.getContent();
        console.log(isi);
        form_data.append('isi_konten', isi);
        $.ajax({
            url: "<?php echo base_url(); ?>admin/form_data_berita_simpan",
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