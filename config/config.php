<?php
	define("nick", "匿名");
	define("success", "success");
	define("error", "error");
	define("notexist", "notexist");
	define("exist", "exist");
	define("nickerror", "nickerror");
	
	//SMTP服务器
	define("smtpserver", "smtp.163.com");
	
	//SMTP服务器端口
	define("smtpserverport", 25);
	
	//SMTP服务器的用户邮箱
	define("smtpusermail", "glj19881215@163.com");
	
	//SMTP服务器的用户帐号
	define("smtpuser", "glj19881215@163.com");
	
	//SMTP服务器的用户密码
	define("smtppass", "5330820");
	
	//邮件主题
	define("mailsubject", "TeeSays.com用户注册激活!");
	
	//邮件格式（HTML/TXT）,TXT为文本邮件
	define("mailtype", "HTML");
	
	//查找用户上传的所有设计图方法参数传入(值可以配置)
	define("getUserImageMes", "getUserImageMes");
	
	//删除后台用户上传的衣服图片,方法参数传入(值可以配置)
	define("delUploadPic", "delUploadPic");
	
	//删除用户上传的设计图,方法参数传入(值可以配置)
	define("delUserPic", "delUserPic");
	
	//用户设计图通过是否加入队列进行查询
	define("queue", "queue");
	
	//上架
	define("doshelf", "doshelf");
	
	//转换存放的地方
	define("release", "release");
	
	//大图尺寸宽
	define("bigwid", "481");
	
	//大图尺寸高
	define("bighei", "612");
	
	//小图尺寸宽
	define("smallwid", "80");
	
	//大图尺寸高
	define("smallhei", "80");
	
	//中图尺寸宽
	define("midwid", "150");
	
	//中图尺寸高
	define("midhei", "150");
	
	//删除whole
	define("delWhole", "delWhole");

	define("HTTP_HOST",$_SERVER ['HTTP_HOST']); 
?>