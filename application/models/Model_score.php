<?php
class Model_score extends CI_Model
{
	//DIKA AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
	function score_rekap()
	{
		$this->db->select("'penyisihan' AS 'jenis'");
		$this->db->select("A.id_pertandingan");
		$this->db->select("A.id_event");
		$this->db->select("A.id_kategori");
		$this->db->select("A.pool");
		$this->db->select("A.urutan");
		$this->db->select("A.tanggal");
		$this->db->select("A.waktu");
		$this->db->select("A.id_lapangan");
		$this->db->select("A.id_tim_A");
		$this->db->select("A.id_tim_B");
		$this->db->select("A.set1_tim_A");
		$this->db->select("A.set1_tim_B");
		$this->db->select("B.lapangan");
		$this->db->select("KATEGORI(A.id_kategori) AS kategori");
		// $this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_A) AS nama_tim_A");
		// $this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_B) AS nama_tim_B");
		$this->db->from('data_babak_penyisihan AS A');
		$this->db->join("master_lapangan AS B", "A.id_lapangan = B.id_lapangan", 'left');
		$this->db->order_by("A.id_event DESC, A.id_kategori ASC, A.pool ASC, A.urutan ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	//DIKA AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
}
