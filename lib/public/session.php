<?php
	
	function getSessionUser(){
		//开启会话
		if(!isset($_SESSION)){
			session_start();
		}
		if(empty($_SESSION['user']['guId'])){
			$result = getFailureResultByMessage("not login");
			echo json_encode($result);
			exit ;
		}else{
			$session_user = $_SESSION['user'];
			return $session_user;
		}
	}

	
?>