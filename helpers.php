<?php
/**
 * Created by PhpStorm.
 * User: renxiaolong
 * Date: 2019/1/2
 * Time: 12:55
 */

function p($var, $exit = false, $echo = false){
    static $i = 0;
    ob_start();
    var_dump($var);
    $output = ob_get_clean();
    $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
    if (PHP_SAPI == 'cli') {
        $output = PHP_EOL . $output . PHP_EOL;
    } else {
        if ($i%2 == 0){
            $color = '#ccffcc';
        } else {
            $color = '#ff9999';
        }
        $i++;        //#ff9999 粉色       #ccffcc 浅绿色
        $output = "<pre style='padding: 25px;background: " . $color . "'>" . $output . '</pre>';
    }
    if ($echo === false) {
        echo($output);
        if ($exit)        {
            exit();
        }
    }
    return $output;
}

function t($flag){
    static $startTime = 0;
    static $lastTime = 0;
    $time = microtime(true);
    if ($startTime === 0){
        $startTime = $time;
        $str1 = '第一次';
    } else {
        $str1 = '距离第一次: ' . ($time - $startTime)*1000 . ' 毫秒';
    }
    if ($lastTime !== 0){
        $str2 = '距离上次: ' . ($time - $lastTime)*1000 . ' 毫秒';
    } else {
        $str2 = '';
    }
    $lastTime = $time;

    p('[ ' . $flag . ' ] ' . $str1 . ' | ' . $str2);
}