<div class="content content-fixed">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-0">
            <li class="breadcrumb-item"><a href="#">Menu</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $judul; ?></li>
        </ol>
    </nav>
    <div class="table-responsive">
        <h2>TURNAMEN TENIS BEREGU PIALA KMA KE 19 TAHUN 2022</h2>
        <h4 class="text-center mg-t-20">
            <div class="form-group ml-4">
                <select class="form-control" id='beregu'>
                    <option value='putra' selected>Putra</option>
                    <option value='putri'>Putri</option>
                </select>
            </div>

        </h4>
        <div class="table-responsive mg-t-20">
            <div class="container-fluid" id='konten'></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#beregu").on("change", function() {
            // alert();skip();
            load_data();
        });

        function load_data() {
            // alert(id_kategori);
            var form_data = new FormData();
            form_data.append('id_event', '2');
            form_data.append('beregu', $("#beregu").val());

            $.ajax({
                url: "<?php echo base_url(); ?>main/data_skema_pertandingan_rekap",
                type: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                dataType: 'json',
                success: function(json) {
                    if (json.status !== true) {
                        alert("Ada Kesalahan... !!!");
                        skip();
                    } else {
                        $("#konten").hide(300);
                        $("#konten").html(json.konten);
                        $("#konten").show(300);
                    }
                }
            });
        }
    });
</script>