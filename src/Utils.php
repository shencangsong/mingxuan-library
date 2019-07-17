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

    /**
     * 计算两点地理坐标之间的距离
     * @param  Decimal $longitude1 起点经度
     * @param  Decimal $latitude1  起点纬度
     * @param  Decimal $longitude2 终点经度
     * @param  Decimal $latitude2  终点纬度
     * @param  Int     $unit       单位 1:米 2:公里
     * @param  Int     $decimal    精度 保留小数位数
     * @return Decimal
     */
    static function distance($longitude1, $latitude1, $longitude2, $latitude2, $unit=2, $decimal=2){
        $EARTH_RADIUS = 6370.996; // 地球半径系数
        $PI = 3.1415926;

        $radLat1 = $latitude1 * $PI / 180.0;
        $radLat2 = $latitude2 * $PI / 180.0;

        $radLng1 = $longitude1 * $PI / 180.0;
        $radLng2 = $longitude2 * $PI /180.0;

        $a = $radLat1 - $radLat2;
        $b = $radLng1 - $radLng2;

        $distance = 2 * asin(sqrt(pow(sin($a/2),2) + cos($radLat1) * cos($radLat2) * pow(sin($b/2),2)));
        $distance = $distance * $EARTH_RADIUS * 1000;

        if($unit==2){
            $distance = $distance / 1000;
        }
        return round($distance, $decimal);
    }
}