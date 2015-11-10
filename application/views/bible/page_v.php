<!--<script>
 window.location.hash = "List_5";
</script> -->

<div style="height:40px" align=right>
	  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="modal" data-target="#myModal" aria-expanded="false"><?=$titleName?> <span class="caret"></span></button>  
	  <!-- book Select Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" align=left>
		  <div class="modal-dialog">
 			<div class="modal-content">
    		    <div class="modal-header">
					<table width=100%><tr><td align=left>
					<div class="btn-group" role="group" aria-label="...">
					<script type="text/javascript">
						function setOrderBy(sortby){
							var date = new Date(); 
							date.setDate(date.getDate() + 999);
							document.cookie = "BookOrder" + '=' + escape(sortby) + ';expires=' + date.toGMTString();
							location.reload();
						}
					</script>
						 <? if ($orderBy=="origin"){?>
						  <button type="button" class="btn btn-active" onclick="javascript:setOrderBy('origin')"><?=$strOrderOrigin?></button>
						  <button type="button" class="btn btn-default" onclick="javascript:setOrderBy('word')"><?=$strOrderWord?></button>
						 <?}else{?>
						   <button type="button" class="btn btn-default" onclick="javascript:setOrderBy('origin')"><?=$strOrderOrigin?></button>
						  <button type="button" class="btn btn-active" onclick="javascript:setOrderBy('word')"><?=$strOrderWord?></button>
						 <?}?>
					</div>
					<td align=right>
						<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?=$strClose?></button>
					</tr></table>
			</div>  <!-- modal-header -->
			<div class="modal-body" align=left>
      	    <table width=100%">
			<?
			$i = 1;
			foreach ($titles as $lt)
			{
				if ($i%2 == 1) echo ("<tr>");
				$titleId = sprintf("%02d",$lt->titleId);
				echo("<td><button type='button' class='btn btn-default btn-block' onclick=\"location.href='/bible/page/");
				echo($idArray["transId"].$titleId."001000");		
				echo("';\">".$lt->transTitle."</a></button></td>");
				echo("</a></div>");
				if ($i%2 == 0) echo ("</tr>");
				$i++;
			}?>
			</table>
			</div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?=$strClose?></button>
			  </div><!-- modal-body-->
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="modal" data-target="#pageModal" aria-expanded="false"><?=$page?> <?=$strPageUnit?><span class="caret"></span></button>  

		<!-- Page Select Modal -->
		<div class="modal fade" id="pageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  align=left>
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
					<table width=100%><tr><td align=left>
					<h4 class="modal-title"><?=$strSelectPage?> </h4>
					<td align=right>
							<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?=$strClose?></button>
					</td></table>
			  </div>
			  <div class="modal-body" align=center>
			  <table width=100%">
		   <?for($i=1;$i<=$pageCount;$i++)
			{
   			    if ($i%5 == 1) echo ("<tr>");
				 echo("<td><button type='button' class='btn btn-default btn-block' onclick=\"location.href='/bible/page/");
				$rowPageId = sprintf("%03d",$i);
				echo($idArray["transId"].$idArray["titleId"].$rowPageId."000");		
				echo("';\">".$i."</a></button></td>");
				if ($i%5 == 0) echo ("</tr>");
			}
			if ($i%5 != 0) echo ("</tr>");
			
			?>
			</table>

			   </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?=$strClose?></button>
			  </div>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	<input type="hidden" id="rowCount" value="<?=count($pageList)?>"/>
</div>



<!-- Bible Page Body Start -->
<div class="list-group">

  <script type='text/javascript'>
	var minSelectRow = 0;
	var maxSelectRow = 0;
    var selectCount = 0;

	function like() {
		minId = "";
		maxId = "";

		if (selectCount>0)
		{
			curPage = "<?=$pageId?>".substring(0,9);
			minIdStr = '00'+minSelectRow;
			minId = curPage + minIdStr.slice(-3);
			maxIdStr = '00'+maxSelectRow;
			maxId = curPage + maxIdStr.slice(-3);
		}
		window.location = "/post/like/"+minId+maxId;
	}

	function writePost() {
		minId = "";
		maxId = "";

		if (selectCount>0)
		{
			curPage = "<?=$pageId?>".substring(0,9);
			minIdStr = '00'+minSelectRow;
			minId = curPage + minIdStr.slice(-3);
			maxIdStr = '00'+maxSelectRow;
			maxId = curPage + maxIdStr.slice(-3);
		}
		window.location = "/post/writeform/"+minId+maxId;
	}

	function toggleAll() {
	  if (selectCount==0){
		  selectAll();
	  }
	  else {
		  deselectAll();
	  }
	}

	function selectAll() {
		 minSelectRow = 1;
		 maxSelectRow = $("#rowCount").val();
		 selectCount = maxSelectRow;
		 jQuery(".list-group-item").addClass("list-group-item-warning");	
		 $("#selectToggleButtonIcon").attr("class","glyphicon glyphicon-remove");	
		 $("#likeButton").attr("class","btn btn-default btn-lg");	
		 
	}

	function deselectAll() {
		for (var i=minSelectRow;i<=maxSelectRow;i++)
		{
			var elementId = "#List_" + i;
		    $(elementId).removeClass("list-group-item-warning");
		}
		minSelectRow=0;
		maxSelectRow=0;
		selectCount = 0;
  		$("#selectToggleButtonIcon").attr("class","glyphicon glyphicon-ok");	
		$("#likeButton").attr("class","btn btn-default btn-lg disabled");	

	}

    function selectRow(rowNum) {		  
			 
		  if (selectCount==0)  // 아무것도 선택이 안된 경우
		  {			
			minSelectRow=rowNum;
			maxSelectRow=rowNum;
			selectCount++;   
			var elementId = "#List_" + rowNum;
		    $(elementId).addClass("list-group-item-warning");			
     		$("#selectToggleButtonIcon").attr("class","glyphicon glyphicon-remove");
			$("#likeButton").attr("class","btn btn-default btn-lg");	
		  }else if ((maxSelectRow+1)==rowNum){  // 선택 영역 추가
		    maxSelectRow=rowNum;
			selectCount++;   
			var elementId = "#List_" + rowNum;
		    $(elementId).addClass("list-group-item-warning")
		  }else if ((minSelectRow-1)==rowNum){  // 선택 영역 추가
		    minSelectRow=rowNum;
			selectCount++;   
			var elementId = "#List_" + rowNum;
		    $(elementId).addClass("list-group-item-warning")
		  }
	  }
	
  </script>
<?

    foreach ($pageList as $lt)
    {	
        echo("<a href='javascript:selectRow(".$lt->row.");' id='List_".$lt->row."' class='list-group-item'>");
		echo ("<strong>".$lt->row."</strong> ".$lt->sentence);
        echo("</a>");
    }

	// 하단의 다음 버튼
	if ($nextPageId) {
		?>
			<div class="btn-group btn-group-justified" style="height:50px" role="group" aria-label="...">
				<a href="/bible/page/<?=$nextPageId?>" class="btn btn-primary" role="button"><span class='glyphicon glyphicon-forward' aria-hidden='true'/></a>
			</div>
		<?
	}
?>
	<table height=35><tr><td valign=bottom>
	
	</td></tr></table>
</div>

</div>
  <nav class="navbar navbar-fixed-bottom" role="navigation">
        <div align=center>
     
 		 <button type="button" class="btn btn-default btn-lg" onclick="javascript:toggleAll();">
			<span id="selectToggleButtonIcon" class="glyphicon glyphicon-ok"></span>
		   </button>


          <button type="button" id="likeButton" class="btn btn-default btn-lg disabled" onclick="javascript:like();">
            <span class="glyphicon glyphicon-heart"></span>
          </button>

		  <button type="button" id="writeButton" class="btn btn-default btn-lg" onClick="javascript:writePost();">
            <span class="glyphicon glyphicon-pencil"></span>
          </button>
           </div>

     </nav>


</nav>
