<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Score extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_score');
		// $this->basic->squrity();
	}

	public function index()
	{
		$this->load->view("score/index");
	}
	
	public function score_rekap()
	{
		$this->load->view("score/score_rekap");
	}
	
	public function manage()
	{
		// PRINT_R($_POST);DIE();
		IF(!IN_ARRAY($_POST['jenis'], ARRAY("penyisihan","final"))) DIE("Maaf... Kategori ini tidak valid");
		
		OB_START();
		$this->load->view("score/score_manage", $_POST);
		$konten = ob_get_clean();
		
		echo JSON_ENCODE(array("konten" => $konten));
	}
	
	public function manage_set()
	{
		// PRINT_R($_POST);DIE();
		$function_model = "score_rekap_".$_POST['jenis'];
		$data = $this->Model_score->$function_model($_POST['key']);
		$data = $data->row_array();
		// PRINT_R($data->row_array());DIE();
		$ARRAY["game_tim_A"] = $data["set".$_POST['set']."_tim_A"];
		$ARRAY["game_tim_B"] = $data["set".$_POST['set']."_tim_B"];
		echo JSON_ENCODE($ARRAY);
	}
	
	public function manage_tombol()
	{
		// PRINT_R($_POST);DIE();
		
		$status = $this->Model_score->manage_tombol($_POST);
		
		$function_model = "score_rekap_".$_POST['jenis'];
		$data = $this->Model_score->$function_model($_POST['key']);
		$data = $data->row_array();
		// PRINT_R($data->row_array());DIE();
		
		$ARRAY['status'] 		= $status;
		$ARRAY["game_tim_A"] 	= $data["set".$_POST['set']."_tim_A"];
		$ARRAY["game_tim_B"] 	= $data["set".$_POST['set']."_tim_B"];
		
		echo JSON_ENCODE($ARRAY);
	}


}
