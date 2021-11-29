<div class="content content-fixed">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-style1 mg-b-0">
			<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Beranda</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?php echo $judul; ?></li>
		</ol>
	</nav>
	<div class="table-responsive mg-t-30">
		<h3>DATA PEMAIN</h3>
		<table id="datatable-pemain" class='table'>
			<thead>
				<tr>
					<th class="wd-10p text-center">No.</th>
					<th>Nama</th>
					<th>Kategori</th>
					<th>Satuan Kerja</th>
				</tr>
			</thead>
			<?php
			$data 	= $this->Model_main->model_data_pemain();
			if (COUNT($data->result_array())) {
				$no = 0;
				foreach ($data->result_array() as $R) {
					$no++;
			?>
					<tr>
						<td class="text-center"><?php echo $no; ?></td>
						<td><?php echo $R['nama']; ?></td>
						<td><?php echo $R['kategori']; ?></td>
						<td><?php echo $R['satker']; ?></td>
					</tr>
			<?php
				}
			}
			?>
			<tfoot class="bg-primary">
				<tr>
					<th colspan='3' class="text-white">Jumlah Pemain: <?php echo $no; ?></th>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
<script>
	$('#datatable-pemain').DataTable({
		language: {
			searchPlaceholder: 'Pencarian...',
			sSearch: '',
			lengthMenu: '_MENU_ Pemain/Halaman',
		}
	});
</script>