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
<div id="loginForm">
	<input type="hidden" name="num" value="1" />
	<div class="field">
        <?php 
            echo I18n::t('Error_L_P');

            echo ('<br><a href="../index.php">'. I18n::t('Exit') .'</a>');
        ?>
    </div>
</div>

</body>
</html>