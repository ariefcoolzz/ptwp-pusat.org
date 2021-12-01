<select id='pool'>
	<option value='<?php echo MD7("0"); ?>'>SEMUA POOL</option>
	<?php
	IF(ISSET($_POST['id_kategori'])) $id_kategori = $_POST['id_kategori']; ELSE $id_kategori = false;
	echo $id_kategori."bbb";
	$pool 	= $this->Model_main->model_select_pool($id_kategori);
	IF(COUNT($pool->result_array()))
		{
			foreach($pool->result_array() as $R){
				echo "<option value='".MD7($R['pool'])."'>POOL $R[pool]</option>";
			}
		}
	?>
</select>