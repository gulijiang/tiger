<?php
include '../../lib/util/resultUtil.php';
include '../../lib/database/DBconn.php';
include '../../lib/public/basedinformation.php';
include '../../lib/public/wholebase.php';
include '../../lib/public/user.php';
include '../../lib/public/session.php';
include '../../lib/public/online.php';
if(!empty($_GET['method'])){
	$method = $_GET['method'];
	if($method=='getWinResult'){
		//判断该用户的银两数是不是够
		if(!isset($_SESSION)){
			session_start();
		}
		$sessionUser = getSessionUser();
		$guId = $sessionUser['guId'];
		
		$mysql = new MySQL();
		$onlineUser = getOnlineUserByEmail($mysql, $sessionUser['email']);
		if(count($onlineUser) <= 0){
			addOnline($mysql, $sessionUser['email'], $sessionUser['nick']);
		}else{
			updateOnline($mysql, $sessionUser['email']);
		}
		
		//接受参数  并且判断压的总数是不是超过 (可以压的数量 如果不行则不给压，如果可以则再进行后续操作,暂时不考虑)
		$param = $_POST['param'];
		//1.数据  = 自身概率（百分数） * 整体基数 * 1/压数  $dataArray 就是所需要的数据
		$dataArray = getBasedinformations($mysql);
		$baseData = getWholebases($mysql);
		$wholeBase = $baseData[0]['wholeBase'];
		$flag = true;
		$tatalCount = 0;//总投的银两数
		$key = 0;//概率为0的下标
		for ($i = 0,$count = count($dataArray);$i < $count; $i++) {
			if($dataArray[$i]['probability'] == 0){
				$key = $i;
			}
			for ($j = 0,$length = count($param);$j < $length; $j++) {
				$dataArray[$i]['pinNumber'] = 0;
				if($param[$j]['pinNumber'] < 0 || !is_numeric($param[$j]['pinNumber'])){
					$result = getFailureResult();
					echo json_encode($result);exit();
				}
				if($dataArray[$i]['guId'] == $param[$j]['guId']){
					if($param[$j]['pinNumber'] == 0){
						$dataArray[$i]['realProbability'] = $dataArray[$i]['probability'] * $wholeBase;
						$dataArray[$i]['pinNumber'] = $param[$j]['pinNumber'];
						break;
					}
					else{
						$dataArray[$i]['realProbability'] = $dataArray[$i]['probability'] * $wholeBase * (1/$param[$j]['pinNumber']);
						$dataArray[$i]['pinNumber'] = $param[$j]['pinNumber'];
						break;
					}
				}
			}
		}
		for ($k2 = 0; $k2 < $length; $k2++) {
			$tatalCount += $param[$k2]['pinNumber'];
		}
		
		$resCount = checkAvailableSilver($mysql, $tatalCount, $guId);
		if($resCount[0]['availableSilver'] <= 0){
			$result = getFailureResultByMessage("可用银币不够,请兑换!");
			echo json_encode($result);exit();
		}
		//2.求出数组中的每个realProbability的最小值min，与最大值max
		$realProbabilityMin = $dataArray[0]['realProbability'];
		$realProbabilityMax = $realProbabilityMin;
		for ($j2 = 0; $j2 < $count; $j2++) {
			if($dataArray[$j2]['realProbability'] < $realProbabilityMin){
				$realProbabilityMin = $dataArray[$j2]['realProbability'];
			}
			if($dataArray[$j2]['realProbability'] > $realProbabilityMax){
				$realProbabilityMax = $dataArray[$j2]['realProbability'];
			}
		}
		//3.有php自带的方法 mt_rand(min,max) 生成一个数值 $rand
		$rand = mt_rand($realProbabilityMin, $realProbabilityMax);
		//4.然后 再分别求出 |$rand - 数值中的每个realProbability|，再求出差值最小的值 所对应的就是出现的中奖物体。
		$min = abs($dataArray[0]['realProbability'] - $rand);
		$index = 0;
		for ($k = 0; $k < $count; $k++) {
			$res = abs($dataArray[$k]['realProbability'] - $rand);
			$dataArray[$k]['absDif'] = $res;
			if($res < $min){
				$min = $res;
				$index = $k;
			}
		}
		$message =  $dataArray[$index];
		if($dataArray[$index]['probability'] == 0){
			//扣除银两
			dealAvailableSilver($mysql, $guId, $tatalCount,$message);
		}else{
			//概率不是0的话，
			if($dataArray[$index]['times'] == 0){//倍数是0
				$result = getSuccessResultByMessage($message);
				echo json_encode($result);
			}else{//倍数不是0
				$remindCount = $dataArray[$index]['pinNumber'] * $dataArray[$index]['times'] - $tatalCount;//赢的银子减去输的银子
				if($remindCount > 0){//赢得多
					//即目前有的钱数不能大于等于充值数   （可用银元 - 用的银元）/10 + 剩余  + 中奖  < 总数  => （可用银元 + 银的银元）/10 + 剩余 < 总数
					$user = getUserById($mysql, $guId);
					if(($user[0]['availableSilver'] + $remindCount)/10 + $user[0]['remainMoney'] < $user[0]['totalMoney']){//还是赢的
						//加上银两
						deductAvailableSilver($mysql, $guId, -$remindCount,$message);
					}else{//亏本了
						$message = $dataArray[$key];
						dealAvailableSilver($mysql, $guId, $tatalCount,$message);
					}
				}else{//赢得少
					dealAvailableSilver($mysql, $guId, -$remindCount,$message);
				}
			}
		}
	}else{
		//方法参数未传过来
		errorMethod();
	}
}else{
	//方法参数未传过来
	errorMethod();
}


/**
 * 扣除银两
 * @param $mysql
 * @param $guId
 * @param $count 应该扣除的银两
 */
function dealAvailableSilver($mysql,$guId,$tatalCount,$message){
	if(!deductAvailableSilver($mysql, $guId, $tatalCount)){
		error_log("扣除银两出错：用户Id".$guId."扣除的银两数：".$tatalCount);
		$result = getFailureResultByMessage("扣除银两出错");
		echo json_encode($result);
	}else{
		$result = getSuccessResultByMessage($message);
		echo json_encode($result);
	}
}




?>