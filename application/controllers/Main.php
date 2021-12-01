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

	public function index()
	{
		$data['judul'] = "Persatuan Tenis Warga Peradilan (PTWP) Pusat";
		$data['berita_terbaru'] = $this->basic->get_data_where(array('cat_id'=>'1'),'data_konten');
		$this->template->load('ptwp_template', 'main/home', $data);
	}

	public function page($konten=false)
	{
		if(!$konten){
			$data['judul'] = "NOT FOUND";
			$this->template->load('ptwp_template', 'main/404', $data);
		}
		$q = $this->basic->get_data_where(array('alias'=>$konten),'data_konten')->row_array();
		if(!empty($q)){
			$data['judul'] = $q['judul'];
			$data['konten'] = $q;
		}
		else{
			$data['judul'] = $konten;
			$data['konten']['isi'] = '<h1 class="tx-color-01 tx-24 tx-sm-32 tx-lg-36 mg-xl-b-5">Halaman Belum Tersedia</h1>';
		}
		
		$this->template->load('ptwp_template', 'main/page', $data);
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
	
	public function data_penyisihan_file( )
	{
		$data['judul'] = "DATA PENYISIHAN";
		$this->template->load('ptwp_template', 'main/data_pennyisihan_statis', $data);
	}
}
