<?php 
/*  등록 페이지 */
?>
<div class="container">
<p class="text-warning"> <?php echo validation_errors(); ?></p>

    <form class="form-signin" action="/login/register_form" method="post">
        <h2 class="form-signin-heading"><?=$strRegisterForm?></h2>

        <label for="inputEmail" class="sr-only">Email Adress</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="<?=$strEmailAdress?>" required autofocus>

        <label for="inputName" class="sr-only">User Name</label>
        <input type="text" id="user_name" name="user_name" class="form-control" placeholder="<?=$strUserName?>" required>

        <label for="inputPassword" class="sr-only">password</label>
        <input type="password" id="password"  name="password" class="form-control" placeholder="<?=$strPassword?>" required>

        <label for="inputPassword" class="sr-only">re_password</label>
        <input type="password" id="re_password" name="re_password" class="form-control" placeholder="<?=$strPasswordConfirmed?>" required>

        <div   style="margin-top:5px;">

            <button type="submit" class="btn btn-lg btn-primary btn-block"><?=$strRegister?></button></a>

        </div> <!-- /container -->

    </form>
</div>
