<?php
	include '../../lib/public/doImage.php';
	//图片上传类
	function  uploadImage($sRealPath,$myfile,$dir,$filename){
	if($_FILES[$myfile]['error'] > 0)
	{
		return false;
	}else if((($_FILES[$myfile]["type"] == "image/gif") 
				|| ($_FILES[$myfile]["type"] == "image/jpeg") 
				|| ($_FILES[$myfile]["type"] == "image/png") 
				|| ($_FILES[$myfile]["type"] == "image/pjpeg")) 
				&& (($_FILES[$myfile]["size"]/1024)<500)) {
		$UPURL = $sRealPath.$dir.$filename.".".getSurfix($_FILES[$myfile]["name"]);
 		move_uploaded_file($_FILES[$myfile]["tmp_name"],iconv("utf-8","gb2312",$UPURL));
 		return  true;		
	}else {
		//echo "图片类型为.gif或 .jpeg或者.png文件且大小限制为500K";
		return  false;
	}	
	}
?>