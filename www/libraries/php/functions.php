<?php

	function connectDB($db_host, $db_name, $db_user, $db_pass){
		R::setup("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
		
		if(!R::testConnection())
			exit("Отсутствует подключение к базе данных!");
	}
	
	function getRandomString($length = 32){
		$chars = 'abcdefghijklmnopqrstwxyzABCDEFGHIJKLMNOPQRSTWXYZ1234567890';
		$numChars = strlen($chars);
		$string = "";
		
		for ($i = 0; $i < $length; $i++)
			$string .= substr($chars, rand(1, $numChars) - 1, 1);
		
		return $string;
	}
	
	function findUser($email){
		return R::findOne('users', 'email = ?', array($email));
	}
	
	function findSession($session){
		return R::findOne('sessions', 'session = ?', array($session));
	}
	
	function getUser($id){
		return R::load('users', $id); 
	}
	
	function getUserData($id){
		return R::findOne('profiles', 'user_id = ?', array($id));			
	}

?>