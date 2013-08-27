<?php
	include '../../lib/database/DBconn.php';
	include '../../lib/util/resultUtil.php';
	include '../../lib/public/user.php';
	include '../../lib/public/online.php';
	include '../../lib/public/session.php';
	
	if(!empty($_GET['method'])){
		$method = $_GET['method'];
		if($method=='registUser'){
			$userParam = $_POST['param'];
			
			
			
			
		}
		else if($method == "getOnlineUser"){
			getSessionUser();
			$mysql = new MySQL();
			$time = time() - 30*60;
			$delTime = date("Y-m-d H:i:s",$time);
			deleteOnlineByDelTime($mysql, $delTime);
			$array = getOnlineUser($mysql);
			$result = getSuccessResultByMessage($array);
			echo json_encode($result);
		}
		else if($method == "getUserInfo"){
			$sessionUser = getSessionUser();
			$mysql = new MySQL();
			$guId = $sessionUser['guId'];
			$userArray = getUserById($mysql, $guId);
			$result = getSuccessResultByMessage($userArray);
			echo json_encode($result);
		}
		else{
			error();
		}
	}else{
		error();
	}
?>