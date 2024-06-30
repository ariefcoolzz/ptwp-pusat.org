<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Feeds extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_main');
        // $this->sesi = '28';
        // $this->hari = '3';
        // $this->basic->squrity();
        $this->load->helper('xml');
        $this->load->helper('text');
    }
    public function index()
    {
        show_404();
    }
    public function berita_pusat()
    {
        $data['feed_name'] = 'Berita PTWP Pusat';
        $data['encoding'] = 'utf-8';
        $data['feed_url'] = 'https://ptwp-pusat.org/feeds/berita_pusat';
        $data['page_description'] = 'Berita Seputar PTWP PUSAT.';
        $data['page_language'] = 'id-id';
        $data['creator_email'] = 'admin@ptwp-pusat.org';
        $data['posts'] = $this->Model_main->get_data_konten_list('1','30');
        // echo '<pre>';
        // print_r($data['posts']->result_array());
        // echo '</pre>';
        // die();
        $this->load->view('rss', $data);
    }
    public function berita_daerah()
    {
        $data['feed_name'] = 'Berita PTWP Daerah';
        $data['encoding'] = 'utf-8';
        $data['feed_url'] = 'https://ptwp-pusat.org/feeds/berita_daerah';
        $data['page_description'] = 'Berita Seputar PTWP Daerah.';
        $data['page_language'] = 'id-id';
        $data['creator_email'] = 'admin@ptwp-pusat.org';
        $data['posts'] = $this->Model_main->get_data_konten_list('3','30');
        // echo '<pre>';
        // print_r($data['posts']->result_array());
        // echo '</pre>';
        // die();
        $this->load->view('rss', $data);
    }
}
