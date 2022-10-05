<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_main');
		// $this->sesi = '28';
		// $this->hari = '3';
		// $this->basic->squrity();
	}

	public function register_get_pegawai()
	{
		// DIE($_POST['nip']);
		$data = $this->Model_main->register_get_pegawai($_POST['nip']);
		// echo ($data->num_rows());
		if ($data->num_rows()) {
			$R = $data->row_array();
			echo JSON_ENCODE(array("nama" => $R['nama'], "no_wa" => $R['NomorHandphone'], "id_satker_parent" => $R['id_satker_parent']));
		}
	}


	public function register()
	{
		$data['judul'] = "Halaman Register";
		$this->template->load('ptwp_template', 'main/register', $data);
	}

	public function register_simpan()
	{
		//VALIDASI 
		$pesan = "";
		EXTRACT($_POST);
		// if ($nip == "") 					$pesan .= "Maaf... Nip Tidak Valid Harus Diisi<br>";
		if ($nama == "") 				$pesan .= "Maaf... Nama Harus Diisi<br>";
		if ($no_wa == "") 					$pesan .= "Maaf... No Whatsapp Harus Diisi<br>";
		if ($id_panitia == "") 	$pesan .= "Maaf... Jenis Panitia Harus Dipilih<br>";
		if ($id_satker_parent == "") 			$pesan .= "Maaf... Wilayah Pengurus Daerah Harus Dipilih<br>";
		// if ($file_upload == "") 			$pesan .= "Maaf... Dokumen Pendukung Belum Diupload<br>";
		if ($username == "") 				$pesan .= "Maaf... Username Harus Diisi<br>";
		if ($password == "") 				$pesan .= "Maaf... Password Harus Diisi<br>";
		if ($password_confirm == "") 				$pesan .= "Maaf... Konfirmasi Password Harus Diisi<br>";

		if ($pesan != "") die(JSON_ENCODE(array("status" => FALSE, "pesan" => $pesan)));
		//VALIDASI
		// echo '<pre>';
		// print_r($_POST);
		// echo '</pre>';
		// die();
		//FILE UPLOAD
		$status = FALSE;
		$config = array(
			'upload_path'			=> './file_upload/dokumen',
			'allowed_types'			=> 'pdf',
			'max_size'				=> 2048,
			'overwrite'				=> true,
			'file_name'				=> MD7($_POST['id_satker_parent']) . ".pdf"
		);
		$this->load->library('upload', $config);
		if (!empty($_FILES['file_upload']['name'])) {
			if (!$this->upload->do_upload('file_upload')) {
				$msg = $this->upload->display_errors();
				die(JSON_ENCODE(array("status" => FALSE, "pesan" => $msg)));
			}
		}
		// die();
		
		if ($_POST['password'] === $_POST['password_confirm']) {
			$status = $this->Model_main->register_simpan($_POST);
		}
		echo JSON_ENCODE(array("status" => $status));
	}


	public function index()
	{
		$data['judul'] = "Persatuan Tenis Warga Peradilan (PTWP) Pusat";
		$data['berita_pusat'] = $this->Model_main->get_data_konten_list('1', '3'); // KATEGORI 1 LIMIT 3
		$data['berita_daerah'] = $this->Model_main->get_data_konten_list('3', '3'); // KATEGORI 1 LIMIT 3
		// $data['berita_terbaru'] = $this->basic->get_data_where_limit(array('cat_id' => '1'), 3, 'data_konten');
		$this->template->load('ptwp_template', 'main/home', $data);
	}

	public function page($konten = false)
	{
		if (!$konten) {
			$data['judul'] = "NOT FOUND";
			$this->template->load('ptwp_template', 'main/404', $data);
		}
		// $q = $this->basic->get_data_where(array('alias' => $konten), 'data_konten')->row_array();
		$q = $this->Model_main->get_data_konten($konten)->row_array();
		if (!empty($q)) {
			$this->Model_main->log_data_konten($q['id']);
			$data['judul'] = $q['judul'];
			$data['konten'] = $q;
		} else {
			$data['judul'] = $konten;
			$data['konten']['isi'] = '<h1 class="tx-color-01 tx-24 tx-sm-32 tx-lg-36 mg-xl-b-5">Halaman Belum Tersedia</h1>';
		}

		$this->template->load('ptwp_template', 'main/page', $data);
	}

	public function berita_ptwp_pusat()
	{
		$data['judul'] = "Berita PTWP Pusat";
		$data['list_berita'] = $this->Model_main->get_data_konten_list('1'); // KATEGORI 1
		// $data['berita_ptwp_pusat'] = $this->basic->get_data_where(array('cat_id' => '1'), 'data_konten');
		$this->template->load('ptwp_template', 'main/berita_ptwp_pusat', $data);
	}
	public function berita_ptwp_daerah()
	{
		$data['judul'] = "Berita PTWP Daerah";
		$data['list_berita'] = $this->Model_main->get_data_konten_list('3'); // KATEGORI 3 DAERAH
		// $data['berita_ptwp_pusat'] = $this->basic->get_data_where(array('cat_id' => '1'), 'data_konten');
		$this->template->load('ptwp_template', 'main/berita_ptwp_pusat', $data);
	}


	public function data_pemain()
	{
		$data['judul'] = "DATA PEMAIN";
		$this->template->load('ptwp_template', 'main/data_pemain', $data);
	}

	public function data_penyisihan()
	{
		$data['judul'] = "DATA PENYISIHAN TURNAMEN PERTANDINGAN";
		$this->template->load('ptwp_template', 'main/data_penyisihan', $data);
	}
	public function data_pertandingan()
	{
		$data['judul'] = "DATA PERTANDINGAN";
		$this->template->load('ptwp_template', 'main/data_pertandingan', $data);
	}

	public function data_pertandingan_point()
	{
		if (!isset($_POST['id_data_point'])) die("Maaf... Anda Tidak Dapat Mengakses Halaman Ini... !!!");
		$data['id_data_point'] = $_POST['id_data_point'];

		OB_START();
		$this->load->view('main/data_pertandingan_point', $data);
		$konten = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten" => $konten));
	}

	public function data_babak_penyisihan()
	{
		$data['judul'] = "Babak Penyisihan";
		$this->template->load('ptwp_template', 'main/data_babak_penyisihan', $data);
	}

	public function data_babak_penyisihan_rekap()
	{
		OB_START();
		$this->load->view('main/data_babak_penyisihan_rekap');
		$konten = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten" => $konten));
	}


	public function data_babak_final($per)
	{
		$data['judul'] 	= "Babak Perdelapan Final";
		$data['per']	= $per;
		$this->template->load('ptwp_template', 'main/data_babak_final', $data);
	}

	public function data_babak_final_rekap()
	{
		OB_START();
		$this->load->view('main/data_babak_final_rekap');
		$konten = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten" => $konten));
	}

	public function data_skema_pertandingan()
	{
		$data['judul'] 	= "Skema Pertandingan";
		$this->template->load('ptwp_template', 'main/data_skema_pertandingan', $data);
	}

	public function data_skema_pertandingan_rekap()
	{
		OB_START();
		$this->load->view('main/data_skema_pertandingan_rekap');
		$konten = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten" => $konten));
	}

	public function data_jadwal_pertandingan()
	{
		$data['judul'] 	= "Jadwal Pertandingan";
		$this->template->load('ptwp_template', 'main/data_jadwal_pertandingan', $data);
	}

	public function data_penyisihan_file()
	{
		$data['judul'] = "DATA PENYISIHAN";
		$this->template->load('ptwp_template', 'main/data_pennyisihan_statis', $data);
	}
}
