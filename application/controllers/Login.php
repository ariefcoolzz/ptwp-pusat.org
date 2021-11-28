<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Login extends CI_Controller {
		
		public function index()
		{
			$this->load->view('admin/login_v');
		}
		
		public function signin($param=''){
			$this->session->set_flashdata('param', $param);
			$sessid = '';
			while (strlen($sessid) < 32)
			{
				$sessid .= mt_rand(0, mt_getrandmax());
			}
			
			// To make the session ID even more secure we'll combine it with the user's IP
			$sessid .= $this->input->ip_address();
			
			$userName= trim($this->input->post('userName'));
			$password= trim($this->input->post('password'));
			// print_r($password);
			$q = $this->basic->processLogin($userName,kuncidong($password));
			// print_r($q->result_array());die;
			
			$this->form_validation->set_rules('userName', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->form_validation->set_message('required', 'Masukan %s');
			
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('admin/login_v');
				//echo "gagal";
			}
			else if($userName == 'admin' && $password == 'BadilagJaya'){
				redirect('/admin/list_peserta/1');
			}
			else{
				if($q->num_rows()>0)
				{
					$query = $q->result();
					$user = array(
					'nip' => $query[0]->nip,
					'nama' => $query[0]->nama,
					'no_hp' => $query[0]->no_hp,
					'level' => '1',
					'session_id'	=> md5(uniqid($sessid, TRUE)),
					'ip_address'	=> $this->input->ip_address(),
					'user_agent'	=> substr($this->input->user_agent(), 0, 120),
					'last_activity'	=> time(),
					);
					// print_r($user);die;
					$this->session->set_userdata($user);
					
					$level = $this->session->userdata('level');
					
					// print_r($level);die;
					if($level < '10'){ // Admin
						redirect('/dashboard');
					}
					else{
						$this->session->set_flashdata('error_msg', '<div class="alert alert-danger text-center">Maaf Anda tidak memiliki hak akses</div>');
						$this->load->view('admin/login_v');
					}
				}
				else{
					$this->form_validation->set_message('validateUser', 'Username atau password salah');
					$this->session->set_flashdata('error_msg', '<div class="alert alert-danger text-center">Password salah</div>');
					$this->load->view('admin/login_v');
				}
				
			}
		}
		
		public function logout(){
			$this->session->sess_destroy();
			redirect('login');
		}
		
		public function validateUser($userName,$recordCount){
			if ($recordCount != 0){
				return TRUE;
				}else{
				$this->form_validation->set_message('validateUser', 'Username atau password salah');
				return FALSE;
			}
		}
		
		function arr2md5($arrinput){
			$hasil='';
			foreach($arrinput as $val){
				if($hasil==''){
					$hasil=md5($val);
				}
				else {
					$code=md5($val);
					for($hit=0;$hit<min(array(strlen($code),strlen($hasil)));$hit++){
						$hasil[$hit]=chr(ord($hasil[$hit]) ^ ord($code[$hit]));
					}
				}
			}
			return(md5($hasil));
		}
		
		}
		
		/* End of file welcome.php */
	/* Location: ./application/controllers/welcome.php */	