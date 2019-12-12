<?php


$http = new swoole_http_server("0.0.0.0", 9500);//所有的ip地址

//设置静态文件处理
$http->set(
  [
    'worker_num' => 5,
    'enable_static_handler' => true,
    'document_root' => '/usr/share/nginx/html/swoole/demo/data',
  ]
);

//接收请求
$http->on('request', function ($request, $response) {
    //print_r($request->get);		
    //$response->end("<h1>HTTP service</h1>"); //发送客户端信息 必须是字符串
	$response->cookie('haiyong','woshihaiyong168',time() + 1800); //设置cookie	
	$response->end('get:'.json_encode($request->get)); //发送请求参数	
});
$http->start();






 
