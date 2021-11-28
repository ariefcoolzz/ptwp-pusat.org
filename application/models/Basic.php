<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Basic extends CI_Model {
		public function __construct(){
			parent::__construct();
			// $this->dbganis = $this->load->database("dbganis",TRUE); //Load Database SIPP
		}
		
		function connecting_test($servername,$username,$password,$dbname){
			try{
				$conn = new mysqli($servername, $username, $password);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 
				return "Koneksi Berhasil";
			}
			catch (Exception $e){
				return false;
				log_message('error', $e);
			}
		}
		public function processLogin($userName=NULL,$password){
			$whereCondition = $array = array('nip' =>$userName,'password'=>$password);
			$this->db->where($whereCondition);
			$this->db->from('tbl_peserta_bimtek');
			$query = $this->db->get();
			return $query;
		}
		public function processLogin_pelayanan($userName=NULL,$password){
			$whereCondition = $array = array('username' =>$userName,'pass'=>$password);
			$this->db->where($whereCondition);
			$this->db->from('tbl_user');
			$query = $this->db->get();
			return $query;
		}
		public function squrity(){
			$userName = $this->session->userdata('userid');
			if(empty($userName)){
				$this->session->sess_destroy();
				redirect('login');
			}
		}
		public function squrity_pelayanan(){
			$userName = $this->session->userdata('id_user');
			if(empty($userName)){
				$this->session->sess_destroy();
				redirect('pelayanan/login');
			}
		}
		function get_data($table){
			try{
				$query = $this->db->get($table); 
				return $query;
				}catch (Exception $e){
				return false;
				//log_message('error', $e);
			}		
		}				
		function get_data_where($whereconditon,$table){
			$this->db->where($whereconditon);
			$query = $this->db->get($table); 
			return $query;
		}
		public function insert_data($tableName,$data){
			$res=$this->db->insert($tableName,$data);
			return $res;
		}
		public function update_data($whereconditon,$tableName,$data){
			$this->db->where($whereconditon);
			$res=$this->db->update($tableName, $data);
			return $res;
		}
		public function delete_data($whereconditon,$tableName){
			$this->db->where($whereconditon);
			$res=$this->db->delete($tableName);
			return $res;
		}	
		public function get_config(){
			$q=$this->db->query("SELECT * FROM tbl_config where hidden = '0'");
			$data=array();
			foreach ($q->result_array() as $d){
				$kd = $d['kd'];
				$data[$kd] = $d['value'];
			}
			return $data;
		}
		
		function menu_parent(){
			try{
				$sql = "SELECT *, (SELECT COUNT(*) FROM keu_menus WHERE parent_id = A.id) AS child FROM keu_menus A WHERE parent_id IS NULL ORDER BY ordering";
				$query=$this->db->query($sql);
				return $query;
				}catch (Exception $e){
				return false;
				log_message('error', $e);
			}
		}
		function menu_child(){
			try{
				$sql = "SELECT * FROM keu_menus A WHERE parent_id IS NOT NULL ORDER BY parent_id,ordering";
				$query=$this->db->query($sql);
				return $query;
				}catch (Exception $e){
				return false;
				log_message('error', $e);
			}
		}
		
		function set_petugas($nip,$petugas){
			try{
				$sql = "UPDATE `tbl_peserta_bimtek` SET `petugas_registrasi` = '0' , `proses_registrasi` = '0' WHERE `petugas_registrasi` = '$petugas'";
				$query=$this->db->query($sql);
				$sql = "UPDATE `tbl_peserta_bimtek` SET `petugas_registrasi` = '$petugas' , `proses_registrasi` = '1' WHERE `nip` = '$nip'";
				$query=$this->db->query($sql);
				return $query;
				}catch (Exception $e){
				return false;
				log_message('error', $e);
			}
		}
		function clear_petugas($petugas){
			try{
				$sql = "UPDATE `tbl_peserta_bimtek` SET `petugas_registrasi` = '0' , `proses_registrasi` = '0' WHERE `petugas_registrasi` = '$petugas'";
				$query=$this->db->query($sql);
				return $query;
				}catch (Exception $e){
				return false;
				log_message('error', $e);
			}
		}
		function update_no_hp($nip,$no_hp){
			try{
				$sql = "UPDATE `tbl_peserta_bimtek` SET `no_hp` = '$no_hp' WHERE `nip` = '$nip'";
				$query=$this->db->query($sql);
				return $query;
				}catch (Exception $e){
				return false;
				log_message('error', $e);
			}
		}
		function update_no_email($nip,$email){
			try{
				$sql = "UPDATE `tbl_peserta_bimtek` SET `email` = '$email' WHERE `nip` = '$nip'";
				$query=$this->db->query($sql);
				return $query;
				}catch (Exception $e){
				return false;
				log_message('error', $e);
			}
		}
		function update_status($nip){
			try{
				$sql = "UPDATE `tbl_peserta_bimtek` SET `status` = '1' WHERE `nip` = '$nip'";
				$query=$this->db->query($sql);
				return $query;
				}catch (Exception $e){
				return false;
				log_message('error', $e);
			}
		}
		function template_model(){
			try{
				$sql = "    ";
				$query=$this->db->query($sql);
				return $query;
				}catch (Exception $e){
				return false;
				log_message('error', $e);
			}
		}
	}
