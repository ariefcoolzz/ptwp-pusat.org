<div class="content content-fixed">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-style1 mg-b-0">
			<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Beranda</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?php echo $judul; ?></li>
		</ol>
	</nav>
	<hr class="mg-y-40">

        <h4 id="section1" class="mg-b-10">Basic Example</h4>
        <p class="mg-b-30">The basic tab component consists of links, that are aligned horizontally.</p>

        <div data-label="Example" class="df-example">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Tunggal Hakim</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Ganda Hakim</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Tunggal Karyawan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Ganda Karyawan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Tunggal Putri</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Ganda Putri</a>
            </li>
          </ul>
          <div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <h6>Home</h6>
              <p class="mg-b-0">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore.</p>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <h6>Profile</h6>
              <p class="mg-b-0">Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat.</p>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
              <h6>Contact</h6>
              <p class="mg-b-0">Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</p>
            </div>
          </div>
        </div><!-- df-example -->
</div>
<style>
	.data_pertandingan_point {
		cursor: pointer;
	}
</style>
<script>
	$('[data-toggle="tooltip"]').tooltip();

	$(document).ready(function() {
		$(".data_pertandingan_point").on("click", function() {
			// alert();skip();
			if ($(this).text() == 'Tampilkan') {
				$(this).text('Sembunyikan');
			} else {
				$(this).text('Tampilkan');
			}

			var id_data_point = $(this).attr('id_data_point');
			var form_data = new FormData();
			form_data.append('id_data_point', id_data_point);
			$.ajax({
				url: "<?php echo base_url(); ?>main/data_pertandingan_point",
				type: 'POST',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				dataType: 'json',
				success: function(json) {
					if (json.status !== true) {
						alert("Ada Kesalahan... !!!");
						skip();
					} else {
						$("#data_pertandingan_point" + id_data_point).html(json.konten);
						$("#data_pertandingan_point" + id_data_point).toggle(300);
					}
				}
			});
		});
	});
</script>