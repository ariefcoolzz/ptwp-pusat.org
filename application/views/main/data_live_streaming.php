<div class="content bg-indigo mg-0">
    <div class="divider-text">
        <h4 class="text-white">Hasil Pertandingan Lapangan Live Streaming</h4>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="text-uppercase">Live Score</h3>
            <a href="<?php echo base_url('main/data_babak_penyisihan'); ?>" class="btn btn-sm btn-outline-primary tx-bold">All Score</a>
        </div>
        <div class="card-body">
            <div class='row'>
                <?php
                    $nama_kontingen = "";
                    $str = ARRAY();
                    $result = $this->Model_main->model_data_live_streaming();
                    if ($result->num_rows()) {
                        foreach ($result->result_array() as $R) {
                            $idl = $R['id_lapangan'];

                            IF(!ISSET($str[$idl])) $str[$idl] = "";
                            IF(!ISSET($nama_kontingen[$idl])) $nama_kontingen[$idl] = "";
                            IF(!ISSET($set1_tim_A[$idl])) $set1_tim_A[$idl] = 0;
                            IF(!ISSET($set1_tim_B[$idl])) $set1_tim_B[$idl] = 0;
                            IF(!ISSET($kemenangan_A[$idl])) $kemenangan_A[$idl] = 0;
                            IF(!ISSET($kemenangan_B[$idl])) $kemenangan_B[$idl] = 0;

                            $set1_tim_A[$idl] = $R['set1_tim_A'];
                            $set1_tim_B[$idl] = $R['set1_tim_B'];

                            IF($set1_tim_A[$idl] == '8') $kemenangan_A[$idl]++;
                            IF($set1_tim_B[$idl] == '8') $kemenangan_B[$idl]++;

                            $nama_kontingen_tim = $R['nama_kontingen_tim_A']." VS ".$R['nama_kontingen_tim_B'];

                            IF($nama_kontingen[$idl] != $nama_kontingen_tim)
                            {
                                
                                $nama_kontingen[$idl] = $R['nama_kontingen_tim_A']." VS ".$R['nama_kontingen_tim_B'];
                                // $str[$idl] .= "<div>$nama_kontingen[$idl] ($kemenangan_A[$idl] - $kemenangan_B[$idl])</div>";
                                $str[$idl] .= "<div>$nama_kontingen[$idl]</div>";
                            }
                            $str[$idl] .= "<div class='row'>";
                            $str[$idl] .= "<div class='col-10'>".nama_singkat($R['nama_pemain_tim_A'])."</div>";
                            $str[$idl] .= "<div class='col-2'>$R[set1_tim_A]</div>";
                            $str[$idl] .= "<div class='col-10'>".nama_singkat($R['nama_pemain_tim_B'])."</div>";
                            $str[$idl] .= "<div class='col-2'>$R[set1_tim_B]</div>";
                            $str[$idl] .= "</div>";
                            $str[$idl] .= "<hr>";
                                
                        }

                        $link = ARRAY();
                        $result = $this->Model_main->model_data_link_streaming();
                        if ($result->num_rows()) {
                            foreach ($result->result_array() as $R) {
                                $link[$R['id_lapangan']] = $R['link_streaming']; // ini asli dari database
                                // $link[$R['id_lapangan']] = "https://www.youtube.com/embed/cnqkyfumWco"; // sementara tampilin ini dulu
                            }
                        }

                        FOR($ke=25;$ke<=30;$ke++)
                            {
                                $i = $ke - 24;
                                IF(!ISSET($str[$ke])) $str[$ke] = "";
                                echo "
                                        <div class='col-lg-2 col-sm-12' style='border:1px solid red;'> 
                                            Lapangan Tenis UNNES Court $i<br>
                                            <span data-link='$link[$ke]' class='tonton btn btn-danger'><i data-feather='youtube'></i> Siaran Langsung</span>
                                            $str[$ke]
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
</script>