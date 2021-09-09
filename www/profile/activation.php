<?php

$root = "../";
require_once($root."php/main.php");

$code = $_GET['code'];
$user = R::findOne("users", "confirm_id = ?", array($code));

if($user == NULL)
	$result = "Пользователь уже активирован, либо пользователя с таким id не существует!";
else {
	$result = "Ваш аккаунт успешно активирован!";
	$user->confirmed = 1;
	$user->confirm_id = "activated";
	R::store($user);
}

header("Location: http://".$_SERVER['HTTP_HOST']."/");

?>
