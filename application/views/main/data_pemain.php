<div class="content content-fixed">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-style1 mg-b-0">
			<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Beranda</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?php echo $judul; ?></li>
		</ol>
	</nav>
</div>
<div class="content">
	<div class="table-responsive">
		<table class='table table-striped'>
			<h4 class="header-title btn-sm btn-dark">DATA PEMAIN</h4>
			<div class="dropdown-divider" style="border-color: seagreen;"></div>
			<tr>
				<th>No.</th>
				<th>Nama</th>
				<th>Nip</th>
			</tr>
			<?php
			$data 	= $this->Model_main->model_data_pemain();
			if (COUNT($data->result_array())) {
				$no = 0;
				foreach ($data->result_array() as $R) {
					$no++;
			?>
					<tr>
						<td class="p-1"><?php echo $no; ?></td>
						<td class="p-1"><?php echo $R['nama']; ?></td>
						<td class="p-1"><?php echo $R['nip']; ?></td>
					</tr>
			<?php
				}
			}
			?>
			<tr>
				<th colspan='3'>Jumlah Pemain: <?php echo $no; ?></th>
			</tr>
		</table>
	</div>
</div><!-- content -->