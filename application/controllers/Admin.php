<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// $this->basic->squrity();
	}

	public function index()
	{
		$data['judul'] = "Halaman Admin";
		$this->template->load('admin_template', 'admin/home', $data);
	}
}
