<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Coba extends CI_Controller
{

	public function index()
	{
		$data['judul'] = "Halaman Login";
		$this->template->load('ptwp_template', 'admin/login_v', $data);
	}

	public function pass_coba()
	{
		$pass = MD7('admin');
		echo $pass."<br>";
		$q = $this->basic->processLogin('admin', MD7('admin'));
		print_r($q->result_array());
	}
	public function sessi()
	{
		echo "<pre>";
		// extract($_POST);
		print_r($_POST);
		
	}
}
