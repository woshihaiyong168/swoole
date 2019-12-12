<?php 
//连接 swoole_udp 服务
$client = new swoole_client(SWOOLE_SOCK_UDP);

if (!$client->connect('127.0.0.1', 9502)) {
     echo '连接失败！';
     exit;
}
// php cli常量
fwrite(STDOUT,"请输入消息："); // 标准的输出设备
$msg = trim(fgets(STDIN)); // 标准的输入设备

// 发送消息给udp  service服务器
$client->send($msg);

// 接收来自service的数据
$result = $client->recv();

echo $result;




