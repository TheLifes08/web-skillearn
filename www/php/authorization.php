<?php

$root = "../";
require_once("main.php");

$email = $_POST['email'];
$password = $_POST['password'];
$result = "";

$user = findUser($email);

if($user == NULL){
	$result = "error1";
} else if($user->confirmed == 0){
	$result = "error2";
} else if(password_verify($password, $user->password)){
	$result = "success";
	
	$_SESSION['user'] = $user;
	$_SESSION['authorized'] = true;
	
	$sess_data = getRandomString(60);
	$sess_k_data = password_hash($user->password, PASSWORD_BCRYPT);
	
	$session = R::findOne('sessions', 'user_id = ?', array($user->id));
	
	if($session == NULL)
		$session = R::dispense('sessions');
	
	$session->user_id = $user->id;
	$session->session = $sess_data;
	$session->session_key = $user->password;
	R::store($session);
	
	setcookie('sess', $sess_data, time()+60*60*24*30*12, "/");
	setcookie('sess_k', $sess_k_data, time()+60*60*24*30*12, "/");
} else
	$result = "error1";

echo $result;

?>