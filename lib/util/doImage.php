<?php
	/**
	 * 得到文件的前缀
	 * Enter description here ...
	 * @param $img 文件地址
	 */
	function getPrefix($img)
	{
	   $full_length = strlen($img);
       $type_length = strlen(getSurfix($img));
       $name_length = $full_length-$type_length;
       $name  = substr($img,0,$name_length-1);
       return $name;
	}
	
	/**
	 * 得到文件的后缀
	 * Enter description here ...
	 * @param $img 文件地址
	 */
	function getSurfix($img)
	{
		//或者类型
		 $type = substr(strrchr($img,"."),1);
		 return $type;
	}
	
	function getPicAddr($src,$width,$height){
		$prefix = getPrefix($src);
		$surfix = getSurfix($src);
		$picAddr = $prefix."-".$width."x".$height.".".$surfix;
		return  $picAddr;
	}
	
	//根据图片路径得到图片的高
	function getHeight($path){
		$size = getimagesize($path);
		return $size[0];
	}
	
	//根据图片路径得到图片的宽
	function getWidth($path)
	{
		$size = getimagesize($path);
		return $size[1];
	}
	
	function getTransPicAddr($name,$width,$height){
		$name = str_replace("source","release",$name);
		$resadd = getPicAddr($name, $width, $height);
		return $resadd;
	}
?>
	
	
	