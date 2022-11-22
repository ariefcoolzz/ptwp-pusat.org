<div class="content bg-indigo mg-0">
    <div class="divider-text">
        <h4 class="text-white">Hasil Pertandingan Lapangan UNNES Live Streaming</h4>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="text-uppercase">Live Score</h3>
            <span class="btn btn-sm btn-outline-primary tx-bold live_streaming_all_score" data-beregu='putra' style='cursor:pointer;'>All Score Beregu Putra</span>
            <span class="btn btn-sm btn-outline-primary tx-bold live_streaming_all_score" data-beregu='putri' style='cursor:pointer;'>All Score Beregu Putri</span>
        </div>
        <div class="card-body">
            <div class='row'>
                <?php
                $nama_kontingen = array();
                $str = array();
                $result = $this->Model_main->model_data_live_streaming();
                if ($result->num_rows()) {
                    foreach ($result->result_array() as $R) {
                        $idl = $R['id_lapangan'];

                        if (!isset($str[$idl])) $str[$idl] = "";
                        if (!isset($nama_kontingen[$idl])) $nama_kontingen[$idl] = "";
                        if (!isset($set1_tim_A[$idl])) $set1_tim_A[$idl] = 0;
                        if (!isset($set1_tim_B[$idl])) $set1_tim_B[$idl] = 0;
                        if (!isset($kemenangan_A[$idl])) $kemenangan_A[$idl] = 0;
                        if (!isset($kemenangan_B[$idl])) $kemenangan_B[$idl] = 0;

                        $set1_tim_A[$idl] = $R['set1_tim_A'];
                        $set1_tim_B[$idl] = $R['set1_tim_B'];

                        if ($set1_tim_A[$idl] == '8') $kemenangan_A[$idl]++;
                        if ($set1_tim_B[$idl] == '8') $kemenangan_B[$idl]++;

                        $nama_kontingen_tim = $R['nama_kontingen_tim_A'] . " VS " . $R['nama_kontingen_tim_B'];

                        if ($nama_kontingen[$idl] != $nama_kontingen_tim) {

                            $nama_kontingen[$idl] = $R['nama_kontingen_tim_A'] . " VS " . $R['nama_kontingen_tim_B'];
                            // $str[$idl] .= "<div>$nama_kontingen[$idl] ($kemenangan_A[$idl] - $kemenangan_B[$idl])</div>";
                            $str[$idl] .= "<div class='tx-bold tx-center badge bg-warning mt-3'>$nama_kontingen[$idl]</div>";
                        }

                        $str[$idl] .= "<div class='d-flex justify-content-between'><div>" . nama_singkat($R['nama_pemain_tim_A']) . "</div>$R[set1_tim_A]</div>";
                        $str[$idl] .= "<div class='d-flex justify-content-between'><div>" . nama_singkat($R['nama_pemain_tim_B']) . "</div>$R[set1_tim_B]</div>";
                        $str[$idl] .= "<hr style='margin:0px;'>";
                    }

                    $link = array();
                    $result = $this->Model_main->model_data_link_streaming();
                    if ($result->num_rows()) {
                        foreach ($result->result_array() as $R) {
                            $link[$R['id_lapangan']] = $R['link_streaming']; // ini asli dari database
                            // $link[$R['id_lapangan']] = "https://www.youtube.com/embed/cnqkyfumWco"; // sementara tampilin ini dulu
                        }
                    }

                    for ($ke = 25; $ke <= 30; $ke++) {
                        $i = $ke - 24;
                        if (!isset($str[$ke])) $str[$ke] = "";
                        echo "
                                        <div class='col-sm-12 col-md-6 col-lg-6 col-xl-2 mt-1'> 
                                            <div class='card'>
                                                <div class='card-header text-center'>
                                                    <h4>Lapangan Tenis UNNES Court $i</h4>
                                                    <button data-link='$link[$ke]' class='tonton btn btn-danger'><i class='fa fa-youtube-play'></i> Siaran Langsung</button>
                                                </div>
                                                <div class='card-body'>
                                                    <div class='overflow-y-auto ht-500 pr-2'>
                                                        $str[$ke]
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    ";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(".tonton").on("click", function() {
        var link = $(this).data('link');
        $("#judul_popup_streaming").html("SIARAN LANGSUNG LAPANGAN UNNES");
        $("#isi_popup_streaming").html("<iframe src='" + link + "?autoplay=1' allow='autoplay' width='100%' height='500px' title='YouTube video player' frameborder='0' allow='autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>");
        $("#popup_streaming").modal('show');
    });

    $(".live_streaming_all_score").on("click", function() {
        var form_data = new FormData();
        form_data.append('beregu', $(this).data('beregu'));
        $.ajax({
            url: "<?php echo base_url(); ?>main/data_live_streaming_all_score",
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
                    $("#isi_modal_score").html(json.konten);
                    $("#modal_score").modal('show');
                }
            }
        });
    });
    
</script>