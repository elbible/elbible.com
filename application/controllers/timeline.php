<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TimeLine extends CI_Controller {

 var $data;

 function __construct()
 {
   parent::__construct();
   $this->load->database();
 //  $this->load->model('config_m');
 //  $this->load->helper('url');
   $this->lang->load('elbible');
 }

 public function index()
 {
   $this->timeLine();
 }

 public function timeLine()
 {
	
   $this->output->enable_profiler(FALSE);
   $this->data['title'] = "Social TimeLine";
   $this->load->view('underconstrut_v',$this->data);
 }

 public function _remap($method){
  $this->data['pageTitle'] = "TimeLine :: elBible";
  $this->load->view('header_v',$this->data);
  if (method_exists($this, $method)){
    $this->{"{$method}"}();
  }
 }
}	
