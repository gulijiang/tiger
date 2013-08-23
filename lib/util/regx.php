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
?>