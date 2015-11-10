<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Post extends CI_Controller {
  var $defaultLanguage = 'korean';

 function __construct()
 {
   parent::__construct();
   $this->load->database();     
   $this->load->model('bible_m');
   $this->load->model('post_m');
   $this->load->helper('url');
   $this->setLang(); // 언어 설정

	 
 }

 public function index()
 {
   $this->view();
 }

 public function checkAuth()
 {
	 if(!$this->session->userdata('is_login')){
        redirect('/auth/login?returnURL='.rawurlencode(site_url('/diary/')));
    }
 }

 public function view()
 {
    $this->output->enable_profiler(FALSE);
    $data=null;

	$this->load->view('post/view_v', $data);
 }


 public function slide()
 {
    $this->output->enable_profiler(FALSE);
    $postSn = $this->uri->segment(3);
	$data = $this->post_m->getPost($postSn);

	$this->load->view('post/slide_v', $data);
 }



 public function setLang()   // 언어 설정
 { 
    $elBibleLang = null;
  
     if (!isset($_COOKIE["elBibleLang"])) {
        $elBibleLang = $this->defaultLanguage;
        setcookie("elBibleLang", $elBibleLang, time() + 3153600, "/");
     }else{
         $elBibleLang = $_COOKIE["elBibleLang"];
     }
     $this->lang->load('elbible',$elBibleLang);
 }


public function write()
{
	$comment = $this->input->post('comment');
	$bibleId = $this->input->post('bible_id');
	$regDate = $this->input->post('reg_date');
	$user_info = $this->session->userdata('elbible_user_info');
	if ($user_info == null) {
		echo("error");
		return -1;
	}

	if ($bibleId != null){
		$return = $this->post_m->writeBibleComment($user_info->sn, $bibleId, $comment);
		redirect('/diary/');
	}
	else {
		$regDate = $regDate.":00";
		$return = $this->post_m->writeComment($user_info->sn, $regDate, $comment);
		redirect('/diary/');
	}
}



 public function remove()
 {
	$user_info = $this->session->userdata('elbible_user_info');
	if ($user_info == null) {
		echo("error");
		return -1;
	}

    $sn = $this->uri->segment(3);


	if ($sn != null){
		$this->post_m->remove($user_info->sn, $sn);
		redirect('/diary/');
	}
	else {
		redirect('/diary/');
	}
 }


 public function writeform()
 {
   $this->output->enable_profiler(FALSE);
   $this->checkAuth();

   $pageStrParam = $this->uri->segment(3);
   $paramLen = strlen($pageStrParam);
   $data["none_message"] = $this->lang->line('WritePostContents');
   $data["writeMode"] = "None";
   $data["dateTime"] = date("Y-m-d H:i");
   if($paramLen == 24) {
	   $minId = substr($pageStrParam,0,12);
	   $maxId = substr($pageStrParam,12,12);
	   $transId = substr($pageStrParam,0,4);
	   $titleId = substr($pageStrParam,4,2);
	   $data["writeMode"] = "BibleComment";
	   $data["titleName"] = $this->bible_m->getTitleName($transId,  $titleId);
	   $data["bibleId"]=$pageStrParam;
	   $data["minPage"] = sprintf("%d",substr($minId,6,3));
	   $data["minRow"] = sprintf("%d",substr($minId,9,3));
	   $data["maxPage"] = sprintf("%d",substr($maxId,6,3));
	   $data["maxRow"] = sprintf("%d",substr($maxId,9,3));
	   $data['strPageUnit'] = $this->lang->line('UnitPage');
	   $data['strRowUnit'] = $this->lang->line('UnitRow');
  }
  $this->load->view('post/writeform_v', $data);
 }


public function like()
{
   $this->output->enable_profiler(FALSE);
   $this->checkAuth();

   $pageStrParam = $this->uri->segment(3);
   $paramLen = strlen($pageStrParam);  
   
   if($paramLen == 24) {
	$bibleId = $pageStrParam;
	$regDate = $data["dateTime"] = date("Y-m-d H:i");
	$user_info = $this->session->userdata('elbible_user_info');
    $minId = substr($pageStrParam,0,12);
    $maxId = substr($pageStrParam,12,12);
    $transId = substr($pageStrParam,0,4);
    $titleId = substr($pageStrParam,4,2);
    $data["writeMode"] = "BibleComment";
    $data["titleName"] = $this->bible_m->getTitleName($transId,  $titleId);
    $data["bibleId"]=$pageStrParam;
    $data["minPage"] = sprintf("%d",substr($minId,6,3));
    $data["minRow"] = sprintf("%d",substr($minId,9,3));
    $data["maxPage"] = sprintf("%d",substr($maxId,6,3));
    $data["maxRow"] = sprintf("%d",substr($maxId,9,3));
    $data['strPageUnit'] = $this->lang->line('UnitPage');
    $data['strRowUnit'] = $this->lang->line('UnitRow');

	$return = $this->post_m->writeBibleComment($user_info->sn, $bibleId,null);
   }
   $this->load->view('post/like_v', $data);
}

 public function _remap($method){
  $this->load->view('post/header_v');
  if (method_exists($this, $method)){
    $this->{"{$method}"}();
  }
 }
}	
