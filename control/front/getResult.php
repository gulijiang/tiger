<?php
	include '../../lib/util/resultUtil.php';
	
	
	if(!empty($_GET['method'])){
		$method = $_GET['method'];
		if($method=='getWinResult'){
			
			
			
			
		}else{
			//方法参数未传过来
			error();
		}
	}else{
		//方法参数未传过来
		error();
	}
	
	
	function errorMethod($message){
		$message = "error method";
		$result = getFailureResultByMessage($message);
		echo json_encode($result);
	}
	
	
?>