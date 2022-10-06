
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table td-wrap w-100">
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
                                // echo "<td><span class='badge bg-success text-light'>$R[nama_tim_A]</span> <span class='badge bg-success text-light'>$R[set1_tim_A]</span> <small>VS</small> <span class='badge bg-danger text-light'>$R[set1_tim_B]</span> <span class='badge bg-danger text-light'>$R[nama_tim_B]</span></td>";
								echo "<td><span class='edit badge bg-success' data-jenis='$jenis' data-key='$key'>Edit</span></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
					
					
					
					<hr>
					
					<table id="datatable" class="table td-wrap w-100">
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
                                <?php /*<th>Tim A VS Tim B</th>*/ ?>
                                <th>Link Manage Score</th>
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
                                // echo "<td><span class='badge bg-success text-light'>$R[nama_tim_A]</span> <span class='badge bg-success text-light'>$R[set1_tim_A]</span> <small>VS</small> <span class='badge bg-danger text-light'>$R[set1_tim_B]</span> <span class='badge bg-danger text-light'>$R[nama_tim_B]</span></td>";
                                echo "<td><span class='edit badge bg-success' data-jenis='$jenis' data-key='$key'>Edit</span></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
					
                </div><!-- table-responsive -->
            </div>
        </div>
    </div>
</div>

<script>
    $(".edit").on("click", function() {
        // var key = $(this).data('key');
        // var jenis = $(this).data('jenis');
        // var link = "<?php echo base_url(); ?>score/manage/" + jenis + "/" + key;
        // window.open(link, '_blank');
		
		var form_data = new FormData();
		form_data.append('jenis', $(this).data('jenis'));
		form_data.append('key', $(this).data('key'));
		$.ajax({
			url: "<?php echo base_url(); ?>score/manage",
			type: 'POST',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			dataType: 'json',
			success: function(json) {
				// alert(json.konten);
				$("body").scrollTop('0px');
				$("#konten").fadeOut(300);
				$("#konten").html(json.konten);
				$("#konten").fadeIn(300);
			}
		});
    });
</script>