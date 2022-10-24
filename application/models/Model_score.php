<?php
class Model_score extends CI_Model
{
	//DIKA AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
	function get_id_pertandingan($jenis, $key)
	{
		$this->db->select("A.id_pertandingan");
		$this->db->from("data_babak_$jenis AS A");
		$this->db->where("MD7(A.id_pertandingan)",$key); 
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query->row_array()['id_pertandingan'];
	}

	function get_game($jenis, $key)
	{
		$this->db->select("A.set1_tim_A");
		$this->db->select("A.set2_tim_A");
		$this->db->select("A.set3_tim_A");
		$this->db->select("A.set1_tim_B");
		$this->db->select("A.set2_tim_B");
		$this->db->select("A.set3_tim_B");
		$this->db->from("data_babak_".$jenis." AS A");
		$this->db->where("MD7(A.id_pertandingan)",$key); 
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}

	function get_point($jenis, $key)
	{
		$this->db->select("`POINT`(A.id_point_tim_A) AS point_tim_A");
		$this->db->select("`POINT`(A.id_point_tim_B) AS point_tim_B");
		$this->db->from("data_babak_".$jenis."_score AS A");
		$this->db->where("MD7(A.id_pertandingan)",$key); 
		$this->db->order_by("`set` DESC, `game` DESC"); 
		$this->db->limit(1); 
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}

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

	function score_point_detail($P)
	{
		$this->db->select("A.*");
		$this->db->select("`POINT`(A.id_point_tim_A) AS point_tim_A");
		$this->db->select("`POINT`(A.id_point_tim_B) AS point_tim_B");
		$this->db->from("data_babak_".$P['jenis']."_score AS A");
		$this->db->where("MD7(A.id_pertandingan)",$P['key']);
		$this->db->where("A.`set`",$P['set']);
		$this->db->where("A.`game`",$P['game']);
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	
	function manage_tombol_game($P)
	{
		//Contoh Query = UPDATE data_babak_final SET set1_tim_B = (set1_tim_B - 1) WHERE id_pertandingan = 1
		$query = "UPDATE data_babak_".$P['jenis']." SET set".$P['set']."_tim_".$P['tim']." = (set".$P['set']."_tim_".$P['tim']." ".$P['aksi']." 1) WHERE MD7(id_pertandingan) = '".$P['key']."'";
		$status = $this->db->query($query);
		// DIE($this->db->last_query());
		return $status;
	}

	function manage_tombol_point($P)
	{
		$this->db->select("A.id_pertandingan");
		$this->db->from("data_babak_".$P['jenis']."_score AS A");
		$this->db->where("MD7(A.id_pertandingan)",$P['key']);
		$this->db->where("A.`set`",$P['set']);
		$this->db->where("A.`game`",$P['game']);
		$query = $this->db->get();
		// DIE($this->db->last_query());
		IF(!$query->num_rows())
			{
				$jenis					= $P['jenis'];
				// PRINT_R($P);DIE();
				$I['id_pertandingan']	= $this->get_id_pertandingan($P['jenis'],$P['key']);;
				$I['set']				= $P['set'];
				$I['game']				= $P['game'];
				
				$status = $this->db->insert("data_babak_".$jenis."_score", $I);
				// DIE($this->db->last_query());
			}
		
		//Contoh Query = UPDATE data_babak_final SET set1_tim_B = (set1_tim_B - 1) WHERE id_pertandingan = 1
		$query = "UPDATE data_babak_".$P['jenis']."_score SET id_point_tim_".$P['tim']." = (id_point_tim_".$P['tim']." ".$P['aksi']." 1) WHERE MD7(id_pertandingan) = '".$P['key']."' AND `set` = '".$P['set']."' AND game = '".$P['game']."'";
		$status = $this->db->query($query);
		// DIE($this->db->last_query());
		return $status;
	}
	//DIKA AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
}
