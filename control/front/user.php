<?php
	include '../../lib/util/resultUtil.php';
	include '../../lib/public/user.php';
	if(!empty($_GET['method'])){
		$method = $_GET['method'];
		if($method=='registUser'){
			$userParam = $_POST['param'];
			
			
			
			
		}else{
			error();
		}
	}else{
		error();
	}
?>