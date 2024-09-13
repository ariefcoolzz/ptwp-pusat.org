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
	<div data-label="MyTabPTWP" class="df-example">
		<?php 
			echo '
				
				<iframe width="100%" height=3000 src="'.base_url('assets/pdf/piala-ketua-mari-yogyakarta-2024.pdf').'"> 
					<p style="font-size: 110%;"><em><strong>ERROR: </strong>  
					An &#105;frame should be displayed here but your browser version does not support &#105;frames. </em>Please update your browser to its most recent version and try again.</p>
				</iframe>
				';
		?>
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