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
		$this->template->load('ptwp_template', 'main/home', $data);
	}

	public function sejarah()
	{
		$data['judul'] = "Sejarah";
		$this->template->load('ptwp_template', 'main/sejarah', $data);
	}

	public function data_pemain()
	{
		$data['judul'] = "DATA PEMAIN";
		$this->template->load('ptwp_template', 'main/data_pemain', $data);
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

	public function kontak()
	{
		$data['judul'] = "Kontak";
		$this->template->load('ptwp_template', 'main/kontak', $data);
	}
}
