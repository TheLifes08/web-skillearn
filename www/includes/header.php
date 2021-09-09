	<body>
		<header>
			<div id="header">
				<div id="header-logo-div" class="center">
					<a href="/" title="Перейти на главную страницу">
						<img id="header-logo" src="/images/header/header_logo.png" alt="SkillEarn">
					</a>
				</div>
				<div id="header-menu" class="center">
					<nav id="header-menu-list" class="flex">
						<a class="header-menu-list-element" href="/news/" title="Перейти на страницу новостей">Новости</a>
						<a class="header-menu-list-element" href="/forum/" title="Перейти на страницу форума">Форум</a>
						<a class="header-menu-list-element" href="/courses/" title="Открыть каталог курсов">Курсы</a>
						<a class="header-menu-list-element" href="/tasks/" title="Рещение заданий">Задания</a>
					</nav>
				</div>
				<div id="header-user" class="center">
					<div id="header-user-div" class="center">
						<?php
							if(isset($_SESSION['user'])){
								$profile = getUserData($_SESSION['user']->id);
								
								if(file_exists($root.'images/profile/'.$_SESSION['user']->id.'/icon/icon.png'))
									$img_path = "/images/profile/".$_SESSION['user']->id."/icon/icon.png";
								else 
									$img_path = "/images/profile/default_profile_icon.png";
								
								echo   '<div id="header-user-div-info">
											<div id="header-user-div-info-name">'.$profile->name.'</div>
											<div id="header-user-div-info-inf">KP: '.$profile->kp.' | REP: '.$profile->reputation.'</div>
										</div>
										<div id="header-user-div-avatar">
											<img src="'.$img_path.'">
										</div>
										<div id="header-user-div-menu-butt" class="center">
											<img id="header-user-div-menu-butt-div-img" src="/images/down_arrow.svg">
										</div>';
							} else {
								echo   '<div id="header-user-div-butt" class="flex">
											<a href="javascript:showRegAuthWindow(\'auth\')">
												<div id="header-button-log" class="header-button">Войти</div>
											</a>
											<a href="javascript:showRegAuthWindow(\'reg\')">
												<div id="header-button-reg" class="header-button">Регистрация</div>
											</a>
										</div>';
							}
						?>
					</div>
				</div>
			</div>
		</header>
		
		<div id="blackout-div">
			<div id="blackout-div-window">
				<div id="blackout-div-window-up-panel">
					<a id="blackout-div-window-up-panel-auth-a" href="javascript:changeRegAuthWindowContent('auth')">
						<div id="blackout-div-window-up-panel-auth" class="center">
							<span class="href-span-unactive">Авторизация</span>
						</div>
					</a>
					<a id="blackout-div-window-up-panel-reg-a" href="javascript:changeRegAuthWindowContent('reg')">
						<div id="blackout-div-window-up-panel-reg" class="center">
							<span class="href-span-unactive">Регистрация</span>
						</div>
					</a>
					<a href="javascript:hideRegAuthWindow()">
						<div id="blackout-div-window-up-panel-close" class="center">
							<img src="/images/cross_grey.svg">
						</div>
					</a>
				</div>
				<div id="blackout-div-window-content">
				</div>
			</div>
		</div>
		
		<div id="wrapper">
		
			<div id="user-slider-menu">
				<nav id="user-slider-menu-nav">
					<a href="/profile/<?php echo $_SESSION['user']->id; ?>/">
						<div name="first" class="user-slider-menu-nav-element">Профиль</div>
					</a>
					<a href="#">
						<div class="user-slider-menu-nav-element">Инвентарь</div>
					</a>
					<a href="#">
						<div name="last" class="user-slider-menu-nav-element">Уведомления</div>
					</a>
					<div id="user-slider-menu-nav-down-panel" class="user-slider-menu-nav-element">
						<a href="#">
							<div class="user-slider-menu-nav-down-panel-button">
								<img src="/images/message.svg">
							</div>
						</a>
						<a href="#">
							<div class="user-slider-menu-nav-down-panel-button">
								<img src="/images/settings.svg">
							</div>
						</a>
						<a href="/php/exit.php">
							<div class="user-slider-menu-nav-down-panel-button">
								<img src="/images/logout.svg">
							</div>
						</a>
					</div>
				</nav>
			</div>