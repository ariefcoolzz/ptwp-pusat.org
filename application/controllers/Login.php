<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function index()
	{
		$data['judul'] = "Halaman Login";
		$this->template->load('ptwp_template', 'admin/login_v', $data);
	}

	public function signin($param = '')
	{
		$data['judul'] = "Halaman Login";
		$this->session->set_flashdata('param', $param);
		$sessid = '';
		while (strlen($sessid) < 32) {
			$sessid .= mt_rand(0, mt_getrandmax());
		}

		// To make the session ID even more secure we'll combine it with the user's IP
		$sessid .= $this->input->ip_address();

		$userName = trim($this->input->post('userName'));
		$password = trim($this->input->post('password'));
		// print_r($userName);
		$q = $this->basic->processLogin($userName, $password);
		// echo "<pre>";
		// print_r($q->result_array());die;

		$this->form_validation->set_rules('userName', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_message('required', 'Masukan %s');

		if ($this->form_validation->run() == FALSE) {
			$this->template->load('ptwp_template', 'admin/login_v', $data);
			//echo "gagal";
		} 
		else {
			if ($q->num_rows() > 0) {
				$query = $q->result();
				$user = array(
					'id_user' => $query[0]->id_user,
					'username' => $query[0]->username,
					'nama' => $query[0]->nama,
					'FotoPegawai' => $query[0]->FotoPegawai,
					'FotoFormal' => $query[0]->FotoFormal,
					'id_panitia' => $query[0]->id_panitia,
					'panitia' => $query[0]->panitia,
					'session_id'	=> md5(uniqid($sessid, TRUE)),
					'ip_address'	=> $this->input->ip_address(),
					'user_agent'	=> substr($this->input->user_agent(), 0, 120),
					'last_activity'	=> time(),
				);
				// print_r($user);die;
				$this->session->set_userdata($user); //Save ke Session
                        $sess = array(
                        'id_user' => $query[0]->id_user,
                        'session_id'	=> md5(uniqid($sessid, TRUE)),
                        'ip_address'	=> $this->input->ip_address(),
                        'last_login'	=> date('Y-m-d H:i:s'),
                        'last_activity'	=> date('Y-m-d H:i:s'),
                        'user_agent'	=> substr($this->input->user_agent(), 0, 120),
                        'uri'	=> base_url().'login',
                        'current_page'	=> base_url().'login',
                        
                        );
				$this->basic->update_log($sess);
				// $level = $this->session->userdata('level');
				redirect('/admin');

			} else {
				$this->form_validation->set_message('validateUser', 'Username atau password salah');
				$this->session->set_flashdata('error_msg', '<div class="alert alert-danger text-center">Password salah</div>');
				$this->template->load('ptwp_template', 'admin/login_v', $data);
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

	public function validateUser($userName, $recordCount)
	{
		if ($recordCount != 0) {
			return TRUE;
		} else {
			$this->form_validation->set_message('validateUser', 'Username atau password salah');
			return FALSE;
		}
	}

	function arr2md5($arrinput)
	{
		$hasil = '';
		foreach ($arrinput as $val) {
			if ($hasil == '') {
				$hasil = md5($val);
			} else {
				$code = md5($val);
				for ($hit = 0; $hit < min(array(strlen($code), strlen($hasil))); $hit++) {
					$hasil[$hit] = chr(ord($hasil[$hit]) ^ ord($code[$hit]));
				}
			}
		}
		return (md5($hasil));
	}
}
