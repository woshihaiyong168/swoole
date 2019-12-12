<?php

//要抓取6个页面的数据
$url_list = [
    'https://1',
    'https://2',
    'https://3',
    'https://4',
    'https://5',
    'https://6',
];

//正常执行
echo date('Y-m-d H:i:s').PHP_EOL;
//normal($url_list);
//多进程
moreProcess($url_list);
echo date('Y-m-d H:i:s').PHP_EOL;
//多进程执行

/**
 *
 * 正常执行
 *
 * @param $url_list
 */
function normal($url_list) {
    foreach ($url_list as $url_info) {
        curlData($url_info);
    }
}

/**
 *
 * 多进程
 *
 * @param $url_list
 */
function moreProcess($url_list){
    //多进程
    $worker = [];
    foreach ($url_list as $url_info) {
        //子进程
        $process = new swoole_process(function(swoole_process $worker) use($url_info){
            $content = curlData($url_info);
            $worker->write($content.PHP_EOL);
        }, true);
        $pid = $process->start();
         echo $pid.PHP_EOL;
        $worker[$pid] = $process;
    }

    //为了读取进程内数据
    foreach($worker as $process) {
        echo $process->read().PHP_EOL;
    }
}

/**
 *
 * 请求网站
 *
 * @param $url
 */
function curlData($url){
    echo $url.PHP_EOL;
    sleep(1);
}






