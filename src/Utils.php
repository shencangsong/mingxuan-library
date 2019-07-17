<?php 
namespace Mingxuan;

class Utils{

    /**
     * 正则验证手机号
     * @param string $mobile
     * @return bool
     */
    static function preg_mobile($mobile = ''){
        if(preg_match("/^1[3456789]\d{9}$/", $mobile)){
            return true;
        }
        return false;
    }

    /**
     * utf8 字符长度
     * @param string $str
     * @return float|int
     */
    static function strlen_utf8($str = ''){
        return (mb_strlen($str) + strlen($str))/2;
    }
}