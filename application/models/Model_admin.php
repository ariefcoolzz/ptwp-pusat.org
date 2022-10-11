<?php
class Model_admin extends CI_Model
{
	function model_get_data_id_nama($keyword = NULL)
	{
		$this->db->select("A.id_pegawai AS id");
		// $this->db->select("CONCAT(\"<span><img sytle='display: inline-block;' class='rounded-circle ht-40 wd-50 pd-x-5' src='//images.weserv.nl/?url=https://sikep.mahkamahagung.go.id/uploads/foto_pegawai/\",A.FotoPegawai,\"&w=200'>\",A.nama,' [',A.nip,']</span>') AS text");
		$this->db->select("CONCAT(\"<div class='media'><img class='img-thumbnail ht-90 wd-75 mg-r-10' src='//images.weserv.nl/?url=https://sikep.mahkamahagung.go.id/uploads/foto_pegawai/\",A.FotoPegawai,\"&w=200'>\",A.nama,' <br>',A.nip,' <br>',A.nama_satker,' <br>',NAMA_SATKER('$_SESSION[id_kontingen]'),'</div>') AS text");
		$this->db->from("data_pegawai_all AS A");
		$this->db->where("(A.nama_gelar LIKE '%$keyword%' OR A.nip LIKE '%$keyword%')");
		if (IN_ARRAY($_SESSION['id_panitia'], array(2, 3))) $this->db->where("(A.id_satker = '$_SESSION[id_kontingen]' OR  A.id_satker_parent = '$_SESSION[id_kontingen]')");
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
		$this->db->select("CONCAT(\"<div class='media'><img class='img-thumbnail ht-90 wd-75 mg-r-10' src='//images.weserv.nl/?url=https://sikep.mahkamahagung.go.id/uploads/foto_pegawai/xxx.jpg&w=200'>\",B.NamaAnggotaKeluarga,' Istri dari ', A.nama,' (Dharmayukti)</div>') AS text");
		$this->db->from("data_pegawai_all AS A");
		$this->db->join("tmst_keluarga AS B", "A.id_pegawai = B.IdPegawai AND B.JenisHubunganKeluarga = '9'", "LEFT");
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
	function score_manage()
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


	//PUTRA AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
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
	function get_data_pemain($id_kontingen, $jenis_kelamin = false, $is_official = false)
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
		if ($is_official) $this->db->where('A.is_official', '1');
		else $this->db->where('A.is_official', '0');
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
		IFNULL(B.total_putri_sudah,'0') AS total_putri_sudah
		FROM tmst_satker AS A
		LEFT JOIN 
		(SELECT V.`id_kontingen` AS id_kontingen,
		SUM(CASE WHEN V.`is_verifikasi` = '0' AND V.`is_official` = '1' THEN 1 ELSE 0 END) AS total_official_blm,
		SUM(CASE WHEN V.`is_verifikasi` = '1' AND V.`is_official` = '1' THEN 1 ELSE 0 END) AS total_official_sudah,
		SUM(CASE WHEN V.`is_verifikasi` = '0' AND V.`is_official` = '0' AND V.`jenis_kelamin` = 'PRIA'  AND  V.`is_dharmayukti` = '0' THEN 1 ELSE 0 END) AS total_putra_blm,
		SUM(CASE WHEN V.`is_verifikasi` = '1' AND V.`is_official` = '0' AND V.`jenis_kelamin` = 'PRIA'  AND  V.`is_dharmayukti` = '0' THEN 1 ELSE 0 END) AS total_putra_sudah,
		SUM(CASE WHEN V.`is_verifikasi` = '0' AND V.`is_official` = '0' AND (V.`jenis_kelamin` = 'WANITA' OR V.`is_dharmayukti` = '1') THEN 1 ELSE 0 END) AS total_putri_blm,
		SUM(CASE WHEN V.`is_verifikasi` = '1' AND V.`is_official` = '0' AND (V.`jenis_kelamin` = 'WANITA' OR V.`is_dharmayukti` = '1') THEN 1 ELSE 0 END) AS total_putri_sudah
		FROM
		view_pemain AS V
		WHERE V.`id_event` = '2'
		GROUP BY id_kontingen) 
		AS B ON A.IdSatker = B.id_kontingen
		WHERE (IdSatker = 920 OR LevelSatker = 2) AND IsAktif = 'Y'
		ORDER BY UrutanTingkatBanding ASC");
		// die($this->db->last_query());
		return $query;
	}
	function get_data_kontingen($id_kontingen)
	{
		$query = $this->db->query("SELECT NAMA_SATKER('$id_kontingen') as nama_kontingen")->row_array();
		// die($this->db->last_query());
		return $query['nama_kontingen'];
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
		$this->db->from('master_lapangan');
		// if ($data['id_event']) $this->db->where('A.id_event', $data['id_event']);
		// if ($data['aktif'] >= 0)		 $this->db->where('A.aktif', $data['aktif']);
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}
}
//DONIE EEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE