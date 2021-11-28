<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('database','session','TanggalHelper','form_validation','template','encryption','kunciku');
$autoload['drivers'] = array();
$autoload['helper'] = array('url','html','form','function');

/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['config'] = array('config1', 'config2');
|
| NOTE: This item is intended for use ONLY if you have created custom
| config files.  Otherwise, leave it blank.
|
*/
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array('basic');
