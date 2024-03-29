<h1>Harus Login</h1>
<h1>Bikin Log Penginput</h1>
<div class="container">
    <div class="card mg-y-30">
        <div class="card-header tx-center">
            <h1>BABAK FINAL</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable-score1" class="table table-primary table-striped w-100">
                    <thead>
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Event</th>
                            <th>Kategori</th>
                            <th>Per</th>
                            <th>Urutan</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Lapangan</th>
                            <th>Game & Score</th>
                            <?php /*<th>Tim A VS Tim B</th>*/ ?>
                            <th>Link Manage Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $rekap = $this->Model_score->score_rekap_final();
                        foreach ($rekap->result_array() as $R) {
                            $key     = MD7($R['id_pertandingan']);
                            $jenis     = $R['jenis'];
                            $no++;

                            $score = "";
                            IF($R['set1_tim_A'] > 0 OR $R['set1_tim_B'] > 0) $score .= "Set 1: $R[set1_tim_A] - $R[set1_tim_B]";
                            IF($R['set2_tim_A'] > 0 OR $R['set2_tim_B'] > 0) $score .= "<br>Set 2: $R[set2_tim_A] - $R[set2_tim_B]";
                            IF($R['set3_tim_A'] > 0 OR $R['set3_tim_B'] > 0) $score .= "<br>Set 3: $R[set3_tim_A] - $R[set3_tim_B]";

                            echo "<tr class='tx-center'>";
                            echo "<td>" . $R['id_pertandingan'] . "</td>";
                            // echo "<td>" . $R['jenis'] . "</td>";
                            echo "<td>" . $R['id_event'] . "</td>";
                            echo "<td>" . $R['kategori'] . "</td>";
                            echo "<td>" . $R['per'] . "</td>";
                            echo "<td>" . $R['urutan'] . "</td>";
                            echo "<td>" . format_tanggal('ddmmyyyy', $R['tanggal']) . "</td>";
                            echo "<td>" . $R['waktu'] . "</td>";
                            echo "<td>" . $R['lapangan'] . "</td>";
                            echo "<td>$score</td>";
                            // echo "<td><span class='badge bg-success text-light'>$R[nama_tim_A]</span> <span class='badge bg-success text-light'>$R[set1_tim_A]</span> <small>VS</small> <span class='badge bg-danger text-light'>$R[set1_tim_B]</span> <span class='badge bg-danger text-light'>$R[nama_tim_B]</span></td>";
							echo "<td>
										<span class='share btn btn-sm btn-success' data-jenis='$jenis' data-key='$key'>Share Score</span>
										<span class='edit btn btn-sm btn-primary' data-jenis='$jenis' data-key='$key'>Manage Score</span>
								</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                    </div>
                    </div>
                    </div>
              
                
        <div class="card mg-y-30">
        <div class="card-header tx-center">
            <h1>BABAK PENYISIHAN</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable-score2" class="table table-primary table-striped w-100">
                    <thead>
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Event</th>
                            <th>Kategori</th>
                            <th>Pool</th>
                            <th>Urutan</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Lapangan</th>
                            <th>Score</th>
                            <th>Link Manage Score</th>
                            <?php /*<th>Tim A VS Tim B</th>*/ ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $rekap = $this->Model_score->score_rekap_penyisihan();
                        foreach ($rekap->result_array() as $R) {
                            $key     = MD7($R['id_pertandingan']);
                            $jenis     = $R['jenis'];
                            $no++;

                            $score = "";
                            IF($R['set1_tim_A'] > 0 OR $R['set1_tim_B'] > 0) $score .= "Set 1: $R[set1_tim_A] - $R[set1_tim_B]";
                            IF($R['set2_tim_A'] > 0 OR $R['set2_tim_B'] > 0) $score .= "<br>Set 2: $R[set2_tim_A] - $R[set2_tim_B]";
                            IF($R['set3_tim_A'] > 0 OR $R['set3_tim_B'] > 0) $score .= "<br>Set 3: $R[set3_tim_A] - $R[set3_tim_B]";

                            echo "<tr class='tx-center'>";
                            echo "<td>" . $R['id_pertandingan'] . "</td>";
                            // echo "<td>" . $R['jenis'] . "</td>";
                            echo "<td>" . $R['id_event'] . "</td>";
                            echo "<td>" . $R['kategori'] . "</td>";
                            echo "<td>" . $R['pool'] . "</td>";
                            echo "<td>" . $R['urutan'] . "</td>";
                            echo "<td>" . format_tanggal('ddmmyyyy', $R['tanggal']) . "</td>";
                            echo "<td>" . $R['waktu'] . "</td>";
                            echo "<td>" . $R['lapangan'] . "</td>";
                            echo "<td>$score</td>";
                            // echo "<td><span class='badge bg-success text-light'>$R[nama_tim_A]</span> <span class='badge bg-success text-light'>$R[set1_tim_A]</span> <small>VS</small> <span class='badge bg-danger text-light'>$R[set1_tim_B]</span> <span class='badge bg-danger text-light'>$R[nama_tim_B]</span></td>";
                            echo "<td>
										<span class='share btn btn-sm btn-success' data-jenis='$jenis' data-key='$key'>Share Score</span>
										<span class='edit btn btn-sm btn-primary' data-jenis='$jenis' data-key='$key'>Manage Score</span>
								</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </div><!-- table-responsive -->
        </div>
    </div>
</div>

<script>
    $('[data-toggle="tooltip"]').tooltip();
    $('#datatable-score1').DataTable({
        responsive: true,
        ordering: false,
        paging: false,
        language: {
            searchPlaceholder: 'Pencarian...',
            sSearch: '',
            // lengthMenu: '_MENU_ user/Halaman',
        }
    });
    $('#datatable-score2').DataTable({
        responsive: true,
        ordering: false,
        paging: false,
        language: {
            searchPlaceholder: 'Pencarian...',
            sSearch: '',
            // lengthMenu: '_MENU_ user/Halaman',
        }
    });


    $(document).ready(function() {
        $(".table").on('click', '.share', function(e) {
            var key = $(this).data('key');
            var jenis = $(this).data('jenis');
            var link = "<?php echo base_url(); ?>score/share/" + jenis + "/" + key;
            window.open(link, '_blank');

            // var form_data = new FormData();
            // form_data.append('jenis', $(this).data('jenis'));
            // form_data.append('key', $(this).data('key'));
            // $.ajax({
                // url: "<?php echo base_url(); ?>score/manage",
                // type: 'POST',
                // cache: false,
                // contentType: false,
                // processData: false,
                // data: form_data,
                // dataType: 'json',
                // success: function(json) {
                    // // alert(json.konten);
                    // $("body").scrollTop('0px');
                    // $("#konten").fadeOut(300);
                    // $("#konten").html(json.konten);
                    // $("#konten").fadeIn(300);
                // }
            // });
        });
		
		$(".table").on('click', '.edit', function(e) {
            var key = $(this).data('key');
            var jenis = $(this).data('jenis');
            var link = "<?php echo base_url(); ?>score/manage/" + jenis + "/" + key;
            window.open(link, '_blank');

            // var form_data = new FormData();
            // form_data.append('jenis', $(this).data('jenis'));
            // form_data.append('key', $(this).data('key'));
            // $.ajax({
                // url: "<?php echo base_url(); ?>score/manage",
                // type: 'POST',
                // cache: false,
                // contentType: false,
                // processData: false,
                // data: form_data,
                // dataType: 'json',
                // success: function(json) {
                    // // alert(json.konten);
                    // $("body").scrollTop('0px');
                    // $("#konten").fadeOut(300);
                    // $("#konten").html(json.konten);
                    // $("#konten").fadeIn(300);
                // }
            // });
        });
    });
</script>