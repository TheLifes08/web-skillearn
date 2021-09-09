var global_email, global_pass;
var menu_switch = false;
var site_address = "http://www.skillearn.ru/";
var auth_content = `<div id="blackout-div-window-content-step">
								Введите свой Email и пароль:
							</div>
							<div id="blackout-div-window-content-form">
								<div class="blackout-div-window-content-form-input">
									<input name="log_input_email" class="input-multi-up" type="email" placeholder="Email">
										<div class="input-error-info-div" name="email">
											<img onmouseover="showHint('show', this);" onmouseout="showHint('hide', this);" src="/images/info.svg">
											<div onmouseover="$(this).fadeIn(200);" onmouseover="$(this).fadeOut(200);"></div>
										</div>
								</div>
								<div class="blackout-div-window-content-form-input">
									<input name="log_input_password" class="input-multi-middle" type="password" placeholder="Пароль">
									<div class="input-error-info-div" name="password">
										<img onmouseover="showHint('show', this);" onmouseout="showHint('hide', this);" src="/images/info.svg">
										<div onmouseover="$(this).fadeIn(200);" onmouseover="$(this).fadeOut(200);"></div>
									</div>
								</div>
								<div class="blackout-div-window-content-form-input">
									<div class="input-multi-button" onclick="login();">
										<div class="center">Войти</div>
									</div>
									<div class="input-error-info-div" name="button">
										<img onmouseover="showHint('show', this);" onmouseout="showHint('hide', this);" src="/images/info.svg">
										<div onmouseover="$(this).fadeIn(200);" onmouseover="$(this).fadeOut(200);"></div>
									</div>
								</div>
							</div>
							<div id="blackout-div-window-content-account-recovery">
								<a href="javascript:alert('recovery account!')">Восстановление аккаунта</a>
							</div>`;
							
var reg_content  = `<div id="blackout-div-window-content-step">
							Шаг 1 | Введите свою почту:
							</div>
							<div id="blackout-div-window-content-form">
								<div class="blackout-div-window-content-form-input">
									<input class="input-multi-up" name="reg_email_input" type="email" placeholder="Email">
									<div class="input-error-info-div" name="email">
										<img onmouseover="showHint('show', this);" onmouseout="showHint('hide', this);" src="/images/info.svg">
										<div onmouseover="$(this).fadeIn(200);" onmouseover="$(this).fadeOut(200);"></div>
									</div>
								</div>
								<div class="blackout-div-window-content-form-input">
									<div class="input-multi-button" onclick="registrationStepOne();">
										<div class="center">Продолжить</div>
									</div>
									<div class="input-error-info-div" name="button">
										<img onmouseover="showHint('show', this);" onmouseout="showHint('hide', this);" src="/images/info.svg">
										<div onmouseover="$(this).fadeIn(200);" onmouseover="$(this).fadeOut(200);"></div>
									</div>
								</div>
							</div>`;

var contentStepTwo = `
						<div id="blackout-div-window-content-step">
							Шаг 2 | Введите пароль:
						</div>
						<div id="blackout-div-window-content-form">
							<div class="blackout-div-window-content-form-input">
								<input class="input-multi-up" name="reg_pass_input" type="password" placeholder="Пароль">
								<div class="input-error-info-div" name="password">
									<img onmouseover="showHint('show', this);" onmouseout="showHint('hide', this);" src="/images/info.svg">
									<div onmouseover="$(this).fadeIn(200);" onmouseover="$(this).fadeOut(200);"></div>
								</div>
							</div>
							<div class="blackout-div-window-content-form-input">
								<div class="input-multi-button" onclick="registrationStepTwo();">
									<div class="center">Продолжить</div>
								</div>
								<div class="input-error-info-div" name="button">
									<img onmouseover="showHint('show', this);" onmouseout="showHint('hide', this);" src="/images/info.svg">
									<div onmouseover="$(this).fadeIn(200);" onmouseover="$(this).fadeOut(200);"></div>
								</div>
							</div>
						</div>`;
						
function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}
						
$(document).ready(function(){
	$('#header-user-div-menu-butt').bind("click", slideMenu);
	$("img, a").on("dragstart", function(event) { event.preventDefault(); });
});

function slideMenu(){
	menu_switch = !menu_switch;
	
	if(menu_switch == true){
		$('#user-slider-menu').slideDown(300);
		$('#header-user-div-menu-butt-div-img').rotate({
			duration: 300,
			angle: 0,
			animateTo: 180
		});
	} else {
		$('#user-slider-menu').slideUp(300);
		$('#header-user-div-menu-butt-div-img').rotate({
			duration: 300,
			angle: 180,
			animateTo: 0
		});
	}
}

function showRegAuthWindow(type){
	changeRegAuthWindowContent(type);
	$("#blackout-div").fadeIn(200);
}

function switchPointerEvents(obj, state){
	if(state == "enable"){
		$(obj).css("pointer-events", "none");
		$(obj).css("cursor", "default");
	} else {
		$(obj).css("pointer-events", "auto");
		$(obj).css("cursor", "pointer");
	}
}

function hideRegAuthWindow(){
	$("#blackout-div").fadeOut(200);
}

function showHint(state, obj){
	if(state == "show")
		$(obj).parent().find("div").fadeIn(200);
	else
		$(obj).parent().find("div").fadeOut(200);
}

function setErrorInput(obj, error){
	obj.css("background-color", "#FFE1E1");
	var obj2 = obj.parent().find(".input-error-info-div");
	obj2.fadeIn(200);
	obj2.find("div").html(error);
}

function setErrorButton(error){
	var obj2 = $(".input-error-info-div[name='button']");
	obj2.fadeIn(200);
	obj2.find("div").html(error);
}

function changeButton(state, text){
	if(text === undefined)
		text = "Продолжить";
	if(state == 1){
		$(".input-multi-button").css("background-color", "#EDEDED");
		$(".input-multi-button div").html("Загрузка...");
		$(".input-multi-button div").css("color", "#333333");
	} else {
		$(".input-multi-button").css("background-color", "#65CD65");
		$(".input-multi-button div").html(text);
		$(".input-multi-button div").css("color", "white");
	}
}

function changeRegAuthWindowContent(type){
	$("#blackout-div-window-content").html("");
						
	if(type == "auth"){
		$("#blackout-div-window-up-panel-auth span").css("color", "#333333");
		$("#blackout-div-window-up-panel-reg span").css("color", "#428bca");
		$("#blackout-div-window-up-panel-auth").css("background-color", "white");
		$("#blackout-div-window-up-panel-auth").css("border-bottom", "0");
		$("#blackout-div-window-up-panel-reg").css("background-color", "#EDEDED");
		$("#blackout-div-window-up-panel-reg").css("border-bottom", "1px solid #d8d8d8");
		switchPointerEvents("#blackout-div-window-up-panel-auth-a", "enable");
		switchPointerEvents("#blackout-div-window-up-panel-reg-a", "disable");
		$("#blackout-div-window").animate({ height: "340px" }, 50);
		$("#blackout-div-window-content").html(auth_content);
	} else {
		$("#blackout-div-window-up-panel-reg span").css("color", "#333333");
		$("#blackout-div-window-up-panel-auth span").css("color", "#428bca");
		$("#blackout-div-window-up-panel-reg").css("background-color", "white");
		$("#blackout-div-window-up-panel-reg").css("border-bottom", "0");
		$("#blackout-div-window-up-panel-auth").css("background-color", "#EDEDED");
		$("#blackout-div-window-up-panel-auth").css("border-bottom", "1px solid #d8d8d8");
		switchPointerEvents("#blackout-div-window-up-panel-reg-a", "enable");
		switchPointerEvents("#blackout-div-window-up-panel-auth-a", "disable");
		$("#blackout-div-window").animate({ height: "280px" }, 50);
		$("#blackout-div-window-content").html(reg_content);
	}
}

function login(){
	changeButton(1);
	var email = $("input[name='log_input_email']").val();
	var password = $("input[name='log_input_password']").val();
	var adr_pattern = /[0-9a-z_-]+@[0-9a-z_-]+\.[a-z]{2,5}/i;
	var input_email = $("input[name='log_input_email']");
	var input_pass = $("input[name='log_input_password']");
	var sel_input;
	var error = "";
	
	input_email.css("background-color", "white");
	input_pass.css("background-color", "white");
	$(".input-error-info-div").css("display", "none");
	
	if(!(adr_pattern.test(email))){
		error = "Введите корректный Email! Пример: example@example.com";
		sel_input = input_email;
	} else if(email == "" || email == " "){
		error = "Вы не ввели свой Email!";
		sel_input = input_email;
	} else if(password == "" || password == " "){
		error = "Вы не ввели свой пароль!";
		sel_input = input_pass;
	} else if(password.length < 6){
		error = "Пароль должен состоять из 6 или более символов!";
		sel_input = input_pass;
	}
	
	if(error == ""){
		$.ajax({
			url: '/php/authorization.php',
			type: 'POST',
			cache: 'false',
			data: { 'email': email, 'password': password },
			dataType: 'html',
			success: function(data){
				if(data == "success"){
					window.location.href = site_address;
				} else if(data == "error1"){
					error = "Неверный Email или пароль!";
					setErrorButton(error);
					changeButton(2, "Войти");
				} else if(data == "error2"){
					error = "Для входа в аккаунт необходимо его активировать. На ваш аккаунт было отправлено письмо со ссылкой активации аккаунта.<br><a>Я не получил письма</a>";
					setErrorButton(error);
					changeButton(2, "Войти");
				} else {
					error = "Произошла неизвестная ошибка! Попробуйте авторизоваться позже.";
					setErrorButton(error);
					changeButton(2, "Войти");
				}
			}
		});
	} else {
		setErrorInput(sel_input, error);
		changeButton(2, "Войти");
	}
}

function registrationStepOne(){
	changeButton(1);
	var email = $("input[name='reg_email_input']").val();
	var input = $("input[name='reg_email_input']");
	var adr_pattern = /[0-9a-z_-]+@[0-9a-z_-]+\.[a-z]{2,5}/i;
	var error = "";
	
	if(!(adr_pattern.test(email)))
		error = "Введите корректный Email! Пример: example@example.com";
	else if(email == "" || email == " ")
		error = "Вы не ввели свой Email!";
	
	if(error == ""){
		$.ajax({
			url: '/php/checkRegEmail.php',
			type: 'POST',
			cache: 'false',
			data: { 'email': email },
			dataType: 'html',
			success: function(data){
				if(data == "error1"){
					error = "Данный Email уже зарегистрирован!";
					setErrorInput(input, error);
					changeButton(2);
				} else if(data == "success"){
					global_email = email;
					$("#blackout-div-window-content").html(contentStepTwo);
				} else {
					error = "Произошла неизвестная ошибка! Попробуйте зарегистироваться позже.";
					setErrorInput(input, error);
					changeButton(2);
				}
			}
		});
	} else {
		setErrorInput(input, error);
		changeButton(2);
	}
}

function registrationStepTwo(){
	changeButton(1);
	var email = global_email;
	var input = $("input[name='reg_pass_input']");
	var password = $("input[name='reg_pass_input']").val();
	var error = "";
	
	if(password == "" || password == " ")
		error = "Вы не ввели свой пароль!";
	else if(password.length < 6)
		error = "Пароль должен состоять из 6 или более символов!";
	
	if(error == ""){
		$.ajax({
			url: '/php/registration.php',
			type: 'POST',
			cache: 'false',
			data: { 'email': email, 'password': password },
			dataType: 'html',
			success: function(data){
				if(data == "error1"){
					error = "Вы ввели некорректный Email!";
					setErrorButton(error);
					changeButton(2, "Зарегистрироваться");	
				} else if(data == "error2"){
					error = "Пароль должен состоять из 6 или более символов!";
					setErrorInput(input, error);
					changeButton(2, "Зарегистрироваться");	
				} else if(data == "error3"){
					error = "Данный Email уже зарегистрирован!";
					setErrorButton(error);
					changeButton(2, "Зарегистрироваться");	
				} else if(data == "success"){
					global_pass = password;
					$("#blackout-div-window").animate({ height: "350px" }, 100);
					$("#blackout-div-window-content").html(`
					<div id="blackout-div-window-content-step">
						Шаг 3 | Введите капчу:
					</div>
					<div id="blackout-div-window-content-form">
						<div style="margin-left: 65px;"><img id="img_captcha" style="margin-bottom: 10px;" src="` + getCookie('captcha_img') + `"></div>
						<div class="blackout-div-window-content-form-input">
								<input class="input-multi-up" type="text" name="captcha_input" placeholder="Код">
								<div class="input-error-info-div" name="password">
									<img onmouseover="showHint('show', this);" onmouseout="showHint('hide', this);" src="/images/info.svg">
									<div onmouseover="$(this).fadeIn(200);" onmouseover="$(this).fadeOut(200);"></div>
								</div>
						</div>
						<div class="blackout-div-window-content-form-input">
							<div class="input-multi-button" onclick="registrationStepThree();">
								<div class="center">Зарегистрироваться</div>
							</div>
							<div class="input-error-info-div" name="button">
									<img onmouseover="showHint('show', this);" onmouseout="showHint('hide', this);" src="/images/info.svg">
									<div onmouseover="$(this).fadeIn(200);" onmouseover="$(this).fadeOut(200);"></div>
							</div>
						</div>
					</div>
					`);
				} else {
					error = "Произошла неизвестная ошибка! Попробуйте зарегистироваться позже.";
					setErrorButton(error);
					changeButton(2, "Зарегистрироваться");	
				}
			}
		});
	} else {
		setErrorInput(input, error);
		changeButton(2, "Зарегистрироваться");	
	}
}
							
function registrationStepThree(){
	changeButton(1);
	
	var email = global_email;
	var password = global_pass;
	var input_captcha = $("input[name='captcha_input']");
	var captcha = $("input[name='captcha_input']").val();

	$.ajax({
		url: '/php/registration.php',
		type: 'POST',
		cache: 'false',
		data: { 'email': email, 'password': password, 'captcha': captcha },
		dataType: 'html',
		success: function(data){
			if(data == "success_reg"){
				$("#blackout-div-window").animate({ height: "280px" }, 100);
				$("#blackout-div-window-content").html(`
				<div id="blackout-div-window-content-step">
					Шаг 4 | Активация аккаунта:
				</div>
				<div style="text-align: justify;" id="reg-step-3-info-div">
					<span>Для завершения регистрации необходимо актировать ваш аккаунт. На ваш Email было выслано письмо со ссылкой активации аккаунта. Для его активации необходимо перейти по этой ссылке.</span><br>
				</div>
				<div style="margin-left: 30px; margin-top: 15px;"><a id="dont_give_mail_href" href="#" style="font-size: 15px;">Я не получил письма</a></div>
				`);
			} else if(data == "error0"){
				error = "Неверный код с картинки!";
				setErrorInput(input_captcha, error);
				changeButton(2, "Зарегистрироваться");
				$('#img_captcha').attr('src', getCookie('captcha_img'));
			} else if(data == "error1"){
				error = "Вы ввели некорректный Email!";
				setErrorButton(error);
				changeButton(2, "Зарегистрироваться");	
			} else if(data == "error2"){
				error = "Пароль должен состоять из 6 или более символов!";
				setErrorInput(input, error);
				changeButton(2, "Зарегистрироваться");	
			} else if(data == "error3"){
				error = "Данный Email уже зарегистрирован!";
				setErrorButton(error);
				changeButton(2, "Зарегистрироваться");	
			}
		}
	});
}