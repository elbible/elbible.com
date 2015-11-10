<script language='javascript'>  
function bgcolorchange(){
   document.body.style.background = "#000000";
}
</script>

<body onload='javasciprt:bgcolorchange();'>
<nav class="navbar navbar-inverse navbar-fixed-top">
	 <table width=100%> 
	 <td width=10% style="padding:0px 0px 0px 10px;"><? if ($prevSn!=null) {?> <a href='/post/slide/<?=$prevSn?>'><h3> ◀</h3></a> <?}?></td> 
	 <td width=80% align=center><h3> <font color='#ffffaa'>[<?=$title?> <?=$startPage?>장 
		<? if ($startRow!=$endRow) echo($startRow."~");
	   	  echo ($endRow."절]"); ?>
    	 <?=$postInfo->comment?></font></h3></td>
	 <td width=10% align=right style="padding:0px 10px 0 0px;"> <? if ($postSn!=null) {?>  <a href='/post/slide/<?=$postSn?>'><h3>▶ </h3></a>  <?}?></td></table>
</nav>
<div style = 'height:60px;'></div>

<font color='#dddddd' size='6pt'>

 <? foreach($setenceList as $lt){?>
 	<div class="media" style='margin-left:15px;margin-right:15px;'>
	  <div class="media-left"><span class="badge"><?=$lt->row?></span>
	  </div>
	  <div class="media-body">
		<?=$lt->sentence?>
	  </div>
	</div>
 <?}?>
</font>
  <div align=right><a href='/diary/'>[닫기]</a></div>
  </div>

</body>