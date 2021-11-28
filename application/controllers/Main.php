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

	public function pertandingan()
	{
		$data['judul'] = "Pertandingan";
		$this->template->load('ptwp_template', 'main/pertandingan', $data);
	}

	public function pengurus()
	{
		$data['judul'] = "Pengurus";
		$this->template->load('ptwp_template', 'main/pengurus', $data);
	}

	public function livescore()
	{
		$data['judul'] = "Livescore";
		$this->template->load('ptwp_template', 'main/livescore', $data);
	}
}
