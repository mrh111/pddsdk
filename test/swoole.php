<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/19
 * Time: 10:32
 */
error_reporting(E_ALL);
require dirname(__DIR__) . '/vendor/autoload.php';

class  swooleDemo
{
    public function __construct()
    {
        $http = new \swoole_http_server("0.0.0.0", 10000);
        $http->set(array(
            'worker_num' => 2,
            'dispatch_mode' => 2,
            'reload_async' => true,
            'max_wait_time' => 50,
            'daemonize' => 0,
            'max_request' => 20000
        ));
        $http->on('Start', [$this, 'onStart']);
        $http->on("request", [$this, 'onRequest']);
        $http->start();
    }

    public function onStart(\swoole_server $server)
    {
        echo "swoole is start 0.0.0.0:10000" . PHP_EOL;
    }

    public function onRequest(\swoole_http_request $request, \swoole_http_response $response)
    {

        $config = [
            'appId' => '',
            'appSk' => '',
            'ddkId' => ''
        ];
        $pdd = new \pddUnionSdk\pddUnionFactory($config);
        $info = $pdd->goods->mall('918323727');
        if ($info === false) {
            var_dump($pdd->getError());
        }
        var_dump($info);
        $response->end('index');
    }

}

new swooleDemo();
