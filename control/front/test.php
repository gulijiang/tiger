<?php
include '../../lib/util/resultUtil.php';
include '../../lib/public/basedinformation.php';
include '../../lib/util/checkUtil.php';
//include '../../lib/public/wholebase.php';
if($_GET['method']){
	var_dump(1/10);
	
	//echo date("Y-m-d H:i:s",time()-30*60);
	 
	 
	//echo md5(123456);
	/* $now = time() -30;
	 echo $now;*/
	/*$message = getBasedinformations();
	 echo json_encode($message);
	 echo "<br/>";*/
	/*$res = getWholebases();
	 echo json_encode($res);*/
	//$result = md5(123456);
	//$result = $_GET['result_message'];
	 
	//$result = json_decode($param);
	/*for ($i = 0 ,$count = count($result) ; $i < $count; $i++) {
	 echo $result[$i]['guId'];
	 }
	 return ;*/
	/*$result['max'] = mt_getrandmax();
		for ($i = 0; $i < 100; $i++) {
		$result[$i] = mt_rand(0.00001, 100);
		}
		$result['total'] = 1/7 * 0.5 * 1/10 ;  */
	/*$result = getSuccessResultByMessage($message);
	 echo json_encode($result);*/
}else{
	$array['result_code'] = 0;
	echo json_encode($array);
}
?>