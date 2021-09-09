<?php

$root = "../";
require_once("main.php");

$email = $_POST['email'];

if(R::count('users', 'email = ?', array($email)) > 0)
	$result = "error1";
else
	$result = "success";

echo $result;

?>