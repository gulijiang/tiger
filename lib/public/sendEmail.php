<?php
require_once ('email.class.php');//调用下面的邮件发送类
include '../../config/config.php';
function sendmail($smtpemailto,$mailbody){
	$smtp = new smtp(smtpserver,smtpserverport,true,smtpuser,smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = FALSE;//是否显示发送的调试信息
	if ($smtp->sendmail($smtpemailto, smtpusermail, mailsubject, $mailbody, mailtype)){
		return true;
	}else {
		return false;
	}
}
?>