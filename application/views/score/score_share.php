<?php $this->load->view("score/@header"); ?>
<div class="pos-relative">
	<!-- <div class="pos-fixed t-30 l-30">
		<img src="<?php echo base_url('assets/img/favicon.png'); ?>" class="wd-60" alt="">
	</div>
	<div class="pos-fixed t-30 r-30">
		<h3 class="tx-roboto tx-danger">LIVE</h3>
	</div> -->
	<div class="pos-fixed t-10 l-10">
		<div class="card wd-350">
			<div class="card-body p-0">
				<?php $this->load->view('score/score_share_tabel_' . $jenis); ?>
			</div>
		</div>
	</div>
	<!-- <div class="pos-fixed b-30 l-30">
		<div class="card wd-400">
			<div class="card-body bg-secondary rounded">
				<?php $this->load->view('score/score_share_tabel_' . $jenis); ?>
			</div>
		</div>
	</div> -->
	<!-- <div class="pos-fixed b-30 r-30">
		<img src="<?php echo base_url('assets/img/maskot.png'); ?>" class="ht-150" alt="">
	</div> -->
</div>
<?php $this->load->view("score/@footer"); ?>
<script>
	setInterval(refresh, 3000); // 1000 = 1 detik

	function refresh() {

		var form_data = new FormData();
		form_data.append('jenis', "<?php echo $jenis; ?>");
		form_data.append('key', "<?php echo $key; ?>");
		form_data.append('set', $("#set").val());
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
				$("#point_tim_A").text(json.point_tim_A);
				$("#point_tim_B").text(json.point_tim_B);
			}
		});
	}
</script>