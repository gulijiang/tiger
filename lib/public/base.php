<?php
	
	function getInsertSql($table,$condition){
		$sql = "insert into `$table` set ";
		$content = null;
		foreach ($condition as $k => $v ) {
			$v_str = null;
			if(is_numeric($v)){
				$v_str = "'{$v}'";
			}
			else if(is_null($v)){
				$v_str = 'NULL';
			}else{
				$v_str = "'".escape_string($v)."'";
			}
			$content .= "`$k`=$v_str,";
		}
		$content = trim($content,',');
		$sql .= $content;
		return $sql;
	}
	
	
	function getUpdateSql($table,$condition,$guId){
		$sql = "update `$table` set ";
		$content = null;
		foreach ($condition as $k => $v ) {
			$v_str = null;
			if(is_numeric($v)){
				$v_str = "'{$v}'";
			}
			else if(is_null($v)){
				$v_str = 'NULL';
			}else{
				$v_str = "'".escape_string($v)."'";
			}
			$content .= "`$k`=$v_str,";
		}
		$content = trim($content,',');
		$content .= " where guId = {$guId}";
		$sql .= $content;
		return $sql;
	} 
	
	function escape_string($string){
		return @mysql_real_escape_string($string);
	}
?>