<?php
class Model_admin extends CI_Model
{
	function model_get_data_id_nama($keyword = NULL, $veteran = 0)
	{
		$id_satker = $_SESSION['id_kontingen'];
		if($id_satker == '1500') $id_satker = '3';
		if($id_satker == '1501') $id_satker = '4';
		$this->db->select("A.id_pegawai AS id");
		// $this->db->select("CONCAT(\"<span><img sytle='display: inline-block;' class='rounded-circle ht-40 wd-50 pd-x-5' src='//images.weserv.nl/?url=https://sikep.mahkamahagung.go.id/uploads/foto_pegawai/\",A.FotoPegawai,\"&w=200'>\",A.nama,' [',A.nip,']</span>') AS text");
		$this->db->select("CONCAT(\"<div class='media'><img class='img-thumbnail ht-90 wd-75 mg-r-10' src='//images.weserv.nl/?url=https://sikep.mahkamahagung.go.id/uploads/foto_pegawai/\",A.FotoPegawai,\"&w=200'>\",A.nama,' (',A.umur,')',' <br>',A.nip,' <br>',A.nama_satker,' <br>',NAMA_SATKER('$_SESSION[id_kontingen]'),'</div>') AS text");
		$this->db->from("data_pegawai_all AS A");
		$this->db->where("(A.nama_gelar LIKE '%$keyword%' OR A.nip LIKE '%$keyword%')");
		if (IN_ARRAY($_SESSION['id_panitia'], array(2, 3))) $this->db->where("(A.id_satker = '$id_satker' OR  A.id_satker_parent = '$id_satker')");
		// if ($veteran) $this->db->where("(A.umur >= '60' OR A.id_jabatan = '30')"); //INI TAHUN 2022
		if ($veteran) $this->db->where("(A.umur >= '60' AND A.umur <= 70)");
		$this->db->where("id_status_pegawai = 1");
		$this->db->limit("100");
		$query = $this->db->get();
		// echo($this->db->last_query());
		// die($this->db->last_query());
		return $query;
	}
	function model_get_data_id_nama_veteran($keyword = NULL)
	{
		$id_satker = $_SESSION['id_kontingen'];
		if($id_satker == '1500') $id_satker = '3';
		if($id_satker == '1501') $id_satker = '4';
		$this->db->select("A.id_pegawai AS id");
		// $this->db->select("CONCAT(\"<span><img sytle='display: inline-block;' class='rounded-circle ht-40 wd-50 pd-x-5' src='//images.weserv.nl/?url=https://sikep.mahkamahagung.go.id/uploads/foto_pegawai/\",A.FotoPegawai,\"&w=200'>\",A.nama,' [',A.nip,']</span>') AS text");
		$this->db->select("CONCAT(\"<div class='media'><img class='img-thumbnail ht-90 wd-75 mg-r-10' src='//images.weserv.nl/?url=https://sikep.mahkamahagung.go.id/uploads/foto_pegawai/\",A.FotoPegawai,\"&w=200'>\",A.nama,' (',A.umur,')',' <br> Tgl Lahir : ',A.tgl_lahir,' <br>',A.nip,' <br>',A.nama_satker,' <br>','</div>') AS text");
		$this->db->from("data_pegawai_all AS A");
		$this->db->where("(A.nama_gelar LIKE '%$keyword%' OR A.nip LIKE '%$keyword%')");
		// if ($veteran) $this->db->where("(A.umur >= '60' OR A.id_jabatan = '30')"); //INI TAHUN 2022
		$this->db->where("((YEAR(A.tgl_lahir) <= 1964 AND A.umur <= 70) OR A.id_jabatan = '30')");
		$this->db->where("id_status_pegawai = 1");
		$this->db->limit("100");
		$query = $this->db->get();
		// echo($this->db->last_query());
		// die($this->db->last_query());
		return $query;
	}

	function model_get_data_id_nama_dharmayukti($keyword = NULL)
	{
		$this->db->select("B.IdAnggotaKeluarga AS id");
		// $this->db->select("CONCAT(\"<span><img sytle='display: inline-block;' class='rounded-circle ht-40 wd-50 pd-x-5' src='//images.weserv.nl/?url=https://sikep.mahkamahagung.go.id/uploads/foto_pegawai/\",A.FotoPegawai,\"&w=200'>\",A.nama,' [',A.nip,']</span>') AS text");
		$this->db->select("CONCAT(\"<div class='media'><img class='img-thumbnail ht-90 wd-75 mg-r-10' src='".base_url('assets/img/default.png')."'>\",B.NamaAnggotaKeluarga,' Istri dari ', A.nama,' (Dharmayukti)</div>') AS text");
		$this->db->from("data_pegawai_all AS A");
		$this->db->join("tmst_keluarga AS B", "A.id_pegawai = B.IdPegawai AND B.JenisHubunganKeluarga IN ('9','10')", "LEFT");
		$this->db->where("(B.NamaAnggotaKeluarga LIKE '%$keyword%' OR A.nama LIKE '%$keyword%')");
		if (IN_ARRAY($_SESSION['id_panitia'], array(2, 3))) $this->db->where("(A.id_satker = '$_SESSION[id_kontingen]' OR  A.id_satker_parent = '$_SESSION[id_kontingen]')");
		$this->db->limit("100");
		$query = $this->db->get();
		// echo($this->db->last_query());
		// DIE($this->db->last_query());
		return $query;
	}

	function data_tim($id_kategori = false)
	{
		$this->db->select("A.*, C.kategori");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2))))) AS nama_pasangan");
		$this->db->select("NAMA_SATKER(id_pemain1) as nama_satker");
		$this->db->from('data_tim AS A');
		$this->db->join("master_kategori_pemain AS C", "A.id_kategori = C.id_kategori", 'left');
		if ($id_kategori) $this->db->where('A.id_kategori', $id_kategori);
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
		if ($id_kategori) $this->db->where("A.id_kategori = '$id_kategori' AND pool IS NULL");
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
		if ($id_kategori) $this->db->where("A.id_kategori = '$id_kategori' AND pool IS NULL");
		$this->db->order_by("A.id_tim", "ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	function get_tim_A_free($id_kategori = false)
	{
		$this->db->select("A.*, C.kategori");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2))))) AS nama_pasangan");
		$this->db->select("NAMA_SATKER(id_pemain1) as nama_satker");
		$this->db->from('data_tim AS A');
		$this->db->join("master_kategori_pemain AS C", "A.id_kategori = C.id_kategori", 'left');
		if ($id_kategori) $this->db->where("A.id_kategori = '$id_kategori'");
		$this->db->order_by("A.id_tim", "ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	function get_tim_B_free($id_kategori = false)
	{
		$this->db->select("A.*, C.kategori");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2))))) AS nama_pasangan");
		$this->db->select("NAMA_SATKER(id_pemain1) as nama_satker");
		$this->db->from('data_tim AS A');
		$this->db->join("master_kategori_pemain AS C", "A.id_kategori = C.id_kategori", 'left');
		if ($id_kategori) $this->db->where("A.id_kategori = '$id_kategori'");
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
		if ($id_tim) $this->db->where('A.id_tim', $id_tim);
		$this->db->order_by("A.id_tim", "ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	function get_max_urutan($pool, $id_kategori)
	{
		$this->db->select("MAX(urutan) as urutan");
		$this->db->from("data_babak_penyisihan AS A");
		$this->db->where("pool = '$pool' AND id_kategori = '$id_kategori'");
		$query = $this->db->get()->row_array();
		// DIE($this->db->last_query());
		return $query['urutan'];
	}
	function get_max_urutan_turnamen($per, $id_kategori)
	{
		$this->db->select("MAX(urutan) as urutan");
		$this->db->from("data_babak_final AS A");
		$this->db->where("per = '$per' AND id_kategori = '$id_kategori'");
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
		if ($id_kategori) $this->db->where('A.id_kategori', $id_kategori);
		$this->db->order_by("`A`.`pool` ASC, `A`.`urutan` ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	function get_data_turnamen($id_kategori = false)
	{
		$this->db->select("`A`.*, `B`.`lapangan`, C.nama as per_babak");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_A) AS nama_tim_A");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_B) AS nama_tim_B");
		$this->db->from('data_babak_final AS A');
		$this->db->join("master_lapangan AS B", "A.id_lapangan = B.id_lapangan", 'left');
		$this->db->join("master_kategori_babak AS C", "A.per = C.id_babak", 'left');
		if ($id_kategori) $this->db->where('A.id_kategori', $id_kategori);
		$this->db->order_by("`A`.`per` ASC,`A`.`urutan` ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	function get_tim_byId($id_tim_A, $id_tim_B)
	{
		$this->db->select("`A`.*, `B`.`lapangan`");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_A) AS nama_tim_A");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_B) AS nama_tim_B");
		$this->db->from('data_babak_penyisihan AS A');
		$this->db->join("master_lapangan AS B", "A.id_lapangan = B.id_lapangan", 'left');
		$this->db->where('A.id_tim_A', $id_tim_A);
		$this->db->where('A.id_tim_B', $id_tim_B);

		$this->db->order_by("`A`.`pool` ASC, `A`.`urutan` ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query->row_array();
	}
	function get_turnamen_byId($id_tim_A, $id_tim_B)
	{
		$this->db->select("`A`.*, `B`.`lapangan`");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_A) AS nama_tim_A");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_B) AS nama_tim_B");
		$this->db->from('data_babak_final AS A');
		$this->db->join("master_lapangan AS B", "A.id_lapangan = B.id_lapangan", 'left');
		$this->db->where('A.id_tim_A', $id_tim_A);
		$this->db->where('A.id_tim_B', $id_tim_B);

		$this->db->order_by("`A`.`per` ASC, `A`.`urutan` ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query->row_array();
	}

	//DIKA AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
	// function score_manage()
	// {
	// 	$this->db->select("'penyisihan' AS 'jenis'");
	// 	$this->db->select("A.id_pertandingan");
	// 	$this->db->select("A.id_event");
	// 	$this->db->select("A.id_kategori");
	// 	$this->db->select("A.pool");
	// 	$this->db->select("A.urutan");
	// 	$this->db->select("A.tanggal");
	// 	$this->db->select("A.waktu");
	// 	$this->db->select("A.id_lapangan");
	// 	$this->db->select("A.id_tim_A");
	// 	$this->db->select("A.id_tim_B");
	// 	$this->db->select("A.set1_tim_A");
	// 	$this->db->select("A.set1_tim_B");
	// 	$this->db->select("B.lapangan");
	// 	$this->db->select("KATEGORI(A.id_kategori) AS kategori");
	// 	// $this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_A) AS nama_tim_A");
	// 	// $this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1), IF(id_pemain2 IS NULL, '', CONCAT(' / ', NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_B) AS nama_tim_B");
	// 	$this->db->from('data_babak_penyisihan AS A');
	// 	$this->db->join("master_lapangan AS B", "A.id_lapangan = B.id_lapangan", 'left');
	// 	$this->db->order_by("A.id_event DESC, A.id_kategori ASC, A.pool ASC, A.urutan ASC");
	// 	$query = $this->db->get();
	// 	// DIE($this->db->last_query());
	// 	return $query;
	// }

	function model_rule($id_event, $field = NULL)
	{
		IF($field == NULL) $this->db->select('A.*'); ELSE $this->db->select('A.'.$field);
		$this->db->from('rule AS A');
		$this->db->where('A.id_event', $id_event);
		$query = $this->db->get();
		// die($this->db->last_query());
		IF($field == NULL) return $query; ELSE return $query->row_array()[$field];
	}

	function model_tmst_satker()
	{
		$this->db->select('A.*');
		$this->db->select('NAMA_SATKER_SINGKAT(A.IdSatker) AS nama_satker_singkat');
		$this->db->from('tmst_satker AS A');
		$this->db->where('A.LevelSatker <= 2');
		$this->db->order_by('A.NamaSatker ASC');
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}

	function model_master_lapangan($P)
	{
		$this->db->select('A.*');
		$this->db->from('master_lapangan AS A');
		$this->db->order_by('A.lapangan ASC');
		IF(ISSET($P['id_event'])) $this->db->where('A.id_event', $P['id_event']);
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}

	function model_data_pool_kontingen_group()
	{
		$this->db->select('A.id_kontingen');
		$this->db->select('NAMA_SATKER(A.id_kontingen) AS nama_satker');
		$this->db->from('data_pool AS A');
		$this->db->where('A.id_kontingen IS NOT NULL');
		$this->db->group_by('A.id_kontingen');
		$this->db->order_by('nama_satker ASC');
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}

	function model_data_pool_rekap($P)
	{
		$this->db->select('A.*');
		$this->db->select('NAMA_SATKER(A.id_kontingen) AS nama_satker');
		$this->db->from('data_pool AS A');
		$this->db->order_by('A.id_event ASC, A.pool ASC, A.urutan ASC');
		$this->db->where('A.beregu', $P['beregu']);
		$this->db->where('A.id_event', $P['id_event']);
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}

	function model_data_pool_set_kontingen($P)
	{
		IF(!$P['id_kontingen'] > 0) $P['id_kontingen'] = NULL;
		$this->db->where('id_event', $P['id_event']);
		$this->db->where('pool', $P['pool']);
		$this->db->where('urutan', $P['urutan']);
		$this->db->where('beregu', $P['beregu']);
		$query = $this->db->update('data_pool', $P); 
		// die($this->db->last_query());
		return $query;
	}

	function model_data_drawing_copy($data_batch)
	{
		$data_batch = JSON_DECODE($data_batch);
		$query = $this->db->insert_batch('data_pool', $data_batch); 
		// die($this->db->last_query());
		return $query;
	}

	function model_data_babak_penyisihan_rekap($P)
	{
		$this->db->select('A.*');
		$this->db->select('NAMA_SATKER(A.id_kontingen_tim_A) AS kontingen_tim_A');
		$this->db->select('NAMA_SATKER(A.id_kontingen_tim_B) AS kontingen_tim_B');
		$this->db->select('LAPANGAN(A.id_lapangan) AS lapangan');
		$this->db->select('KATEGORI(A.id_kategori) AS kategori');
		$this->db->select('TUNGGAL_GANDA(A.id_kategori) AS tunggal_ganda');
		$this->db->select('A.nama_pemain_tim_A AS nama_pemain_tim_A');
		$this->db->select('A.nama_pemain_tim_B AS nama_pemain_tim_B');
		$this->db->from('data_babak_penyisihan AS A');
		$this->db->where('A.id_event', $P['id_event']); //id event dimanualin dulu, gw kata ribet gak pake session
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

	function model_data_babak_penyisihan_pemain($P)
	{
		$this->db->select('A.*');
		$this->db->select("IF(A.is_dharmayukti = '0', A.nama, A.nama_istri) AS nama");
		$this->db->from('view_pemain AS A');
		$this->db->where('A.id_event', $P['id_event']); //id event dimanualin dulu, gw kata ribet gak pake session
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

	function model_data_babak_penyisihan_simpan($P)
	{
		IF($P['nama_pemain2_tim_A'] != "") 
			{
				$P['nama_pemain_tim_A'] = $P['nama_pemain1_tim_A'].",".$P['nama_pemain2_tim_A'];
			} 
		ELSE {
			$P['nama_pemain_tim_A'] = $P['nama_pemain1_tim_A'];
		}
		IF($P['nama_pemain2_tim_B'] != "") 
			{
				$P['nama_pemain_tim_B'] = $P['nama_pemain1_tim_B'].",".$P['nama_pemain2_tim_B'];
			} 
		ELSE {
			$P['nama_pemain_tim_B'] = $P['nama_pemain1_tim_B'];
		}

		UNSET($P['nama_pemain1_tim_A']);
		UNSET($P['nama_pemain2_tim_A']);
		UNSET($P['nama_pemain1_tim_B']);
		UNSET($P['nama_pemain2_tim_B']);

		$this->db->where('id_pertandingan', $P['id_pertandingan']);
		$query = $this->db->update('data_babak_penyisihan', $P); 
		//die($this->db->last_query());
		return $query;
	}

	function model_data_babak_penyisihan_generate($P)
	{
		$this->db->select('A.id_event');
		$this->db->select('A.beregu');
		$this->db->select('A.pool');
		$this->db->select('A.urutan');
		$this->db->select('A.id_kontingen AS id_kontingen_tim_A');
		$this->db->select("(SELECT GROUP_CONCAT(id_kontingen ORDER BY urutan ASC SEPARATOR '|') FROM data_pool WHERE id_event = A.id_event AND beregu = A.beregu AND pool = A.pool AND urutan > A.urutan ORDER BY urutan ASC) AS id_kontingen_tim_lawan");
		$this->db->from('data_pool AS A');
		$this->db->where('A.id_event', $P['id_event']); //id event dimanualin dulu, gw kata ribet gak pake session
		$this->db->where('A.id_kontingen IS NOT NULL');
		$this->db->having('id_kontingen_tim_lawan IS NOT NULL');
		$this->db->order_by('A.id_event ASC, A.beregu ASC, A.pool ASC, A.urutan ASC');
		$query = $this->db->get();
		//die($this->db->last_query());
		$status = false;
		IF($query->num_rows())
			{
				$no = 0;
				$urutan = 0;
				$pool = "A";
				FOREACH($query->result_array() AS $R)
					{
						$ajpk = EXPLODE('|', $R['id_kontingen_tim_lawan']); //jpk = jumlah pool kontingen
						// echo "Ketemu ".COUNT($ajpk)." $R[id_kontingen_tim_lawan]<br>";
						FOR($u=0;$u < COUNT($ajpk);$u++)
							{
								$urutan++;
								IF($pool != $R['pool']) 
									{ 
										$urutan=1; 
										$pool = $R['pool'];
									}
								$FIX['id_event'] = $R['id_event'];
								$FIX['beregu'] = $R['beregu'];
								$FIX['pool'] = $R['pool'];
								$FIX['urutan'] = $urutan;
								$FIX['id_kontingen_tim_A'] = $R['id_kontingen_tim_A'];
								$FIX['id_kontingen_tim_B'] = $ajpk[$u];

								$this->db->select('A.id_kategori');
								$this->db->from('master_kategori_pemain AS A');
								$this->db->where('A.beregu', $R['beregu']);
								$this->db->order_by('A.urutan ASC');
								$kategori = $this->db->get(); 
								IF($kategori->num_rows())
									{
										FOREACH($kategori->result_array() AS $k) 
											{
												$FIX['id_kategori'] = $k['id_kategori'];
												$no++;
												// echo "$no. $FIX[id_event] $FIX[beregu] $FIX[pool] $FIX[urutan] $FIX[id_kategori] = $R[id_kontingen_tim_A] vs $ajpk[$u] ($R[id_kontingen_tim_lawan])<br>";
												
												//Pengecekan tabel data_babak_penyisihan, Jika sudah ada tidak di insert
												$this->db->select('A.id_pertandingan');
												$this->db->from('data_babak_penyisihan AS A');
												$this->db->where('A.id_event', $FIX['id_event']);
												$this->db->where('A.beregu', $FIX['beregu']);
												$this->db->where('A.pool', $FIX['pool']);
												$this->db->where('A.urutan', $FIX['urutan']);
												$this->db->where('A.id_kategori', $FIX['id_kategori']);
												$cek = $this->db->get(); 
												//Pengecekan tabel data_babak_penyisihan, Jika sudah ada tidak di insert
												IF(!$cek->num_rows())
													{
														$status = $this->db->insert('data_babak_penyisihan', $FIX);
													}
												else {
													$this->db->where('id_pertandingan', $cek->row_array()['id_pertandingan']);
													$status = $this->db->update('data_babak_penyisihan', $FIX);
												}
											}
									}
							}
						// echo " xxx<br>";	
					}
			}
		return $status;
	}

	function model_tabel_babak_penyisihan_rekap($P)
	{
		// PRINT_R($P);DIE();
		$this->db->select('A.*');
		$this->db->select('NAMA_SATKER(A.id_kontingen) AS nama_satker');
		$this->db->select('NAMA_SATKER_SINGKAT(A.id_kontingen) AS nama_satker_singkat');
		$this->db->from('data_pool AS A');
		$this->db->where('A.id_event', $P['id_event']);
		$this->db->where('A.beregu', $P['beregu']);
		$this->db->where('A.id_kontingen IS NOT NULL');
		IF($P['pool'] != "all") $this->db->where('A.pool', $P['pool']);
		$this->db->order_by('A.id_event ASC, A.pool ASC, A.urutan ASC');
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}

	function model_tabel_babak_penyisihan_score($P)
	{
		$this->db->select('A.*');
		$this->db->from('data_babak_penyisihan AS A');
		$this->db->where('A.id_event', $P['id_event']);
		$this->db->where('A.beregu', $P['beregu']);
		IF($P['pool'] != "all") $this->db->where('A.pool', $P['pool']);
		$this->db->order_by('A.id_event ASC, A.pool ASC, A.urutan ASC');
		$query = $this->db->get();
		//  die($this->db->last_query());
		return $query;
	}

	function model_data_skema($P)
	{
		$this->db->select('A.*');
		$this->db->from('data_skema AS A');
		$this->db->where('A.id_event', $P['id_event']);
		$this->db->where('A.beregu', $P['beregu']);
		$query = $this->db->get(); 
		return $query;
	}

	function model_data_skema_simpan($FIX)
	{
		$this->db->select('A.id_event');
		$this->db->from('data_skema AS A');
		$this->db->where('A.id_event', $FIX['id_event']);
		$this->db->where('A.beregu', $FIX['beregu']);
		$this->db->where('A.per', $FIX['per']);
		$this->db->where('A.urutan', $FIX['urutan']);
		$ketemu = $this->db->get(); 
		IF(!$ketemu->num_rows())
			{
				$status = $this->db->insert('data_skema', $FIX);
			}
			else {
				$this->db->where('id_event', $FIX['id_event']);
				$this->db->where('beregu', $FIX['beregu']);
				$this->db->where('per', $FIX['per']);
				$this->db->where('urutan', $FIX['urutan']);
				$status = $this->db->update('data_skema', $FIX);
			}
		return $status;
	}

	function model_data_babak_final_generate($P)
	{
		FOR($a=1;$a<=16;$a++)
		{
			$G['id_event'] = $P['id_event'];
			$G['beregu'] = 'putra'; 
			$G['per'] = '16'; 
			$G['urutan'] = $a; 
			// PRINT_R($G);DIE();
			$this->model_data_babak_final_generate_simpan($G);
		}

		FOR($a=1;$a<=8;$a++)
		{
			$G['id_event'] = $P['id_event'];
			$G['beregu'] = 'putri'; 
			$G['per'] = '8'; 
			$G['urutan'] = $a; 
			// PRINT_R($G);DIE();
			$this->model_data_babak_final_generate_simpan($G);
		}
	}

	function model_data_babak_final_generate_simpan($FIX)
	{
		$this->db->select('A.id_kategori');
		$this->db->from('master_kategori_pemain AS A');
		$this->db->where('A.beregu', $FIX['beregu']);
		$this->db->order_by('A.urutan ASC');
		$kategori = $this->db->get(); 
		IF($kategori->num_rows())
			{
				FOREACH($kategori->result_array() AS $k) 
					{			
						$FIX['id_kategori'] = $k['id_kategori'];

						$this->db->select('A.id_pertandingan');
						$this->db->from('data_babak_final AS A');
						$this->db->where('A.id_event', $FIX['id_event']);
						$this->db->where('A.beregu', $FIX['beregu']);
						$this->db->where('A.per', $FIX['per']);
						$this->db->where('A.urutan', $FIX['urutan']);
						$this->db->where('A.id_kategori', $FIX['id_kategori']);
						$cek = $this->db->get(); 
						//Pengecekan tabel data_babak_penyisihan, Jika sudah ada tidak di insert
						IF(!$cek->num_rows())
							{
								$status = $this->db->insert('data_babak_final', $FIX);
							}
						else {
							$this->db->where('id_pertandingan', $cek->row_array()['id_pertandingan']);
							$status = $this->db->update('data_babak_final', $FIX);
						}
					}
			}
	}

	function model_data_babak_final_rekap($P)
	{
		$this->db->select('A.*');
		$this->db->select('(SELECT id_kontingen_tim_A FROM data_skema WHERE id_event=A.id_event AND beregu=A.beregu AND per=A.per AND urutan=A.urutan) AS id_kontingen_tim_A');
		$this->db->select('(SELECT id_kontingen_tim_B FROM data_skema WHERE id_event=A.id_event AND beregu=A.beregu AND per=A.per AND urutan=A.urutan) AS id_kontingen_tim_B');
		$this->db->select('(SELECT NAMA_SATKER(id_kontingen_tim_A) FROM data_skema WHERE id_event=A.id_event AND beregu=A.beregu AND per=A.per AND urutan=A.urutan) AS kontingen_tim_A');
		$this->db->select('(SELECT NAMA_SATKER(id_kontingen_tim_B) FROM data_skema WHERE id_event=A.id_event AND beregu=A.beregu AND per=A.per AND urutan=A.urutan) AS kontingen_tim_B');
		$this->db->select('LAPANGAN(A.id_lapangan) AS lapangan');
		$this->db->select('KATEGORI(A.id_kategori) AS kategori');
		$this->db->select('TUNGGAL_GANDA(A.id_kategori) AS tunggal_ganda');
		$this->db->select('A.nama_pemain_tim_A AS nama_pemain_tim_A');
		$this->db->select('A.nama_pemain_tim_B AS nama_pemain_tim_B');
		$this->db->from('data_babak_final AS A');
		$this->db->where('A.id_event', $P['id_event']); //id event dimanualin dulu, gw kata ribet gak pake session
		IF(ISSET($P['id_pertandingan'])) $this->db->where('A.id_pertandingan', $P['id_pertandingan']); 
		IF(ISSET($P['beregu']) AND $P['beregu'] == "putra") $this->db->where('A.beregu', 'putra'); 
		IF(ISSET($P['beregu']) AND $P['beregu'] == "putri") $this->db->where('A.beregu', 'putri'); 
		IF(ISSET($P['beregu']) AND $P['beregu'] == "veteran") $this->db->where('A.beregu', 'veteran'); 
		IF(ISSET($P['per']) AND $P['per'] != "all") $this->db->where('A.per', $P['per']); 
		IF(ISSET($P['id_kontingen_tim_A']) AND $P['id_kontingen_tim_A'] != "all") $this->db->where('A.id_kontingen_tim_A', $P['id_kontingen_tim_A']); 
		IF(ISSET($P['id_kontingen_tim_B']) AND $P['id_kontingen_tim_B'] != "all") $this->db->where('A.id_kontingen_tim_B', $P['id_kontingen_tim_B']); 
		$this->db->order_by('A.id_event ASC, A.beregu ASC, A.per ASC, A.urutan ASC, A.id_kategori ASC');
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}

	function model_data_babak_final_simpan($P)
	{
		IF($P['nama_pemain2_tim_A'] != "") 
			{
				$P['nama_pemain_tim_A'] = $P['nama_pemain1_tim_A'].",".$P['nama_pemain2_tim_A'];
			} 
		ELSE {
			$P['nama_pemain_tim_A'] = $P['nama_pemain1_tim_A'];
		}
		IF($P['nama_pemain2_tim_B'] != "") 
			{
				$P['nama_pemain_tim_B'] = $P['nama_pemain1_tim_B'].",".$P['nama_pemain2_tim_B'];
			} 
		ELSE {
			$P['nama_pemain_tim_B'] = $P['nama_pemain1_tim_B'];
		}

		UNSET($P['nama_pemain1_tim_A']);
		UNSET($P['nama_pemain2_tim_A']);
		UNSET($P['nama_pemain1_tim_B']);
		UNSET($P['nama_pemain2_tim_B']);

		$this->db->where('id_pertandingan', $P['id_pertandingan']);
		$query = $this->db->update('data_babak_final', $P); 
		//die($this->db->last_query());
		return $query;
	}

	//DIKA AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA


	//PUTRA AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
	function list_kategori_pemain($P)
	{
		$this->db->from('master_kategori_pemain AS A');
		$this->db->where('A.beregu', $P['beregu']);
		$this->db->order_by('A.urutan');
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}
	function get_list_pool()
	{
		$id_event = $this->input->post('id_event');
		$beregu = $this->input->post('beregu');
		$this->db->select('pool');
		$this->db->from('data_babak_penyisihan AS A');
		$this->db->where('A.id_event', $id_event);
		$this->db->where('A.beregu', $beregu);
		$this->db->group_by('A.pool');
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}
	function get_data_user($data)
	{
		$id_panitia = $this->input->post('id_panitia');
		$this->db->from('view_user AS A');
		if ($data['id_panitia']) $this->db->where('A.id_panitia', $data['id_panitia']);
		if ($data['aktif'] >= 0)		 $this->db->where('A.aktif', $data['aktif']);
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}
	function get_data_berita()
	{
		$this->db->from('data_konten AS A');
		$this->db->join("view_user AS B", "A.user_created = B.id_user", 'left');
		$this->db->join("tmst_satker AS C", "B.id_kontingen = C.IdSatker", 'left');
		if (IN_ARRAY($_SESSION['id_panitia'], array(2, 3))) {
			$this->db->where(array('cat_id' => '3'));
			$this->db->where("(B.id_kontingen = '" . $_SESSION['id_kontingen'] . "' OR A.user_created = '" . $_SESSION['id_user'] . "')");
		}
		if (IN_ARRAY($_SESSION['id_panitia'], array(0, 1))) $this->db->where_in('cat_id', array('1', '3'));

		$this->db->order_by('id DESC');

		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}
	function get_data_pemain($id_kontingen, $jenis_kelamin = false, $is_official = 0, $is_veteran = false)
	{
		$id_event = $this->input->post('id_event');
		$id_panitia = $this->input->post('id_panitia');
		$this->db->from('view_pemain AS A');
		$this->db->where('A.id_event', $id_event);
		$this->db->where('A.id_kontingen', $id_kontingen);
		if ($jenis_kelamin == "Pria") {
			$this->db->where('A.jenis_kelamin', $jenis_kelamin);
			$this->db->where('A.is_dharmayukti', '0');
		}
		if ($jenis_kelamin == "Wanita") {
			// $this->db->where('A.jenis_kelamin', $jenis_kelamin);
			// $this->db->or_where('A.is_dharmayukti', '1');
			$this->db->where("(A.jenis_kelamin = '" . $jenis_kelamin . "' OR A.is_dharmayukti = '1')");
		}
		if ($is_official) $this->db->where('A.is_official', $is_official);
		else if ($is_veteran) $this->db->where('A.is_veteran', '1');
		else {
			$this->db->where('A.is_official', '0');
			$this->db->where('A.is_veteran', '0');
		}
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}
	function get_data_pemain_new($id_kontingen, $id_kategori = false)
	{
		$id_event = $this->input->post('id_event');
		$id_panitia = $this->input->post('id_panitia');
		$this->db->from('view_pemain AS A');
		$this->db->where('A.id_event', $id_event);
		$this->db->where('A.id_kontingen', $id_kontingen);
		if($id_kategori) $this->db->where('A.id_kategori', $id_kategori);
		$this->db->order_by("A.id_kategori", "ASC");
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}
	function get_data_non_pemain($id_kontingen = false, $id_kategori = false)
	{
		$id_event = $this->input->post('id_event');
		$id_panitia = $this->input->post('id_panitia');
		$this->db->select('sat.`NamaSatker` as nama_kontingen, A.*, B.*');
		$this->db->from('data_non_pemain AS A');
		$this->db->join('data_pegawai_all AS B','A.id_user = B.id_pegawai', 'LEFT');
		$this->db->join('tmst_satker AS sat','A.id_kontingen = sat.IdSatker','LEFT');
		$this->db->where('A.id_event', $id_event);
		if($id_kontingen) $this->db->where('A.id_kontingen', $id_kontingen);
		if($id_kategori) $this->db->where('A.id_kategori', $id_kategori);
		$this->db->order_by("A.id_kategori", "ASC");
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}
	function get_data_pemain_veteran()
	{
		$id_event = $this->input->post('id_event');

		$this->db->from('view_pemain AS A');		
		$this->db->join("data_tim AS B", "A.`id_kategori` = B.`id_kategori` AND (A.`id_pemain` = B.`id_pemain1` OR A.`id_pemain` = B.`id_pemain2`)", 'left');
		$this->db->where('A.id_event', $id_event);
		$this->db->where('A.is_veteran', '1');
		$this->db->order_by("B.id_tim", "ASC");
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}
	function get_data_event($data)
	{
		$id_event = $this->input->post('id_event');
		$this->db->from('data_event');
		// if ($data['id_event']) $this->db->where('A.id_event', $data['id_event']);
		// if ($data['aktif'] >= 0)		 $this->db->where('A.aktif', $data['aktif']);
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}
	function get_list_pemain_beregu($id_event)
	{
		$query = $this->db->query("SELECT A.`IdSatker` AS id_kontingen, A.`NamaSatker` AS nama_satker, 
		IFNULL(B.total_official_blm,'0') AS total_official_blm,
		IFNULL(B.total_official_sudah,'0') AS total_official_sudah,
		IFNULL(B.total_putra_blm,'0') AS total_putra_blm,
		IFNULL(B.total_putra_sudah,'0') AS total_putra_sudah,
		IFNULL(B.total_putri_blm,'0') AS total_putri_blm,
		IFNULL(B.total_putri_sudah,'0') AS total_putri_sudah,
		IFNULL(B.total_veteran_blm,'0') AS total_veteran_blm,
		IFNULL(B.total_veteran_sudah,'0') AS total_veteran_sudah
		FROM tmst_satker AS A
		LEFT JOIN 
		(SELECT V.`id_kontingen` AS id_kontingen,
		SUM(CASE WHEN V.`is_verifikasi` = '0' AND V.`is_official` = '1' THEN 1 ELSE 0 END) AS total_official_blm,
		SUM(CASE WHEN V.`is_verifikasi` = '1' AND V.`is_official` = '1' THEN 1 ELSE 0 END) AS total_official_sudah,
		SUM(CASE WHEN V.`is_verifikasi` = '0' AND V.`is_veteran` = '1' THEN 1 ELSE 0 END) AS total_veteran_blm,
		SUM(CASE WHEN V.`is_verifikasi` = '1' AND V.`is_veteran` = '1' THEN 1 ELSE 0 END) AS total_veteran_sudah,
		SUM(CASE WHEN V.`is_verifikasi` = '0' AND V.`is_veteran` = '0' AND V.`is_official` = '0' AND V.`jenis_kelamin` = 'PRIA'  AND  V.`is_dharmayukti` = '0' THEN 1 ELSE 0 END) AS total_putra_blm,
		SUM(CASE WHEN V.`is_verifikasi` = '1' AND V.`is_veteran` = '0' AND V.`is_official` = '0' AND V.`jenis_kelamin` = 'PRIA'  AND  V.`is_dharmayukti` = '0' THEN 1 ELSE 0 END) AS total_putra_sudah,
		SUM(CASE WHEN V.`is_verifikasi` = '0' AND V.`is_veteran` = '0' AND V.`is_official` = '0' AND (V.`jenis_kelamin` = 'WANITA' OR V.`is_dharmayukti` = '1') THEN 1 ELSE 0 END) AS total_putri_blm,
		SUM(CASE WHEN V.`is_verifikasi` = '1' AND V.`is_veteran` = '0' AND V.`is_official` = '0' AND (V.`jenis_kelamin` = 'WANITA' OR V.`is_dharmayukti` = '1') THEN 1 ELSE 0 END) AS total_putri_sudah
		FROM
		view_pemain AS V
		WHERE V.`id_event` = '$id_event'
		GROUP BY id_kontingen) 
		AS B ON A.IdSatker = B.id_kontingen
		WHERE (IdSatker = 920 OR LevelSatker = 2) AND IsAktif = 'Y'
		ORDER BY UrutanTingkatBanding ASC");
		// die($this->db->last_query());
		return $query;
	}
	function get_list_kontingen_perorangan($id_event)
	{
		$query = $this->db->query("SELECT A.`IdSatker` AS id_kontingen, A.`NamaSatker` AS nama_satker, 
		IFNULL(B.total_official,'0') AS total_official,
		IFNULL(B.total_peserta_konggres,'0') AS total_peserta_konggres
		FROM tmst_satker AS A
		LEFT JOIN 
		(SELECT V.`id_kontingen` AS id_kontingen,
		SUM(CASE WHEN V.`id_kategori` = '1' THEN 1 ELSE 0 END) AS total_official,
		SUM(CASE WHEN V.`id_kategori` = '2' THEN 1 ELSE 0 END) AS total_peserta_konggres
		FROM
		data_non_pemain AS V
		WHERE V.`id_event` = '$id_event'
		GROUP BY id_kontingen) 
		AS B ON A.IdSatker = B.id_kontingen
		WHERE (IdSatker = 920 OR LevelSatker = 2) AND IsAktif = 'Y'
		ORDER BY UrutanTingkatBanding ASC");
		// die($this->db->last_query());
		return $query;
	}
	function get_list_pemain_all($id_event)
	{
		$query = $this->db->query("SELECT sat.`NamaSatker` as nama_kontingen, A.* FROM view_pemain AS A
		left join tmst_satker as sat on A.id_kontingen = sat.`IdSatker`
		WHERE A.id_event = '$id_event'
		ORDER BY UrutanTingkatBanding ASC, A.is_official DESC, is_veteran ASC, is_dharmayukti ASC, jenis_kelamin ASC");
		// die($this->db->last_query());
		return $query;
	}
	function get_data_kontingen($id_kontingen)
	{
		$query = $this->db->query("SELECT NAMA_SATKER('$id_kontingen') as nama_kontingen")->row_array();
		// die($this->db->last_query());
		return $query;
	}
	function get_kategori_pemain($id_event)
	{
		$query = $this->db->query("SELECT * FROM master_kategori_pemain WHERE id_event = '$id_event' ORDER BY urutan");
		// die($this->db->last_query());
		return $query;
	}
	//PUTRA AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
	
	//DONIE EEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
	function get_data_wasit($data)
	{
		$id_wasit = $this->input->post('id_wasit');
		$this->db->from('data_wasit');
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}

	function get_data_lapangan($data)
	{
		$id_lapangan = $this->input->post('id_lapangan');
		$this->db->from('master_lapangan AS A');
		$this->db->join("data_event AS B", "A.id_event = B.id_event", 'left');
		// if ($data['id_event']) $this->db->where('A.id_event', $data['id_event']);
		// if ($data['aktif'] >= 0)		 $this->db->where('A.aktif', $data['aktif']);
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}
}
//DONIE EEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE