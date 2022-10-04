<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Event</li>
            </ol>
        </nav>
        <div class="row">
            <div class="form-group ml-4">
                <span id='tambah' class="btn-tambah btn btn-info btn-md"><i class="fa fa-plus-circle"></i> Data Event</span>
            </div>
            <!-- <div class="form-group ml-2">
                <select id="id_panitia" class="filter form-control">
                    <option value="0">---Semua Event----</option>
                    <?php
                    $list_panitia = $this->basic->get_data('master_panitia');
                    if ($list_panitia->num_rows()) {
                        foreach ($list_panitia->result_array() as $R) {
                            echo "<option value='" . $R['id_panitia'] . "'>" . $R['panitia'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group ml-2">
                <select id="is_aktif" class="filter form-control">
                    <option value="-1">---Semua Status----</option>
                    <option value="1">Aktif</option>
                    <option value="0">Belum Aktif</option>
                </select>
            </div> -->
        </div>

    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div data-label="Example" class="df-example demo-table" id="dt-table">

                </div><!-- df-example -->
            </div>
        </div>
    </div>
</div>
<script>
    $('[data-toggle="tooltip"]').tooltip();


    load_data();
    $(".filter").on('change', function() {
        load_data();
    });

    function load_data() {
        var form_data = new FormData();
        form_data.append('id_panitia', $("#id_panitia").val());
        form_data.append('aktif', $("#is_aktif").val());
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_event_tabel",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(json) {
                if (json.status !== true) {
                    alert();
                    skip();
                } else {
                    $("#dt-table").html(json.konten_menu);
                }
            }
        });
    }

    $("#tambah").on('click', function() {
        //loader
        $(".title_loader").text("Sedang Memuat Halaman");
        $("#konten").html($("#loader_html").html());
        // $('.nav-item.active').removeClass('active');
        // $(this).closest('li.nav-item').addClass('active');
        //loader
        // skip();
        var form_data = new FormData();
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_event_form",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(json) {
                if (json.status !== true) {
                    location.reload();
                } else {
                    $("body").scrollTop('0px');
                    $("#konten").fadeOut(300);
                    $("#konten").html(json.konten_menu);
                    $("#konten").fadeIn(300);

                }
            }
        });
    });

    $(".edit").on('click', function() {
        //loader
        $(".title_loader").text("Sedang Memuat Halaman");
        $("#konten").html($("#loader_html").html());
        // $('.nav-item.active').removeClass('active');
        // $(this).closest('li.nav-item').addClass('active');
        //loader
        // skip();
        var form_data = new FormData();
        form_data.append('id_event', $(this).data('id_event'));
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_event_form",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: 'json',
            success: function(json) {
                if (json.status !== true) {
                    location.reload();
                } else {
                    $("body").scrollTop('0px');
                    $("#konten").fadeOut(300);
                    $("#konten").html(json.konten_menu);
                    $("#konten").fadeIn(300);

                }
            }
        });
    });

    $(".hapus").on('click', function() {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus saja!',
            cancelButtonText: 'Batalkan saja!'
        }).then((result) => {
            if (result.isConfirmed) {
                var form_data = new FormData();
                form_data.append('id_user', $(this).data('id_user'));
                $.ajax({
                    url: "<?php echo base_url(); ?>admin/data_user_hapus",
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    dataType: 'json',
                    success: function(html) {
                        if (html.status !== true) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Data Gagal Di Hapus',
                                showConfirmButton: false,
                                timer: 1000
                            });
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Berhasil Di Hapus',
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
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Data Aman...',
                    showConfirmButton: false,
                    timer: 2000
                });

            }
        });
    });
</script>