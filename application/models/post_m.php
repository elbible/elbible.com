<?php if (!defined('BASEPATH')) exit('No direct scprit access allowed');

class Post_m extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
  }


  function setUserSn($userSn){
    $this->userSn = $userSn;
  }
  
  // 페이지 소셜 리스트 가져오기
  function getUserPostList($userSn,  $startCount = 0, $length = 10)
  {
	if ($userSn==null) return -1;
     $sql = "SELECT * FROM post WHERE user_sn ='".$userSn."'  ORDER BY sn desc LIMIT ".$startCount.",".$length.";";
     $query = $this->db->query($sql);
     $result = $query->result();
     return $result;
  }


  // 단일 포스트 정보 가져오기
  function getPost($sn)
  {
	if ($sn==null) return -1;
     $sql = "SELECT * FROM post WHERE sn ='".$sn."';";
     $query = $this->db->query($sql);
     $postInfo = $query->result()[0];
	 $result["postInfo"] = $postInfo;

 	 $user_sn = $postInfo->user_sn;
	 $result["prevSn"]= $this->getPrevSn($user_sn, $sn);
	 $result["postSn"]= $this->getPostSn($user_sn, $sn);

	 if ($postInfo->bible_id != null){
	     $startId = substr($postInfo->bible_id,0,12);
	     $endId = substr($postInfo->bible_id,12,12);		 
	     $sql = "SELECT * FROM BibleSentence WHERE sentenceId BETWEEN '".$startId."' AND '".$endId."';";
		 $query = $this->db->query($sql);

		 $result["setenceList"] = $query->result();
		 $result["title"] = $this->getTitleNameFromBibleId($startId);
 	     $result["startPage"] = sprintf("%d",substr($startId,6,3));
  	     $result["startRow"] = sprintf("%d",substr($startId,9,3));
   	     $result["endRow"] = sprintf("%d",substr($endId,9,3));
	 }
     return $result;
  }

 function getPrevSn($user_sn, $sn)
  {
    $sql = "SELECT sn FROM post WHERE user_sn = '".$user_sn."' AND bible_id > 0 AND sn <'".$sn."' ORDER BY sn desc LIMIT 0,1;";
	$query = $this->db->query($sql);
	$result = $query->result();
	if ($result==null) return null;
    return $result[0]->sn;
  }

  function getPostSn($user_sn, $sn)
  {
    $sql = "SELECT sn FROM post WHERE user_sn = '".$user_sn."' AND bible_id > 0 AND sn >'".$sn."'   ORDER BY sn asc LIMIT 0,1;";
	$query = $this->db->query($sql);
	$result = $query->result();
	if ($result==null) return null;
    return $result[0]->sn;
  }


  // 성경 책명  가져오기
  function getTitleNameFromBibleId($bibleId) {  // bible모델 중복
   if ($bibleId==null) return null;
   $transId = substr($bibleId,0,4);
   $titleId = substr($bibleId,4,2);
   $sql = "SELECT transTitle FROM BibleTransTitle WHERE transId ='".$transId."' AND titleId = '".$titleId."';";
   $query = $this->db->query($sql);
   $result = $query->result();
   return $result[0]->transTitle;
  }

// 삭제


  function remove($userSn, $postSn)
  {
	  if ($userSn == null || $postSn == null) 
		  return -1;

       $sql = "DELETE  FROM post WHERE user_sn ='".$userSn."' AND sn = '".$postSn."';";  
	   return $this->db->query($sql);

  }
 
  // 성경 첨부 포스트 쓰기
  function writeBibleComment($userSn, $bibleId, $comment)
   {
        $this->db->set('user_sn', $userSn);
        $this->db->set('reg_date', 'NOW()', false);
		$this->db->set('comment', $comment);
		$this->db->set('bible_id', $bibleId);			

		$this->db->insert('post');		
        $result = $this->db->insert_id();
        return $result;
   }


   // 일반  포스트 쓰기
   function writeComment($userSn, $regDate, $comment)
   {
        $this->db->set('user_sn', $userSn);
        $this->db->set('reg_date', $regDate);
		$this->db->set('comment', $comment);
		$this->db->insert('post');		
        $result = $this->db->insert_id();
        return $result;
   }

}
