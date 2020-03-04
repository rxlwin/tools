<?php
/**
 * Author: 任小龙 Date:2020/2/13 Time:22:43
 * 报错的找不到的类或助手函数是基础laravel框架的,所以如果是在别的框架下,把这些方法改掉
 */


namespace rxlwin\tools\Json;


class Json
{
    private static $codeMsg = [
        200 => '',
        301 => '参数不合法'
    ];

    public static function success(array $data = [])
    {
        return self::export(200, '', $data, []);
    }

    public static function error(int $code, string $errMsg, array $errArr = [])
    {
        $msg = self::$codeMsg[$code];
        if (defined('APP_DEBUG')) {
            $data = ['errMsg' => $errMsg];
        } else {
            $data = [];
        }
        return self::export($code, $msg, $data, $errArr);
    }

    private static function export($code, $msg, $data, $errDara)
    {
        if (empty($data)) {
            $data = (object)[];
        }
        $resId = ParamExport::getImpressionId();
        $res = [
            'res_id' => $resId,
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
        //写日志,这里使用的是 laravel 的写法
        $logData = self::getParam();
        if (empty($errDara)) {
            $logData = array_merge($logData,['res'=>$res]);
            Log::stack(['info'])->info($resId, $logData);
        } else {
            $logData = array_merge($logData, ['res'=>$res], ['errorInfo' => $errDara]);
            Log::stack(['info','error'])->error($resId, $logData);
        }

        return response()->json($res);
    }

    private static function getParam()
    {
        $data = [
            'user_id' => UserExport::getUserId(),
            'device_id' => ParamExport::getDeviceID(),
            'IP' => ParamExport::getIP(),
            'route' => ParamExport::getLocalRoute(),
            'header' => ParamExport::getHeader(),
            'request' => ParamExport::getRequest(),
        ];
        return $data;
    }
}