<?php
Class MySQL
{
	//发布时改成默认localhost
//	var $host = "localhost:3307";
//	var $user = "root";
//	var $passwd = "tsadmin123";
//	var $database = "sq_teesays";
	
	var $host = "localhost:3306";
	var $user = "root";
	//var $passwd = "insigma";
	var $passwd = "123456";
	var $database = "tiger";
	var $conn;

	//利用构造函数实现变量初始化
	//同时连接数据库操作
	function MySQL()
	{
		$this->conn=mysql_connect($this->host, $this->user,$this->passwd) or die("Could not connect to $this->host");
		mysql_select_db($this->database,$this->conn) or die("Could not switch to database $this->database");
	}

	//该函数实现数据库查询操作
	function Query($queryStr)
	{
		//解决中文显示乱码问题
		mysql_query("SET NAMES UTF8");
		$res = Mysql_query($queryStr, $this->conn) or die("Could not query database");
		return $res;
	}
	
	//插入数据库数据
	function insert($query)
	{
		$flag = true;
		//解决中文显示乱码问题
		mysql_query("SET NAMES UTF8");
		if(!mysql_query($query,$this->conn))
		{
			$flag = false;
		}
		return $flag;
	}
	
	//删除数据库数据
	function delete($query)
	{
		$flag = true;
		if(!mysql_query($query,$this->conn)){
			$flag = false;
		}
		return $flag;
	}
	
	function update($query)
	{
		$flag = true;
		//解决中文显示乱码问题
		mysql_query("SET NAMES UTF8");
		if(!mysql_query($query,$this->conn)){
			$flag = false;
		}
		return $flag;
	}
	
	//该函数返回记录集
	function getRows($res)
	{
		$rowno = 0;
		$rowno = MySQL_num_rows($res);
		if($rowno>0)
		{
			for($row=0;$row<$rowno;$row++ )
			{	
				/*
				 MYSQL_ASSOC - 关联数组
				 MYSQL_NUM - 数字数组
				 MYSQL_BOTH - 默认。同时产生关联和数字数组
				*/
				$rows[$row] = MySQL_fetch_array($res,MYSQL_ASSOC);
				
				//$rows[$row] = mysql_fetch_row($res);
				//本来为MySQL_fetch_row,但是不能以数组的方式来提取,只能用索引
				//这样可以用索引和名称，更为方便
			}
			return $rows;
		}
	}

	//该函数取回数据库记录数

	function getRowsNum($res)
	{
		$rowno = 0;
		$rowno = mysql_num_rows($res);
		return $rowno;
	}

	//该函数返回数据库表字段数
	function getFieldsNum($res)

	{
		$fieldno = 0;
		$fieldno = mysql_num_fields($res);
		return $fieldno;
	}

	//该函数返回数据库表字段名称集
	function getFields($res)
	{
		$fno = $this->getFieldsNum($res);
		if($fno>0)
		{
			for($i=0;$i<$fno;$i++ )
			{
				$fs[$i]=MySQL_field_name($res,$i);//取第i个字段的名称
			}
			return $fs;
		}
	}
	
	
	
	//关闭数据库连接
	function closeConnet()
	{
		mysql_close($con);
	}
	
}
?>