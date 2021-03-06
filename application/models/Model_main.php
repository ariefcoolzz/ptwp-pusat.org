<?php
class Model_main extends CI_Model
{
	function model_select_pool($id_kategori = false)
	{
		$this->db->distinct();
		$this->db->select("A.pool");
		$this->db->from('data_babak_penyisihan AS A');
		if($id_kategori)$this->db->where('A.id_kategori',$id_kategori);
		$this->db->order_by("A.pool", "ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	
	function model_data_pemain($id_kategori = false)
	{
		$this->db->select("A.*, C.kategori");
		$this->db->from('data_pemain AS A');
		$this->db->join("data_tim AS B", "(A.id_pemain = B.id_pemain1 OR A.id_pemain = B.id_pemain2)", 'left');
		$this->db->join("master_kategori_pemain AS C", "B.id_kategori = C.id_kategori", 'left');
		if($id_kategori)$this->db->where('B.id_kategori',$id_kategori);
		$this->db->order_by("A.nama", "ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	
	// function model_data_pertandingan()
	// {
		// $this->db->select("A.*");
		// $this->db->select("B.lapangan");
		// // $this->db->select("(SELECT CONCAT(NIP_PEMAIN(id_pemain1),IF(id_pemain2 IS NULL,'',CONCAT('<br>',NIP_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_A) AS nip_tim_A");
		// // $this->db->select("(SELECT CONCAT(NIP_PEMAIN(id_pemain1),IF(id_pemain2 IS NULL,'',CONCAT('<br>',NIP_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_B) AS nip_tim_B");
		// $this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1),IF(id_pemain2 IS NULL,'',CONCAT('<br>',NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_A) AS nama_tim_A");
		// $this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1),IF(id_pemain2 IS NULL,'',CONCAT('<br>',NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_B) AS nama_tim_B");
		// $this->db->from('data_pertandingan AS A');
		// $this->db->join('master_lapangan AS B','A.id_lapangan=B.id_lapangan','left');
		// $this->db->order_by("A.tanggal", "ASC");
		// $this->db->order_by("A.waktu", "ASC");
		// $this->db->order_by("A.id_lapangan", "ASC");
		// $query = $this->db->get();
		// // DIE($this->db->last_query());
		// return $query;
	// }
	
	// function model_data_pertandingan_point($id_data_point)
	// {
		// $this->db->select("A.*");
		// $this->db->select("NAMA_POINT(A.id_point_tim_A) AS point_tim_A");
		// $this->db->select("NAMA_POINT(A.id_point_tim_B) AS point_tim_B");
		// $this->db->from('data_point AS A');
		// $this->db->where('A.id_data_point',$id_data_point);
		// $this->db->order_by("A.set", "ASC");
		// $query = $this->db->get();
		// // DIE($this->db->last_query());
		// return $query;
	// }
	
	function model_data_babak_penyisihan($id_kategori,$pool)
	{
		$this->db->select("A.*");
		// $this->db->select("B.id_tim_B");
		// $this->db->select("B.set1_tim_A");
		// $this->db->select("B.set1_tim_B");
		$this->db->select("C.lapangan");
		// $this->db->select("(SELECT CONCAT(NIP_PEMAIN(id_pemain1),IF(id_pemain2 IS NULL,'',CONCAT('<br>',NIP_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_A) AS nip_tim_A");
		// $this->db->select("(SELECT CONCAT(NIP_PEMAIN(id_pemain1),IF(id_pemain2 IS NULL,'',CONCAT('<br>',NIP_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = B.id_tim_B) AS nip_tim_B");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1),IF(id_pemain2 IS NULL,'',CONCAT('<br>',NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_A) AS nama_tim_A");
		// $this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1),IF(id_pemain2 IS NULL,'',CONCAT('<br>',NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = B.id_tim_B) AS nama_tim_B");
		$this->db->from('data_babak_penyisihan AS A');
		// $this->db->join('data_babak_penyisihan_detail AS B','A.id_kategori=B.id_kategori AND A.pool=B.pool AND A.urutan=B.urutan','left');
		$this->db->join('master_lapangan AS C','A.id_lapangan=C.id_lapangan','left');
		$this->db->where("MD7(A.id_kategori)", $id_kategori);
		IF($pool != MD7('0')) $this->db->where("MD7(A.pool)", $pool);
		$this->db->order_by("A.id_kategori", "ASC");
		$this->db->order_by("A.pool", "ASC");
		$this->db->order_by("A.urutan", "ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	
	function model_data_babak_penyisihan_get_score($id_kategori,$pool,$id_tim_A,$id_tim_B,$tim)
	{
		$this->db->select("B.set1_tim_A AS score");
		$this->db->from('data_babak_penyisihan AS A');
		$this->db->join('data_babak_penyisihan_detail AS B','A.id_kategori=B.id_kategori AND A.pool=B.pool AND A.urutan=B.urutan','inner');
		$this->db->where("A.id_kategori", $id_kategori);
		$this->db->where("A.pool", $pool);
		$this->db->where("(A.id_tim_A = '$id_tim_A' AND B.id_tim_B = '$id_tim_B')");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query->row_array()['score'];
	}
	
	function model_data_babak_final($id_kategori = false,$per = false)
	{
		$this->db->select("A.*");
		$this->db->select("B.lapangan");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1),IF(id_pemain2 IS NULL,'',CONCAT('<br>',NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_A) AS nama_tim_A");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1),IF(id_pemain2 IS NULL,'',CONCAT('<br>',NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_B) AS nama_tim_B");
		$this->db->from('data_babak_final AS A');
		$this->db->join('master_lapangan AS B','A.id_lapangan=B.id_lapangan','left');
		if($id_kategori) $this->db->where('MD7(A.id_kategori)',$id_kategori);
		if($per) $this->db->where('MD7(A.per)',$per);
		$this->db->order_by("A.id_kategori", "ASC");
		$this->db->order_by("A.per", "ASC");
		$this->db->order_by("A.urutan", "ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	
	function model_cek_tunggal_ganda($id_kategori)
	{
		$this->db->select("A.tunggal_ganda");
		$this->db->from('master_kategori_pemain AS A');
		$this->db->where("A.id_kategori", $id_kategori);
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query->row_array()['tunggal_ganda'];
	}
	
	function model_data_jadwal_pertandingan_babak_penyisihan()
	{
		$this->db->select("A.*");
		$this->db->select("B.lapangan");
		$this->db->select("KATEGORI(A.id_kategori) AS kategori");
		// $this->db->select("(SELECT CONCAT(NIP_PEMAIN(id_pemain1),IF(id_pemain2 IS NULL,'',CONCAT('<br>',NIP_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_A) AS nip_tim_A");
		// $this->db->select("(SELECT CONCAT(NIP_PEMAIN(id_pemain1),IF(id_pemain2 IS NULL,'',CONCAT('<br>',NIP_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_B) AS nip_tim_B");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1),IF(id_pemain2 IS NULL,'',CONCAT('<br>',NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_A) AS nama_tim_A");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1),IF(id_pemain2 IS NULL,'',CONCAT('<br>',NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_B) AS nama_tim_B");
		$this->db->from('data_babak_penyisihan AS A');
		$this->db->join('master_lapangan AS B','A.id_lapangan=B.id_lapangan','left');
		$this->db->order_by("A.tanggal", "ASC");
		$this->db->order_by("A.waktu", "ASC");
		$this->db->order_by("A.id_lapangan", "ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	
	function model_data_jadwal_pertandingan_babak_final()
	{
		$this->db->select("A.*");
		$this->db->select("B.lapangan");
		$this->db->select("KATEGORI(A.id_kategori) AS kategori");
		// $this->db->select("(SELECT CONCAT(NIP_PEMAIN(id_pemain1),IF(id_pemain2 IS NULL,'',CONCAT('<br>',NIP_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_A) AS nip_tim_A");
		// $this->db->select("(SELECT CONCAT(NIP_PEMAIN(id_pemain1),IF(id_pemain2 IS NULL,'',CONCAT('<br>',NIP_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_B) AS nip_tim_B");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1),IF(id_pemain2 IS NULL,'',CONCAT('<br>',NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_A) AS nama_tim_A");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1),IF(id_pemain2 IS NULL,'',CONCAT('<br>',NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_B) AS nama_tim_B");
		$this->db->from('data_babak_final AS A');
		$this->db->join('master_lapangan AS B','A.id_lapangan=B.id_lapangan','left');
		$this->db->order_by("A.tanggal", "ASC");
		$this->db->order_by("A.waktu", "ASC");
		$this->db->order_by("A.id_lapangan", "ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
}
