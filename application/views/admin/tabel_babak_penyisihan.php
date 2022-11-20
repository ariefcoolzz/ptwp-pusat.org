<select class="form-control" id='beregu'>
    <option value='putra' selected>Putra</option>
    <option value='putri'>Putri</option>
</select>

<select class="form-control" id='pool'>
    <option value='all' selected>Semua Pool</option>
    <?php
        $jumlah_pool = 26; //sampai Z
        FOR($i=1;$i<=$jumlah_pool;$i++)
            {
                echo "<option value='".pool($i)."'>Pool ".pool($i)."</option>";
            }
    ?>
</select>

<div id="konten_menu"></div>

<script>
    $("#beregu,#pool").on('change', function() {
        load_data();
    });

    load_data();
    function load_data() {
        var form_data = new FormData();
        // form_data.append('id_panitia', $("#id_panitia").val());
        form_data.append('id_event', $("#list_event").val());
        form_data.append('beregu', $("#beregu").val());
        form_data.append('pool', $("#pool").val());
        $.ajax({
            url: "<?php echo base_url(); ?>admin/tabel_babak_penyisihan_rekap",
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
                    $("#konten_menu").fadeOut(300);
                    $("#konten_menu").html(json.konten_menu);
                    $("#konten_menu").fadeIn(300);
                }
            }
        });
    }
</script>