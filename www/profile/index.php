<?php

$root = "../";
require_once($root."php/main.php");

if(isset($_GET['user'])){
	$id = $_GET['user'];
	$userData = getUserData($id);
}

if($_SESSION['user']->id == $id)
	$ownerMode = true;
else
	$ownerMode = false;

$page = new WebPage($root, "Профиль - ".$userData->name." ".$userData->surname."$titlePostfix");
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
	<div id="navigation-bar">
		<span><a href="<?php echo '/profiles/'.$id.'/'; ?>">Профиль</a> >></span>
	</div>
	<div id="main-profile-content">
		<div id="profile-left-content">
			<div id="profile-left-content-user-main-info">
				<div id="profile-left-content-user-main-info-avatar">
					<img src="/images/profile/<?=$id?>/icon/icon.png">
				</div>
				<div id="profile-left-content-user-main-info-text">
					<div id="profile-left-content-user-main-info-text-name"><?=$userData->name." ".$userData->surname?></div>
					<div id="profile-left-content-user-main-info-text-desc"><?=$userData->description?></div>
				</div>
				<div id="profile-left-content-user-main-info-extra">
					<div id="profile-left-content-user-main-info-extra-level" class="center">
						<span>Уровень:</span>
						<div class="center"><?=$userData->level?></div>
					</div>
					<div id="profile-left-content-user-main-info-extra-rep-kp">
						<div class="flex" title="KP (Knowledge points) - Очки знаний. Получаются за выполнение заданий."><img src="/images/experiment.svg"><div>KP: <?=$userData->kp?></div></div>
						<div class="flex" title="REP (Reputation) - Репутация. Повышается, если вас положительно оценивают." style="margin-top: 5px;"><img src="/images/star.svg"><div>REP: <?=$userData->reputation?></div></div>
					</div>
				</div>
			</div>
		</div>
		<div><div id="profile-right-content">
			<?php echo '
			<div id="profile-right-content-button-edit-profile" class="center">
				<div>
					<a href="#"><div style="margin-bottom: 6px; color: #428bca; background-color: white; border: 1px solid #428bca;" class="center">Личные сообщения</div></a>
					<a href="#"><div class="center">Настройки профиля</div></a>
				</div>
			</div>';
			?>
			<div class="profile-right-content-div" id="profile-right-content-znak-div">
				<div name="title"><a href="#"><span>Значки (<?=$userData->badge_num?>)</span></a></div>
				<div name="content" class="flex">
				</div>
			</div>
			<div class="profile-right-content-div" id="profile-right-content-achivements-div">
				<div name="title"><a href="#"><span>Пройденные курсы (<?=$userData->compl_num?>)</span></a></div>
				<div name="content" class="flex">
				</div>
			</div>
			<div class="profile-right-content-div" id="profile-right-content-achivements-div">
				<div name="title"><a href="#"><span>Достижения (<?=$userData->achiv_num?>)</span></a></div>
				<div name="content" class="flex">
				</div>
			</div>
			<div class="profile-right-content-div" id="profile-right-content-friends-div">
				<div name="title"><a href="#"><span>Друзья (<?=$userData->friends_num?>)</span></a></div>
				<div name="content">
					<div></div>
				</div>
			</div>
			<div class="profile-right-content-div" id="profile-right-content-znak-div">
				<div name="title"><a href="#"><span>Инвентарь (<?=$userData->inv_num?>)</span></a></div>
			</div>
		</div></div>
	</div>
</div>

<? include($root."includes/footer.php"); ?>