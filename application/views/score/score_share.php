<?php $this->load->view("score/@header"); ?>
<div class="container">
    <div class="card mg-y-30">
        <div class="card-body">
			<div class="table-responsive">
				<table id="datatable-score1" class="table table-primary table-striped w-100">
					<tr>
						<th rowspan='2'><span class='d-block'>Nama</span>
							<select id='set' class="form-control col-2">
								<option value='0'>Pilih SET</option>
								<option value='1'>Satu</option>
								<option value='2'>Dua</option>
								<option value='3'>Tiga</option>
							</select>
						</th>
						<th colspan='3'>Set Game</th>
						<th rowspan='2'>Score</th>
					</tr>
					<tr>
						<th>1</th>
						<th>2</th>
						<th>3</th>
					</tr>
					<tr>
						<td>Foto Tim A Nama Tim A</td>
						<td><span id='set1_tim_A'>0</span></td>
						<td><span id='set2_tim_A'>0</span></td>
						<td><span id='set3_tim_A'>0</span></td>
						<td>0</td>
					</tr>
					<tr>
						<td>Foto Tim B Nama Tim B</td>
						<td><span id='set1_tim_B'>0</span></td>
						<td><span id='set2_tim_B'>0</span></td>
						<td><span id='set3_tim_B'>0</span></td>
						<td>0</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view("score/@footer"); ?>
<script>
	setInterval(refresh, 1000);
	
	function refresh() {
		
		var form_data = new FormData();
		form_data.append('jenis', "<?php echo $jenis; ?>");
		form_data.append('key',   "<?php echo $key; ?>");
		form_data.append('set',   $("#set").val());
		$.ajax({
			url: "<?php echo base_url(); ?>score/score_get",
			type: 'POST',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			dataType: 'json',
			success: function(json) {
				// alert(json.game_tim_A);
				$("#set1_tim_A").text(json.set1_tim_A);
				$("#set1_tim_B").text(json.set1_tim_B);
				$("#set2_tim_A").text(json.set2_tim_A);
				$("#set2_tim_B").text(json.set2_tim_B);
				$("#set3_tim_A").text(json.set3_tim_A);
				$("#set3_tim_B").text(json.set3_tim_B);
			}
		});
	}
</script>