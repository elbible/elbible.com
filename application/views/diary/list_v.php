<?
if ($postList == null) {
 ?>
             
		 <div align=center> <button type="button" class="btn btn-default" aria-label="Left Align" onclick='javascript:writeForm(1);'>
		   <span class="glyphicon glyphicon-pencil" aria-hidden="true"> 새 글쓰기</span>
		  </button>
		  </div>
		  <script language='javascript'>
				  function writeForm(){	
					location.href='/post/writeform/';	
			 }
		</script>

 <?
}?>
   <div class="panel-heading">
	 <div class="media">
		<div class="media-left">
    	<img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjE0LjUiIHk9IjMyIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="width: 64px; height: 64px; margin:5px">    
	    </div>
		<div class="media-body">
			<h4><b><?=$user->user_name?></b></h4>
    	    <font size=2>여기에 한줄 소개 입력하기.</font>
	   </div>
	</div>
  </div>
  <script language='javascript'>
   function card_click(id){
//    $("#bible_div_"+id).attr("style","display:block");
      if ($("#bible_div_"+id).attr("style")=="display:block")
      {
		  $("#bible_div_"+id).attr("style","display:none");
      }else
	  {
	  	  $("#bible_div_"+id).attr("style","display:block");
	  }

   }
  </script>
<?
foreach ($postList as $lt)
{
    $dateTime = date_create($lt->reg_date);
    $month_and_week = date_format($dateTime,"M D");
	$day= date_format($dateTime,"j");
	 ?>
<div class="panel panel-default">
  <div class="panel-heading"'>
	 <div class="media" style="margin-bottom:10px;"  onclick='javascript:card_click(<?=$lt->sn?>);'>
		<div class="media-left" style="background-color:#ffffff;width: 60px; height: 60px;text-align:center;padding:0px;">
		<font size=2 color="#aaaaaa"><?=$month_and_week?></font><br>
		<font size=5><b><?=$day?></b></font>
	    </div>
		<div class="media-body" style="padding-left:10px;">

			<? if ($lt->bible_id!=null) { ?>
			<h4><b><?=$lt->start_title?> <?=$lt->start_page?><?=$strPageUnit?>	
				<? if ($lt->start_row!=$lt->end_row) echo($lt->start_row."~");
				  echo ($lt->end_row.$strRowUnit);
				?>		
			</span></b></h4>
			<?}?>

			<h5><?=$lt->reg_date?></h5>
	   </div>
	</div>

    <div>


<? if ($lt->bible_id!=null) { ?>
 <div class="list-group" style='display:none;' id='bible_div_<?=$lt->sn?>'>
  <? foreach($lt->sentence_list as $bibleRow){ ?>
  	<li class="list-group-item"><strong><?=$bibleRow->row?></strong> <?=$bibleRow->sentence?></li>
    <?}?>
</div>
<?}?>


		




	</div>
	 <? if ($lt->comment!=null) {?>
	  <pre style="background-color:#ffffff;"> <?=$lt->comment?></pre>
	 <?}?>








	  <div align=right> <!-- 버튼 영역 -->
	  	<? if ($lt->bible_id!=null) { ?>
		  <button type="button" class="btn btn-default" aria-label="Left Align" onclick='javascript:slide(<?=$lt->sn?>);'>
		   <span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span>
		  </button>
			<?}?>

 		  <button type="button" class="btn btn-default" aria-label="Left Align" onclick='javascript:removePost(<?=$lt->sn?>);'>
		  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		  </button>
     </div>


  </div>




</div>

<script language='javascript'>
function slide(sn){
	location.href='/post/slide/'+sn;	
}



function removePost(sn){
 if (confirm("정말로 삭제하십니까?"))
 {
	location.href='/post/remove/'+sn;	
 }

}

</script>



<?}?>




