<select id='pool' class="form-control">
	<option value='<?php echo MD7("0"); ?>'>SEMUA POOL</option>
	<?php
	if (isset($_POST['id_kategori'])) $id_kategori = $_POST['id_kategori'];
	else $id_kategori = false;
	echo $id_kategori . "bbb";
	$pool 	= $this->Model_main->model_select_pool($id_kategori);
	if (COUNT($pool->result_array())) {
		foreach ($pool->result_array() as $R) {
			echo "<option value='" . MD7($R['pool']) . "'>POOL $R[pool]</option>";
		}
	}
	?>
</select>