<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8" />
    <link href="<?php echo "http://".$_SERVER['HTTP_HOST']."/css/style.css"; ?>" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="script.js"></script>
</head>

<body>
    <?php
    session_start();
    // Устанавливаем язык
    require_once 'i18n.php';
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
<div id="regForm">
	<input type="hidden" name="num" value="2" />
    <div class="field">
        <label><?php echo I18n::t('Username');?>: <?php echo $_SESSION['username'];?></label>
    </div>
	<div class="field">
        <label><?php echo I18n::t('Name');?>: <?php echo $_SESSION['name'];?></label>
    </div>
	<div class="field">
	    <label><?php echo I18n::t('Email');?>: <?php echo $_SESSION['email'];?></label>
    </div>
    <div class="field">
        <label><?php echo I18n::t('Avatar');?>:</label>
        <img src="<?php echo "http://".$_SERVER['HTTP_HOST']."/download/".$_SESSION['image'];?>">
    </div>
    <div class="register">
        <?php
            session_destroy();       
            echo ('<a href="../index.php">'. I18n::t('Exit') .'</a>');
        ?>
    </div>
</div>
</body>
</html>