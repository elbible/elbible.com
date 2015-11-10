<?php

// first file is txt file as bible txt format
// output file is add .sql extends query file

$srcFile=fopen($argv[1],"r");
$dstFile=fopen($argv[1].".sql","w");

$limit=-1;
$count=0;
while(!feof($srcFile)){
 $inString=fgets($srcFile,1024);
 switch($count)
 {
  case 0 :
  	$splitStr = split(",",$inString);
  	$outString = "insert into onthebible.BibleTrans (transId, langId, description) values ( '".$splitStr[0]."', '".$splitStr[1]."', '".$splitStr[2]."');\n";
        $transId=$splitStr[0];
	break;
  case 1 :
       $splitStr = split(",",$inString);
       for($i=0; $i<count($splitStr); $i++){
	$outString = $outString."insert into onthebible.BibleTransTitle (transId ,TitleId, TransTitle) values ('".$transId."', ".($i+1).", '".$splitStr[$i]."');\n";
       }	
       break;
  default :
       $s = parseSentence($transId,$inString);
       if ($s!=null) {
         $outString = "insert into onthebible.BibleSentence (sentenceId, transId, TitleId, page, row, sentence) values(".$s[0].", ".$s[1].",".$s[2].",".$s[3].",".$s[4].",'".$s[5]."');\n";
       }else {
         $outString = null;
       }
       break;
 }
 if($outString==null) break;
 fputs($dstFile,$outString);
 echo($outString);
 $outString="";

 if($count==$limit){
   break;
 } 
 $count++;
} 

fclose($dstFile);
fclose($srcFile);



function parseSentence($transId,$inString){
       $sStartPos = strpos($inString," ");
       $header = substr($inString,0,$sStartPos);
       $title = substr($header,0,3);
       $header = substr($header,4,strlen($header));
       $pageRow = split(":",$header);
       $page = $pageRow[0];
       $row = $pageRow[1];
       $sentence = substr($inString,$sStartPos+1,strlen($inString));
       $sentence = preg_replace('/\r\n|\r|\n/','',$sentence); 
       $sentence = str_replace("'","\'",$sentence);

       $titleId = getTitleId($title);
       
       if($titleId==null || $row==null || $page==null) return null;

       $sentenceCode = $transId*100000000+$titleId*1000000+$page*1000+$row;
       return array($sentenceCode,$transId,$titleId,$page,$row,$sentence);
}

function getTitleId($title){

static $titleCode  =  array("GEN", "EXO", "LEV", "NUM", "DEU", "JOS", "JDG", "RUT", "SA1", "SA2", "KI1", "KI2", "CH1", "CH2", "EZR", "NEH", "EST", "JOB", "PSA", "PRO", "ECC", "SON", "ISA", "JER", "LAM", "EZE", "DAN", "HOS", "JOE", "AMO", "OBD", "JON", "MIC", "NAH", "HAB", "ZEP", "HAG", "ZEC", "MAL", "MAT", "MAR", "LUK", "JOH", "ACT", "ROM", "CO1", "CO2", "GAL", "EPH", "PHP", "COL", "TH1", "TH2", "TI1", "TI2", "TIT", "PHM", "HEB", "JAS", "PE1", "PE2", "JO1", "JO2", "JO3", "JUD", "REV");
  
for($i=0;$i<count($titleCode);$i++){
    if(strcmp($titleCode[$i],$title)==0) return ($i+1);
  }
  return null;
}


?>
