<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Template
{
    var $ci;
    function __construct()
    {
        $this->ci = &get_instance();
        $this->page_title = 'Persatuan Tenis Warga Peradilan (PTWP) Pusat';
        $this->navbar_menu = array();
    }
    function load($tpl_view, $body_view = '', $data = array(), $js_ext = '')
    {
        $data['page_title'] = $this->page_title;
        $data['navbar_menu'] = $this->navbar_menu;


        $data['body'] = ($body_view == '') ? '' : $this->ci->load->view($body_view, $data, TRUE);
        $data['js_ext'] = $js_ext;
        $this->ci->load->view('template/' . $tpl_view, $data);
    }
}
