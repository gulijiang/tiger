<?php
	
	function addRecord($mysql,$userId,$type,$money,$transNo){
		$addSql = "insert into tb_record(userId,type,money,state,insertTime,updateTime,transNo) values({$userId},{$type},{$money},{$state},NOW(),NOW(),{$transNo})";
		$flag = $mysql -> insert($addSql);
		return $flag;
	}
	
	function updateState($mysql,$state,$transNo){
		$updateSql = "update tb_record set state = {$state} where transNo = {$transNo}";
		$flag = $mysql -> update($addSql);
		return $flag;
	}
	
?>