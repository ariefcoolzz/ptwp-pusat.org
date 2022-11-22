<div class="content bg-indigo mg-0">
    <div class="divider-text">
        <h4 class="text-white">Hasil Score Babak Penyisihan</h4>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="text-uppercase">Live Score</h3>
        </div>
        <div class="card-body">
            <div class='row'>
                <?php
                $nama_kontingen = array();
                $str = array();
                $result = $this->Model_main->model_data_live_streaming_all_score();
                if ($result->num_rows()) {
                    foreach ($result->result_array() as $R) {
                        $p = $R['pool'];

                        if (!isset($str[$p])) $str[$p] = "";
                        if (!isset($nama_kontingen[$p])) $nama_kontingen[$p] = "";
                        if (!isset($set1_tim_A[$p])) $set1_tim_A[$p] = 0;
                        if (!isset($set1_tim_B[$p])) $set1_tim_B[$p] = 0;

                        $set1_tim_A[$p] = $R['set1_tim_A'];
                        $set1_tim_B[$p] = $R['set1_tim_B'];

                        $nama_kontingen_tim = $R['nama_kontingen_tim_A'] . " VS " . $R['nama_kontingen_tim_B'];

                        if ($nama_kontingen[$p] != $nama_kontingen_tim) {

                            $nama_kontingen[$p] = $R['nama_kontingen_tim_A'] . " VS " . $R['nama_kontingen_tim_B'];
                            // $str[$p] .= "<div>$nama_kontingen[$p] ($kemenangan_A[$p] - $kemenangan_B[$p])</div>";
                            $str[$p] .= "<div class='tx-bold tx-center badge bg-warning mt-3'>$nama_kontingen[$p]</div>";
                        }

                        $str[$p] .= "<div class='row'>";
                        $str[$p] .= "<div class='col-5'>" . nama_singkat($R['nama_pemain_tim_A']) . "</div>";
                        $str[$p] .= "<div class='col-2 badge'>" . $R['set1_tim_A'] ." - ".$R['set1_tim_B'] . "</div>";
                        
                        $str[$p] .= "<div class='col-5'>" . nama_singkat($R['nama_pemain_tim_B']) . "</div>";
                        $str[$p] .= "</div>";
                        $str[$p] .= "<hr style='margin:0px;'>";
                    }

                    for ($ke = 1; $ke <= 16; $ke++) {
                        $p = pool($ke);
                        if (!isset($str[$p])) $str[$p] = "";
                        echo "
                                <div class='col-sm-12 col-md-3 col-lg-3 col-xl-3 mt-1'> 
                                    <div class='card'>
                                        <div class='card-header text-center'>
                                            <h4>POOL ".$p."</h4>
                                        </div>
                                        <div class='card-body'>
                                            <div class='overflow-y-auto ht-500 pr-2'>
                                                $str[$p]
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
</script>