#!/usr/bin/php -q
<?php
/*
  +----------------------------------------------------------------------+
  | Name:make_newlog.php
  +----------------------------------------------------------------------+
  | Comment:创建模拟新格式的日志(一天的),使用方法直接./make_newlog.php > resultfile
  +----------------------------------------------------------------------+
  | Author:Evoup     evoex@126.com                                                     
  +----------------------------------------------------------------------+
  | Create: 2015-04-30 15:58:59
  +----------------------------------------------------------------------+
  | Last-Modified: 2015-04-30 15:59:09
  +----------------------------------------------------------------------+
*/
set_time_limit(86400);
@ini_set ('memory_limit', '-1');
date_default_timezone_set('PRC');

if ( isset($argv[1]) && !empty($argv[1]) ) {
    $mytime=strtotime($argv[1]);
} else {
    $mytime=time();
}

$tm_temp_start=strtotime(date('Y-m-d',$mytime)." 00:00:00");
$tm_temp_end=strtotime(date('Y-m-d',$mytime)." 23:59:59");

// 活动id|广告位|类型|ip|session|timestamp|device_id|device_type|dt|os|province_code|city_code|platform

$probably=15; // 几率重复该秒
for($i=$tm_temp_start;$i<$tm_temp_end;) {
    if (time()%$probably!=$probably-1) {
    } else {
        $i++;
    }
    // 活动id
    $campaign_id=rand(90004911,90034911);

    // 广告位id
    $ad_id=rand(90031770,90041770);

    // 类型（展示还是点击）
    $type=(rand()%2==1)?1:11;

    // ip
    $ip=rand(0,255).'.'.rand(0,255).'.'.rand(0,255).'.'.rand(0,255);

    // session
    $session=create_sid();

    // timestamp
    $timestamp=$i;

    // device_id
    $device_id=create_device_id();

    // device_type(imei:0,mac:1,idfa:2,android id:3,udid:4,durid:5)
    $device_type=rand(0,5);

    // dt
    $dt=date('Y-m-d',$mytime);

    // os,0为ios，1为android
    $os=rand(0,1);

    // province_code暂时为空
    $province_code='';

    // city_code
    $city_code='';

    // platform
    $platform=0;
    echo "{$campaign_id}|{$ad_id}|{$type}|{$ip}|{$session}|{$timestamp}|{$device_id}|{$device_type}|{$dt}|{$os}|{$province_code}|{$city_code}|{$platform}\n";
}

/**
 * @brief 创建随机sid
 * @param $length 长度
 * @return 
 */
function create_sid($length = 8) {
    $randsid = '';
    for ($i = 0; $i < $length; $i++) {
        $randsid .= chr(mt_rand(97, 122));
    }
    return $randsid;
}

/**
 * @brief 创建device id
 * @return 
 */
function create_device_id($length = 12) {
    $randsid = '';
    for ($i = 0; $i < $length; $i++) {
        $randsid .= chr(mt_rand(97, 122));
    }
    return $randsid;
}
?>
