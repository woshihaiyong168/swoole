<?php
//pstree -p pid

$process = new swoole_process(function(swoole_process $worker) {
    //todo
	 echo '111111'; 
},true);

$pid = $process->start();
echo $pid.PHP_EOL;



