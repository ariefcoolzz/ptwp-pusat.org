<?php
class Model_admin extends CI_Model
{
	function data_tim($id_kategori = false)
	{
		$this->db->select("A.*, C.kategori");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2))))) AS nama_pasangan");
		$this->db->select("NAMA_SATKER(id_pemain1) as nama_satker");
		$this->db->from('data_tim AS A');
		$this->db->join("master_kategori_pemain AS C", "A.id_kategori = C.id_kategori", 'left');
		if($id_kategori)$this->db->where('A.id_kategori',$id_kategori);
		$this->db->order_by("A.id_tim", "ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	function get_pemain_for_tim()
	{
		$this->db->select("A.*");
		$this->db->from('data_pemain AS A');
		$this->db->join("data_tim AS B", "A.id_pemain = B.id_pemain1", 'left');
		$this->db->join("data_tim AS C", "A.id_pemain = C.id_pemain2", 'left');
		$this->db->where('B.`id_tim` IS NULL AND C.`id_tim` IS NULL');
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	function get_tim_A($id_kategori = false)
	{
		$this->db->select("A.*, C.kategori");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2))))) AS nama_pasangan");
		$this->db->select("NAMA_SATKER(id_pemain1) as nama_satker");
		$this->db->from('data_tim AS A');
		$this->db->join("data_babak_penyisihan AS B", "A.id_tim = B.id_tim_A", 'left');
		$this->db->join("master_kategori_pemain AS C", "A.id_kategori = C.id_kategori", 'left');
		if($id_kategori)$this->db->where("A.id_kategori = '$id_kategori' AND pool IS NULL");
		$this->db->order_by("A.id_tim", "ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	function get_tim_B($id_kategori = false)
	{
		$this->db->select("A.*, C.kategori");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2))))) AS nama_pasangan");
		$this->db->select("NAMA_SATKER(id_pemain1) as nama_satker");
		$this->db->from('data_tim AS A');
		$this->db->join("data_babak_penyisihan AS B", "A.id_tim = B.id_tim_B", 'left');
		$this->db->join("master_kategori_pemain AS C", "A.id_kategori = C.id_kategori", 'left');
		if($id_kategori)$this->db->where("A.id_kategori = '$id_kategori' AND pool IS NULL");
		$this->db->order_by("A.id_tim", "ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	function data_tim_byid($id_tim = false)
	{
		$this->db->select("A.*, C.kategori");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2))))) AS nama_pasangan");
		$this->db->select("NAMA_SATKER(id_pemain1) as nama_satker");
		$this->db->from('data_tim AS A');
		$this->db->join("master_kategori_pemain AS C", "A.id_kategori = C.id_kategori", 'left');
		if($id_tim)$this->db->where('A.id_tim',$id_tim);
		$this->db->order_by("A.id_tim", "ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	function get_max_urutan($pool,$id_kategori)
	{
		$this->db->select("MAX(urutan) as urutan");
		$this->db->from("data_babak_penyisihan AS A");
		$this->db->where("pool = '$pool' AND id_kategori = '$id_kategori'");
		$query = $this->db->get()->row_array();
		// DIE($this->db->last_query());
		return $query['urutan'];
	}
	function get_data_penyisihan($id_kategori = false)
	{
		$this->db->select("`A`.*, `B`.`lapangan`");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_A) AS nama_tim_A");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_B) AS nama_tim_B");
		$this->db->from('data_babak_penyisihan AS A');
		$this->db->join("master_lapangan AS B", "A.id_lapangan = B.id_lapangan", 'left');
		if($id_kategori)$this->db->where('A.id_kategori',$id_kategori);
		$this->db->order_by("`A`.`pool` ASC, `A`.`urutan` ASC, `A`.`tanggal` ASC, `A`.`waktu` ASC, `A`.`id_lapangan` ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	
}
