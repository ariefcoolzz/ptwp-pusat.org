Jumlah Kontingen
<select id='jumlah_kontingen'>
    <option value='3'>3</option>
    <option value='4'>4</option>
    <option value='5'>5</option>
</select>
<button id='drawing_acak'>Drawing Acak</button>
<br>
<br>
<div id='konten_drawing'></div>

<script>
     $("#drawing_acak").on('click', function() {
    if(confirm("Apakah Benar Anda Ingin Men Draw ???"))
        {
            if(confirm("Apakah Anda benar benar yakin ???"))
        {
            $(".title_loader").text("Sedang Memuat Halaman");
            $("#konten_drawing").html($("#loader_html").html());
            // $('.nav-item.active').removeClass('active');
            // $(this).closest('li.nav-item').addClass('active');
            //loader
            // skip();
            var form_data = new FormData();
            form_data.append('pool', $("#pool").val());
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
        }}
    });
</script>