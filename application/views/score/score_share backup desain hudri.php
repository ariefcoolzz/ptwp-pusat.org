<?php $this->load->view("score/@header"); ?>
<div class="pos-relative">
	<div class="pos-fixed t-30 l-30">
		<img src="<?php echo base_url('assets/img/favicon.png'); ?>" class="wd-60" alt="">
	</div>
	<div class="pos-fixed t-30 r-30">
		<h3 class="tx-roboto tx-danger">LIVE</h3>
	</div>
	<div class="pos-fixed b-30 l-30">
		<div class="card wd-450"> 
			<div class="card-body bg-secondary rounded-lg">
				<ul class="list-group list-group-flush tx-13">
					<li class="list-group-item d-flex pd-sm-x-20">
						<div class="avatar"></div>
						<div class="pd-l-10">
							<p class="tx-medium mg-b-0">Set</p>
							<small class="tx-12 tx-color-03 mg-b-0"></small>
						</div>
						<div class="mg-l-auto d-flex align-self-center">
							<nav class="nav nav-icon-only">
								<a class="nav-link tx-20">1</a>
								<a class="nav-link tx-20"></a>
								<a class="nav-link tx-20">2</a>
								<a class="nav-link tx-20"></a>
								<a class="nav-link tx-20">3</a>
								<a class="nav-link tx-20">Point</a>
							</nav>
						</div>
					</li>
					<li class="list-group-item d-flex pd-sm-x-20">
						<div class="avatar"><img src="<?php echo base_url('assets/img/default.png'); ?>" class="rounded-circle" alt=""></div>
						<div class="pd-l-10">
							<p class="tx-medium mg-b-0">Pemain 1</p>
							<small class="tx-12 tx-color-03 mg-b-0">Tim A</small>
						</div>
						<div class="mg-l-auto d-flex align-self-center">
							<nav class="nav nav-icon-only">
								<a class="nav-link tx-20" id='set1_tim_A'>0</a>
								<a class="nav-link tx-20">|</a>
								<a class="nav-link tx-20" id='set2_tim_A'>0</a>
								<a class="nav-link tx-20">|</a>
								<a class="nav-link tx-20" id='set3_tim_A'>0</a>
								<a class="nav-link tx-20">|</a>
								<a class="nav-link tx-20 font-weight-bold" id='set3_tim_A'>0</a>
							</nav>
						</div>
					</li>
					<li class="list-group-item d-flex pd-x-20">
						<div class="avatar"><img src="<?php echo base_url('assets/img/default.png'); ?>" class="rounded-circle" alt=""></div>
						<div class="pd-l-10">
							<p class="tx-medium mg-b-0">Pemain 2</p>
							<small class="tx-12 tx-color-03 mg-b-0">Tim B</small>
						</div>
						<div class="mg-l-auto d-flex align-self-center">
							<nav class="nav nav-icon-only">
								<a class="nav-link tx-20" id='set1_tim_B'>0</a>
								<a class="nav-link tx-20">|</a>
								<a class="nav-link tx-20" id='set2_tim_B'>0</a>
								<a class="nav-link tx-20">|</a>
								<a class="nav-link tx-20" id='set3_tim_B'>0</a>
								<a class="nav-link tx-20">|</a>
								<a class="nav-link tx-20 font-weight-bold" id='set3_tim_B'>0</a>
							</nav>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="pos-fixed b-30 r-30">
		<img src="<?php echo base_url('assets/img/maskot.png'); ?>" class="ht-150" alt="">
	</div>
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
			}
		});
	}
</script>