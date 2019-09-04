<?php
/**
 * Author: 任小龙 Date:2019-09-03 Time:22:12
 */


namespace rxlwin\tools\redis;


class RedisConfig
{
    private static $config = null;

    public static function getConfig()
    {
        if (is_null(self::$config)) {
            throw new \Exception('请先设置Redis参数');
        }
        return self::$config;
    }

    public static function setRedis($host, $auth = '', $port = 6379)
    {
        self::$config = [
            'host' => $host,
            'port' => $port,
            'auth' => $auth
        ];
    }
}