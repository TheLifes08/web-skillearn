<?php 

if(!isset($_SESSION['authorized'])){
	if(isset($_COOKIE['sess']) && isset($_COOKIE['sess_k'])){
		$session = findSession($_COOKIE['sess']);
		
		if($session != NULL){
			if(password_verify($session->session_key, $_COOKIE['sess_k'])){
				$_SESSION['authorized'] = true;
				$_SESSION['user'] = getUser($session->user_id);
			} else {
				setcookie('sess', '', time()-1);
				setcookie('sess_k', '', time()-1);
			}
		} else {
			setcookie('sess', '', time()-1);
			setcookie('sess_k', '', time()-1);
		}
	}
}

?>