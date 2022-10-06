<div id='tes'>
	<table border='1'>
		<tr>
			<td>Foto Tim A</td>
			<td>Foto Tim B</td>
			<td>Nama Tim A</td>
			<td>Nama Tim B</td>
			<td><span id='#game_tim_A'>0</span></td>
			<td><span id='#game_tim_B'>0</span></td>
			<td>0</td>
			<td>0</td>
		</tr>
	</table>
</div>
<script>
	setInterval(function () {
		
		var form_data = new FormData();
		form_data.append('jenis', "<?php echo $jenis; ?>");
		form_data.append('key',   "<?php echo $key; ?>");
		form_data.append('set',   $(this).val());
		$.ajax({
			url: "<?php echo base_url(); ?>score/manage_set",
			type: 'POST',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			dataType: 'json',
			success: function(json) {
				// alert(json.konten_button);
				$("#game_tim_A").text(json.game_tim_A);
				$("#game_tim_B").text(json.game_tim_B);
			}
		});
		
	}, 1000);
</script>