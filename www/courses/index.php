<?php

$root = "../";
require_once($root."php/main.php");

$page = new WebPage($root, "Курсы$titlePostfix");
$page->favicon = "/images/favicon.ico";
$page->links = array(
	array("/styles/basics.css", "stylesheet", "text/css"),
	array("/styles/mainpage.css", "stylesheet", "text/css")
);
$page->scripts = array("/scripts/jquery.js", "/scripts/basic.js", "/scripts/jq_rotate.js");
$page->language = "ru";


include($root."includes/head.php");
include($root."includes/header.php");

?>

<div>

	<div></div>
	<div></div>

</div>

<? include($root."includes/footer.php"); ?>