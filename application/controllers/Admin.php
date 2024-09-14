<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_main');
		$this->load->model('Model_admin');
		$this->load->model('Model_basic');
		$this->basic->squrity();
	}

	public function get_data_id_nama()
	{
		if (isset($_GET['q']) and STRLEN($_GET['q']) >= 4) {
			$keyword = $_GET['q'];
			$veteran = $_GET['veteran'];
			if ($_GET['dharmayukti'] == 1) $data = $this->Model_admin->model_get_data_id_nama_dharmayukti($keyword); //1 FUNGSI AJA BANG
			else $data = $this->Model_admin->model_get_data_id_nama($keyword, $veteran);
			// PRINT_R($data->result_array());DIE();
			$hasil = array("results" => $data->result_array());
			// PRINT_R($hasil);DIE();
			echo JSON_ENCODE($hasil);
		}
	}
	public function get_data_id_nama_veteran()
	{
		if (isset($_GET['q']) and STRLEN($_GET['q']) >= 4) {
			$keyword = $_GET['q'];
			$data = $this->Model_admin->model_get_data_id_nama_veteran($keyword);
			// PRINT_R($data->result_array());DIE();
			$hasil = array("results" => $data->result_array());
			// PRINT_R($hasil);DIE();
			echo JSON_ENCODE($hasil);
		}
	}

	public function get_data_id_nama_dharmayukti()
	{
		if (isset($_GET['q']) and STRLEN($_GET['q']) >= 4) {
			$keyword = $_GET['q'];
			$data = $this->Model_admin->model_get_data_id_nama_dharmayukti($keyword);
			// PRINT_R($data->result_array());DIE();
			$hasil = array("results" => $data->result_array());
			// PRINT_R($hasil);DIE();
			echo JSON_ENCODE($hasil);
		}
	}

	public function index()
	{
		$_SESSION['id_event'] = $this->Model_basic->get_event_aktif();
		$data['judul'] = "Halaman Admin";
		$data['set_id_event'] = $this->basic->get_data('data_event');
		$this->template->load('admin_template', 'admin/home', $data);
	}

	public function data_konten()
	{
		$data['judul'] = "DATA MENU KONTEN";
		$data['cat_id'] = 0;
		$where = array('cat_id' => 0);
		$order_by = 'id DESC';
		$data['list_konten'] = $this->basic->get_data_where($where, 'data_konten', $order_by);
		OB_START();
		$this->load->view("admin/data_konten", $data);
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function data_berita()
	{
		$data['judul'] = "DATA MENU BERITA";
		$data['list_konten'] = $this->Model_admin->get_data_berita();
		OB_START();
		$this->load->view("admin/data_berita", $data);
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_user()
	{
		OB_START();
		$this->load->view("admin/data_user");
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function data_sewa_mobil()
	{
		OB_START();
		$this->load->view("admin/data_sewa_mobil");
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function data_transparansi_keuangan()
	{
		OB_START();
		$q = $this->Model_main->get_data_konten('laporan_keuangan')->row_array();
		if (!empty($q)) {
			$this->Model_main->log_data_konten($q['id']);
			$data['judul'] = $q['judul'];
			$data['konten'] = $q;
		}
		$this->load->view("main/page", $data);
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function data_user_tabel()
	{
		$konten_menu = $this->load->view("admin/data_user_tabel", "", TRUE);
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_user_form()
	{
		OB_START();
		$this->load->view("admin/data_user_form");
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_user_aktivasi()
	{
		$id_user 		= $this->input->post('id_user');
		$aktif			= $this->input->post('aktif');
		$nomor			= $this->input->post('nomor');
		$where 	= array('id_user' => $id_user);
		$update = array('aktif' => $aktif);
		$res = $this->basic->update_data($where, 'data_user', $update);
		if ($res) {
			OB_START();
			if ($aktif) {
				echo '<div class="custom-control custom-switch">
					<input type="checkbox" class="custom-control-input aktivasi" data-no="' . $nomor . '" id="customSwitch_' . $nomor . '" checked>
					<label class="custom-control-label" for="customSwitch_' . $nomor . '"><span class="badge badge-success">Aktif</span></label>
				</div>';
			} else {
				echo '<div class="custom-control custom-switch">
					<input type="checkbox" class="custom-control-input aktivasi" data-no="' . $nomor . '" id="customSwitch_' . $nomor . '">
					<label class="custom-control-label" for="customSwitch_' . $nomor . '"><span class="badge badge-danger">Belum Aktif</span></label>
				</div>';
			}

			$konten_menu = ob_get_clean();
			echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
		}
	}

	public function data_user_hapus()
	{
		$where = array('id_user' => $_POST['id_user']);
		$status = $this->basic->delete_data($where, 'data_user');
		OB_START();
		$this->load->view("admin/data_user");
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}


	public function data_user_simpan()
	{
		$where = array('id_user' => $_POST['id_user']);
		$cek_user = $this->basic->get_data_where($where, 'data_user');
		if ($cek_user->num_rows()) {
			$where = array('id_user' => $_POST['id_user']);
			$status = $this->basic->update_data($where, 'data_user', $_POST);
		} else {
			$status = $this->basic->insert_data('data_user', $_POST);
		}

		OB_START();
		$this->load->view("admin/data_user");
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => $status, "konten_menu" => $konten_menu));
	}

	public function data_event()
	{
		OB_START();
		$this->load->view("admin/data_event");
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function data_event_tabel()
	{
		$konten_menu = $this->load->view("admin/data_event_tabel", "", TRUE);
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function data_event_form()
	{
		OB_START();
		$this->load->view("admin/data_event_form");
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function data_event_aktivasi()
	{
		$id_event 		= $this->input->post('id_event');
		$aktif			= $this->input->post('aktif');
		$nomor			= $this->input->post('nomor');
		$where 	= array('id_event' => $id_event);
		$update = array('aktif' => $aktif);
		$res = $this->basic->update_data($where, 'data_event', $update);
		if ($res) {
			OB_START();
			if ($aktif) {
				echo '<div class="custom-control custom-switch">
					<input type="checkbox" class="custom-control-input aktivasi" data-no="' . $nomor . '" id="customSwitch_' . $nomor . '" checked>
					<label class="custom-control-label" for="customSwitch_' . $nomor . '"><span class="badge badge-success">Aktif</span></label>
				</div>';
			} else {
				echo '<div class="custom-control custom-switch">
					<input type="checkbox" class="custom-control-input aktivasi" data-no="' . $nomor . '" id="customSwitch_' . $nomor . '">
					<label class="custom-control-label" for="customSwitch_' . $nomor . '"><span class="badge badge-danger">Belum Aktif</span></label>
				</div>';
			}

			$konten_menu = ob_get_clean();
			echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
		}
	}
	public function data_event_hapus()
	{
		$where = array('id_event' => $_POST['id_event']);
		$status = $this->basic->delete_data($where, 'data_event');
		OB_START();
		$this->load->view("admin/data_event");
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_event_simpan()
	{
		// PRINT_R($_POST);DIE();
		$status = FALSE;
		if ($_POST['id_event'] > 0) {
			$where = array('id_event' => $_POST['id_event']);
			$status = $this->basic->update_data($where, 'data_event', $_POST);
		} else {
			$status = $this->basic->insert_data('data_event', $_POST);
		}

		OB_START();
		$this->load->view("admin/data_event");
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => $status, "konten_menu" => $konten_menu));
	}

	public function data_wasit()
	{
		OB_START();
		$this->load->view("admin/data_wasit");
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function data_wasit_tabel()
	{
		$konten_menu = $this->load->view("admin/data_wasit_tabel", "", TRUE);
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function data_wasit_form()
	{
		OB_START();
		$this->load->view("admin/data_wasit_form");
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	// public function data_wasit_aktivasi()
	// {
	// 	$id_wasit 		= $this->input->post('id_wasit');
	// 	$aktif			= $this->input->post('aktif');
	// 	$nomor			= $this->input->post('nomor');
	// 	$where 	= array('id_wasit' => $id_wasit);
	// 	$update = array('aktif' => $aktif);
	// 	$res = $this->basic->update_data($where, 'data_wasit', $update);
	// 	if ($res) {
	// 		OB_START();
	// 		if ($aktif) {
	// 			echo '<div class="custom-control custom-switch">
	// 				<input type="checkbox" class="custom-control-input aktivasi" data-no="' . $nomor . '" id="customSwitch_' . $nomor . '" checked>
	// 				<label class="custom-control-label" for="customSwitch_' . $nomor . '"><span class="badge badge-success">Aktif</span></label>
	// 			</div>';
	// 		} else {
	// 			echo '<div class="custom-control custom-switch">
	// 				<input type="checkbox" class="custom-control-input aktivasi" data-no="' . $nomor . '" id="customSwitch_' . $nomor . '">
	// 				<label class="custom-control-label" for="customSwitch_' . $nomor . '"><span class="badge badge-danger">Belum Aktif</span></label>
	// 			</div>';
	// 		}

	// 		$konten_menu = ob_get_clean();
	// 		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	// 	}
	// }
	public function data_wasit_hapus()
	{
		$where = array('id_wasit' => $_POST['id_wasit']);
		$status = $this->basic->delete_data($where, 'data_wasit');
		OB_START();
		$this->load->view("admin/data_wasit");
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_wasit_simpan()
	{
		// PRINT_R($_POST);DIE();
		$status = FALSE;
		if ($_POST['id_wasit'] > 0) {
			$where = array('id_wasit' => $_POST['id_wasit']);
			$status = $this->basic->update_data($where, 'data_wasit', $_POST);
		} else {
			$status = $this->basic->insert_data('data_wasit', $_POST);
		}

		OB_START();
		$this->load->view("admin/data_wasit");
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => $status, "konten_menu" => $konten_menu));
	}

	public function data_lapangan()
	{
		OB_START();
		$this->load->view("admin/data_lapangan");
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function data_lapangan_tabel()
	{
		$konten_menu = $this->load->view("admin/data_lapangan_tabel", "", TRUE);
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function data_lapangan_form()
	{
		OB_START();
		$this->load->view("admin/data_lapangan_form");
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function data_lapangan_hapus()
	{
		$where = array('id_lapangan' => $_POST['id_lapangan']);
		$status = $this->basic->delete_data($where, 'master_lapangan');
		OB_START();
		$this->load->view("admin/data_lapangan");
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_lapangan_simpan()
	{
		// PRINT_R($_POST);DIE();
		$status = FALSE;
		if ($_POST['id_lapangan'] > 0) {
			$where = array('id_lapangan' => $_POST['id_lapangan']);
			$status = $this->basic->update_data($where, 'master_lapangan', $_POST);
		} else {
			$status = $this->basic->insert_data('master_lapangan', $_POST);
		}

		OB_START();
		$this->load->view("admin/data_lapangan");
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => $status, "konten_menu" => $konten_menu));
	}

	public function data_pemain_export($jenis, $id_kontingen, $id_event)
	{
		$data['id_kontingen'] = $id_kontingen;
		$_POST['id_event'] = $id_event; //MANUAL DLU AH
		$kontingen = $this->Model_admin->get_data_kontingen($id_kontingen);
		$data['kontingen'] = $kontingen;
		$data['kategori_pemain']	= $this->basic->get_data_where(array('id_event' => $id_event, 'is_tampil'=> 1), 'master_kategori_pemain');
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=data_pemain_" . $kontingen['nama_kontingen'] . ".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		$tabel = $this->load->view("admin/data_pemain_" . $jenis . "_export", $data, TRUE);
		$tabel = str_replace("<br>", "<br style='mso-data-placement:same-cell;'/>", $tabel);
		echo $tabel;
	}
	public function data_pemain_export_all($id_event)
	{
		$_POST['id_event'] = $id_event;
		$data['event']= $event	= $this->basic->get_data_where(array('id_event' => $id_event), 'data_event')->row_array();
		$data['non_pemain'] = $this->Model_admin->get_data_non_pemain(false,false);		
		$data['pemain'] = $this->Model_admin->get_list_pemain_all($id_event);		
		$data['kategori_pemain']	= $this->basic->get_data_where(array('id_event' => $id_event), 'master_kategori_pemain');
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=data_pemain_all.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		$tabel = $this->load->view("admin/data_pemain_export_all", $data, TRUE);
		$tabel = str_replace("<br>", "<br style='mso-data-placement:same-cell;'/>", $tabel);
		echo $tabel;
	}
	public function data_pemain_veteran_export($id_event)
	{
		$data['event']= $event	= $this->basic->get_data_where(array('id_event' => $id_event), 'data_event')->row_array();
		$_POST['id_event'] = $id_event;
		$data['pemain'] = $this->Model_admin->get_data_pemain_veteran();
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=data_pemain_veteran.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		// echo '<pre>';
		// print_r($data['pemain']->result_array());
		// echo '</pre>';
		// die();
		$tabel = $this->load->view("admin/data_pemain_veteran_export", $data, TRUE);
		$tabel = str_replace("<br>", "<br style='mso-data-placement:same-cell;'/>", $tabel);
		echo $tabel;
	}
	public function data_pemain()
	{
		// $data['list_pemain'] = $this->Model_admin->get_data_pemain();
		$data['id_event'] = $this->input->post('id_event');
		$data['event'] = $event 	= $this->basic->get_data_where(array('id_event' => $data['id_event']), 'data_event')->row_array();
		$data['kategori_pemain']	= $this->basic->get_data_where(array('id_event' => $data['id_event'], 'is_tampil'=> 1), 'master_kategori_pemain');
		if (IN_ARRAY($_SESSION['id_panitia'], array(0, 1))) {
			$konten_menu = $this->load->view("admin/data_pemain_list_" . $event['jenis_pertandingan'], $data, TRUE);
		} else if (IN_ARRAY($_SESSION['id_panitia'], array(2, 3))) {
			$data['id_kontingen'] = $_SESSION['id_kontingen'];
			$konten_menu = $this->load->view("admin/data_pemain_" . $event['jenis_pertandingan'], $data, TRUE);
		} else {
			$konten_menu = "HALAMAN TIDAK TERSEDIA";
		}
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function data_pemain_veteran() //KASUISTIS KARNA TANPA KONTINGEN
	{
		// $data['list_pemain'] = $this->Model_admin->get_data_pemain();
		$data['id_event'] = $this->input->post('id_event');
		$data['event'] = $event 	= $this->basic->get_data_where(array('id_event' => $data['id_event']), 'data_event')->row_array();
		$data['kategori_pemain']	= $this->basic->get_data_where(array('id_event' => $data['id_event'], 'beregu'=> 'veteran'), 'master_kategori_pemain')->row_array();
		$konten_menu = $this->load->view("admin/data_pemain_veteran", $data, TRUE);
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function data_pemain_detil_beregu()
	{
		// $data['list_pemain'] = $this->Model_admin->get_data_pemain();
		$data['id_event'] = $this->input->post('id_event');
		$data['id_kontingen'] = $this->input->post('id_kontingen');
		$data['event'] 	= $this->basic->get_data_where(array('id_event' => $data['id_event']), 'data_event')->row_array();
		$konten_menu = $this->load->view("admin/data_pemain_Beregu", $data, TRUE);
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}
	public function data_pemain_detil_perorangan()
	{
		// $data['list_pemain'] = $this->Model_admin->get_data_pemain();
		$data['id_event'] = $this->input->post('id_event');
		$data['id_kontingen'] = $this->input->post('id_kontingen');
		$data['event'] 	= $this->basic->get_data_where(array('id_event' => $data['id_event']), 'data_event')->row_array();
		$data['kategori_pemain']	= $this->basic->get_data_where(array('id_event' => $data['id_event'], 'is_tampil'=> 1), 'master_kategori_pemain');
		$konten_menu = $this->load->view("admin/data_pemain_Perorangan", $data, TRUE);
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_pemain_form()
	{
		OB_START();
		$this->load->view("admin/data_pemain_form");
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_pemain_simpan()
	{
		// echo JSON_ENCODE(array("status" => false, "pesan" => 'GAGAL'));
		// die();
		// echo '<pre>';
		// print_r($_POST);
		// echo '</pre>';
		// die();
		$id_pemain = $this->input->post('id_pemain');
		// echo $id_pemain;
		// die();
		if (empty($id_pemain) or $id_pemain == 'null') {
			echo JSON_ENCODE(array("status" => false, "pesan" => 'SILAHKAN PILIH PEMAIN / OFFICIAL TERLEBIH DAHULU'));
			return;
		}
		// $_POST['id_kontingen'] 	= $_SESSION['id_kontingen'];
		
		if ($_POST['is_dharmayukti']) {
			$id_keluarga = $_POST['id_pemain'];
			$_POST['id_keluarga'] = $id_keluarga;
			$cek_suami = $this->basic->get_data_where(array('IdAnggotaKeluarga' => $id_keluarga), 'tmst_keluarga')->row_array();
			$_POST['id_pemain'] = $cek_suami['IdPegawai'];
		}
		$cek_pegawai = $this->basic->get_data_where(array('id_pegawai' => $_POST['id_pemain']), 'data_pegawai_all')->row_array();
		// echo '<pre>';
		// print_r($cek_pegawai);
		// echo '</pre>';
		// die();
		/* if ($cek_pegawai['jenis_kelamin'] == 'Pria' and $_POST['is_dharmayukti'] == '0' and $_POST['is_official'] == '0' and $_POST['is_veteran'] == '0') {
			$cek_pemain_pria = $this->basic->get_data_where(array('id_kontingen' => $_POST['id_kontingen'], 'jenis_kelamin' => 'Pria', 'is_official' => '0', 'is_veteran' => '0', 'is_dharmayukti' => '0'), 'view_pemain');
			if ($cek_pemain_pria->num_rows() >= 8) {
				echo JSON_ENCODE(array("status" => false, "pesan" => 'PEMAIN PUTRA BEREGU MAKSIMAL 8 ORANG'));
				return;
			}
			$cek_karyawan = $this->basic->get_data_where(array('id_kontingen' => $_POST['id_kontingen'], 'jenis_kelamin' => 'Pria', 'is_subdit !=' => '1', 'is_veteran' => '0', 'is_official' => '0', 'is_dharmayukti' => '0'), 'view_pemain');
			if ($cek_karyawan->num_rows() >= 3 && $cek_pegawai['is_subdit'] !== '1') {
				echo JSON_ENCODE(array("status" => false, "pesan" => 'PEMAIN KARYAWAN PUTRA BEREGU MAKSIMAL 3 ORANG'));
				return;
			}
		} else if ($_POST['is_official']) {
			$cek_official = $this->basic->get_data_where(array('id_kontingen' => $_POST['id_kontingen'], 'is_official' => $_POST['is_official']), 'data_pemain');
			if ($cek_official->num_rows() >= 2) {
				echo JSON_ENCODE(array("status" => false, "pesan" => 'OFFICIAL / MANAGER MAKSIMAL 2 ORANG'));
				return;
			}
		} else if ($_POST['is_veteran']) {
			//nothing
		} else {
			$cek_pemain_putri = $this->basic->get_data_where(array('id_kontingen' => $_POST['id_kontingen'], 'jenis_kelamin' => 'Wanita', 'is_veteran' => '0', 'is_official' => '0'), 'view_pemain');
			$cek_pemain_dyk = $this->basic->get_data_where(array('id_kontingen' => $_POST['id_kontingen'], 'is_dharmayukti' => '1', 'is_veteran' => '0', 'is_official' => '0'), 'view_pemain');
			if (($cek_pemain_putri->num_rows() + $cek_pemain_dyk->num_rows()) >= 6) {
				echo JSON_ENCODE(array("status" => false, "pesan" => 'PEMAIN PUTRI BEREGU MAKSIMAL 6 ORANG'));
				return;
			}
		} */ ##DISABLE CHECKING FOR BEREGU MALES BET BKIN KONDISI MATIIN DLU

		// if ($_POST['is_dharmayukti'] == 'true')  $_POST['is_dharmayukti'] = 1;
		// else $_POST['is_dharmayukti'] = 0;
		$is_official = $this->input->post('is_official');
		$where = array();
		$nama_table = 'data_pemain';
		$DATA_INSERT = $_POST;
		$DATA_INSERT['user_created'] = $_SESSION['id_user'];
		if ($_POST){
			if($is_official){
				$nama_table = 'data_non_pemain';
				$where = array('id_user' => $_POST['id_pemain'], 'id_kategori' => $_POST['id_kategori'], 'id_event' => $_POST['id_event']);
				$DATA_INSERT['id_user'] = $_POST['id_pemain'];
				unset($DATA_INSERT['id_pemain']);
				unset($DATA_INSERT['is_dharmayukti']);
				unset($DATA_INSERT['is_official']);
				unset($DATA_INSERT['is_veteran']);
			}
			else{
				$where = array('id_pemain' => $_POST['id_pemain'], 'is_dharmayukti' => $_POST['is_dharmayukti'], 'id_event' => $_POST['id_event']);
			}
		}
			
		$cek_pemain = $this->basic->get_data_where($where, $nama_table);
		if ($cek_pemain->num_rows()) {
			echo JSON_ENCODE(array("status" => false, "pesan" => 'SUDAH ADA PEMAIN / OFFICIAL DENGAN NAMA TERSEBUT, SILAHKAN HAPUS TERLEBIH DAHULU'));
			return;
		} else {
			$status = $this->basic->insert_data($nama_table, $DATA_INSERT);
		}

		if ($status) {
			$this->data_pemain();
		} else {
			echo JSON_ENCODE(array("status" => false, "pesan" => 'GAGAL'));
		}
	}
	public function data_pemain_veteran_simpan()
	{
		// echo JSON_ENCODE(array("status" => false, "pesan" => 'GAGAL'));
		// die();
		// echo '<pre>';
		// print_r($_POST);
		// echo '</pre>';
		// die();
		$id_pemain_1 	= $this->input->post('id_pemain_1');
		$id_pemain_2 	= $this->input->post('id_pemain_2');
		$id_event 		= $this->input->post('id_event');
		// echo $id_pemain;
		// die();
		if (empty($id_pemain_1) or $id_pemain_1 == 'null') {
			echo JSON_ENCODE(array("status" => false, "pesan" => 'SILAHKAN PILIH PEMAIN TERLEBIH DAHULU'));
			return;
		}
		if (empty($id_pemain_2) or $id_pemain_2 == 'null') {
			echo JSON_ENCODE(array("status" => false, "pesan" => 'SILAHKAN PILIH PEMAIN TERLEBIH DAHULU'));
			return;
		}
		if ($id_pemain_1 == $id_pemain_2) {
			echo JSON_ENCODE(array("status" => false, "pesan" => 'PEMAIN 1 tidak boleh sama dengan PEMAIN 2'));
			return;
		}
		
		$this->db->where("id_pemain IN ('$id_pemain_1','$id_pemain_2') AND id_event ='$id_event'");
		$cek_pemain = $this->db->get('data_pemain');
		if ($cek_pemain->num_rows()) {
			echo JSON_ENCODE(array("status" => false, "pesan" => 'SUDAH ADA PEMAIN / OFFICIAL DENGAN NAMA TERSEBUT, SILAHKAN HAPUS TERLEBIH DAHULU'));
			return;
		} else {
						
			$this->db->where("beregu = 'veteran' AND id_event ='$id_event'");
			$get_kategori = $this->db->get('master_kategori_pemain')->row_array();
			$id_kategori = $get_kategori['id_kategori']; 

			$data['id_kontingen'] = '920'; //VETERAN TANPA KONTINGEN, KITA TAMPUNG DI MA AJA
			$data['id_pemain'] = $id_pemain_1;
			$data['is_veteran'] = 1;
			$data['id_event'] = $id_event;
			$data['id_kategori'] = $id_kategori;
			$data['user_created'] = $_SESSION['id_user'];
			$pemain1 = $this->basic->insert_data('data_pemain', $data);
			$data['id_pemain'] = $id_pemain_2;
			$pemain2 = $this->basic->insert_data('data_pemain', $data); //INSERT 2 pemain langsung aja karena kategori GANDA


			$insert_tim['id_kategori'] =$id_kategori;
			$insert_tim['id_pemain1'] = $id_pemain_1;
			$insert_tim['id_pemain2'] = $id_pemain_2;
			
			$status = $this->basic->insert_data('data_tim', $insert_tim);

		}

		if ($status) {
			$this->data_pemain_veteran();
		} else {
			echo JSON_ENCODE(array("status" => false, "pesan" => 'GAGAL'));
		}
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
	public function form_data_berita()
	{

		$id_konten = $this->input->post('id_konten');

		$data['id'] = $id_konten;
		$data['isi'] = '';
		$data['judul'] = '';
		$data['img'] = '';
		$data['alias'] = '';
		$data['title'] = "FORM TAMBAH BERITA";
		if (!empty($id_konten)) {
			$q = $this->basic->get_data_where(array('id' => $id_konten), 'data_konten')->row_array();
			$data = $q;
			$data['title'] = "UBAH BERITA";
			// echo "<pre>";
			// print_r($data);
			// die;
		}
		OB_START();
		$this->load->view("admin/form_data_berita", $data);
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
	public function form_data_berita_simpan()
	{
		$id = $this->input->post('id');
		$data['judul'] = $this->input->post('judul');
		$data['cat_id'] = $this->input->post('cat_id');
		$data['alias'] = $this->input->post('alias');
		$data['img'] = $this->input->post('img');
		$data['isi'] = $this->input->post('isi_konten');
		$data['is_publish'] = $this->input->post('is_publish');
		$data['is_pengumuman'] = $this->input->post('is_pengumuman');
		$data['user_created'] = $_SESSION['id_user'];

		if (empty($data['alias'])) {
			$data['alias'] = strtolower(preg_replace('/\s+/', '_', $data['judul']));
		}
		$data['alias']  = preg_replace('/\s+/', '_', $data['alias']);
		if (empty($data['is_publish'])) {
			$data['is_publish'] = 0;
		}
		// preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $data['isi'], $data['img']);

		// echo "<pre>";
		// print_r($data);
		// die;
		$kirim_wa = 0;
		if ($id > 0) {
			$data['date_updated'] = date('Y-m-d H:i:s');
			unset($data['user_created']);
			$where = array('id' => $id);
			$res = $this->basic->update_data($where, 'data_konten', $data);
		} else {
			$data['user_created'] = $this->session->userdata('id_user');
			$data['date_created'] = date('Y-m-d H:i:s');
			$res = $this->basic->insert_data('data_konten', $data);
			if ($data['cat_id'] == '3') $kirim_wa = 1;
		}
		if ($res) {
			if ($kirim_wa) {
				##SEND WA ##

				$kirim_ke = array('6285712423460', '6282120494550', '628114043343', '6281281419338'); //PUTRA, REZA, ILMAN, CANDRA BOY
				$data['pesan']	= $_SESSION['nama'] . ' Mengirim Berita Daerah dengan Judul : "*' . $data['judul'] . '*" |Harap segera dipublish';
				foreach ($kirim_ke as $R) {
					$data['nowa']	= $R;
					$this->kirim_wa($data);
				}
			}
			$this->session->set_flashdata('msg', '<div class="alert alert-success"> Data Berhasil Disimpan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"> Data Gagal Disimpan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
		}
		redirect('admin/data_berita');
	}
	public function form_data_konten_simpan()
	{
		$id = $this->input->post('id');
		$data['judul'] = $this->input->post('judul');
		$data['cat_id'] = $this->input->post('cat_id');
		$data['alias'] = $this->input->post('alias');
		$data['img'] = $this->input->post('img');
		$data['isi'] = $this->input->post('isi_konten');
		$data['is_publish'] = $this->input->post('is_publish');
		$data['is_pengumuman'] = $this->input->post('is_pengumuman');

		if (empty($data['alias'])) {
			$data['alias'] = strtolower(preg_replace('/\s+/', '_', $data['judul']));
		}
		$data['alias']  = preg_replace('/\s+/', '_', $data['alias']);
		if (empty($data['is_publish'])) {
			$data['is_publish'] = 0;
		}
		if ($id > 0) {
			$data['date_updated'] = date('Y-m-d H:i:s');
			$where = array('id' => $id);
			$res = $this->basic->update_data($where, 'data_konten', $data);
		} else {
			$data['user_created'] = $this->session->userdata('id_user');
			$data['date_created'] = date('Y-m-d H:i:s');
			$data['date_updated'] = date('Y-m-d H:i:s');
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
		$jenis = $this->input->post('jenis');
		$id_event = $this->input->post('id_event');
		$id_kategori = $this->input->post('id_kategori');
		$nama_tabel = 'data_pemain';
		if($jenis == 'pemain'){
			$where = array('id_pemain' => $id_pemain, 'id_event'=>$id_event, 'id_kategori' => $id_kategori);
		}
		else{
			$nama_tabel = 'data_non_pemain';
			$where = array('id_user' => $id_pemain, 'id_event'=>$id_event, 'id_kategori' => $id_kategori);
		}
		
		$status = $this->basic->delete_data($where, $nama_tabel);
		if ($status) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success"> Data Berhasil Dihapus.</div>');
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"> Data Gagal Dihapus.</div>');
		}
		$this->data_pemain();
	}
	public function hapus_data_tim_veteran(){
		$id_tim = $this->input->post('id_tim');
		$where = array('id_tim' => $id_tim);
		$get = $this->basic->get_data_where($where, 'data_tim')->row_array();
		
		$status = $this->basic->delete_data($where, 'data_tim');
		$where = array('id_pemain' => $get['id_pemain1'], 'is_veteran' => 1);
		$status = $this->basic->delete_data($where, 'data_pemain');
		$where = array('id_pemain' => $get['id_pemain2'], 'is_veteran' => 1);
		$status = $this->basic->delete_data($where, 'data_pemain');
		if ($status) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success"> Data Berhasil Dihapus.</div>');
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger"> Data Gagal Dihapus.</div>');
		}
		$this->data_pemain_veteran();
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

	//Dika aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
	public function data_drawing()
	{
		$konten_menu = $this->load->view("admin/data_drawing", NULL, TRUE);
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_drawing_acak()
	{
		$konten_menu = $this->load->view("admin/data_drawing_acak", NULL, TRUE);
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_drawing_copy()
	{
		// echo JSON_DECODE($_POST['data_batch']);
		// die();
		// PRINT_R(JSON_DECODE($_POST['data_batch']));
		$status = $this->Model_admin->model_data_drawing_copy($_POST['data_batch']);
		
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function data_perorangan_pool()
	{
		$konten_menu = $this->load->view("admin/data_perorangan_pool", NULL, TRUE);
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_perorangan_pool_rekap()
	{
		$konten_menu = $this->load->view("admin/data_perorangan_pool_rekap", NULL, TRUE);
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_perorangan_pool_hapus()
	{
		EXTRACT($_POST);
		$P['from'] = "data_perorangan_pool";
		$P['where'] 	= array("id_event" => $_SESSION['id_event'], "id_kategori_pemain" => $id_kategori_pemain, "pool" => $pool, "urutan" => $urutan);
		$status = $this->Model_basic->delete($P);
		echo JSON_ENCODE(array("status" => $status));
	}

	public function data_perorangan_pool_simpan()
	{
		EXTRACT($_POST);

		$pesan = "";
		if($id_kategori_pemain == "") $pesan .= "Kategori Pemain Harus Dipilih<br>";
		if($pool == "") $pesan .= "Pool Harus Dipilih<br>";
		if($urutan == "") $pesan .= "Urutan Harus Dipilih<br>";
		if($id_pemain1 == "") $pesan .= "Pemain Pertama Harus Dipilih<br>";
		// if($id_pemain1_tim_B == "") $pesan .= "Pemain Pertama Tim B Harus Dipilih<br>";
		if($pesan != "") die(JSON_ENCODE(array("status" => false, "pesan" => $pesan)));

		if(!$id_pemain2) 
			{
				$id_pemain2 = NULL;
				$is_dharmayukti2 = NULL;
				$id_keluarga2 = NULL;
			}

		if(!$is_dharmayukti1) 
			{
				$is_dharmayukti1 = NULL;
				$id_keluarga1 = NULL;
			}

		if(!$is_dharmayukti2) 
			{
				$is_dharmayukti2 = NULL;
				$id_keluarga2 = NULL;
			}

		$P['from'] = "data_perorangan_pool";
		$P['values'] 	= array("id_event" => $_SESSION['id_event'], "id_kategori_pemain" => $id_kategori_pemain, "pool" => $pool, "urutan" => $urutan, "id_pemain1" => $id_pemain1, "id_pemain2" => $id_pemain2, "is_dharmayukti1" => $is_dharmayukti1, "is_dharmayukti2" => $is_dharmayukti2, "id_keluarga1" => $id_keluarga1, "id_keluarga2" => $id_keluarga2);
		$P['where'] 	= array("id_event" => $_SESSION['id_event'], "id_kategori_pemain" => $id_kategori_pemain, "pool" => $pool, "urutan" => $urutan);
		// $P['die'] = true;
		$status = $this->Model_basic->insert_cek($P);
		echo JSON_ENCODE(array("status" => $status));
	}

	public function data_perorangan_penyisihan()
	{
		$konten_menu = $this->load->view("admin/data_perorangan_penyisihan", NULL, TRUE);
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_perorangan_penyisihan_rekap()
	{
		$konten_menu = $this->load->view("admin/data_perorangan_penyisihan_rekap", NULL, TRUE);
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_perorangan_penyisihan_simpan()
	{
		EXTRACT($_POST);

		$pesan = "";
		if($id_pertandingan == "") $pesan .= "ID Pertandingan tidak valid<br>";
		if(!($set_tim_A >= 0 AND $set_tim_A <= 6)) $pesan .= "Set Tim A Tidak Valid<br>";
		if(!($set_tim_B >= 0 AND $set_tim_B <= 6)) $pesan .= "Set Tim B Tidak Valid<br>";
		if($set_tim_A != 6 AND $set_tim_B != 6 AND $set_tim_A != 0 AND $set_tim_B != 0) $pesan .= "Set Tim A / B Salah Satu Harus Menang<br>";
		// if($id_pemain1_tim_B == "") $pesan .= "Pemain Pertama Tim B Harus Dipilih<br>";
		if($pesan != "") die(JSON_ENCODE(array("status" => false, "pesan" => $pesan)));

		$P['from'] = "data_perorangan_penyisihan";
		$P['set'] 	= array("set_tim_A" => $set_tim_A, "set_tim_B" => $set_tim_B);
		$P['where'] 	= array("id_pertandingan" => $id_pertandingan);
		// $P['die'] = true;
		$status = $this->Model_basic->update($P);
		echo JSON_ENCODE(array("status" => $status));
	}

	public function data_perorangan_penyisihan_generate()
	{
		UNSET($P);
		$P['select'] = "A.id_event, A.id_kategori_pemain, A.pool, COUNT(A.urutan) AS jumlah_urutan";
		$P['from'] = "data_perorangan_pool AS A";
		$P['where'] = "A.id_event = '$_SESSION[id_event]' ";
		$P['group_by'] = "A.id_kategori_pemain, A.pool";
		$P['order_by'] = "A.id_kategori_pemain ASC, A.pool ASC, A.urutan DESC";
		$data = $this->Model_basic->select($P);
		if($data->num_rows())
			{
				foreach($data->result_array() AS $R)
					{
						// echo $R['id_kategori_pemain']." ".$R['pool']." > ".$R['jumlah_urutan']."<br>";
						$ju = $R['jumlah_urutan'];
						$urutan = 0;
						for($a=1;$a<=$ju;$a++)
							{
								UNSET($P); // Tim A
								$P['from'] = "data_perorangan_pool AS A";
								$P['where'] = "A.id_event = '$R[id_event]' AND A.id_kategori_pemain='$R[id_kategori_pemain]' AND A.pool='$R[pool]' AND A.urutan='$a'";
								// $P['echo'] = true;
								$dataS = $this->Model_basic->select($P);
								if($dataS->num_rows())
									{
										$SA = $dataS->row_array();
									}

								for($b=$a+1;$b<=$ju;$b++)
									{
										// echo "$a : $b<br>";

										UNSET($P); // Tim B
										$P['from'] = "data_perorangan_pool AS A";
										$P['where'] = "A.id_event = '$R[id_event]' AND A.id_kategori_pemain='$R[id_kategori_pemain]' AND A.pool='$R[pool]' AND A.urutan='$b'";
										// $P['echo'] = true;
										// $P['die'] = true;
										$dataS = $this->Model_basic->select($P);
										if($dataS->num_rows())
											{
												$SB = $dataS->row_array();
											}

										$urutan++;
										UNSET($P);
										$P['from'] = "data_perorangan_penyisihan";
										$P['values'] = array(
											"id_event" => $R['id_event'],
											"id_kategori_pemain" => $R['id_kategori_pemain'],
											"pool" => $R['pool'],
											"urutan" => $urutan,
											"id_pemain1_tim_A" => $SA['id_pemain1'],
											"id_pemain2_tim_A" => $SA['id_pemain2'],
											"id_pemain1_tim_B" => $SB['id_pemain1'],
											"id_pemain2_tim_B" => $SB['id_pemain2'],
											"is_dharmayukti1_tim_A" => $SA['is_dharmayukti1'],
											"is_dharmayukti2_tim_A" => $SA['is_dharmayukti2'],
											"is_dharmayukti1_tim_B" => $SB['is_dharmayukti1'],
											"is_dharmayukti2_tim_B" => $SB['is_dharmayukti2'],
											"id_keluarga1_tim_A" => $SA['id_keluarga1'],
											"id_keluarga2_tim_A" => $SA['id_keluarga2'],
											"id_keluarga1_tim_B" => $SB['id_keluarga1'],
											"id_keluarga2_tim_B" => $SB['id_keluarga2']
										);
										$P['where'] = array(
											"id_event" => $R['id_event'],
											"id_kategori_pemain" => $R['id_kategori_pemain'],
											"pool" => $R['pool'],
											"urutan" => $urutan
										);
										// $P['echo'] = true;
										$this->Model_basic->insert_cek($P);
										// $this->Model_basic->insert($P);
									}
							}
					}
			}
		echo JSON_ENCODE(array("status" => TRUE));
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function data_pool()
	{
		$konten_menu = $this->load->view("admin/data_pool", NULL, TRUE);
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_pool_rekap()
	{
		$konten_menu = $this->load->view("admin/data_pool_rekap", NULL, TRUE);
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_pool_set_kontingen()
	{
		$status = $this->Model_admin->model_data_pool_set_kontingen($_POST);
		echo JSON_ENCODE(array("status" => $status));
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

	public function data_babak_penyisihan_rekap()
	{
		$konten_menu = $this->load->view("admin/data_babak_penyisihan_rekap", NULL, TRUE);
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_babak_penyisihan_generate()
	{
		$status = $this->Model_admin->model_data_babak_penyisihan_generate($_POST);
		$konten_menu = $this->load->view("admin/data_babak_penyisihan_rekap", NULL, TRUE);
		echo JSON_ENCODE(array("status" => $status, "konten_menu" => $konten_menu));
	}

	public function data_babak_penyisihan_form()
	{
		$konten_menu = $this->load->view("admin/data_babak_penyisihan_form", NULL, TRUE);
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_babak_penyisihan_simpan()
	{
		$status = $this->Model_admin->model_data_babak_penyisihan_simpan($_POST);
		unset($_POST['id_pertandingan']);
		$konten_menu = $this->load->view("admin/data_babak_penyisihan_rekap", NULL, TRUE);
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function tabel_babak_penyisihan()
	{
		$konten_menu = $this->load->view("admin/tabel_babak_penyisihan", NULL, TRUE);
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function tabel_babak_penyisihan_rekap()
	{
		$pool = $this->input->post('pool');
		$konten_menu = '';
		if ($pool != "all")	$konten_menu = $this->load->view("admin/tabel_babak_penyisihan_rekap", NULL, TRUE);
		else {
			$list_pool = $this->Model_admin->get_list_pool();
			foreach ($list_pool->result_array() as $R) {
				$_POST['pool'] = $R['pool'];
				$konten_menu .= $this->load->view("admin/tabel_babak_penyisihan_rekap", NULL, TRUE);
			}
		}
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_skema()
	{
		OB_START();
		$this->load->view("admin/data_skema", NULL);
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_skema_rekap()
	{
		OB_START();
		$this->load->view("admin/data_skema_rekap", NULL);
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_skema_simpan()
	{
		// PRINT_R($_POST);
		$status = $this->Model_admin->model_data_skema_simpan($_POST);
		OB_START();
		$this->load->view("admin/data_skema_rekap", NULL);
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => $status, "konten_menu" => $konten_menu));
	}

	public function data_babak_final()
	{
		OB_START();
		$this->load->view("admin/data_babak_final", NULL);
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_babak_final_form()
	{
		OB_START();
		$this->load->view("admin/data_babak_final_form", NULL);
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}


	public function data_babak_final_generate()
	{
		$this->Model_admin->model_data_babak_final_generate($_POST);
		OB_START();
		$this->load->view("admin/data_babak_final_rekap", NULL);
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	
	public function data_babak_final_rekap()
	{
		OB_START();
		$this->load->view("admin/data_babak_final_rekap", NULL);
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}

	public function data_babak_final_simpan()
	{
		$status = $this->Model_admin->model_data_babak_final_simpan($_POST);
		OB_START();
		$this->load->view("admin/data_babak_final", NULL);
		$konten_menu = ob_get_clean();
		echo JSON_ENCODE(array("status" => $status, "konten_menu" => $konten_menu));
	}

	public function skema_babak_final()
	{
		$konten_menu = $this->load->view("admin/skema_babak_final", NULL, TRUE);
		echo JSON_ENCODE(array("status" => TRUE, "konten_menu" => $konten_menu));
	}


	//Dika aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa

	function kirim_wa($data)
	{
		##SEND WA ##
		$this->load->library('encryption');
		$key = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.e30.6UeJp52ITYbGsfOCWrzUkfyNU2tbmeu6wpKaFqlRlY0';
		$token_key = array('authorization:' . $key);
		$url = 'https://simtepa.badilag.net/api/send_wa';
		$data['cek']	= true;
		$data['app']	= 'PORTAL PTWP PUSAT';

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $token_key);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($ch);
		$err = curl_error($ch);

		curl_close($ch);
	}
	
}
