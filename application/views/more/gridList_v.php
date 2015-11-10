<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><?=$strSetting?></div>

  <!-- List group -->
  <ul class="list-group">
      <li class="list-group-item" data-toggle="modal" data-target="#langModal" ><?=$strLanguage?>   : <?=$lang?></li>

      <!-- Modal -->
      <div class="modal fade" id="langModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title"><?=$strSetLanguage?></h></h4>
                  </div>
                  <div class="modal-body">
                      <a href='/more/setLanguage/korean' class='list-group-item'>
                          <strong>한국어</strong> </a>
                      <a href='/more/setLanguage/english' class='list-group-item'>
                          <strong>English</strong> </a>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal"><?=$strClose?></button>
                  </div>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->


    <li class="list-group-item" data-toggle="modal" data-target="#transModal" ><?=$strTransBook?> : <?=$transTitle?></li>

<!-- Modal -->
<div class="modal fade" id="transModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title"><?=$strSetTranslationBook?> </h4>
      </div>
      <div class="modal-body">
   <?
	foreach ($transList as $lt)
    {
    echo("<a href='/more/setTransId/". $lt->transId );
		echo("' class='list-group-item'>");
	    echo ("<strong>".$lt->description."</strong> ");
        echo("</a>");
    }?>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?=$strClose?></button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
 
</div><!-- /.modal -->
      <li class="list-group-item"><a href='<?=$loginChangeURL?>'><?=$strLoginChage?></a></li>



  </div>

<div class="panel panel-default">

  <div class="panel-heading"><?=$strNotice?></div> 
  <ul class="list-group">
   <li class="list-group-item">

<p class='lead' align=center>Not ‘Don’t be Evil’, Be Good!<br>Let’s make it with us</p>
<h4>1. elBible컨셉</h4>
<h5>1) 사용만 하지 마시고 <b>함께 만들어요.</b><br>
<small>- 오픈프로젝트로 개발, 운영됩니다. 누구나 다양한 방법으로 <a href='/more/aboutNDonation'>기여</a>가 가능합니다.  </small>
</h5>
<h5>2) <b>성경위의 삶</b> 을 살 수 있도록 도움을 드립니다..<br>
<small>- 교회에서 집에서 길에서 어디에서나, 신앙의 친구들과 나누고 싶은 성경말씀과 메시지를 나누세요.</small>
</h5>
<h5>3) 성경에 대한 모든것을 기록하는 <b>성경플랫폼</b><br> 
<small>-구글 지도가 전세계의 지역정보를 기록하는 것 처럼, 성경에 대한 사람들의 이야기를 기록하고 싶습니다.</small></h5>
<br><h4>2, elBible목표</h4>
<h5>1) 서비스의 모토는 <b>be Good!</b><br>
<small>성경을 기반으로 하는 서비스는 Don＇t be evil로는 충분하지 않습니다. 크리스챤은 be Good을 추구해야 합니다. </small></h5>
<h5>2) 크리스챤은 <b>크리스챤 답게 되도록</b> 돕자.
<small>세상을 변화시키기 위해 제가(저희가) 찾은 방법 중 하나는 크리스챤을 크리스챤 답게 만드는 일이고, 그것의 실행 수단으로는 성경기반의 삶을 살도록 돕는 elBible서비스를 만드는 일입니다.</small></h5>
<h5>3) <b>크리스챤외의 사람들을 도울 것</b> 입니다.<br>
<small>(아직까지는 그런일이 벌어지지 못했지만) 크리스챤을 크리스챤 답게 만들고 역량이 남으면,크리스챤 외의 사람들을 도울 것입니다. 크리스챤들의 삶을 기록하는 플랫폼으로서, 삶은 크리스챤 공동체 안에만 있다고 생각하지 않기 때문입니다.</small></h5>
<br><h4>3.elBible은 도움을 바랍니다.</h4>
<h5>
<small>대한민국의 숲속얘기에 의해 개발되었으며 아이디어와 실행에 도움을 주신분들이 계십니다.</small>
<small>현재 개발, 운영은 직장과 병행하여, 용돈으로 하고 있으니, 여러분의 작은 지원이라도 서비스를 안정화 시키고 개선하는데 큰 도움이 될 것입니다.</small></h5>
<br>
<center>
<button type='button' class='btn btn-primary btn-block' onclick="location.href='/more/aboutNDonation'"><b>도움을 주시는 방법</b></button><br>

문의 : fstory97@naver.com</adress></p>

</li>
</ul>
</div>
