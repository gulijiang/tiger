<?php
	include '../../lib/util/resultUtil.php';
	include '../../lib/public/user.php';
	include '../../lib/database/DBconn.php';
	include '../../lib/public/online.php';
	if(!empty($_GET['method'])){
		$method = $_GET['method'];
		if($method=='login'){//登录
			$mysql = new MySQL();
			$email = $_POST['email'];
			$pwd = $_POST['pwd'];
			if(empty($email)){
				$result = getFailureResultByMessage("账号不能为空!");
				echo json_encode($result);exit();
			}
			if(empty($pwd)){
				$result = getFailureResultByMessage("密码不能为空!");
				echo json_encode($result);exit();
			}
			$user = getUserByEmail($mysql, $email);
			if(count($user) <= 0){
				$result = getFailureResultByMessage("账号不正确!");
				echo json_encode($result);exit();
			}
			if($user[0]['pwd'] == md5(trim($pwd))){
				//开启会话
				session_cache_limiter('private');
				$cache_limiter = session_cache_limiter();
				session_cache_expire(30);
				if(!isset($_SESSION)){
					session_start();
				}
				$_SESSION['user'] = $user[0];
				$result = getSuccessResult();
				$onlineUser = getOnlineUserByEmail($mysql, $user[0]['email']);
				if(count($onlineUser) <= 0){
					addOnline($mysql, $user[0]['email'], $user[0]['nick']);
				}else{
					updateOnline($mysql, $user[0]['email']);
				}
				echo json_encode($result);
			}else{
				$result = getFailureResultByMessage("密码不正确!");
				echo json_encode($result);
			}
		}
		else if($method == 'logout'){
			if(!isset($_SESSION)){
				session_start();
			}
			if($_SESSION['user']['email'] != ""){
			   $mysql = new MySQL();
			   deleteOnlineUser($mysql, $_SESSION['user']['email']);
			}	
			$_SESSION['user']['guId']="";
			$result = getSuccessResultByMessage("退出成功!");
			echo json_encode($result);
		}
		else{
			errorMethod();
		}
	}else{
		errorMethod();
	}
?>