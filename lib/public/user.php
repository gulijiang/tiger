<?php
	include '../../lib/database/DBconn.php';
	include './base.php';
	/**
	 * 添加用户
	 * @param $conditon
	 */
	function addUser($condition){
		$mysql = new MySQL();
		$sql = getInsertSql("tb_user", $condition);
		$flag = $mysql ->insert($sql);
		return $flag;
	}
	
	/**
	 * 通过guId更新用户信息
	 * @param $condition
	 * @param $guId
	 */
	function updateUserById($condition,$guId){
		$mysql = new MySQL();
		$sql = getUpdateSql("tb_user", $condition, $guId);
		$flag = $mysql ->update($sql);
		return $flag;
	}
	
	/**
	 * 根据Id查询用户
	 * @param $guId
	 */
	function getUserById($guId){
		$mysql = new MySQL();
		$query = "select guId,nick,pwd,secretQuestion,secretAnswer,mobile,sex,headPic,email,bankName,bankAccount,cardHolder,totalMoney,desirableMoney,".
		         "useableMoney,frostMoney,remainMoney,availableSilver from tb_user where guId = {$guId}";
		$flag = $mysql ->update($query);
		return $flag;
	}
	
	
	
?>