<?php 

$server = new Swoole\WebSocket\Server("0.0.0.0", 9505);
//$server->on('open', function (Swoole\WebSocket\Server $server, $request) {
//        echo "server: handshake success with fd{$request->fd}\n";
//    });
//设置静态文件处理
//$server->set(
//  [
//    'enable_static_handler' => true,
//    'document_root' => '/usr/share/nginx/html/swoole/demo/data',
//  ]
//);

//监听ws消息事件
$server->on('open','onOpen');
function onOpen($server, $request){
  print_r($request->fd);
}
//
$server->on('message', function (Swoole\WebSocket\Server $server, $frame) {
var_dump($frame);

        echo "receive from {$frame->fd}:{$frame->data}";
        $server->push($frame->fd, "service push  success");
    });
//关闭
$server->on('close', function ($ser, $fd) {
        echo "client {$fd} closed\n";
    });

//$server->on('request', function (Swoole\Http\Request $request, Swoole\Http\Response $response) {
//    global $server;//调用外部的server
    // $server->connections 遍历所有websocket连接用户的fd，给所有用户推送
 //   foreach ($server->connections as $fd) {
        // 需要先判断是否是正确的websocket连接，否则有可能会push失败
  //      if ($server->isEstablished($fd)) {
   //         $server->push($fd, $request->get['message']);
   //     }
   // }
//});
$server->start();







