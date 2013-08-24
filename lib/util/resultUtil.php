<?php
	
	/**
	 * 返回成功信息
	 */
	function getSuccessResult(){
		$result['result_code'] = 0;
		$result['result_message'] = 'success';
		return $result;
	}
	
	/**
	 * 返回成功信息
	 * @param $message 返回内容
	 */
	function getSuccessResultByMessage($message){
		$result['result_code'] = 0;
		$result['result_message'] = $message;
		return $result;
	}
	
	/**
	 * 返回失败信息
	 */
	function getFailureResult(){
		$result['result_code'] = 1;
		$result['result_message'] = 'error';
		return $result;
	}
	
	/**
	 * 返回失败信息
	 * @param $message 失败内容
	 */
	function getFailureResultByMessage($message){
		$result['result_code'] = 1;
		$result['result_message'] = $message;
		return $result;
	}
	
	/**
	 * 错误信息
	 * @param $message
	 */
	function errorMethod(){
		$message = "error method";
		$result = getFailureResultByMessage($message);
		echo json_encode($result);
	}
?>