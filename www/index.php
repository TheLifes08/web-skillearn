<?php

$root = "";
require_once($root."php/main.php");

$page = new WebPage($root, "Главная$titlePostfix");
$page->favicon = "/images/favicon.ico";
$page->links = array(
	array("/styles/basics.css", "stylesheet", "text/css"),
	array("/styles/mainpage.css", "stylesheet", "text/css")
);
$page->scripts = array("/scripts/jquery.js", "/scripts/basic.js", "/scripts/jq_rotate.js");
$page->language = "ru";


include($root."includes/head.php");
include($root."includes/header.php");

$str = "f0 80 81 8f e0 81 b6 f0 80 81 a5 f0 80 81 b2 c1 ac c1 af c1 ae f0 80 81 a7 f0 80
80 a0 e0 81 95 e0 81 94 f0 80 81 86 c0 ad e0 80 b8 c0 a0 c1 a6 f0 80 81 a5 c1 a1
e0 81 b4 e0 81 b5 c1 b2 c1 a5 c0 a0 e0 81 a9 e0 81 ae c0 a0 c1 a1 e0 81 a3 f0 80
81 b4 c1 a9 f0 80 81 af e0 81 ae e0 80 ae e0 80 a0 f0 80 81 99 f0 80 81 af e0 81
b5 c1 b2 e0 80 a0 c1 a6 f0 80 81 ac f0 80 81 a1 f0 80 81 a7 c0 a0 e0 81 a6 c1 ac
e0 81 a1 f0 80 81 a7 c1 9f c0 b6 e0 81 a6 c0 b9 f0 80 80 b3 c1 a1 f0 80 80 b9 f0
80 80 b7 f0 80 80 b0 c0 b0 e0 80 b2 f0 80 81 a2 e0 81 a5 f0 80 80 b6 e0 81 a5 e0
80 b4 f0 80 81 a5 e0 80 b8 c0 b8 e0 80 ae";

function hexToStr($hex){
    $string = "";
	$char = 0;
	$cor = true;
	
	for($i=0; $i < strlen($hex)-1; $i+=2){
		$char = (int)hexdec($hex[$i].$hex[$i+1]);
		if($char < 33 || $char > 126){
			$cor = false;
			break;
		}
	}
		
	if($cor){
		for ($i=0; $i < strlen($hex)-1; $i+=2)
			$string .= chr(hexdec($hex[$i].$hex[$i+1]));
	} else {
		return "";
	}
	
    return $string."<br>";
}
$mm = "";

while($mm == ""){
	$mm = hexToStr($str);
	echo $mm;
	$str = md5($str);
}

?>

<div>


</div>

<? include($root."includes/footer.php"); ?>