<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['logout'] = 'login/logout';

$route['register'] = 'main/register';
$route['register_get_pegawai'] = 'main/register_get_pegawai';
$route['register_simpan'] = 'main/register_simpan';
