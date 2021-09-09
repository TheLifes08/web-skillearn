<?php

$root = "../";
require_once("main.php");

$se = R::findOne('sessions', 'user_id = ? ', array($_SESSION['user']->id)); 
R::trash($se); 

session_destroy();

setcookie('sess', '', time()-1);
setcookie('sess_k', '', time()-1);

header("Location: http://".$_SERVER['HTTP_HOST']."/");

exit;

?>