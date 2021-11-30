<?php 
	$kategori = $this->basic->get_data('master_kategori_pemain'); 
?>
<div class="content content-fixed">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-style1 mg-b-0">
			<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Beranda</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?php echo $judul; ?></li>
		</ol>
	</nav>
	<hr class="mg-y-40">
	<h4 id="section1" class="mg-b-10">DATA PEMAIN TOURNAMEN KETUA MA PTWP</h4>
	<div data-label="MyTabPTWP" class="df-example">
    	<ul class="nav nav-tabs" id="myTab" role="tablist">
			<?php 
				foreach($kategori->result_array() as $R){
					$activ = '';
					if($R['id_kategori'] == 1) $activ = 'active';
					echo '<li class="nav-item">
						  <a class="nav-link '.$activ.'" id="'.$R['id_kategori'].'-tab" data-toggle="tab" href="#tab_'.$R['id_kategori'].'" role="tab" aria-controls="home" aria-selected="true">'.$R['kategori'].'</a>
						</li>';
				}
			?>
		 </ul>
		<div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="MyTabPTWP">
			<?php 
				foreach($kategori->result_array() as $R){
					$activ = '';
					if($R['id_kategori'] == 1) $activ = 'show active';
					echo '<div class="tab-pane fade '.$activ.'" id="tab_'.$R['id_kategori'].'" role="tabpanel" aria-labelledby="'.$R['id_kategori'].'-tab">';
					echo '<table class="datatable-pemain table">
							<thead>
								<tr>
									<th class="wd-10p text-center">No.</th>
									<th class="text-center">Nama</th>
									<th class="text-center">Kategori</th>
									<th class="text-center">Satuan Kerja</th>
								</tr>
							</thead><tbody>';
					$data 	= $this->Model_main->model_data_pemain($R['id_kategori']);
					if (COUNT($data->result_array())) {
						$no = 0;
						foreach ($data->result_array() as $T) {
							$no++;
							echo '<tr>';
							echo '<td class="text-center">'.$no.'</td>';
							echo '<td>'.$T['nama'].'</td>';
							echo '<td class="text-center">'.$T['kategori'].'</td>';
							echo '<td class="text-center">'.$T['satker'].'</td>';
							echo '</tr>';
						}
					}
					echo '</tbody><tfoot class="bg-primary">
							<tr>
								<th colspan="4" class="text-white">Jumlah Pemain: '.$no.'</th>
							</tr>
						  </tfoot></table>';
					echo '</div>';
				}
			?>
	 	</div>
     </div>
</div>
<script>
	$('.datatable-pemain').DataTable({
		language: {
			searchPlaceholder: 'Pencarian...',
			sSearch: '',
			lengthMenu: '_MENU_ Pemain/Halaman',
		}
	});
</script>