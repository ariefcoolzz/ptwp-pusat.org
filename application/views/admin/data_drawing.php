<div class="col-lg-2 col-md-6 col-sm-6">
    <label class="tx-bold">Jumlah Kontingen</label>
    <select id='jumlah_kontingen' class="form-control">
        <option value='3'>3</option>
        <option value='4'>4</option>
        <option value='5'>5</option>
    </select>
</div>
<div class="col my-3">
    <button class="btn- btn-sm btn-primary" id='drawing_acak'><i class="typcn typcn-arrow-repeat"></i> Drawing Acak</button>
    <hr />
</div>
<div id='konten_drawing'></div>

<script>
    $("#drawing_acak").on('click', function() {

        $(".title_loader").text("Sedang Memuat Halaman");
        $("#konten_drawing").html($("#loader_html").html());
        // $('.nav-item.active').removeClass('active');
        // $(this).closest('li.nav-item').addClass('active');
        //loader
        // skip();
        var form_data = new FormData();
        form_data.append('jumlah_kontingen', $("#jumlah_kontingen").val());
        $.ajax({
            url: "<?php echo base_url(); ?>admin/data_drawing_acak",
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
                    $("#konten_drawing").html(json.konten_menu);

                }
            }
        });

    });
</script>