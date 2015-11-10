<?php
if (!defined('BASEPATH'))
 	exit('No direct script access allowed');

class More extends CI_Controller {
	var $setTransId = null;
 	var $setLang = null;
	var $data = null;

 	function __construct() {
		parent::__construct();
 		$this->load->database();
    $this->load->model('bible_m');
	}

 	public function index() {
		$this->setTransId = substr($_COOKIE["lastElBibleId"],0,4);
		$this->lang->load('elbible',$_COOKIE["elBibleLang"]);
		$this->setLang = $_COOKIE["elBibleLang"];
 		$this->gridList();
 	}

	public function setTransId() {
 		$this->setTransId = $this->uri->segment(3);
 		$newLastElBibleId = $this->setTransId.substr($_COOKIE["lastElBibleId"],4,12); 
 		setcookie("lastElBibleId", $newLastElBibleId , time() + 3153600, "/");
   	$this->setLang = $_COOKIE["elBibleLang"];
 	  $this->gridList();
	}

	public function setLanguage() {
 		$this->setLang = $this->uri->segment(3);
 		setcookie("elBibleLang", $this->setLang, time() + 3153600, "/");
		$this->setTransId = substr($_COOKIE["lastElBibleId"],0,4);
  	$this->gridList();
	}

 	public function gridList() {
		$this->lang->load('elbible',$this->setLang);
		$this->output->enable_profiler(FALSE);
 		$this->data['strSetting'] = $this->lang->line('Setting');
 		$this->data['strLanguage'] = $this->lang->line('Language');
 		$this->data['strTransBook'] = $this->lang->line('TransBook');
 		$this->data['strAboutTitle'] = $this->lang->line('AboutTitle');
 		$this->data['strNotice'] = $this->lang->line('Notice');
 		$this->data['strClose'] = $this->lang->line('Close');
 		$this->data['strSetLanguage'] = $this->lang->line('SetLanguage');
 		$this->data['strAboutNDonation'] = $this->lang->line('AboutNDonation');
		$this->data['strSetTranslationBook'] = $this->lang->line('SetTranslationBook');
    $this->data['transList'] = $this->bible_m-> getTransBookList();
 		$this->data['transTitle'] = $this->bible_m->getTransName($this->setTransId);
		$this->data['lang'] = $this->getLangName($this->setLang);
		
		if(!$this->session->userdata('is_login')){
		
			$this->data['loginChangeURL'] = "/auth/login?returnURL=/more/";
			$this->data['strLoginChage'] = $this->lang->line('login');

		}else{
				$this->data['loginChangeURL'] = "/auth/logout/";
			$this->data['strLoginChage'] = $this->lang->line('logout');		}


 		$this->load->view('more/gridList_v',$this->data);
 	}

	
 	public function aboutNDonation() {
		$this->setTransId = substr($_COOKIE["lastElBibleId"],0,4);
		$this->lang->load('elbible',$_COOKIE["elBibleLang"]);
		$this->setLang = $_COOKIE["elBibleLang"];
 		$this->load->view('more/aboutNDoation_v');
 	}


 	public function _remap($method) {
   	    $this->data['pageTitle'] = "More :: elBible";
 		$this->load->view('header_v',$this->data);
 		if (method_exists($this, $method)) {
 			$this-> {
"{$method}"			}
();
 		}
	}
 
 	public function getLangname($lang) {
 		if (strcmp($lang,"korean")==0) {
 			return "한국어";
 		}
 
 return "English";
 
 	}

 	public function getTransBookName($transBookId) {
		switch ($transBookId) {
			case 1001 :return "King James Bible";
			case 1002 :
				return "개역개정";
			case 1003 :
				return "새번역";
				default:
					return null;
				}
 		}
	}