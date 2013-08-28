<?php
	include 'base.php';
	/**
	 * 添加用户
	 * @param $conditon
	 */
	function addUser($mysql,$condition){
		$sql = getInsertSql("tb_user", $condition);
		$flag = $mysql ->insert($sql);
		return $flag;
	}
	
	/**
	 * 通过guId更新用户信息
	 * @param $condition
	 * @param $guId
	 */
	function updateUserById($mysql,$condition,$guId){
		$sql = getUpdateSql("tb_user", $condition, $guId);
		$flag = $mysql ->update($sql);
		return $flag;
	}
	
	/**
	 * 根据Id查询用户
	 * @param $guId
	 */
	function getUserById($mysql,$guId){
		$query = "select guId,nick,pwd,secretQuestion,secretAnswer,mobile,sex,headPic,email,bankName,bankAccount,cardHolder,totalMoney,desirableMoney,".
		         "useableMoney,frostMoney,remainMoney,availableSilver from tb_user where guId = {$guId}";
		$res = $mysql ->Query($query);
		$array = $mysql->getRows($res);
		return $array;
	}
	
	
	/**
	 * 通过Email查询用户
	 */
	function getUserByEmail($mysql,$email){
		$query = "select guId,nick,pwd,secretQuestion,secretAnswer,mobile,sex,headPic,email,bankName,bankAccount,cardHolder,totalMoney,desirableMoney,".
		         "useableMoney,frostMoney,remainMoney,availableSilver from tb_user where email = '{$email}'";
		$res = $mysql ->Query($query);
		$array = $mysql->getRows($res);
		return $array;
	}
	
	/**
	 * 检查银两数够不够
	 * Enter description here ...
	 * @param $mysql
	 * @param $availableSilver
	 * @param $guId
	 */
	function checkAvailableSilver($mysql,$availableSilver,$guId){
		$query = "select count(*) as availableSilver from tb_user where guId = {$guId} and (availableSilver-{$availableSilver}) >= 0";
		$res = $mysql ->Query($query);
		$array = $mysql->getRows($res);
		return $array;
	}
	
	/**
	 * 扣除或加上银两
	 * @param $mysql
	 * @param $guId
	 * @param $availableSilver
	 */
	function deductAvailableSilver($mysql,$guId,$availableSilver){
		$updateSql = "update tb_user set availableSilver = availableSilver - {$availableSilver} where guId = {$guId}";
		$flag = $mysql -> update($updateSql);
		return $flag;
	}
	
	/**
	 * 判断总的钱够不够兑换的
	 * Enter description here ...
	 * @param $mysql
	 * @param $count 需要兑换银元的钱数
	 * @param $guId 
	 */
	function checkTotalMoney($mysql,$count,$guId){
		$query = "select count(*) as count from tb_user where guId = {$guId} and (totalMoney-{$count}) >= 0";
		$res = $mysql ->Query($query);
		$array = $mysql->getRows($res);
		return $array;
	}
	
	
	
	/**
	 * 钱转银元
	 * @param $mysql
	 * @param $count 需要兑换银元的钱数
	 * @param $guId
	 */
	function moneyTransToAvailableSilver($mysql,$count,$guId){
		$availableSilver = $count * 10;
		$updateSql = "update tb_user set totalMoney = totalMoney - {$count},desirableMoney = desirableMoney - {$count},useableMoney = useableMoney - {$count},remainMoney = remainMoney - {$count}"
					.",availableSilver = availableSilver + $availableSilver where guId = {$guId}";
		$flag = $mysql -> update($updateSql);
		return $flag;
	}
	
	/**
	 * 银元转钱
	 * @param $mysql
	 * @param $availableSilver 需要兑换钱的银元数
	 * @param $guId
	 */
	function availableSilverToMoney($mysql,$availableSilver,$guId){
		$count = $availableSilver/10;
		$updateSql = "update tb_user set totalMoney = totalMoney + {$count},desirableMoney = desirableMoney + {$count},useableMoney = useableMoney + {$count},remainMoney = remainMoney + {$count}"
					.",availableSilver = availableSilver - $availableSilver where guId = {$guId}";
		$flag = $mysql -> update($updateSql);
		return $flag;			
	}
	
	
?>