<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Diary extends CI_Controller {
  var $defaultLanguage = 'korean';
  var $data = null;

 function __construct()
 {
   parent::__construct();

   $this->load->database();     
   $this->load->model('bible_m');
   $this->load->model('post_m');
   $this->setLang(); // 언어 설정
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


 public function index()
 {
   $this->diary();
 }

 public function diary()
 {
    $this->output->enable_profiler(FALSE);
	$startPos = 0;
	$endPos = 30;
    if(!$this->session->userdata('is_login')){
        $this->load->helper('url');
        redirect('/auth/login?returnURL='.rawurlencode(site_url('/diary/')));
    }

	$this->data['user'] = $this->session->userdata('elbible_user_info');
	
	$this->data['postList'] = $this->post_m->getUserPostList($this->data['user']->sn, $startPos, $endPos);
  

    foreach($this->data['postList']  as $post){
	   if ($post->bible_id!=null){
		   	$startId = substr($post->bible_id,0,12);
		    $startIdArray = $this->bible_m->getIdArrayFromSentenceId($startId);			
			$post->start_title = $this->bible_m->getTitleName($startIdArray["transId"], $startIdArray["titleId"]);
			$post->start_page = $startIdArray["page"];
			$post->start_row =  $startIdArray["row"];
			$endId = substr($post->bible_id,12,12);
		    $endIdArray = $this->bible_m->getIdArrayFromSentenceId($endId);			
			$post->end_title = $this->bible_m->getTitleName($endIdArray["transId"], $endIdArray["titleId"]);
			$post->end_page = $endIdArray["page"];
			$post->end_row =  $endIdArray["row"];
		    $endIdArray = $this->bible_m->getIdArrayFromSentenceId($startId);
			$post->sentence_list = $this->bible_m->getBibleAreaSentencesFromId($post->bible_id);
	   }
     }

    $this->data['strPageUnit'] = $this->lang->line('UnitPage');
    $this->data['strRowUnit'] = $this->lang->line('UnitRow');

    $this->load->view('diary/list_v', $this->data);
 }

 public function _remap($method){
  $this->data['pageTitle'] = "Diary :: elBible";
  $this->load->view('header_v',$this->data);
  if (method_exists($this, $method)){
    $this->{"{$method}"}();
  }
 }
}	
