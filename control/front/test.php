<?php
   include '../../lib/util/resultUtil.php';
   include '../../lib/public/basedinformation.php';
   include '../../lib/public/base.php';
   //include '../../lib/database/DBconn.php';
   if($_GET['method']){
   		$condition['wholeBase'] = 1/40;
   		$condition['maxNumber'] = 20;
   		insert('tb_wholebase', $condition);
   		//$result = $_GET['result_message'];
   		
   		//$result = json_decode($param);
   		/*for ($i = 0 ,$count = count($result) ; $i < $count; $i++) {
   			echo $result[$i]['guId'];
   		}
   		return ;*/
   		//$message = getBasedinformations();
   		/*$result['max'] = mt_getrandmax();
		for ($i = 0; $i < 100; $i++) {
			$result[$i] = mt_rand(0.00001, 100);
		} 
		$result['total'] = 1/7 * 0.5 * 1/10 ;  */	
   	  	//$result = getSuccessResultByMessage($message);
   	    //echo json_encode($result);
   }else{
   		$array['result_code'] = 0;
   		echo json_encode($array);
   }
?>