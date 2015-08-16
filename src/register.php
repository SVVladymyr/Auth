<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8" />
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="script.js"></script>
</head>

<body>
<?php 
    // Устанавливаем язык
    require_once 'i18n.php';
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
    I18n::setPath('../lang');
?>
<form id="regForm" enctype="multipart/form-data" action="controller.php" method="post">
	<input type="hidden" name="num" value="2" />
    <div class="field">
        <label><?php echo I18n::t('Username');?>:</label>
		<div id="lastloginreg_content"></div>
        <div class="input"><input type="text" name="lastloginreg" value="" id="lastloginreg" onBlur="return checkFormLogin(this.id)" onmouseout="checkButton()" /></div>
    </div>
	<div class="field">
        <label><?php echo I18n::t('Name');?>:</label>
		<div id="loginreg_content"></div>
        <div class="input"><input type="text" name="loginreg" value="" id="loginreg" onBlur="return checkFormLogin(this.id)" onmouseout="checkButton()" /></div>
    </div>
	<div class="field">
	<div id="emailreg_content"></div>
        <label><?php echo I18n::t('Email');?>:</label>
        <div class="input"><input type="email" name="emailreg" value="" id="emailreg" onBlur="return checkFormLogin(this.id)" onmouseout="checkButton()" /></div>
    </div>
    <div class="field">
        <label><?php echo I18n::t('Password');?>:</label>
		<div id="passreg_content"></div>
        <div class="input"><input type="password" name="passreg" value="" id="passreg" onBlur="return checkFormLogin(this.id)" onmouseout="checkButton()" /></div>
    </div>
	<div class="field">
        <label> <?php echo I18n::t('Confirm_password');?>:</label>
		<div id="twopassreg_content"></div>
        <div class="input"><input type="password" name="twopassreg" value="" id="twopassreg" onBlur="return checkFormLogin(this.id)" onmouseout="checkButton()" /></div>
    </div>
    <div class="field">
        <label><?php echo I18n::t('Download_image');?>:</label>
        <div id="image_content"></div>
        <!-- <div class="input"><input type="file" name="userfile" value="Download file" id="userfile" /></div> -->
            <div class="fileform">
                <div id="fileformlabel"></div>
                <div class="selectbutton"><?php echo I18n::t('Overview');?></div>
                <input type="file" name="userfile" id="userfile" onchange="getName(this.value);" />
            </div>
    </div>
    <div class="register">
        <button id="button_login" name="button_login" type="submit" disabled="disabled"><?php echo I18n::t('Sign_up');?></button>
    </div>

</form>

</body>
</html>