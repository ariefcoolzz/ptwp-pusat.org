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
		$this->template->load('score_template', 'score/score_rekap');
		// $this->load->view("score/index");
	}

	// public function score_rekap()
	// {
	// 	$this->load->view("score/score_rekap");
	// }

	public function manage($jenis,$key)
	{
		// PRINT_R($_POST);DIE();
		if (!IN_ARRAY($jenis, array("penyisihan", "final"))) die("Maaf... Kategori ini tidak valid");

		$data['jenis'] 	= $jenis;
		$data['key'] 	= $key;
		
		$this->load->view("score/score_manage", $data);
	}

	public function manage_set()
	{
		// PRINT_R($_POST);DIE();
		$function_model = "score_rekap_" . $_POST['jenis'];
		$data = $this->Model_score->$function_model($_POST['key']);
		$data = $data->row_array();
		// PRINT_R($data->row_array());DIE();
		$ARRAY["game_tim_A"] = $data["set" . $_POST['set'] . "_tim_A"];
		$ARRAY["game_tim_B"] = $data["set" . $_POST['set'] . "_tim_B"];
		echo JSON_ENCODE($ARRAY);
	}

	public function manage_point()
	{
		// PRINT_R($_POST);DIE();
		$data = $this->Model_score->score_point_detail($_POST);
		IF(!$data->num_rows())
			{
				$ARRAY["point_tim_A"] = 0;
				$ARRAY["point_tim_B"] = 0;
			}
		ELSE 
			{
				$data = $data->row_array();
				// PRINT_R($data->row_array());DIE();
				$ARRAY["point_tim_A"] = $data["point_tim_A"];
				$ARRAY["point_tim_B"] = $data["point_tim_B"];
			}
		echo JSON_ENCODE($ARRAY);
	}

	public function manage_tombol_game()
	{
		// PRINT_R($_POST);DIE();

		$status = $this->Model_score->manage_tombol_game($_POST);

		$function_model = "score_rekap_" . $_POST['jenis'];
		$data = $this->Model_score->$function_model($_POST['key']);
		$data = $data->row_array();
		// PRINT_R($data->row_array());DIE();

		$ARRAY['status'] 		= $status;
		$ARRAY["game_tim_A"] 	= $data["set" . $_POST['set'] . "_tim_A"];
		$ARRAY["game_tim_B"] 	= $data["set" . $_POST['set'] . "_tim_B"];

		echo JSON_ENCODE($ARRAY);
	}

	public function manage_tombol_point()
	{
		// PRINT_R($_POST);DIE();

		$status = $this->Model_score->manage_tombol_point($_POST);

		$data = $this->Model_score->score_point_detail($_POST);
		$data = $data->row_array();
		// PRINT_R($data->row_array());DIE();

		$ARRAY['status'] 		= $status;
		$ARRAY["point_tim_A"] 	= $data["point_tim_A"];
		$ARRAY["point_tim_B"] 	= $data["point_tim_B"];

		echo JSON_ENCODE($ARRAY);
	}
	
	public function share($jenis,$key)
	{
		// PRINT_R($_POST);DIE();
		if (!IN_ARRAY($jenis, array("penyisihan", "final"))) die("Maaf... Kategori ini tidak valid");

		$data['jenis'] 	= $jenis;
		$data['key'] 	= $key;
		
		$this->load->view("score/score_share", $data);
	
	}
	
	public function score_get()
	{
		// PRINT_R($_POST);DIE();

		//BUAT GET GAME
		$data = $this->Model_score->get_game($_POST['jenis'], $_POST['key']);
		$data = $data->row_array();
		// PRINT_R($data->row_array());DIE();
		$ARRAY["set1_tim_A"] = $data["set1_tim_A"];
		$ARRAY["set1_tim_B"] = $data["set1_tim_B"];
		$ARRAY["set2_tim_A"] = $data["set2_tim_A"];
		$ARRAY["set2_tim_B"] = $data["set2_tim_B"];
		$ARRAY["set3_tim_A"] = $data["set3_tim_A"];
		$ARRAY["set3_tim_B"] = $data["set3_tim_B"];

		//BUAT GET POINT, GAME YANG TERAKHIR
		$data = $this->Model_score->get_point($_POST['jenis'], $_POST['key']);
		$data = $data->row_array();

		$ARRAY["point_tim_A"] = $data["point_tim_A"];
		$ARRAY["point_tim_B"] = $data["point_tim_B"];

		echo JSON_ENCODE($ARRAY);
	}
}
