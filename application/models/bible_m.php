<?php if (!defined('BASEPATH')) exit('No direct scprit access allowed');

class Bible_m extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
  }


  function setTransId($transId){
    $this->transId = $transId;
  }
  

  // 24자리 ID로 구절 리스트 가져오기
  function getBibleAreaSentencesFromId($bibleAreaId){
	   if (strlen($bibleAreaId)!=24){
		   return null;
	   }

   $startId = substr($bibleAreaId,0,12);
   $endId = substr($bibleAreaId,12,12);

   $sql = "SELECT * FROM BibleSentence WHERE sentenceId BETWEEN '".$startId."' AND '".$endId."';";

   $query = $this->db->query($sql);
   $result = $query->result();
   return $result;

  }

  // 페이지 구절 리스트 가져오기
  function getPage($transId,$titleId,$page)
  {
   $startId = $this->getSentenceId($transId, $titleId, $page);
   $endId = $this->getSentenceId($transId, $titleId, $page+1);

   $sql = "SELECT * FROM BibleSentence WHERE sentenceId BETWEEN '".$startId."' AND '".$endId."';";

   $query = $this->db->query($sql);
   $result = $query->result();
   
   return $result;
  }
 
  // 다음 페이지 가져오기
  function getNextPage($transId,$titleId,$page)
  {
   $nextPageId = $this->getSentenceId($transId, $titleId, $page+1);
   
   $sql = "SELECT count(*) as count FROM BibleSentence WHERE sentenceId = '".($nextPageId+1)."';";
   $query = $this->db->query($sql);
   $result = $query->result();
   if ($result[0]->count==1) return $nextPageId;
   if ($titleId == 66) return null;
   return $this->getSentenceId($transId, $titleId+1,1);

  }

  // 번역본 리스트  
  function getTransBookList() {
   $sql = "SELECT transId, langId, description FROM BibleTrans;";
   $query = $this->db->query($sql);
   $result = $query->result();
   
   return $result;
  }

  // 성경 책명  가져오기
  function getTitleNames($transId, $orderBy) {
   if ($transId==null) return null;
   if ($orderBy=="word"){
  	   $sql = "SELECT transTitle,titleId FROM BibleTransTitle WHERE transId ='".$transId."' order by transTitle asc;";
   }else{
   	   $sql = "SELECT transTitle,titleId FROM BibleTransTitle WHERE transId ='".$transId."' order by titleId asc;";
   }
   $query = $this->db->query($sql);
   $result = $query->result();
   return $result;
  }

  // 성경 책명  가져오기
  function getTitleNameFromBibleId($bibleId) {
   if ($bibleId==null) return null;
   $transId = substr($bibleId,0,4);
   $titleId = substr($bibleId,4,2);
   $sql = "SELECT transTitle FROM BibleTransTitle WHERE transId ='".$transId."' AND titleId = '".$titleId."';";
   $query = $this->db->query($sql);
   $result = $query->result();
   return $result[0]->transTitle;
  }


  // 성경 책명  가져오기
  function getTitleName($transId, $titleId) {
   if ($transId==null || $titleId == null) return null;
   $sql = "SELECT transTitle FROM BibleTransTitle WHERE transId ='".$transId."' AND titleId = '".$titleId."';";
   $query = $this->db->query($sql);
   $result = $query->result();
   return $result[0]->transTitle;
  }

  // 성경 번역명 가져오기
  function getTransName($transId){
   if ($transId==null) return null;
   $sql = "SELECT description FROM BibleTrans WHERE transId = '".$transId."';";
   $query = $this->db->query($sql);
   $result = $query->result();
   return $result[0]->description;

  }

  function getIdArrayFromSentenceId($sentenceId){
    if ($sentenceId == null || strlen($sentenceId) != 12) return null;
    $idArray = array();
    $idArray["transId"] = substr($sentenceId,0,4);
    $idArray["titleId"] = substr($sentenceId,4,2);
    $idArray["page"] = sprintf("%d",substr($sentenceId,6,3));
    $idArray["row"] = sprintf("%d",substr($sentenceId,9,3));
    return $idArray;
  }

  // 번역id, 타이틀id, 장, 절을 구절id 로 변경
  function getSentenceId($transId, $titleId, $page=0, $row=0){
    if ($transId == null || $titleId == null) return null;
    
    return (($transId * 100000000) + ($titleId * 1000000) + ($page * 1000) + $row);
  }
}
