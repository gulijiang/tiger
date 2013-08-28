<?php
require_once("alipay.config.php");
require_once("lib/alipay_service.class.php");
include '../lib/database/DBconn.php';
header("Content-Type:text/html;charset=utf-8");
//还需要进行计算
//进行比较，不同则失败
$mysql = new MySQL();

$out_trade_no		= $_POST['out_trade_no'];		
$subject			= $_POST['subject'];	
$body				= $_POST['alibody'];	
$price				= $_POST['total_fee'];	

$logistics_fee		= $_POST['logistics_fee'];				
$logistics_type		= "EXPRESS";			
$logistics_payment	= "BUYER_PAY";			

$quantity			= "1";					

$receive_name		= $_POST['receive_name'];			
$receive_address	= $_POST['receive_address'];			
$receive_zip		= $_POST['receive_zip'];			
$receive_phone		= $_POST['receive_phone'];		
$receive_mobile		= $_POST['receive_mobile'];		

$show_url			= "http://www.teesays.com/main.php";

$query = "select * from tb_order where orderNo ='$out_trade_no'";
$res = $mysql->Query($query);
$array = $mysql->getRows($res);
if(count($array)<=0||$array[0]['money']!=$price||$array[0]['postalprice']!=$logistics_fee){
	header("Location:http://www.teesays.com/error.php?state=5");
}

$parameter = array(
		"service"			=> "create_partner_trade_by_buyer",
		"payment_type"		=> "1",
		
		"partner"			=> trim($aliapy_config['partner']),
		"_input_charset"	=> trim(strtolower($aliapy_config['input_charset'])),
        "seller_email"		=> trim($aliapy_config['seller_email']),
        "return_url"		=> trim($aliapy_config['return_url']),
        "notify_url"		=> trim($aliapy_config['notify_url']),

        "out_trade_no"		=> $out_trade_no,
        "subject"			=> $subject,
        "body"				=> $body,
        "price"				=> $price,
		"quantity"			=> $quantity,
		
		"logistics_fee"		=> $logistics_fee,
		"logistics_type"	=> $logistics_type,
		"logistics_payment"	=> $logistics_payment,
		
		"receive_name"		=> $receive_name,
		"receive_address"	=> $receive_address,
		"receive_zip"		=> $receive_zip,
		"receive_phone"		=> $receive_phone,
		"receive_mobile"	=> $receive_mobile,
		
        "show_url"			=> $show_url
);

$alipayService = new AlipayService($aliapy_config);
$html_text = $alipayService->create_partner_trade_by_buyer($parameter);
echo $html_text;

?>
