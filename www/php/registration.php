<?php

$root = "../";
require_once("main.php");

$email = $_POST['email'];
$password = $_POST['password'];
$result = "success";

if(isset($_SESSION['captcha']['code']) && isset($_POST['captcha'])){
	if(($_POST['captcha'] != $_SESSION['captcha']['code'])){
		$result = "error0";
		$_SESSION['captcha'] = simple_php_captcha();
		setcookie('captcha_img', $_SESSION['captcha']['image_src'], 0, '/');
	} else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		$result = "error1";
	else if(strlen($password) < 6)
		$result = "error2";
	else if(R::count('users', 'email = ?', array($email)) > 0)
		$result = "error3";
	else {
	$user = R::dispense("users");
	$user->email = $email;
	$user->password = password_hash($password, PASSWORD_BCRYPT);

	$id = getRandomString(32);

	while(R::count('users', 'confirmID = ?', array($id)) > 0)
		$id = getRandomString(32);

	$user->confirm_id = $id;

	R::store($user);

	mkdir($root."images/profile/".((findUser($email))->id)."/", 0777);
	mkdir($root."images/profile/".((findUser($email))->id)."/icon/", 0777);

	$headers = 'MIME-Version: 1.0\r\n';
	$headers .= 'Content-type: text/html; charset=utf-8\r\n';
	$link = $site."profile/activation/".$id;

	$message = '<!DOCTYPE html><html><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><style type="text/css"> #button-activating-account { background-color: #428bca; } #button-activating-account:hover { background-color: #52ADFC; } #button-activating-account, #button-activating-account:hover { transition: all.1s ease; -webkit-transition: all.1s ease; -moz-transition: all.1s ease; -o-transition: all.1s ease; -ms-transition: all.1s ease; } @media screen { @font-face{ font-family: "Lato"; font-style: normal; font-weight: 400; src: local("Lato Regular"), local("Lato-Regular"), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format("woff"); } @font-face { font-family: "Lato"; font-style: normal; font-weight: 700; src: local("Lato Bold"), local("Lato-Bold"), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format("woff"); } @font-face { font-family: "Lato"; font-style: italic; font-weight: 400; src: local("Lato Italic"), local("Lato-Italic"), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format("woff");} @font-face { font-family: "Lato"; font-style: italic; font-weight: 700; src: local("Lato Bold Italic"), local("Lato-BoldItalic"), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format("woff"); }} body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; } table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; } img { -ms-interpolation-mode: bicubic; } img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; } table { border-collapse: collapse !important; } body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; } a[x-apple-data-detectors] { color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; } @media screen and (max-width:600px){ h1{ font-size: 32px !important; line-height: 32px !important; }} div[style*="margin: 16px 0;"] { margin: 0 !important; }</style></head><body style="background-color: #d2d2d2; margin: 0 !important; padding: 0 !important;"><div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: "Lato", Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">Подтверждение почты: </div><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td bgcolor="#2b2a29" align="center"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" ><tr><td align="center" valign="top" style="padding: 40px 10px 40px 10px;"><a href="http://litmus.com" target="_blank"><img alt="Logo" src="http://litmuswww.s3.amazonaws.com/community/template-gallery/ceej/logo.png" width="40" height="40" style="display: block; width: 40px; max-width: 40px; min-width: 40px; font-family: "Lato", Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px;" border="0"></a></td></tr></table></td></tr><tr><td bgcolor="#2b2a29" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" ><tr><td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400;  line-height: 48px;"><h1 style="font-size: 36px; font-weight: 600; margin: 0; color: #428bca; font-family: fantasy">Активация аккаунта</h1></td></tr></table></td></tr><tr><td bgcolor="#2b2a29" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" ><tr><td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" ><p style="margin: 0;">Здравствуйте, <br><br>Благодарим вас за регистрацию на нашем веб-сайте SkillEarn.ru. Чтобы завершить регистрацию, нажмите на кнопку ниже: </p></td></tr><tr><td bgcolor="#ffffff" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td bgcolor="#ffffff" align="center" style="padding: 6px 30px 24px 30px;"><table border="0" cellspacing="0" cellpadding="0"><tr><td align="center" style="border-radius: 3px;" bgcolor="#FFA73B"><a id="button-activating-account" href="'.$link.'" target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 4px; border: 1px solid #428bca; display: inline-block; background-color: #428bca">Активировать</a></td></tr></table></td></tr></table></td></tr><tr><td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" ><p style="margin: 0;">Если по какой-то причине кнопка не работает, вы можете перейти по следующей ссылке:</p></td></tr><tr><td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" ><p style="margin: 0;"><a href="'.$link.'" target="_blank" style="color: #428bca;">'.$link.'</a></p></td></tr><tr><td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" ><p style="margin: 0;">Если вы не регистрировались на нашем сайте, проигнорируйте это письмо. Чтобы связаться с нами, пришлите электронное письмо по адресу: </p><a style="margin-top: 10px; text-align: center;" href="mailto:skillearn@inbox.ru">skillearn@inbox.ru</a></td></tr><tr><td bgcolor="#ffffff" align="left" style="padding: 20px 30px 15px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif;" ><p style="margin: 0; font-size: 15px">С Уважением, <br> Команда SkillEarn</p></td></tr><tr><td bgcolor="#ffffff" align="left" style="border-bottom: 1px solid #d8d8d8; padding: 0px 30px 12px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; border-bottom: 1px solid lightgray" ><sub style="margin: 0; font-size: 12px;"> P.S. Это письмо сгенерировано автоматически, пожалуйста, не отвечайте на него.</sub></td></tr><tr><td align=center bgcolor="#ffffff" align="left" style="padding: 12px 30px 4px 30px; color: black; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" ><p style="margin: 0; font-size: 14px;"> Copyright &copy; SkillEarn Team  </p></td></tr><tr><td align=center bgcolor="#ffffff" align="left" style="padding: 0px 30px 24px 30px; border-radius: 0px 0px 4px 4px; color: black; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px; " ><p style="margin: 0; font-size: 14px;"> <a href=# style="margin: 0; font-size: 14px;text-decoration: none; color: #428bca">О нас </a><span style="color: #333333;">&#124;</span><a href=# style="margin: 0; font-size: 14px;text-decoration: none;color: #428bca"> Политика конфиденциальности</a>  </p></td></tr></table></td></tr><tr><td bgcolor="#2b2a29" align="center" style="padding: 0px 10px 0px 10px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"><tr><td bgcolor="#2b2a29" align="left" style="padding: 0px 30px 30px 30px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"></td></tr></table></td></tr></table></body></html>';

	mail($email, "Активация аккаунта - SkillEarn", $message, $headers);
	setcookie('captcha_img', $_SESSION['captcha']['image_src'], time()-1, '/');
	$_SESSION['captcha'] = NULL;	
	$result = "success_reg";
	}
} else {
	$_SESSION['captcha'] = simple_php_captcha();
	setcookie('captcha_img', $_SESSION['captcha']['image_src'], 0, '/');
}

echo $result;

?>