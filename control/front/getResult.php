<?php
	include '../../lib/util/resultUtil.php';
	include '../../lib/database/DBconn.php';
	include '../../lib/public/basedinformation.php';
	include '../../lib/public/wholebase.php';
	
	if(!empty($_GET['method'])){
		$method = $_GET['method'];
		if($method=='getWinResult'){
			$mysql = new MySQL();
			//接受参数  并且判断压的总数是不是超过 (可以压的数量 如果不行则不给压，如果可以则再进行后续操作,暂时不考虑)
			$param = $_POST['param'];
			//1.数据  = 自身概率（百分数） * 整体基数 * 1/压数  $dataArray 就是所需要的数据
			$dataArray = getBasedinformations($mysql);
			$baseData = getWholebases($mysql);
			$wholeBase = $baseData[0]['wholeBase'];
			for ($i = 0,$count = count($dataArray);$i < $count; $i++) {
				for ($j = 0,$length = count($param);$j < $length; $j++) {
					if($dataArray[$i]['guId'] == $param[$j]['guId']){
						if($param[$j]['pinNumber'] < 0 || !is_numeric($param[$j]['pinNumber'])){
							$result = getFailureResult();
							echo json_encode($result);
							break 2;
						}
						else if($param[$j]['pinNumber'] == 0){
							$dataArray[$i]['realProbability'] = $dataArray[$i]['probability'] * $wholeBase;
							break;
						}
						else{
							$dataArray[$i]['realProbability'] = $dataArray[$i]['probability'] * $wholeBase * (1/$param[$j]['pinNumber']);
							break;
						}
					}
				}
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
			$result = getSuccessResultByMessage($message);
			echo json_encode($result);
		}else{
			//方法参数未传过来
			error();
		}
	}else{
		//方法参数未传过来
		error();
	}
	
	
	
	
	
	
	
?>