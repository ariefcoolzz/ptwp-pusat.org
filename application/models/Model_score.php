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

	function model_master_lapangan()
	{
		$this->db->select('A.*');
		$this->db->from('master_lapangan AS A');
		$this->db->order_by('A.lapangan ASC');
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}

	function model_data_pemain($P)
	{
		$this->db->select('A.*');
		$this->db->select("IF(A.is_dharmayukti = '0', A.nama, A.nama_istri) AS nama");
		$this->db->from('view_pemain AS A');
		$this->db->where('A.id_event', $_SESSION['id_event']); 
		$this->db->where('A.is_official', '0');  
		IF(ISSET($P['id_kontingen'])) $this->db->where('A.id_kontingen', $P['id_kontingen']); 
		
		IF(ISSET($P['beregu']) AND $P['beregu'] == 'putra') 
			{
				$this->db->where('A.is_veteran', '0');
				$this->db->where('A.is_dharmayukti', '0');
				$this->db->where('A.beregu', 'putra'); 
			} 
		IF(ISSET($P['beregu']) AND $P['beregu'] == 'putri') 
			{
				$this->db->where('A.is_veteran', '0');
				$this->db->where("((A.beregu = 'putra' AND A.is_dharmayukti = '1') OR A.beregu = 'putri')");
			} 
		IF(ISSET($P['beregu']) AND $P['beregu'] == 'veteran') 
			{
				$this->db->where('A.is_veteran', '1');  
			} 
		$this->db->order_by('nama ASC');
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}

	function model_data_penyisihan_rekap($P)
	{
		$this->db->select('A.*');
		$this->db->select('NAMA_SATKER(A.id_kontingen_tim_A) AS kontingen_tim_A');
		$this->db->select('NAMA_SATKER(A.id_kontingen_tim_B) AS kontingen_tim_B');
		$this->db->select('LAPANGAN(A.id_lapangan) AS lapangan');
		$this->db->select('KATEGORI(A.id_kategori) AS kategori');
		$this->db->select('TUNGGAL_GANDA(A.id_kategori) AS tunggal_ganda');
		$this->db->select('A.nama_pemain_tim_A');
		$this->db->select('A.nama_pemain_tim_B');
		$this->db->from('data_babak_penyisihan AS A');
		$this->db->where('A.id_event', $_SESSION['id_event']);
		IF($_SESSION['beregu'] != "all") $this->db->where('A.beregu', $_SESSION['beregu']); 
		IF($_SESSION['pool'] != "all") $this->db->where('A.pool', $_SESSION['pool']); 
		IF($_SESSION['id_kontingen_tim_A'] != "all") $this->db->where('A.id_kontingen_tim_A', $_SESSION['id_kontingen_tim_A']); 
		IF($_SESSION['id_kontingen_tim_B'] != "all") $this->db->where('A.id_kontingen_tim_B', $_SESSION['id_kontingen_tim_B']); 
		IF(ISSET($P['id_pertandingan'])) $this->db->where('A.id_pertandingan', $P['id_pertandingan']); 
		$this->db->order_by('A.id_event ASC, A.pool ASC, A.urutan ASC, A.id_kategori');
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}

	function model_data_penyisihan_simpan($P)
	{
		IF($P['nama_pemain2_tim_A'] != "") 
			{
				$P['nama_pemain_tim_A'] = $P['nama_pemain1_tim_A']."<br>".$P['nama_pemain2_tim_A'];
			} 
		ELSE {
			$P['nama_pemain_tim_A'] = $P['nama_pemain1_tim_A'];
		}
		IF($P['nama_pemain2_tim_B'] != "") 
			{
				$P['nama_pemain_tim_B'] = $P['nama_pemain1_tim_B']."<br>".$P['nama_pemain2_tim_B'];
			} 
		ELSE {
			$P['nama_pemain_tim_B'] = $P['nama_pemain1_tim_B'];
		}

		UNSET($P['nama_pemain1_tim_A']);
		UNSET($P['nama_pemain2_tim_A']);
		UNSET($P['nama_pemain1_tim_B']);
		UNSET($P['nama_pemain2_tim_B']);

		$P['id_event'] = $_SESSION['id_event'];
		$this->db->where('id_pertandingan', $P['id_pertandingan']);
		$query = $this->db->update('data_babak_penyisihan', $P); 
		//die($this->db->last_query());
		return $query;
	}

	function model_form($P)
	{
		$this->db->select('A.*');
		$this->db->select('NAMA_SATKER(A.id_kontingen_tim_A) AS kontingen_tim_A');
		$this->db->select('NAMA_SATKER(A.id_kontingen_tim_B) AS kontingen_tim_B');
		$this->db->select('LAPANGAN(A.id_lapangan) AS lapangan');
		$this->db->select('KATEGORI(A.id_kategori) AS kategori');
		$this->db->select('TUNGGAL_GANDA(A.id_kategori) AS tunggal_ganda');
		$this->db->select('A.nama_pemain_tim_A');
		$this->db->select('A.nama_pemain_tim_B');
		$this->db->from('data_babak_penyisihan AS A');
		$this->db->where('A.id_event', $_SESSION['id_event']); 
		IF(ISSET($P['id_pertandingan'])) $this->db->where('A.id_pertandingan', $P['id_pertandingan']); 
		IF(ISSET($P['beregu']) AND $P['beregu'] == "putra") $this->db->where('A.beregu', 'putra'); 
		IF(ISSET($P['beregu']) AND $P['beregu'] == "putri") $this->db->where('A.beregu', 'putri'); 
		IF(ISSET($P['pool']) AND $P['pool'] != "all") $this->db->where('A.pool', $P['pool']); 
		IF(ISSET($P['id_kontingen_tim_A']) AND $P['id_kontingen_tim_A'] != "all") $this->db->where('A.id_kontingen_tim_A', $P['id_kontingen_tim_A']); 
		IF(ISSET($P['id_kontingen_tim_B']) AND $P['id_kontingen_tim_B'] != "all") $this->db->where('A.id_kontingen_tim_B', $P['id_kontingen_tim_B']); 
		$this->db->order_by('A.id_event ASC, A.pool ASC, A.urutan ASC, A.id_kategori');
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}

	function model_data_final_rekap($P)
	{
		$this->db->select('A.*');
		$this->db->select('(SELECT id_kontingen_tim_A FROM data_skema WHERE id_event=A.id_event AND beregu=A.beregu AND per=A.per AND urutan=A.urutan) AS id_kontingen_tim_A');
		$this->db->select('(SELECT id_kontingen_tim_B FROM data_skema WHERE id_event=A.id_event AND beregu=A.beregu AND per=A.per AND urutan=A.urutan) AS id_kontingen_tim_B');
		$this->db->select('(SELECT NAMA_SATKER(id_kontingen_tim_A) FROM data_skema WHERE id_event=A.id_event AND beregu=A.beregu AND per=A.per AND urutan=A.urutan) AS kontingen_tim_A');
		$this->db->select('(SELECT NAMA_SATKER(id_kontingen_tim_B) FROM data_skema WHERE id_event=A.id_event AND beregu=A.beregu AND per=A.per AND urutan=A.urutan) AS kontingen_tim_B');
		$this->db->select('LAPANGAN(A.id_lapangan) AS lapangan');
		$this->db->select('KATEGORI(A.id_kategori) AS kategori');
		$this->db->select('TUNGGAL_GANDA(A.id_kategori) AS tunggal_ganda');
		$this->db->select('A.nama_pemain_tim_A');
		$this->db->select('A.nama_pemain_tim_B');
		$this->db->from('data_babak_final AS A');
		$this->db->where('A.id_event', $_SESSION['id_event']);
		IF($_SESSION['beregu'] != "all") $this->db->where('A.beregu', $_SESSION['beregu']); 
		IF($_SESSION['per'] != "all") $this->db->where('A.per', $_SESSION['per']); 
		IF(ISSET($P['id_pertandingan'])) $this->db->where('A.id_pertandingan', $P['id_pertandingan']); 
		IF($_SESSION['id_kontingen_tim_A'] != "all") $this->db->having('id_kontingen_tim_A', $_SESSION['id_kontingen_tim_A']); 
		IF($_SESSION['id_kontingen_tim_B'] != "all") $this->db->having('id_kontingen_tim_B', $_SESSION['id_kontingen_tim_B']); 
		$this->db->order_by('A.id_event ASC, A.per ASC, A.urutan ASC, A.id_kategori ASC');
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}

	function model_data_final_simpan($P)
	{
		IF($P['nama_pemain2_tim_A'] != "") 
			{
				$P['nama_pemain_tim_A'] = $P['nama_pemain1_tim_A']."<br>".$P['nama_pemain2_tim_A'];
			} 
		ELSE {
			$P['nama_pemain_tim_A'] = $P['nama_pemain1_tim_A'];
		}
		IF($P['nama_pemain2_tim_B'] != "") 
			{
				$P['nama_pemain_tim_B'] = $P['nama_pemain1_tim_B']."<br>".$P['nama_pemain2_tim_B'];
			} 
		ELSE {
			$P['nama_pemain_tim_B'] = $P['nama_pemain1_tim_B'];
		}

		UNSET($P['nama_pemain1_tim_A']);
		UNSET($P['nama_pemain2_tim_A']);
		UNSET($P['nama_pemain1_tim_B']);
		UNSET($P['nama_pemain2_tim_B']);

		$P['id_event'] = $_SESSION['id_event'];
		$this->db->where('id_pertandingan', $P['id_pertandingan']);
		$query = $this->db->update('data_babak_final', $P); 
		//die($this->db->last_query());
		return $query;
	}

	function model_data_final_form($P)
	{
		$this->db->select('A.*');
		$this->db->select('NAMA_SATKER(A.id_kontingen_tim_A) AS kontingen_tim_A');
		$this->db->select('NAMA_SATKER(A.id_kontingen_tim_B) AS kontingen_tim_B');
		$this->db->select('LAPANGAN(A.id_lapangan) AS lapangan');
		$this->db->select('KATEGORI(A.id_kategori) AS kategori');
		$this->db->select('TUNGGAL_GANDA(A.id_kategori) AS tunggal_ganda');
		$this->db->select('A.nama_pemain_tim_A');
		$this->db->select('A.nama_pemain_tim_B');
		$this->db->from('data_babak_final AS A');
		$this->db->where('A.id_event', $_SESSION['id_event']); 
		IF(ISSET($P['id_pertandingan'])) $this->db->where('A.id_pertandingan', $P['id_pertandingan']); 
		IF(ISSET($P['beregu']) AND $P['beregu'] == "putra") $this->db->where('A.beregu', 'putra'); 
		IF(ISSET($P['beregu']) AND $P['beregu'] == "putri") $this->db->where('A.beregu', 'putri'); 
		IF(ISSET($P['per']) AND $P['pool'] != "all") $this->db->where('A.per', $P['per']); 
		IF(ISSET($P['id_kontingen_tim_A']) AND $P['id_kontingen_tim_A'] != "all") $this->db->where('A.id_kontingen_tim_A', $P['id_kontingen_tim_A']); 
		IF(ISSET($P['id_kontingen_tim_B']) AND $P['id_kontingen_tim_B'] != "all") $this->db->where('A.id_kontingen_tim_B', $P['id_kontingen_tim_B']); 
		$this->db->order_by('A.id_event ASC, A.pool ASC, A.urutan ASC, A.id_kategori');
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}


	function get_game_penyisihan($key)
	{
		$this->db->select("A.set1_tim_A");
		$this->db->select("A.set2_tim_A");
		$this->db->select("A.set3_tim_A");
		$this->db->select("A.set1_tim_B");
		$this->db->select("A.set2_tim_B");
		$this->db->select("A.set3_tim_B");
		$this->db->select("NAMA_SATKER_SINGKAT(A.id_kontingen_tim_A) AS nama_satker_A");
		$this->db->select("NAMA_SATKER_SINGKAT(A.id_kontingen_tim_B) AS nama_satker_B");
		$this->db->select('A.nama_pemain_tim_A');
		$this->db->select('A.nama_pemain_tim_B');
		$this->db->select("(SELECT COUNT(id_pertandingan) FROM data_babak_penyisihan WHERE beregu=A.beregu AND id_kontingen_tim_A=A.id_kontingen_tim_A AND id_kontingen_tim_B=A.id_kontingen_tim_B AND set1_tim_A = 8) AS menang_tim_A");
		$this->db->select("(SELECT COUNT(id_pertandingan) FROM data_babak_penyisihan WHERE beregu=A.beregu AND id_kontingen_tim_A=A.id_kontingen_tim_A AND id_kontingen_tim_B=A.id_kontingen_tim_B AND set1_tim_B = 8) AS menang_tim_B");
		$this->db->from("data_babak_penyisihan AS A");
		$this->db->where("MD7(A.id_pertandingan)",$key); 
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}

	function get_game_final($key)
	{
		$this->db->select("A.per");
		$this->db->select("A.set1_tim_A");
		$this->db->select("A.set2_tim_A");
		$this->db->select("A.set3_tim_A");
		$this->db->select("A.set1_tim_B");
		$this->db->select("A.set2_tim_B");
		$this->db->select("A.set3_tim_B");
		$this->db->select('(SELECT id_kontingen_tim_A FROM data_skema WHERE id_event=A.id_event AND beregu=A.beregu AND per=A.per AND urutan=A.urutan) AS id_kontingen_tim_A');
		$this->db->select('(SELECT id_kontingen_tim_B FROM data_skema WHERE id_event=A.id_event AND beregu=A.beregu AND per=A.per AND urutan=A.urutan) AS id_kontingen_tim_B');
		$this->db->select('(SELECT NAMA_SATKER_SINGKAT(id_kontingen_tim_A) FROM data_skema WHERE id_event=A.id_event AND beregu=A.beregu AND per=A.per AND urutan=A.urutan) AS nama_satker_A');
		$this->db->select('(SELECT NAMA_SATKER_SINGKAT(id_kontingen_tim_B) FROM data_skema WHERE id_event=A.id_event AND beregu=A.beregu AND per=A.per AND urutan=A.urutan) AS nama_satker_B');
		$this->db->select('A.nama_pemain_tim_A');
		$this->db->select('A.nama_pemain_tim_B');
		$this->db->select("(SELECT COUNT(id_pertandingan) FROM data_babak_final WHERE id_event=A.id_event AND beregu=A.beregu AND per=A.per AND urutan=A.urutan AND (set1_tim_A = 8 OR set2_tim_A = 8 OR set3_tim_A = 8)) AS menang_tim_A");
		$this->db->select("(SELECT COUNT(id_pertandingan) FROM data_babak_final WHERE id_event=A.id_event AND beregu=A.beregu AND per=A.per AND urutan=A.urutan AND (set1_tim_B = 8 OR set2_tim_B = 8 OR set3_tim_B = 8)) AS menang_tim_B");
		
		// $this->db->select("(SELECT COUNT(id_pertandingan) FROM data_babak_penyisihan WHERE beregu=A.beregu AND id_kontingen_tim_A=A.id_kontingen_tim_A AND id_kontingen_tim_B=A.id_kontingen_tim_B AND set1_tim_A = 8) AS menang_tim_A");
		// $this->db->select("(SELECT COUNT(id_pertandingan) FROM data_babak_penyisihan WHERE beregu=A.beregu AND id_kontingen_tim_A=A.id_kontingen_tim_A AND id_kontingen_tim_B=A.id_kontingen_tim_B AND set1_tim_B = 8) AS menang_tim_B");
		$this->db->from("data_babak_final AS A");
		$this->db->where("MD7(A.id_pertandingan)",$key); 
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}


	function get_point($jenis, $key)
	{
		$this->db->select("IF(A.kategori = 'point',`POINT`(A.id_point_tim_A),A.id_point_tim_A) AS point_tim_A");
		$this->db->select("IF(A.kategori = 'point',`POINT`(A.id_point_tim_B),A.id_point_tim_B) AS point_tim_B");
		$this->db->from("data_babak_".$jenis."_score AS A");
		$this->db->where("MD7(A.id_pertandingan)",$key); 
		$this->db->order_by("`set` DESC, `game` DESC"); 
		$this->db->limit(1); 
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}

	function get_point_and_game($jenis, $id_pertandingan)
	{
		$this->db->select("A.*");
		$this->db->select("IF(A.kategori = 'point',`POINT`(A.id_point_tim_A),A.id_point_tim_A) AS point_tim_A");
		$this->db->select("IF(A.kategori = 'point',`POINT`(A.id_point_tim_B),A.id_point_tim_B) AS point_tim_B");
		$this->db->from("data_babak_".$jenis."_score AS A");
		$this->db->where("A.id_pertandingan",$id_pertandingan); 
		$this->db->order_by("`set` ASC, `game` ASC"); 
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
		$this->db->select('A.nama_pemain_tim_A');
		$this->db->select('A.nama_pemain_tim_B');
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
		$this->db->select("IF(A.kategori = 'point',`POINT`(A.id_point_tim_A),A.id_point_tim_A) AS point_tim_A");
		$this->db->select("IF(A.kategori = 'point',`POINT`(A.id_point_tim_B),A.id_point_tim_B) AS point_tim_B");
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
		IF($P['aksi'] == "+") 
			$query = "UPDATE data_babak_".$P['jenis']." SET set".$P['set']."_tim_".$P['tim']." = IF(set".$P['set']."_tim_".$P['tim']." >= 8,8,(set".$P['set']."_tim_".$P['tim']." + 1)) WHERE MD7(id_pertandingan) = '".$P['key']."'";
		ELSE
			$query = "UPDATE data_babak_".$P['jenis']." SET set".$P['set']."_tim_".$P['tim']." = IF(set".$P['set']."_tim_".$P['tim']." <= 0,0,(set".$P['set']."_tim_".$P['tim']." - 1)) WHERE MD7(id_pertandingan) = '".$P['key']."'";
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
				$I['id_pertandingan']	= $this->get_id_pertandingan($P['jenis'],$P['key']);
				$I['set']				= $P['set'];
				$I['game']				= $P['game'];
				
				$status = $this->db->insert("data_babak_".$jenis."_score", $I);
				// DIE($this->db->last_query());
			}
		
		//Contoh Query = UPDATE data_babak_final SET set1_tim_B = (set1_tim_B - 1) WHERE id_pertandingan = 1
		IF($P['kategori'] == 'point')
			{
				IF($P['aksi'] == "+") 
					$query = "UPDATE data_babak_".$P['jenis']."_score SET kategori = '".$P['kategori']."', id_point_tim_".$P['tim']." = IF(id_point_tim_".$P['tim']." >= 4,4,(id_point_tim_".$P['tim']." + 1)) WHERE MD7(id_pertandingan) = '".$P['key']."' AND `set` = '".$P['set']."' AND game = '".$P['game']."'";
				ELSE
					$query = "UPDATE data_babak_".$P['jenis']."_score SET kategori = '".$P['kategori']."', id_point_tim_".$P['tim']." = IF(id_point_tim_".$P['tim']." <= 0,0,(id_point_tim_".$P['tim']." - 1)) WHERE MD7(id_pertandingan) = '".$P['key']."' AND `set` = '".$P['set']."' AND game = '".$P['game']."'";
			}
		ELSE {
			IF($P['aksi'] == "+") 
					$query = "UPDATE data_babak_".$P['jenis']."_score SET kategori = '".$P['kategori']."', id_point_tim_".$P['tim']." = (id_point_tim_".$P['tim']." + 1) WHERE MD7(id_pertandingan) = '".$P['key']."' AND `set` = '".$P['set']."' AND game = '".$P['game']."'";
				ELSE
					$query = "UPDATE data_babak_".$P['jenis']."_score SET kategori = '".$P['kategori']."', id_point_tim_".$P['tim']." = (id_point_tim_".$P['tim']." - 1) WHERE MD7(id_pertandingan) = '".$P['key']."' AND `set` = '".$P['set']."' AND game = '".$P['game']."'";
			
		}
		// DIE($query);
		$status = $this->db->query($query);
		// DIE($this->db->last_query());
		return $status;
	}

	function manage_reset_point($P)
	{
		$FIX['id_pertandingan']= $this->get_id_pertandingan($P['jenis'],$P['key']);
		$FIX['set'] = $P['set'];
		$FIX['game'] = $P['game'];
		$FIX['id_point_tim_A'] = NULL;
		$FIX['id_point_tim_B'] = NULL;
		$this->db->where('id_pertandingan', $FIX['id_pertandingan']);
		$this->db->where('set', $FIX['set']);
		$this->db->where('game', $FIX['game']);
		$status = $this->db->update('data_babak_'.$P['jenis'].'_score', $FIX); 
		return $status;
	}

	function manage_hapus_point($P)
	{
		$FIX['id_pertandingan']= $this->get_id_pertandingan($P['jenis'],$P['key']);
		$FIX['set'] = $P['set'];
		$FIX['game'] = $P['game'];
		$FIX['id_point_tim_A'] = NULL;
		$FIX['id_point_tim_B'] = NULL;
		$this->db->where('id_pertandingan', $FIX['id_pertandingan']);
		$this->db->where('set', $FIX['set']);
		$this->db->where('game', $FIX['game']);
		$status = $this->db->delete('data_babak_'.$P['jenis'].'_score'); 
		// DIE($this->db->last_query());
		return $status;
	}
	//DIKA AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
}
