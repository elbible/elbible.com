<?php
/**
 * Created by PhpStorm.
 * User: fstory97@naver.com
 * Date: 2015-04-06
 * Time: 오후 9:25
 * 목적 : 로그인 뷰 페이지
 */
?>
<div class="container">
     <p class="text-warning"> <?=$message?></p>
      <form class="form-signin"  action="/auth/authentication<?=empty($returnURL) ? '' : '?returnURL='.rawurlencode($returnURL) ?>" method="post">
        <h2 class="form-signin-heading"><?=$strRequireLogin?></h2>
        <label for="inputEmail" class="sr-only">Email Adress</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="<?=$strEmailAdress?>" required autofocus>
        <label for="inputPassword" class="sr-only">password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="<?=$strPassword?>" required>
		<div class="container"  style="margin-top:5px;"> 	    </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit"><?=$strSignIn?></button>

      </form>
    </div>

<div class="container"  style="margin-top:5px;">
<a href="/login/register_form"><button class="btn btn-lg btn-primary btn-block"><?=$strRegister?></button></a>
</div> <!-- /container -->

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>