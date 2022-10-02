<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Score</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Score</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div data-label="Example" class="df-example demo-table">
                    <div class="table-responsive">
                        <table class="datatable-tabel table table-primary mg-b-0">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th class="wd-20">ID Pertandingan</th>
                                    <th>Jenis</th>
                                    <th>Event</th>
                                    <th>Kategori</th>
                                    <th>Pool</th>
                                    <th>Urutan</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Lapangan</th>
                                    <th>Tim A VS Tim B</th>
                                    <th>Link Manage Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
								$rekap = $this->Model_admin->score_manage();
                                foreach ($rekap->result_array() as $R) {
									$key 	= MD7($R['id_pertandingan']);
									$jenis 	= $R['jenis'];
									
                                    echo '<tr align="center">';
                                    echo "<td align='left'>" . $R['id_pertandingan'] . "</td>";
                                    echo "<td align='left'>" . $R['jenis'] . "</td>";
                                    echo "<td align='left'>" . $R['id_event'] . "</td>";
                                    echo "<td align='left'>" . $R['kategori'] . "</td>";
                                    echo "<td align='left'>" . $R['pool'] . "</td>";
                                    echo "<td align='left'>" . $R['urutan'] . "</td>";
                                    echo "<td align='left'>" . format_tanggal('ddmmyyyy',$R['tanggal']) . "</td>";
                                    echo "<td align='left'>" . $R['waktu'] . "</td>";
                                    echo "<td align='left'>" . $R['lapangan'] . "</td>";
                                    echo "<td align='center'><span class='badge bg-success text-light'>$R[nama_tim_A]</span> <span class='badge bg-success text-light'>$R[set1_tim_A]</span> <small>VS</small> <span class='badge bg-danger text-light'>$R[set1_tim_B]</span> <span class='badge bg-danger text-light'>$R[nama_tim_B]</span></td>";
                                    echo "<td align='left'>
											<span class='copy_link badge bg-warning' data-jenis='$jenis' data-key='$key'>Copy Link: " . $key . "</span>
											<span class='open_link badge bg-success' data-jenis='$jenis' data-key='$key'>Open Link: " . $key . "</span>
										</td>";
                                    echo "</tr>";
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div><!-- table-responsive -->
                </div><!-- df-example -->
            </div>
        </div>
    </div>
</div>
<script>
	$(".copy_link").on("click", function(){
		var key 	= $(this).data('key');
		var jenis 	= $(this).data('jenis');
		var link 	= "<?php echo base_url(); ?>scoremanage/" + jenis + "/" + key;
		alert("Hud Copy Hud > Copy Link Berhasil " + link);
	});
	
	$(".open_link").on("click", function(){
		var key 	= $(this).data('key');
		var jenis 	= $(this).data('jenis');
		var link 	= "<?php echo base_url(); ?>scoremanage/" + jenis + "/" + key;
		window.open(link, '_blank');
	});
	 
    $('[data-toggle="tooltip"]').tooltip();

    // $('.datatable-tabel').DataTable,f6dfdffxdftgcvcccccccccccccccccccccccccccccccvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvc vc({
        language: {
            searchPlaceholder: 'Pencarian...',
            sSearch: '',
            lengthMenu: '_MENU_ Pemain/Halaman',
        }
    });
</script>