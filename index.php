<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8" />
    <link href="<?php echo "http://".$_SERVER['HTTP_HOST']."/css/style.css"; ?>" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo "http://".$_SERVER['HTTP_HOST']."/src/script.js"; ?>"></script>
</head>

<body>
<?php
    // Устанавливаем язык
	require_once 'src/i18n.php';
    session_start();
    if(isset($_GET['lang']))
    {
        $_SESSION['lang'] = $_GET['lang'];    
    }
    else
    {    
        if (!isset($_SESSION['lang']))
            $_SESSION['lang'] = 'ru';
    }
    I18n::setLocale($_SESSION['lang']);
    I18n::setPath('./lang');
?>
<form id="loginForm" action="<?php echo "http://".$_SERVER['HTTP_HOST']."/src/controller.php";?>" method="post">
	<input type="hidden" name="num" value="1" />
	<div class="field">
        <label><?php echo I18n::t('Username');?>:</label>
		<div id="login_content"></div>
        <div class="input"><input type="text" name="login" value="" id="login" onBlur="return checkFormLogin(this.id)" onmouseout="checkButton()" /></div>
		<input type="hidden" value="false" />
    </div>

    <div class="field">
      <!--  <a href="#" id="forgot"><?php //echo I18n::t('Forgot_your_password');?> ?</a>-->
        <label><?php echo I18n::t('Password');?>:</label>
		<div id="pass_content"></div>
        <div class="input"><input type="password" name="pass" value="" id="pass" onBlur="return checkFormLogin(this.id)" onmouseout="checkButton()" /></div>
		<a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/src/register.php";?>" id="forgot"><?php echo I18n::t('Sign_up');?> ?</a>
    </div>

    <div class="submit">
        <button id="button_login" name="button_login" type="submit" disabled="disabled" ><?php echo I18n::t('Login');?></button>
      <!--  <label id="remember"><input name="" type="checkbox" value="" /> <?php //echo I18n::t('Remember_me');?></label>-->
    </div>
    <div class="lang">
        <a href="?lang=ru"><img src="/image/ru.png"></a>
        <a href="?lang=en"><img src="/image/en.png"></a>
    </div>
</form>

</body>
</html>