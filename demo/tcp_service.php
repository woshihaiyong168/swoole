<?php 

//创建Server对象，监听 127.0.0.1:9501端口
$serv = new Swoole\Server("127.0.0.1", 9501); 

$serv->set([
   'worker_num'  => 2, //worker进程数 cpu 1-4倍
   'max_request' => 10000, //，此参数表示worker进程在处理完n次请求后结束运行。manager会重新创建一个worker进程。此选项用来防止worker进程内存溢出。
]);

//监听连接进入事件
$serv->on('Connect', function ($serv, $fd, $reactor_id) {  
    echo "Client: 线程{$reactor_id} -文件标识符 {$fd} Connect.\n";
});

//监听数据接收事件
$serv->on('Receive', function ($serv, $fd, $reactor_id, $data) {
    $serv->send($fd, " 线程{$reactor_id} -文件标识符 {$fd} data: ".$data);
});

//监听连接关闭事件
$serv->on('Close', function ($serv, $fd) {
    echo "Client: {$fd} Close.\n";
});

//启动服务器
$serv->start(); 
