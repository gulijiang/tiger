<?php
	include '../../lib/database/DBconn.php';
	include '../../lib/util/resultUtil.php';
	include '../../lib/public/user.php';
	include '../../lib/public/transRecord.php';
	//include '../../lib/public/online.php';
	include '../../lib/public/session.php';
	include '../../lib/util/checkUtil.php';
	
	if(!empty($_GET['method'])){
		$method = $_GET['method'];
		if($method=='transform'){
			$sessionUser = getSessionUser();
			
			$type = $_POST['type'];//类型，是钱转银元 0  还是银元转钱 1
			$count = $_POST['count'];//钱或者银币数量
			
			//判断类型是否是0 或者 1
			if(!($type == 0 || $type == 1)){
				$result = getFailureResultByMessage("类型不对!");
				echo json_encode($result);exit();
			}
			if(!is_numeric($count)){
				$result = getFailureResultByMessage("钱或者银币数量输入格式不正确!");
				echo json_encode($result);exit();
			}
			$mysql = new MySQL();
			//判断count
			if($type==0){
				if(checkPositiveInteger($count)){
					//判断这个钱数 是不是 大于等于 总的钱
					$guId = $sessionUser['guId'];
					$resCount = checkTotalMoney($mysql, $count, $guId);
					if($resCount[0]['count'] <= 0){
						$result = getFailureResultByMessage("总的金额不够需要兑换的金额!");
						echo json_encode($result);exit();
					}else{
						//事务开始：
						mysql_query("BEGIN");
						$flag1 = moneyTransToAvailableSilver($mysql, $count, $guId);
						$flag2 = addTransRecord($mysql, $guId, 0, $count, $count*10);
						if($flag1 && $flag2){
							mysql_query("COMMIT");
							$result = getSuccessResultByMessage("钱兑换成银元成功!");
							echo json_encode($result);exit();
						}else{
							mysql_query("ROLLBACK");
							$result = getFailureResultByMessage("系统忙碌，请稍后操作!");
							echo json_encode($result);exit();
						}
					}
				}else{
					$result = getFailureResultByMessage("输入的钱必须是正整数!");
					echo json_encode($result);exit();
				}
			}
			if($type==1){//银元转钱
				if($count==0 || (!checkPositiveInteger($count/10))){
					$result = getFailureResultByMessage("输入的银元数不是10的倍数，银元转钱必须是10的倍数!");
					echo json_encode($result);exit();
				}else{
					//判断这个银元数是不是大于等于目前有的银元数
					$guId = $sessionUser['guId'];
					$array = checkAvailableSilver($mysql, $count, $guId);
					if($array[0]['availableSilver'] <= 0){
						$result = getFailureResultByMessage("总的银元不够需要兑换的银元!");
						echo json_encode($result);exit();
					}else{
						//事务开始：
						mysql_query("BEGIN");
						$flag1 = availableSilverToMoney($mysql, $count, $guId);
						$flag2 = addTransRecord($mysql, $guId, 1, $count/10, $count);
						if($flag1 && $flag2){
							mysql_query("COMMIT");
							$result = getSuccessResultByMessage("银元兑换成钱成功!");
							echo json_encode($result);exit();
						}else{
							mysql_query("ROLLBACK");
							$result = getFailureResultByMessage("系统忙碌，请稍后操作!");
							echo json_encode($result);exit();
						}
					}
				}
			}
		}
		else{
			error();
		}
	}else{
		error();
	}
	

?>