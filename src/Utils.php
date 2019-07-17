<?php 
namespace Mingxuan;

class Utils{
    /** curl 请求
     * @param $url
     * @param null $postFields
     * @param int $timeout
     * @param array $headers
     * @return bool|string
     */
    static function curl_file_get_contents($url, $postFields = null, $timeout = 100,$headers = [])
    {
        set_time_limit(0);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:26.0) Gecko/20100101 Firefox/26.0');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if($headers){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        if ($postFields) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        }
        $content = curl_exec($ch);
        curl_close($ch);
        return $content;
    }

    /**
     * 正则验证手机号
     * @param string $mobile
     * @return bool
     */
    static function verifyMobile($mobile = ''){
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
    static function strlenUtf8($str = ''){
        return (mb_strlen($str) + strlen($str))/2;
    }
}