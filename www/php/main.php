<?php

require_once($root."libraries/php/rb.php");
require_once($root."libraries/php/WSDLphp.php");
require_once($root."libraries/php/functions.php");
require_once($root."php/info.php");

connectDB($db_host, $db_name, $db_login, $db_password);

session_start();

require_once($root."php/security.php");
require_once($root."libraries/php/simple-php-captcha/simple-php-captcha.php");

?>