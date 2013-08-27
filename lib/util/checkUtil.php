<?php
	//验证email的正确性
    function checkEmail($email){
        $ret=false;
        if(strstr($email, '@') && strstr($email, '.')){
            $reg = '/[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*$/';
            if(preg_match($reg, $email)){
                $ret=true;
            }
        }
        return $ret;
    }
    
    //判断是否是正整数，如果不是  返回false 是true
    function checkPositiveInteger($param){
    	$int_options = array("options"=>
		array("min_range"=>1));
		$flag = filter_var($param, FILTER_VALIDATE_INT, $int_options);
		return $flag;
    }
?>