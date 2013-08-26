<?php
	include 'lib/util/resultUtil.php';
	/**
	 * TODO 全局页面控制
	 */
	//开启会话
	if(!isset($_SESSION)){
		session_start();
	}
	//判断是否登录 是否为注册页面
	if(empty($_SESSION['user']['guId'])){
		$result = getFailureResultByMessage("not login");
		echo json_encode($result);
		exit ;
	}else{
		$session_user = $_SESSION['user'];
	}
?>