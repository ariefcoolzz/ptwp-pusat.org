<?php
class Model_score extends CI_Model
{
	//DIKA AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
	function score_rekap_penyisihan($key = NULL)
	{
		$this->db->select("'penyisihan' AS 'jenis'");
		$this->db->select("A.*");
		$this->db->select("B.lapangan");
		$this->db->select("KATEGORI(A.id_kategori) AS kategori");
		// $this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_A) AS nama_tim_A");
		// $this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_B) AS nama_tim_B");
		$this->db->from('data_babak_penyisihan AS A');
		$this->db->join("master_lapangan AS B", "A.id_lapangan = B.id_lapangan", 'left');
		IF($key != NULL) $this->db->where("MD7(A.id_pertandingan)",$key); 
		$this->db->order_by("A.id_event DESC, A.id_kategori ASC, A.pool ASC, A.urutan ASC");

		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	
	function score_rekap_final($key = NULL)
	{
		$this->db->select("'final' AS 'jenis'");
		$this->db->select("A.*");
		$this->db->select("B.lapangan");
		$this->db->select("KATEGORI(A.id_kategori) AS kategori");
		// $this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_A) AS nama_tim_A");
		// $this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_B) AS nama_tim_B");
		$this->db->from('data_babak_final AS A');
		$this->db->join("master_lapangan AS B", "A.id_lapangan = B.id_lapangan", 'left');
		IF($key != NULL) $this->db->where("MD7(A.id_pertandingan)",$key);
		$this->db->order_by("A.id_event DESC, A.id_kategori ASC, A.per ASC, A.urutan ASC");

		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	
	function manage_tombol($P)
	{
		//Contoh Query = UPDATE data_babak_final SET set1_tim_B = (set1_tim_B - 1) WHERE id_pertandingan = 1
		$query = "UPDATE data_babak_".$P['jenis']." SET set".$P['set']."_tim_".$P['tim']." = (set".$P['set']."_tim_".$P['tim']." ".$P['aksi']." 1) WHERE MD7(id_pertandingan) = '".$P['key']."'";
		$status = $this->db->query($query);
		// DIE($this->db->last_query());
		return $status;
	}
	//DIKA AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
}
