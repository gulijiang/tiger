<?php
	
	function addTransRecord($mysql,$userId,$type,$money,$silverdollar){
		$addSql = "insert into tb_transRecord(userId,type,insertTime,money,silverdollar) values({$userId},{$type},NOW(),{$money},{$silverdollar})"; 
		$flag = $mysql ->insert($addSql);
		return $flag;
	}


?>