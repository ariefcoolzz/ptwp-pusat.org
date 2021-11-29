<?php
class Model_main extends CI_Model
{
	function model_data_pemain()
	{
		$this->db->select("A.*, B.kategori");
		$this->db->from('data_pemain AS A');
		$this->db->join("master_kategori_pemain AS B", "A.id_kategori = B.id_kategori", 'left');
		$this->db->order_by("A.nama", "ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	
	function model_data_pertandingan()
	{
		$this->db->select("A.*");
		$this->db->select("B.lapangan");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1),IF(id_pemain2 IS NULL,'',CONCAT('<br>',NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_A) AS nama_tim_A");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1),IF(id_pemain2 IS NULL,'',CONCAT('<br>',NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_B) AS nama_tim_B");
		$this->db->from('data_pertandingan AS A');
		$this->db->join('master_lapangan AS B','A.id_lapangan=B.id_lapangan','left');
		$this->db->order_by("A.tanggal", "ASC");
		$this->db->order_by("A.waktu", "ASC");
		$this->db->order_by("A.id_lapangan", "ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	
	function model_data_pertandingan_point($id_data_point)
	{
		$this->db->select("A.*");
		$this->db->select("NAMA_POINT(A.id_point_tim_A) AS point_tim_A");
		$this->db->select("NAMA_POINT(A.id_point_tim_B) AS point_tim_B");
		$this->db->from('data_point AS A');
		$this->db->where('A.id_data_point',$id_data_point);
		$this->db->order_by("A.set", "ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
}
