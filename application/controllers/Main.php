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
		
		public function data_pemain()
		{
			$this->template->load('ptwp_template', 'main/data_pemain');
		}
		
		public function data_pertandingan()
		{
			$this->template->load('ptwp_template', 'main/data_pertandingan');
		}
		
		public function data_pertandingan_point()
		{
			IF(!ISSET($_POST['id_data_point'])) DIE("Maaf... Anda Tidak Dapat Mengakses Halaman Ini... !!!");
			$data['id_data_point'] = $_POST['id_data_point'];
			
			OB_START();
			$this->load->view('main/data_pertandingan_point', $data);
			$konten = ob_get_clean();
			echo JSON_ENCODE(array("status" => TRUE, "konten" => $konten));
		}
	}
