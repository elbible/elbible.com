<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Post : elBible</title>
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

 