<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Coba extends CI_Controller
{

	public function index()
	{
		$nama = "Dika Andrian Pradana Putra Permana<br>Arief Kusuma Putra";


		$hasil = '';
		$PEMAIN = EXPLODE("<br>", $nama);
		if (COUNT($PEMAIN) >= 0) {
			for ($a = 0; $a < COUNT($PEMAIN); $a++) {

				// $hasil = $PEMAIN[$a];
				$EXP = EXPLODE(" ", $PEMAIN[$a]);
				if (COUNT($EXP) > 0) {
					$hasil .= $EXP[0] . " ";
					for ($i = 1; $i < COUNT($EXP); $i++) {
						$hasil .= SUBSTR($EXP[$i], 0, 1) . ".";
					}
				}
				$hasil .= "<br>";
			}
		}
		echo $hasil;
	}

	public function pass_coba()
	{
		$pass = MD7('admin');
		echo $pass . "<br>";
		$q = $this->basic->processLogin('admin', MD7('admin'));
		print_r($q->result_array());
	}
	public function sessi()
	{
		echo "<pre>";
		// extract($_POST);
		print_r($_SERVER);
	}
	public function replace_string()
	{
		$text 		= 'Kartu ASN Virtual Potrait Belakang (1).png';
		$temp_name 	= preg_replace('/\s+/', '_', $text);
		// $temp_name 	= str_replace("/", " ", $text);
		echo $temp_name;
	}
	public function pecah_pemain()
	{
		$data = $this->basic->get_data_where(array('id_kategori' => 5), 'data_pemain');
		foreach ($data->result_array() as $d) {
			$tim['id_pemain1'] = $d['id_pemain'];
			$tim['kategori'] = 5;
			$this->db->insert('data_tim', $tim);
			// print_r($pem);
		}
		// echo "<pre>";
		// print_r($data->result_array());
	}
	public function pecah_pemain2()
	{
		$data = $this->basic->get_data_where(array('id_kategori' => 7), 'data_pemain');
		$no = 579;
		foreach ($data->result_array() as $d) {
			$pem = explode('/', $d['nama']);
			$tim['id_pemain1'] = $insert['id_pemain'] = $no++;
			$insert['id_kategori'] = 99;
			$insert['satker'] = $d['satker'];
			$insert['nama'] = trim($pem[0]);
			$this->db->insert('data_pemain', $insert);
			$tim['id_pemain2'] = $insert['id_pemain'] = $no++;
			$insert['nama'] = trim($pem[1]);
			$this->db->insert('data_pemain', $insert);
			$tim['kategori'] = 7;
			$this->db->insert('data_tim', $tim);
			// print_r($pem);
		}
		// echo "<pre>";
		// print_r($data->result_array());
	}
	public function pecah_pool()
	{
		$char = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
		$data = $this->basic->get_data('data_dami');
		$no = 0;
		foreach ($data->result_array() as $d) {
			if (trim($d['nama']) !== 'NAME') {
				$pool = strtoupper($char[$no]);

				$pec = explode('(', $d['nama']);
				$pec2 = explode('/', $pec[0]);
				$pem1 = trim($pec2[0]);
				$data = $this->db->query("SELECT *, NAMA_PEMAIN(id_pemain1) AS pemain1, NAMA_PEMAIN(id_pemain2) AS pemain2
						FROM data_tim AS A
						WHERE NAMA_PEMAIN(id_pemain1) = '$pem1'")->row_array();
				echo $pool . '-' . $pem1 . '-' . $data['id_tim'] . '<br>';
			} else {
				$no++;
			}
		}
		// echo "<pre>";
		// print_r($data->result_array());
	}
	public function last_query()
	{
		print($this->db->last_query());
	}
	public function print_session()
	{
		echo '<pre>';
		print_r($_SESSION);
		echo '</pre>';
		die();
	}
	public function tes_ku()
	{
		$id_event = 92;
		$this->load->model('Model_admin');
		$new_array = array();
		$list_kontingen = $this->Model_admin->get_list_kontingen_perorangan($id_event);
		foreach ($list_kontingen->result_array() as $R) {
			$id_kontingen = $R['id_kontingen'];
			$new_array[$id_kontingen] = $R;
			$new_array[$id_kontingen][1] = $R['total_official'];
			$new_array[$id_kontingen][2] = $R['total_peserta_konggres'];
			$kategori = $this->Model_admin->get_kategori_pemain($id_event);
			foreach ($kategori->result_array() as $D) {
				$id_kategori = $D['id_kategori'];
				$new_array[$id_kontingen][$id_kategori] = 0;
			}
		}
		$all_pemain = $this->Model_admin->get_list_pemain_all($id_event);

		foreach ($all_pemain->result_array() as $D) {
			$id_kontingen = $D['id_kontingen'];
			$id_kategori = $D['id_kategori'];
			$new_array[$id_kontingen][$id_kategori]++;
		}
		echo '<pre>';
		print_r($new_array);
		echo '</pre>';
		die();
	}
}
