<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_main');
		$this->load->model('Model_admin');
		$this->basic->squrity();
	}

	public function index()
	{
		$data['judul'] = "Halaman Admin";
		$this->template->load('admin_template', 'admin/home', $data);
	}
	public function menu()
	{
		$menu = $this->input->post('menu');
		// if (!isset($menu)) $this->template->load('admin_template', 'admin/404', $data);
		redirect('admin/' . $menu);
	}
	public function data_konten()
	{
		$data['judul'] = "DATA MENU KONTEN";
		$data['cat_id'] = 0;
		$where = array('cat_id' => 0);
		$data['list_konten'] = $this->basic->get_data_where($where, 'data_konten');
		OB_START();
		$this->load->view("admin/data_konten", $data);
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function data_berita()
	{
		$data['judul'] = "DATA MENU BERITA";
		$data['cat_id'] = 1;
		$where = array('cat_id' => 1);
		$data['list_konten'] = $this->basic->get_data_where($where, 'data_konten');
		OB_START();
		$this->load->view("admin/data_konten", $data);
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function data_pemain()
	{
		$data['judul'] = "DATA MENU PEMAIN";
		$data['list_pemain'] = $this->basic->get_data('view_pemain');
		OB_START();
		$this->load->view("admin/data_pemain", $data);
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function data_tim()
	{
		$data['judul'] = "DATA TIM PEMAIN";
		$data['kategori'] = $this->basic->get_data('master_kategori_pemain');
		OB_START();
		$this->load->view("admin/data_tim", $data);
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function data_babak_penyisihan()
	{
		$data['judul'] = "DATA POOL BABAK PENYISIHAN";
		$data['kategori'] = $this->basic->get_data('master_kategori_pemain');
		OB_START();
		$this->load->view("admin/data_babak_penyisihan", $data);
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function data_turnamen()
	{
		$data['judul'] = "DATA TURNAMEN";
		$data['kategori'] = $this->basic->get_data('master_kategori_pemain');
		OB_START();
		$this->load->view("admin/data_turnamen", $data);
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
		if (!empty($id_konten)) {
			$q = $this->basic->get_data_where(array('id' => $id_konten), 'data_konten')->row_array();
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
	public function form_data_pemain()
	{

		$id_pemain = $this->input->post('id_pemain');

		$data['id_pemain'] = $id_pemain;
		$data['nama'] = '';
		$data['satker'] = '';
		$data['foto_profil'] = '';
		$data['title'] = "FORM TAMBAH PEMAIN";
		if (!empty($id_pemain)) {
			$q = $this->basic->get_data_where(array('id_pemain' => $id_pemain), 'data_pemain')->row_array();
			$data = $q;
			$data['title'] = "UBAH PEMAIN";
			// echo "<pre>";
			// print_r($data);die;
		}
		OB_START();
		$this->load->view("admin/form_data_pemain", $data);
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function form_data_tim()
	{
		$data['title'] = "FORM TAMBAH POOL";

		$id_tim = $this->input->post('id_tim');

		$data['id_tim'] = $id_tim;

		$data['kategori'] = $this->basic->get_data('master_kategori_pemain');
		OB_START();
		$this->load->view("admin/form_data_tim", $data);
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function form_data_pool()
	{
		$data['title'] = "FORM TAMBAH POOL";

		$id_tim_A = $this->input->post('id_tim_A');
		$id_tim_B = $this->input->post('id_tim_B');

		$data['id_tim_A'] = $id_tim_A;
		$data['id_tim_B'] = $id_tim_B;
		$data['kategori'] = $this->basic->get_data('master_kategori_pemain');
		OB_START();
		$this->load->view("admin/form_data_pool", $data);
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function form_data_turnamen_tambah()
	{
		$data['title'] = "FORM TAMBAH DATA TURNAMEN";

		$id_tim_A = $this->input->post('id_tim_A');
		$id_tim_B = $this->input->post('id_tim_B');

		$data['id_tim_A'] = $id_tim_A;
		$data['id_tim_B'] = $id_tim_B;
		$data['kategori'] = $this->basic->get_data('master_kategori_pemain');
		$this->db->order_by("id_babak DESC");
		$data['kategori_babak'] = $this->basic->get_data('master_kategori_babak');
		OB_START();
		$this->load->view("admin/form_data_turnamen_tambah", $data);
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function form_nilai()
	{

		$id_tim_A = $this->input->post('id_tim_A');
		$id_tim_B = $this->input->post('id_tim_B');

		$data = $this->Model_admin->get_tim_byId($id_tim_A, $id_tim_B);
		OB_START();
		$this->load->view("admin/form_nilai", $data);
		// echo "<pre>";
		// print_r($data);
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function form_nilai_turnamen()
	{
		$set = $this->input->post('set');
		$id_tim_A = $this->input->post('id_tim_A');
		$id_tim_B = $this->input->post('id_tim_B');

		$data = $this->Model_admin->get_turnamen_byId($id_tim_A, $id_tim_B);
		$data['set'] = $set;
		OB_START();
		$this->load->view("admin/form_nilai_turnamen", $data);
		// echo "<pre>";
		// print_r($data);
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
		if ($id > 0) {
			$data['date_updated'] = date('Y-m-d H:i:s');
			$where = array('id' => $id);
			$res = $this->basic->update_data($where, 'data_konten', $data);
		} else {
			$data['user_created'] = $this->session->userdata('id');
			$data['date_created'] = date('Y-m-d H:i:s');
			$res = $this->basic->insert_data('data_konten', $data);
		}
		if ($res) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success"> Data Berhasil Disimpan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"> Data Gagal Disimpan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
		}
		if ($data['cat_id'] == 0) {
			redirect('admin/data_konten');
		} else {
			redirect('admin/data_berita');
		}
	}
	public function form_data_pemain_simpan()
	{
		// echo "<pre>";
		// print_r($_FILES);die;
		//FILE UPLOAD
		// $path_parts = pathinfo($_FILES["file_upload"]["name"]);
		// $extension = $path_parts['extension'];
		// echo $extension; die;
		$id_pemain = $this->input->post('id_pemain');
		$data['nama'] = $this->input->post('nama');
		$data['satker'] = $this->input->post('satker');
		$nama_file = '';
		if ($id_pemain > 0) {
			$data['date_updated'] = date('Y-m-d H:i:s');
			$where = array('id_pemain' => $id_pemain);
			$res = $this->basic->update_data($where, 'data_pemain', $data);
		} else {
			$data['user_created'] = $this->session->userdata('id');
			$data['date_created'] = date('Y-m-d H:i:s');
			$res = $this->basic->insert_data('data_pemain', $data);
			$id_pemain = $this->db->insert_id();
		}
		if ($res) {
			if (!empty($_FILES['file_upload']['name'])) {
				$path_parts = pathinfo($_FILES["file_upload"]["name"]);
				$extension = $path_parts['extension'];
				$nama_file = $id_pemain . '.' . $extension;
				$config = array(
					'upload_path'			=> './assets/profil',
					'allowed_types'			=> 'gif|jpg|png|jpeg',
					'max_size'				=> 5000,
					'overwrite'				=> true,
					'file_name'				=> $nama_file
				);
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('file_upload')) {
					$msg = $this->upload->display_errors();
					$this->session->set_flashdata('msg', '<div class="alert alert-danger">' . $msg . '</div>');
					redirect('admin/data_pemain');
				} else {
					$update['foto_profil'] = $nama_file;
					$where = array('id_pemain' => $id_pemain);
					$res = $this->basic->update_data($where, 'data_pemain', $update);
				}
			}
			$this->session->set_flashdata('msg', '<div class="alert alert-success"> Data Berhasil Disimpan.</div>');
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"> Data Gagal Disimpan.</div>');
		}
		redirect('admin/data_pemain');
	}
	public function hapus_data_konten()
	{
		$id_konten = $this->input->post('id_konten');
		$cat_id = $this->input->post('cat_id');
		$where = array('MD7(id)' => $id_konten);
		$status = $this->basic->delete_data($where, 'data_konten');
		// $file = 'file_upload/data_tpm_aps/'.MD7($_POST['nip']).'.pdf';
		// if(file_exists($file)){
		// unlink($file);
		// }
		// echo JSON_ENCODE(array("status" => $status));
		if ($status) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success"> Data Berhasil Dihapus.</div>');
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"> Data Gagal Dihapus.</div>');
		}
		if ($cat_id == 0) {
			redirect('admin/data_konten');
		} else {
			redirect('admin/data_berita');
		}
	}
	public function get_nama_tim_turnamen()
	{
		$kategori = $this->input->post('kategori');
		$tim = $this->input->post('tim');
		if ($tim == "A") $data = $this->Model_admin->get_tim_A_free($kategori, false);
		if ($tim == "B") $data = $this->Model_admin->get_tim_B_free($kategori, false);
		OB_START();
		echo '<option value="">--PILIH TIM--</option>';
		foreach ($data->result_array() as $d) {
			echo '<option value="' . $d['id_tim'] . '">' . $d['nama_pasangan'] . '</option>';
		}
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function get_nama_tim()
	{
		$kategori = $this->input->post('kategori');
		$tim = $this->input->post('tim');
		if ($tim == "A") $data = $this->Model_admin->get_tim_A($kategori);
		if ($tim == "B") $data = $this->Model_admin->get_tim_B($kategori);
		OB_START();
		echo '<option value="">--PILIH TIM--</option>';
		foreach ($data->result_array() as $d) {
			echo '<option value="' . $d['id_tim'] . '">' . $d['nama_pasangan'] . '</option>';
		}
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function get_nama_pemain_tim()
	{
		$kategori = $this->input->post('kategori');
		$data = $this->Model_admin->get_pemain_for_tim($kategori);
		OB_START();
		echo '<option value="">--PILIH PEMAIN--</option>';
		foreach ($data->result_array() as $d) {
			echo '<option value="' . $d['id_pemain'] . '">' . $d['nama'] . '</option>';
		}
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function form_data_pool_simpan()
	{
		$insert['id_kategori'] = $this->input->post('kategori');
		$insert['pool'] = $this->input->post('pool');
		$insert['id_tim_A'] = $this->input->post('tim_A');
		$insert['id_tim_B'] = $this->input->post('tim_B');
		$insert['id_lapangan'] = 1;
		$insert['tanggal'] = '2021-12-3';
		$insert['waktu'] = '08:00:00';

		$urutan = $this->Model_admin->get_max_urutan($insert['pool'], $insert['id_kategori']);
		if (!empty($urutan)) {
			$insert['urutan'] = $urutan + 1;
		} else {
			$insert['urutan'] = 1;
		}
		// echo "<pre>";
		// print_r($_POST);die;
		$res = $this->basic->insert_data('data_babak_penyisihan', $insert);
		if ($res) {
			$timA = $this->Model_admin->data_tim_byid($insert['id_tim_A'])->row_array();
			$timB = $this->Model_admin->data_tim_byid($insert['id_tim_B'])->row_array();
			$konten_menu = "<li>TIM : " . $timA['nama_pasangan'] . " melawan " . $timB['nama_pasangan'] . " - POOL " . $insert['pool'] . " - Urutan " . $insert['urutan'] . "</li>";
			echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
		} else {
			echo JSON_ENCODE(array("status" => FALSE));
		}
	}
	public function form_data_turnamen_simpan()
	{
		$insert['id_kategori'] = $this->input->post('kategori');
		$insert['per'] = $this->input->post('kategori_babak');
		$insert['id_tim_A'] = $this->input->post('tim_A');
		$insert['id_tim_B'] = $this->input->post('tim_B');
		$insert['id_lapangan'] = 1;
		$insert['tanggal'] = '2021-12-5';
		$insert['waktu'] = '08:00:00';

		$urutan = $this->Model_admin->get_max_urutan_turnamen($insert['per'], $insert['id_kategori']);
		if (!empty($urutan)) {
			$insert['urutan'] = $urutan + 1;
		} else {
			$insert['urutan'] = 1;
		}
		// echo "<pre>";
		// print_r($_POST);die;
		$res = $this->basic->insert_data('data_babak_final', $insert);
		if ($res) {
			$timA = $this->Model_admin->data_tim_byid($insert['id_tim_A'])->row_array();
			$timB = $this->Model_admin->data_tim_byid($insert['id_tim_B'])->row_array();
			$per = $this->basic->get_data_where(array('id_babak' => $insert['per']), 'master_kategori_babak')->row_array();
			$konten_menu = "<li>TIM : " . $timA['nama_pasangan'] . " melawan " . $timB['nama_pasangan'] . " - PER " . $per['nama'] . " - Urutan " . $insert['urutan'] . "</li>";
			echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
		} else {
			echo JSON_ENCODE(array("status" => FALSE));
		}
	}
	public function form_data_tim_simpan()
	{
		$insert['id_kategori'] = $this->input->post('kategori');
		$insert['id_pemain1'] = $this->input->post('id_pemain1');
		$id_pemain2 = $this->input->post('id_pemain2');
		if (!empty($id_pemain2)) {
			$insert['id_pemain2'] = $id_pemain2;
		}
		$res = $this->basic->insert_data('data_tim', $insert);
		if ($res) {
			$last_id = $this->db->insert_id();
			$timA = $this->Model_admin->data_tim_byid($last_id)->row_array();
			$konten_menu = "<li>TIM : " . $timA['nama_pasangan'] . " Berhasil Di Tambahkan dengan ID " . $last_id . "</li>";
			echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
		} else {
			echo JSON_ENCODE(array("status" => FALSE));
		}
	}
	public function hapus_data_pemain()
	{
		$id_pemain = $this->input->post('id_pemain');
		$where = array('id_pemain' => $id_pemain);
		$status = $this->basic->delete_data($where, 'data_pemain');
		if ($status) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success"> Data Berhasil Dihapus.</div>');
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"> Data Gagal Dihapus.</div>');
		}
		redirect('admin/data_pemain');
	}
	public function hapus_data_tim()
	{
		$id_tim = $this->input->post('id_tim');
		$where = array('id_tim' => $id_tim);
		$status = $this->basic->delete_data($where, 'data_tim');
		if ($status) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success"> Data Berhasil Dihapus.</div>');
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"> Data Gagal Dihapus.</div>');
		}
		redirect('admin/data_tim');
	}
	public function hapus_data_pool()
	{
		$id_tim_A = $this->input->post('id_tim_A');
		$id_tim_B = $this->input->post('id_tim_B');
		$where = array('id_tim_A' => $id_tim_A, 'id_tim_B' => $id_tim_B,);
		$status = $this->basic->delete_data($where, 'data_babak_penyisihan');
		if ($status) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success"> Data Berhasil Dihapus.</div>');
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"> Data Gagal Dihapus.</div>');
		}
		// print($this->db->last_query());die;
		redirect('admin/data_babak_penyisihan');
	}
	public function set_nilai_penyisihan()
	{
		// echo "<pre>";
		// print_r($_POST);die;
		$id_tim_A = $this->input->post('id_tim_A');
		$id_tim_B = $this->input->post('id_tim_B');
		$tim_kat = $this->input->post('tim_kat');
		$jenis = $this->input->post('jenis');
		$skor = $this->input->post('skor');

		// $q = $this->Model_admin->get_tim_byId($id_tim_A,$id_tim_B);
		if ($tim_kat == 'A') {
			if ($jenis == 'tambah') $skor = $skor + 1;
			if ($jenis == 'kurang') $skor = $skor - 1;
			$data = array('set1_tim_A' => $skor);
		}
		if ($tim_kat == 'B') {
			if ($jenis == 'tambah') $skor = $skor + 1;
			if ($jenis == 'kurang') $skor = $skor - 1;
			$data = array('set1_tim_B' => $skor);
		}
		$where = array('id_tim_A' => $id_tim_A, 'id_tim_B' => $id_tim_B);

		$res = $this->basic->update_data($where, 'data_babak_penyisihan', $data);

		echo JSON_ENCODE(array("status" => TRUE, "skor_akhir" => $skor));
	}
	public function set_nilai_turnamen()
	{
		// echo "<pre>";
		// print_r($_POST);die;
		$id_tim_A = $this->input->post('id_tim_A');
		$id_tim_B = $this->input->post('id_tim_B');
		$tim_kat = $this->input->post('tim_kat');
		$jenis = $this->input->post('jenis');
		$skor = $this->input->post('skor');
		$set = $this->input->post('set');

		// $q = $this->Model_admin->get_tim_byId($id_tim_A,$id_tim_B);
		if ($tim_kat == 'A') {
			if ($jenis == 'tambah') $skor = $skor + 1;
			if ($jenis == 'kurang') $skor = $skor - 1;
			$data = array('set' . $set . '_tim_A' => $skor);
		}
		if ($tim_kat == 'B') {
			if ($jenis == 'tambah') $skor = $skor + 1;
			if ($jenis == 'kurang') $skor = $skor - 1;
			$data = array('set' . $set . '_tim_B' => $skor);
		}
		$where = array('id_tim_A' => $id_tim_A, 'id_tim_B' => $id_tim_B);

		$res = $this->basic->update_data($where, 'data_babak_final', $data);

		echo JSON_ENCODE(array("status" => TRUE, "skor_akhir" => $skor));
	}
	public function set_komponen()
	{
		// echo "<pre>";
		// print_r($_POST);die;
		$id_tim_A = $this->input->post('id_tim_A');
		$id_tim_B = $this->input->post('id_tim_B');
		if (!empty($this->input->post('lapangan'))) $data['id_lapangan'] = $this->input->post('lapangan');
		if (!empty($this->input->post('tanggal'))) $data['tanggal'] = $this->input->post('tanggal');
		if (!empty($this->input->post('waktu'))) $data['waktu'] = $this->input->post('waktu');

		$where = array('id_tim_A' => $id_tim_A, 'id_tim_B' => $id_tim_B);

		$res = $this->basic->update_data($where, 'data_babak_penyisihan', $data);

		echo JSON_ENCODE(array("status" => TRUE));
	}
	public function set_komponen_turnamen()
	{
		// echo "<pre>";
		// print_r($_POST);die;
		$id_tim_A = $this->input->post('id_tim_A');
		$id_tim_B = $this->input->post('id_tim_B');
		if (!empty($this->input->post('lapangan'))) $data['id_lapangan'] = $this->input->post('lapangan');
		if (!empty($this->input->post('tanggal'))) $data['tanggal'] = $this->input->post('tanggal');
		if (!empty($this->input->post('waktu'))) $data['waktu'] = $this->input->post('waktu');

		$where = array('id_tim_A' => $id_tim_A, 'id_tim_B' => $id_tim_B);

		$res = $this->basic->update_data($where, 'data_babak_final', $data);

		echo JSON_ENCODE(array("status" => TRUE));
	}
	public function upload_file()
	{
		// echo "<pre>";
		// print_r($_FILES);
		// die;
		// echo json_encode(array('error' => "error"));
		// return;


		$path_upload = 'file_upload/berita';
		$config = array(
			'upload_path'			=> './' . $path_upload,
			'max_size'				=> 10000,
			'allowed_types'			=> 'jpg|jpeg|png|bmp|gif',
			'overwrite'				=> true,
		);
		$this->load->library('upload', $config);
		if (!empty($_FILES['file']['name'])) {
			if (!$this->upload->do_upload('file')) {
				$msg = $this->upload->display_errors();
				die(JSON_ENCODE(array("pesan" => $msg)));
			} else {
				// $temp_name = str_replace("/", " ", $_FILES['file']['name']);
				$temp_name = preg_replace('/\s+/', '_', $_FILES['file']['name']);
				$filetowrite = $path_upload . "/" . $temp_name;
				echo json_encode(array('location' => base_url() . $filetowrite));
			}
		}
	}
}
