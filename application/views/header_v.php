<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?=$pageTitle?></title>
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0">

    <!-- 부트스트랩 -->
    <link href="/include/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/include/css/elBible.css" rel="stylesheet" media="screen">
 <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요한) -->
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- 모든 합쳐진 플러그인을 포함하거나 (아래) 필요한 각각의 파일들을 포함하세요 -->
    <script src="/include/js/bootstrap.min.js"></script>
 
    <!-- Respond.js 으로 IE8 에서 반응형 기능을 활성화하세요 (https://github.com/scottjehl/Respond) -->
   <!-- 상단 메뉴 고정 -->
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
   <script type=text/javascript>
    $(document).ready(function(){
       var nav = $('.menuWrap');
    $(window).scroll(function () {
        if ($(this).scrollTop() > 312) {
            nav.addClass("float-menu");
        }else {
            nav.removeClass("float-menu");
        }
    });
});


 </script>
 
</head>
  <body> 
   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style='background-color:#0b78a2;'>
        <div>
          &nbsp; <a href='/'><img src='/img/logo.png' width=90"></a>
        </div>
        <div class="btn-group" style='width:100%;'>
          <button type="button" onClick="top.location.href='/bible/';" class="btn btn-default btn-lg" style='width:20%'>
          <span class="glyphicon glyphicon-book"></span>
          </button>
          <button type="button" onClick="top.location.href='/diary/';" class="btn btn-default btn-lg" style='width:20%'>
             <span class="glyphicon glyphicon-calendar"></span>
          </button>
          <button type="button" onClick="top.location.href='/timeline/';" class="btn btn-default btn-lg" style='width:20%'>
             <span class="glyphicon glyphicon-list"></span>
          </button>
		   <button type="button" onClick="top.location.href='/group/';" class="btn btn-default btn-lg" style='width:20%'>
             <span class="glyphicon glyphicon-tree-deciduous"></span>
          </button>
          <button type="button" onClick="top.location.href='/more/';" class="btn btn-default btn-lg" style='width:20%'>
             <span class="glyphicon glyphicon-plus"></span>
          </button>
        </div>
       </div>
     </nav>

   <div class="col-sm-12" style="margin-top:100px;">

