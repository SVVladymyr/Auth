<?php
Class Action_form
{
	public function login()
	{
		require_once("db.php");
		$dbase = new db();
		if(isset($_POST["login"])){ $l_username = htmlspecialchars($_POST["login"], ENT_HTML5); }
		if(isset($_POST["pass"]))
		{
			if (CRYPT_BLOWFISH == 1) {
				$l_password = crypt(htmlspecialchars($_POST["pass"]), '$2a$07$usespasswordtablestring$');
			}
			else	$l_password = crypt(htmlspecialchars($_POST["pass"]),'usespasswordtablestring'); 
		}
		if(isset($_POST["button_login"])){ $l_send = $_POST["button_login"]; }
		 
		/* Проверяем если была нажата кнопка Войти. Если да, то сравниваем данные полученные из формы с тем логином и паролем который есть в БД и если они совпадаю то пользователь успешно авторизирован, иначе, выводим сообщение что неправильный логин или пароль. Если кнопка не была нажата,  значит что пользователь зашел на страницу напрямую и поэтому выводим ему сообщение об этом. */
		if (isset($l_send))
		{	$result = $dbase->db_authlogin($l_username, $l_password);
			if( $result === TRUE)
			{
				header('Location: profile.php');
			}
			else
			{
				echo $result;
			}

		}
		else{
			header('Location: ../index.php');
		}
	}
	
	public function registration()
	{
		/**
		 * Подключаем класс для работы с базой данных
		 */
		require_once("db.php");
		$dbase = new db();

		/**
		 * Проверяем если в глобальном массиве $_POST? существуют данные отправленные из формы и  заключаем переданные данные в обычные переменные. Таким образом, мы застраховываемся от хостингов, которые не поддерживают глобальные переменные.
		 */
		if(isset($_POST["lastloginreg"])){ $r_name = htmlspecialchars($_POST["lastloginreg"], ENT_HTML5);}
		if(isset($_POST["loginreg"])){ $r_username = htmlspecialchars($_POST["loginreg"], ENT_HTML5); }
		if(isset($_POST["passreg"]))
		{
			if (CRYPT_BLOWFISH == 1)
			{
					$r_password = crypt(htmlspecialchars($_POST["passreg"]), '$2a$07$usespasswordtablestring$');
			}
			else	$r_password = crypt(htmlspecialchars($_POST["passreg"]),'usespasswordtablestring');
		}
		if(isset($_POST["emailreg"])){ $r_email = htmlspecialchars($_POST["emailreg"], ENT_HTML5); }
		if(isset($_POST["button_login"])){ $r_send = $_POST["button_login"]; }
		if(($_FILES["userfile"]['size']!= 0)&&($_FILES["userfile"]['tmp_name']!="")&&(($_FILES['userfile']['type']== "image/gif") || ($_FILES['userfile']['type']=="image/jpeg") || ($_FILES['userfile']['type']=="image/jpg") || ($_FILES['userfile']['type']=="image/png")))
        {
			$r_image = basename($_FILES["userfile"]['name']);
		}
		else
		{
			$r_image = FALSE;
		} 
		/**
		 * Проверяем если была нажата кнопка зарегистрироваться. Если да, то вводим информацию в БД, иначе, значит что кнопка не была нажата, и пользователь зашел на страницу напрямую.
		 */
		if(isset($r_send)){
			if($dbase->db_twologin($r_username) === TRUE)
			{
				$result = $dbase->db_writeregisterdata($r_name,$r_username,$r_email,$r_password,$r_image, $_FILES["userfile"]['tmp_name']);
				// Если все нормально то выводим сообщение.
				if ($result)
				{
					session_start();
					$_SESSION['username'] = $r_username;
					$_SESSION['email'] = $r_email;
					$_SESSION['name'] = $r_name;
					$_SESSION['image'] = $r_image;
					header('Location: profile.php');
				}
			}
			else     header('Location: error.php');
		}
		else
		{
				header('Location: ../index.php');
		}
	}
}
?>