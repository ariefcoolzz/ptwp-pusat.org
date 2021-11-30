<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Admin extends CI_Controller
	{
		
		public function __construct()
		{
			parent::__construct();
			$this->basic->squrity();
		}
		
		public function index()
		{
			$data['judul'] = "Halaman Admin";
			$this->template->load('admin_template', 'admin/home', $data);
		}
		public function menu()
		{
			$menu= $this->input->post('menu');
			if(!ISSET($menu)) $this->template->load('admin_template', 'admin/404', $data);
			redirect('admin/'.$menu);
			
		}
		public function data_konten()
		{
			$data['judul'] = "DATA MENU KONTEN";
			$data['cat_id'] = 0;
			$where = array('cat_id'=>0);
			$data['list_konten'] = $this->basic->get_data_where($where,'data_konten');
			OB_START();
			$this->load->view("admin/data_konten", $data);
			$konten_menu = ob_get_clean();
			echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
			
		}
		public function data_berita()
		{
			$data['judul'] = "DATA MENU BERITA";
			$data['cat_id'] = 1;
			$where = array('cat_id'=>1);
			$data['list_konten'] = $this->basic->get_data_where($where,'data_konten');
			OB_START();
			$this->load->view("admin/data_konten", $data);
			$konten_menu = ob_get_clean();
			echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
			
		}
		public function form_data_konten()
		{
			
			$id_konten = $this->input->post('id_konten');
			$cat_id = $this->input->post('cat_id');
			
			$data['id'] = $id_konten;
			$data['cat_id'] = $cat_id;
			$data['isi'] = '';
			$data['judul'] = '';
			$data['img'] = '';
			$data['alias'] = '';
			$data['title'] = "FORM TAMBAH KONTEN";
			if(!empty($id_konten)){
				$q = $this->basic->get_data_where(array('id'=>$id_konten),'data_konten')->row_array();
				$data = $q;
				$data['title'] = "UBAH KONTEN";
				// echo "<pre>";
				// print_r($data);die;
			}	
			OB_START();
			$this->load->view("admin/form_data_konten", $data);
			$konten_menu = ob_get_clean();
			echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
			
		}
		public function form_data_konten_simpan()
		{
			$id = $this->input->post('id');
			$data['judul'] = $this->input->post('judul');
			$data['cat_id'] = $this->input->post('cat_id');
			$data['alias'] = $this->input->post('alias');
			$data['img'] = $this->input->post('img');
			$data['isi'] = $this->input->post('isi_konten');
			
			// echo "<pre>";
				// print_r($_POST);die;
			if($id > 0){
				$data['date_updated'] = date('Y-m-d H:i:s');
				$where = array ('id' => $id);
				$res = $this->basic->update_data($where,'data_konten',$data);
			}
			else{
				$data['user_created'] = $this->session->userdata('id');
				$data['date_created'] = date('Y-m-d H:i:s');
				$res = $this->basic->insert_data('data_konten',$data);
			}
			if($res){
				$this->session->set_flashdata('msg', '<div class="alert alert-success"> Data Berhasil Disimpan.</div>');
			}
			else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger"> Data Gagal Disimpan.</div>');
			}
			redirect('admin/data_konten');
		}
	}
