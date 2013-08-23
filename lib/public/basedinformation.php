<?php
	include '../../lib/database/DBconn.php';
	
	/**
	 * 查询所有的动物类别基础数据
	 */
	function getBasedinformations(){
		$mysql = new MySQL();
		$query = "select guId,name,probability,addition,times from tb_basedinformation";
		$res = $mysql->Query($query);
		$array = $mysql->getRows($res);
		return $array;
	}
	
	/**
	 * 根据Id查询所有的动物类别基础数据
	 * @param $guId
	 */
	function getBasedinformationById($guId){
		$mysql = new MySQL();
		$query = "select guId,name,probability,addition,times from tb_basedinformation where guId={$guId}";
		$res = $mysql->Query($query);
		$array = $mysql->getRows($res);
		return $array;
	}
	
	
	/**
	 * 通过id进行更新动物类别基础数据(注：不更新)
	 * @param $id
	 */
	function updateBasedinformationById($guId,$probability,$addition,$times){
		$mysql = new MySQL();
		$update = "update tb_basedinformation set probability='{$probability}',addition='{$addition}',times='{$times}' where guId={$guId}";
		$flag = $mysql ->update($update);
		return $flag;
	}
	
	/**
	 * 根据Id删除动物类别基础数据
	 * @param $guId
	 */
	function deleteBasedinformationById($guId){
		$mysql = new MySQL();
		$delete = "delete from tb_basedinformation where guId = {$guId}";
		$flag = $mysql ->delete($delete);
		return $flag;
	}
	
	
	
	
?>