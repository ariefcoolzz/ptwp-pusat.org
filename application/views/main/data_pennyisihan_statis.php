<?php 
	$kategori = $this->basic->get_data('master_kategori_pemain'); 
?>
<style>
	/* CSS for responsive iframe */
	/* ========================= */
	
	/* outer wrapper: set max-width & max-height; max-height greater than padding-bottom % will be ineffective and height will = padding-bottom % of max-width */
	#Iframe-Master-CC-and-Rs {
	max-width: 960px;
	max-height: 100%; 
	overflow: hidden;
	}
	
	/* inner wrapper: make responsive */
	.responsive-wrapper {
	position: relative;
	height: 0;    /* gets height from padding-bottom */
	
	/* put following styles (necessary for overflow and scrolling handling on mobile devices) inline in .responsive-wrapper around iframe because not stable in CSS:
	-webkit-overflow-scrolling: touch; overflow: auto; */
	
	}
	
	.responsive-wrapper iframe {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	
	margin: 0;
	padding: 0;
	border: none;
	}
	
	/* padding-bottom = h/w as % -- sets aspect ratio */
	/* YouTube video aspect ratio */
	.responsive-wrapper-wxh-572x612 {
	padding-bottom: 107%;
	}
	
	/* general styles */
	/* ============== */
	.set-border {
	border: 5px inset #4f4f4f;
	}
	.set-box-shadow { 
	-webkit-box-shadow: 4px 4px 14px #4f4f4f;
	-moz-box-shadow: 4px 4px 14px #4f4f4f;
	box-shadow: 4px 4px 14px #4f4f4f;
	}
	.set-padding {
	padding: 40px;
	}
	.set-margin {
	margin: 30px;
	}
	.center-block-horiz {
	margin-left: auto !important;
	margin-right: auto !important;
	}
	
</style>
<div class="content content-fixed">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-style1 mg-b-0">
			<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Beranda</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?php echo $judul; ?></li>
		</ol>
	</nav>
	<hr class="mg-y-40">
	<h4>Data Pool dan Data Pertandingan</h4>
	<h4>Turnamen Tenis Beregu Ke-19 Piala Ketua Mahkamah Agung Republik Indonesia 2022</h4>
	<div data-label="MyTabPTWP" class="df-example">
    	<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link '.$activ.'" id="data_pool-tab" data-toggle="tab" href="#tab_data_pool" role="tab" aria-controls="home" aria-selected="true">Data Pool dan Data Pertandingan</a>
			 </li>
			<?php 
				// foreach($kategori->result_array() as $R){
					// $activ = '';
					// if($R['id_kategori'] == 1) $activ = 'active';
					// echo '<li class="nav-item">
					// <a class="nav-link '.$activ.'" id="'.$R['id_kategori'].'-tab" data-toggle="tab" href="#tab_'.$R['id_kategori'].'" role="tab" aria-controls="home" aria-selected="true">'.$R['kategori'].'</a>
					// </li>';
				// }
			// ?>
		</ul>
		<div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="MyTabPTWP">
			<?php 
				foreach($kategori->result_array() as $R){
					$activ = '';
					$R['id_kategori'] == 7;
					echo '<div class="tab-pane fade" id="tab_data_pool" role="tabpanel" aria-labelledby="data_pool-tab">' ;
					
					echo '<a class="btn btn-danger" href="'.base_url('assets/pdf/7.pdf').'" target="_blank">Unduh</a>';
					echo '<div id="Iframe-Master-CC-and-Rs" class="set-margin set-padding set-border set-box-shadow center-block-horiz">
						<div class="responsive-wrapper 
						responsive-wrapper-wxh-572x612"
						style="-webkit-overflow-scrolling: touch; overflow: auto;">
							
							<iframe src="'.base_url('assets/pdf/7.pdf').'"> 
								<p style="font-size: 110%;"><em><strong>ERROR: </strong>  
								An &#105;frame should be displayed here but your browser version does not support &#105;frames. </em>Please update your browser to its most recent version and try again.</p>
							</iframe>
							<br>
						</div>
					</div>';
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