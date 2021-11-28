<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Main extends CI_Controller
	{
		
		public function __construct()
		{
			parent::__construct();
			// $this->sesi = '28';
			// $this->hari = '3';
			// $this->basic->squrity();
		}
		
		public function index()
		{
			$data['judul'] = "Persatuan Tenis Warga Peradilan (PTWP) Pusat";
			$this->template->load('ptwp_template', 'main/home', $data);
		}
	}
