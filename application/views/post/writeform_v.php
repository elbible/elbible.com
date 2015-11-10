<script language='javascript'>
function formChk(form) {
	if ($("#comment").val()=="")
	{
		alert('<?=$none_message?>');
		$("#comment").focus();
		return false;
	}
	form.submit();
}
</script>
 <nav class="navbar navbar-inverse" role="navigation">
        <div>
           <a class="navbar-brand" >
		   <span class="glyphicon glyphicon-pencil"></span>
		   <? if ($writeMode=="BibleComment") { 
		        echo ($titleName." ".$minPage.$strPageUnit." ".$minRow.$strRowUnit." ~ ".$maxRow.$strRowUnit);
		      }else
			  {  
				echo ($dateTime);
			  }
		   ?> 
		    </a>
          <div align=right style="margin-right:10px;">

 		 <button type="button" class="btn btn-default navbar-btn" onclick="javascript:history.back();">
				<span id="selectToggleButtonIcon" class="glyphicon glyphicon-remove"></span>
		   </button>
		   			</div>
  </nav>

<form action="/post/write" method="post" id="form">
   <div class="form-group">
			<textarea class="form-control" rows="10" id="comment" name='comment' maxlength=4000></textarea>			

		
   		   <? if ($writeMode=="BibleComment") { 
				echo ("<input type='hidden' name='bible_id' value='".$bibleId."'>");
		      }else
			  {  
				echo ("<input type='hidden' name='reg_date' value='".$dateTime."'>");
			  }
		   ?> 
		   </div>

   <center>
			<button type="button" class="btn btn-default navbar-btn" onclick="javascript:history.back();">
				<span id="selectToggleButtonIcon" class="glyphicon glyphicon-remove"></span>
			 </button>
		    <button type="button" class="btn btn-default navbar-btn" onclick="javascript:formChk(this.form);">
			<span id="selectToggleButtonIcon" class="glyphicon glyphicon-ok"></span>
			 </button>
  </center>
	 </div>
 </form>
