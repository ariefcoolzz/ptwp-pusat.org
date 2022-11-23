<?php
class Model_main extends CI_Model
{

	
	function model_master_lapangan()
	{
		$this->db->select("A.");
		$this->db->from('master_lapangan AS A');
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}

	function register_get_pegawai($nip)
	{
		$this->db->select("A.nama");
		$this->db->select("A.NomorHandphone");
		$this->db->select("A.id_satker_parent");
		$this->db->from('data_pegawai_all AS A');
		$this->db->where('A.nip', $nip);
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}

	function register_simpan($R)
	{
		// PRINT_R($R);DIE();
		unset($R['password_confirm']);

		if (!isset($R['id_user'])) {
			$R['aktif'] = 0;
			$R['date_created'] = DATE('Y-m-d H:i:s');
			$status = $this->db->insert('data_user', $R);
			// DIE($this->db->last_query());
			return $status;
		} else {
			$R['date_updated'] = DATE('Y-m-d H:i:s');
			$this->db->where("id_user", $R['id_user']);
			$status = $this->db->update('data_user', $R);
			// DIE($this->db->last_query());
			return $status;
		}
	}
	function log_data_konten($id)
	{
		$data['id_konten'] 		= $id;
		$data['waktu_akses']	= date('Y-m-d H:i:s');
		$data['ip_address']		= $this->input->ip_address();
		$data['user_agent']		= substr($this->input->user_agent(), 0, 120);
		if (isset($_SERVER['HTTP_REFERER'])) $data['referal']		= $_SERVER['HTTP_REFERER'];

		$this->db->insert('data_statistik_konten', $data);
		// die($this->db->last_query());
	}
	function get_data_konten($alias)
	{
		$this->db->select("A.*");
		$this->db->select("B.nama as nama_creator");
		$this->db->select("(SELECT COUNT(*) FROM data_statistik_konten WHERE id_konten = A.id) as total_dilihat");
		$this->db->from('data_konten AS A');
		$this->db->join("view_user AS B", "A.user_created = B.id_user", 'left');
		$this->db->where('A.alias', $alias);
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	function get_data_konten_list($cat_id, $limit = null)
	{
		$this->db->select("A.*");
		$this->db->select("B.nama as nama_creator");
		$this->db->select("C.NamaSatker as nama_satker");
		$this->db->select("(SELECT COUNT(*) FROM data_statistik_konten WHERE id_konten = A.id) as total_dilihat");
		$this->db->from('data_konten AS A');
		$this->db->join("view_user AS B", "A.user_created = B.id_user", 'left');
		$this->db->join("tmst_satker AS C", "B.id_kontingen = C.IdSatker", 'left');
		$this->db->where('A.cat_id', $cat_id);
		$this->db->where('A.is_publish', '1');
		$this->db->order_by('A.date_created DESC');
		if ($limit) $this->db->limit($limit);
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}
	function get_data_pengumuman($limit = null)
	{
		$this->db->select("A.*");
		$this->db->select("B.nama as nama_creator");
		$this->db->select("C.NamaSatker as nama_satker");
		$this->db->select("(SELECT COUNT(*) FROM data_statistik_konten WHERE id_konten = A.id) as total_dilihat");
		$this->db->from('data_konten AS A');
		$this->db->join("view_user AS B", "A.user_created = B.id_user", 'left');
		$this->db->join("tmst_satker AS C", "B.id_kontingen = C.IdSatker", 'left');
		$this->db->where('A.is_pengumuman', '1');
		$this->db->where('A.is_publish', '1');
		$this->db->order_by('A.date_updated DESC');
		if ($limit) $this->db->limit($limit);
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
	}
	function model_select_pool($id_kategori = false)
	{
		$this->db->distinct();
		$this->db->select("A.pool");
		$this->db->from('data_babak_penyisihan AS A');
		if ($id_kategori) $this->db->where('A.id_kategori', $id_kategori);
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
		if ($id_kategori) $this->db->where('B.id_kategori', $id_kategori);
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

	function model_data_babak_penyisihan($id_kategori, $pool)
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
		$this->db->join('master_lapangan AS C', 'A.id_lapangan=C.id_lapangan', 'left');
		$this->db->where("MD7(A.id_kategori)", $id_kategori);
		if ($pool != MD7('0')) $this->db->where("MD7(A.pool)", $pool);
		$this->db->order_by("A.id_kategori", "ASC");
		$this->db->order_by("A.pool", "ASC");
		$this->db->order_by("A.urutan", "ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}

	function model_data_babak_penyisihan_get_score($id_kategori, $pool, $id_tim_A, $id_tim_B, $tim)
	{
		$this->db->select("B.set1_tim_A AS score");
		$this->db->from('data_babak_penyisihan AS A');
		$this->db->join('data_babak_penyisihan_detail AS B', 'A.id_kategori=B.id_kategori AND A.pool=B.pool AND A.urutan=B.urutan', 'inner');
		$this->db->where("A.id_kategori", $id_kategori);
		$this->db->where("A.pool", $pool);
		$this->db->where("(A.id_tim_A = '$id_tim_A' AND B.id_tim_B = '$id_tim_B')");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query->row_array()['score'];
	}

	function model_data_babak_final($id_kategori = false, $per = false)
	{
		$this->db->select("A.*");
		$this->db->select("B.lapangan");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1),IF(id_pemain2 IS NULL,'',CONCAT('<br>',NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_A) AS nama_tim_A");
		$this->db->select("(SELECT CONCAT(NAMA_PEMAIN(id_pemain1),IF(id_pemain2 IS NULL,'',CONCAT('<br>',NAMA_PEMAIN(id_pemain2)))) FROM data_tim WHERE id_tim = A.id_tim_B) AS nama_tim_B");
		$this->db->from('data_babak_final AS A');
		$this->db->join('master_lapangan AS B', 'A.id_lapangan=B.id_lapangan', 'left');
		if ($id_kategori) $this->db->where('MD7(A.id_kategori)', $id_kategori);
		if ($per) $this->db->where('MD7(A.per)', $per);
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
		$this->db->join('master_lapangan AS B', 'A.id_lapangan=B.id_lapangan', 'left');
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
		$this->db->join('master_lapangan AS B', 'A.id_lapangan=B.id_lapangan', 'left');
		$this->db->order_by("A.tanggal", "ASC");
		$this->db->order_by("A.waktu", "ASC");
		$this->db->order_by("A.id_lapangan", "ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	function get_count_statistik()
	{
		$q = $this->db->query("
		SELECT COUNT(DISTINCT(ip_address)) AS today 
		FROM data_statistik_konten
		WHERE DATE(waktu_akses) = CURDATE()
		")->row_array();
		$data['today'] = $q['today'];

		$q = $this->db->query("
		SELECT COUNT(DISTINCT(ip_address)) as minggu
		FROM   data_statistik_konten
		WHERE  YEARWEEK(`waktu_akses`, 1) = YEARWEEK(CURDATE(), 1)
		")->row_array();
		$data['minggu'] = $q['minggu'];

		$q = $this->db->query("
		SELECT COUNT(DISTINCT(ip_address)) AS bulan
		FROM data_statistik_konten
		WHERE MONTH(waktu_akses) = MONTH(CURRENT_DATE())
		AND YEAR(waktu_akses) = YEAR(CURRENT_DATE())
		")->row_array();
		$data['bulan'] = $q['bulan'];

		$q = $this->db->query("
		SELECT COUNT(DISTINCT(ip_address)) AS tahun
		FROM data_statistik_konten
		WHERE YEAR(waktu_akses) = YEAR(CURRENT_DATE())
		")->row_array();
		$data['tahun'] = $q['tahun'];

		$q = $this->db->query("
		SELECT COUNT(DISTINCT(ip_address)) AS total
		FROM data_statistik_konten
		")->row_array();
		$data['total_all'] = $q['total'];
		return $data;
	}


	//DIKA AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
	function model_data_link_streaming()
	{
		$this->db->select("A.*");
		$this->db->from('data_link_streaming AS A');
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}

	function model_data_live_streaming()
	{
		$this->db->select("A.*");
		$this->db->select("NAMA_SATKER_SINGKAT(A.id_kontingen_tim_A) AS nama_kontingen_tim_A");
		$this->db->select("NAMA_SATKER_SINGKAT(A.id_kontingen_tim_B) AS nama_kontingen_tim_B");
		$this->db->from('data_babak_penyisihan AS A');
		$this->db->where('A.id_event', 2); //manualiin dulu
		$this->db->where('A.id_lapangan IN (25,26,27,28,29,30)'); //manualiin dulu

		$this->db->order_by("A.beregu", "ASC");
		$this->db->order_by("A.pool", "ASC");
		$this->db->order_by("A.urutan", "ASC");
		$this->db->order_by("A.id_kategori", "ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}

	function model_data_live_streaming_all_score($beregu)
	{
		$this->db->select("A.*");
		$this->db->select("NAMA_SATKER_SINGKAT(A.id_kontingen_tim_A) AS nama_kontingen_tim_A");
		$this->db->select("NAMA_SATKER_SINGKAT(A.id_kontingen_tim_B) AS nama_kontingen_tim_B");
		$this->db->from('data_babak_penyisihan AS A');
		$this->db->where('A.id_event', '2');
		$this->db->where('A.beregu', $beregu);
		$this->db->where('A.set1_tim_A IS NOT NULL');
		$this->db->where('A.set1_tim_B IS NOT NULL');
		$this->db->order_by("A.id_event", "ASC");
		$this->db->order_by("A.beregu", "ASC");
		$this->db->order_by("A.pool", "ASC");
		$this->db->order_by("A.urutan", "ASC");
		$this->db->order_by("A.id_kategori", "ASC");
		$query = $this->db->get();
		// DIE($this->db->last_query());
		return $query;
	}
	//DIKA AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA

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
	function model_rule($id_event, $field = NULL)
	{
		IF($field == NULL) $this->db->select('A.*'); ELSE $this->db->select('A.'.$field);
		$this->db->from('rule AS A');
		$this->db->where('A.id_event', $id_event);
		$query = $this->db->get();
		// die($this->db->last_query());
		IF($field == NULL) return $query; ELSE return $query->row_array()[$field];
	}
	function list_kategori_pemain($P)
	{
		$this->db->from('master_kategori_pemain AS A');
		$this->db->where('A.beregu', $P['beregu']);
		$this->db->order_by('A.urutan');
		$query = $this->db->get();
		// die($this->db->last_query());
		return $query;
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
	function model_data_skema($P)
	{
		$this->db->select('A.*');
		$this->db->select('NAMA_SATKER_SINGKAT(A.id_kontingen_tim_A) AS satker_A');
		$this->db->select('NAMA_SATKER_SINGKAT(A.id_kontingen_tim_B) AS satker_B');
		$this->db->from('data_skema AS A');
		$this->db->where('A.id_event', $P['id_event']);
		$this->db->where('A.beregu', $P['beregu']);
		$query = $this->db->get();
		return $query;
	}

}
