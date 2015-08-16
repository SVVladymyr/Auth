<?php
Class Db
{ 
	/**
	 *  Устанавливаем соединение с базой данных
	 */
	private function db_connect($server = "Здесь указываем адрес сервера", $database = "Здесь указываем базу данных", $username = "Здесь указываем логин", $password = "Здесь указываем пароль")
	{
		$db = mysqli_connect($server,$username,$password, $database);
		
		if (mysqli_connect_error()) {
			die('Error connection (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
			exit();
		}
		return $db;
	}
	
	/**
	 * Закрываем соединение с базой данных
	 */
	private function db_close($db)
	{
		$db->close();
	}
	
	/**
	 *	Запрос из базы данных
	 */
	private function db_query($db,$query)
	{	
		return mysqli_query($db,$query);
	}
	
	/**
	 *	Очищаем результирующий набор 
	 */
	private function db_free_result($result)
	{
		mysqli_free_result($result);
	}
	/**
	 *	Копируем файл на сервер 
	 */
	private function copy_avatar($temp_file ,$file)
	{
		$uploaddir = '../download/';
		$uploadfile = $uploaddir . basename($file);

		move_uploaded_file($temp_file, $uploadfile);
	}
	/**
	 *	Проверка логина и пароля 
	 */
	public function db_authlogin($l_username, $l_password)
	{
		$db = $this->db_connect();		
		$query = "SELECT * FROM users WHERE username = '$l_username' AND password = '$l_password'";
		$result = $this->db_query($db, $query);
		/* Проверяем, если в базе нет пользователей с такими данными, то выводим сообщение об ошибке */
		if ( mysqli_num_rows($result) < 1) {
			$error = 1;
			header('Location: /src/error.php');;
		} else {
			/* Если введенные данные совпадают с данными из базы, то сохраняем логин и пароль  в массив сессий.*/
			session_start();
			$_SESSION['username'] = $l_username;
			$_SESSION['password'] = $l_password;
			$this->db_get($l_username);
			$this->db_free_result($result);
			$this->db_close($db);
			return true;
		}
		
	}

	/**
	 *	Получение данных с сервера (запись в ассоциативный массив)
	 */
	public function db_get($l_username)
	{
		$db = $this->db_connect();		
		$query = "SELECT name, username, email, image FROM users WHERE username = '$l_username'";
		$result = $this->db_query($db, $query);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$_SESSION['email'] = $row["email"];
		$_SESSION['name'] = $row["name"];
		$_SESSION['image'] = $row["image"];
		
		$this->db_free_result($result);
		$this->db_close($db);
	}

	/**
	 *	Проверка логина 
	 */
	public function db_twologin($l_username)
	{
		$db = $this->db_connect();		
		$query = "SELECT * FROM users WHERE username = '$l_username'";
		$inf = false;
		if($result = $this->db_query($db, $query))
		{
			/* Проверяем, есть ли в базе пользователь с таким логином */
			if ( mysqli_num_rows($result) < 1) 
			{
				$inf = true;
				$this->db_free_result($result);
			}
			else $inf = false;
		}
		$this->db_close($db);
		return $inf;
	}
	
	/**
	 *	Занесение регистрационных данных в таблицу 
	 */
	public function db_writeregisterdata($r_name, $r_username, $r_email, $r_password,$r_image,$temp_file)
	{
		/* Формируем запрос к БД для ввода данных */
		$db = $this->db_connect();		
		$query = "INSERT INTO users (name,username,email,password,image) VALUES ('$r_name','$r_username','$r_email','$r_password','$r_image')";
		if($this->db_query($db, $query))
		{	
			$result = true;
			if($r_image!=false)
				$this->copy_avatar($temp_file, $r_image);
		}
		else $result = false;
		
		$this->db_close($db);
		return $result;
	}
}
?>