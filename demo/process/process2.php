<?php
//pstree -p pid
$process = new swoole_process(function(swoole_process $process) {
    $process->exec('/usr/bin/php', array(__DIR__.'/../service/http.php'));
},true);
$pid = $process->start();
echo $pid;

//回收子进程
swoole_process::wait();

