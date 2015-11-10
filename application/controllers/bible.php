<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Bible extends CI_Controller {

#1002 : serise of book 
#01 : a book
#001 : chapter
#000 : paragraph
 var $defaultPageId =  '100201001000';

 var $defaultLanguage = 'korean';
 var $data;

# page counts of paragraph of book
 var $pageCounts = array( 50,40,27,36,34,24,21,4,31,24,22,25,29,36,10,13,10,42,150,31,12,8,66,52,5,48,12,14,3,9,1,4,7,3,3,3,2,14,4,28,16,24,21,28,16,16,13,6,6,4,4,5,3,6,4,3,1,13,5,5,3,5,1,1,1,22);

 function __construct()
 {
   parent::__construct();
   $this->load->database();
   $this->load->model('bible_m');  // ���� ��
   $this->load->helper('url');   
   $this->setLang(); // ��� ����
   $this->setPageInfo(); // ���������� ���
 }

 public function setLang()   // ��� ����
 { 
    $elBibleLang = null;
  
     // ������ ��Ű���� �ҷ�����, ��Ű�� ���°��, �⺻�� �ҷ�����, 1�Ⱓ ������
     if (!isset($_COOKIE["elBibleLang"])) {
        $elBibleLang = $this->defaultLanguage;
        setcookie("elBibleLang", $elBibleLang, time() + 3153600, "/");  
     }else{
         $elBibleLang = $_COOKIE["elBibleLang"];
     }
     $this->lang->load('elbible',$elBibleLang);
 }

public function setPageInfo()
{
	  //12�ڸ�ID�� �����ϰ� �ִ��� Ȯ��, ������ �⺻ID
	  $pageStrParam = $this->uri->segment(3);
      if(strlen($pageStrParam) == 12) {
           $pageId = $pageStrParam;
      }else if (isset($_COOKIE["lastElBibleId"])) {
   	      $pageId =$_COOKIE["lastElBibleId"];
      }else{       
		 $pageId = $this->defaultPageId;
      }
      setcookie("lastElBibleId", $pageId, time() + 3153600, "/");
	  $this->pageId = $pageId;
    
	 $idArray = $this->bible_m->getIdArrayFromSentenceId($this->pageId);
	 
	 if (!isset($_COOKIE["BookOrder"])) {
		  $orderBy = "origin";
	      setcookie("BookOrder",$orderBy, time() + 3153600, "/");
	 }else{
			  $orderBy = $_COOKIE["BookOrder"];
	  }
   $this->data['orderBy'] = $orderBy;  
   $this->data['titles'] = $this->bible_m->getTitleNames($idArray["transId"],$orderBy);
   $this->data['transName'] = $this->bible_m->getTransName($idArray["transId"]); 
   $titleId = $idArray["titleId"];
   $this->data['idArray'] = $idArray;
   $titleIdx = $titleId -1;
   $titleName = $this->getTitleNameFromTitles($this->data['titles'],$titleId);
   $this->data['titleName'] = $titleName;
   $this->data['pageCount']=$this->pageCounts[$titleIdx];
   $this->data['pageCounts']=$this->pageCounts;
   $this->data['pageId'] =  $this->pageId;
   $pageNum = $idArray["page"]+0;
   $this->data['page'] =  $pageNum ;
   $this->data['pageList'] = $this->bible_m->getPage($idArray["transId"], $idArray["titleId"], $idArray["page"]);
   $this->data['nextPageId'] = $this->bible_m->getNextPage($idArray["transId"], $idArray["titleId"], $idArray["page"]);

   $this->data['strPageUnit'] = $this->lang->line('UnitPage');
   $this->data['strOrderOrigin'] = $this->lang->line('orderOrigin');
   $this->data['strOrderWord'] = $this->lang->line('orderWord');
   $this->data['strSelectBook'] = $this->lang->line('SelectBook');
   $this->data['strSelectPage'] = $this->lang->line('SelectPage');
   $this->data['strClose'] = $this->lang->line('Close');
   
   if(strlen($pageStrParam) == 12){
	   $this->data['pageTitle'] = $titleName." ".$pageNum.$this->lang->line('UnitPage')." : ".$this->data['transName']." : elBible";
   }else{
	   $this->data['pageTitle'] = "Bible :: elBible";
   }
}

 public function index()
 {
   $this->page();
 }

 public function page()
 {
   $this->output->enable_profiler(FALSE);	

  
   $this->load->view('bible/page_v',$this->data);
 }

 public function getTitleNameFromTitles($titles,$titleId){
	 foreach($titles as $lt){
	   if ($lt->titleId==$titleId){
			return $lt->transTitle;
	   }
   }
 }
 public function _remap($method){
  $this->load->view('header_v',$this->data);
  if (method_exists($this, $method)){
  $this->{"{$method}"}();
  }
 }
}	
