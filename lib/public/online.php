<?php
	
	function addOnline($mysql,$email,$nick){
		$addSql = "insert into tb_online(email,nick,onlineTime,lastTime) values('{$email}','{$nick}',NOW(),NOW())";
		$flag = $mysql -> insert($addSql);
		return $flag;
	}	
	
	function updateOnline($mysql,$email){
		$updateSql = "update tb_online set lastTime = NOW() where email = '{$email}'";
		$flag = $mysql -> update($updateSql);
		return $flag;
	}
	
	function deleteOnlineByDelTime($mysql,$delTime){
		$deleteSql = "delete from tb_online where LastTime < '{$delTime}'";
		$flag = $mysql -> delete($deleteSql);
		return $flag;
	}
	
	function getOnlineUser($mysql){
		$query = "select guId,email,nick,onlineTime,lastTime from tb_online order by onlineTime desc";
		$res = $mysql->Query($query);
		$array = $mysql->getRows($res);
		return $array;
	}
	
	function getOnlineUserByEmail($mysql,$email){
		$query = "select guId,email,nick,onlineTime,lastTime from tb_online where email = '{$email}'";
		$res = $mysql->Query($query);
		$array = $mysql->getRows($res);
		return $array;
	}
	
	function deleteOnlineUser($mysql,$email){
		$deleteSql = "delete from tb_online where email = '{$email}'";
		$flag = $mysql -> delete($deleteSql);
		return $flag;
	}

?>