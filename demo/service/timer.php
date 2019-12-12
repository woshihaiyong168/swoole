<?php

class Ws{

   CONST HOST = '0.0.0.0';
   CONST PORT = 9505;

   public  $ws = null;

   public function __construct(){
     $this->ws = new swoole_websocket_server(self::HOST, self::PORT);
      
//     $this->ws->set(
//	[
//          'worker_num'      => 2,
//	      'task_worker_num' => 2,
//          ]
//     );
     $this->ws->on('open', [$this, 'onOpen']);
     $this->ws->on('message', [$this, 'onMessage']);
     $this->ws->on('task', [$this, 'onTask']);
     $this->ws->on('finish', [$this, 'onFinish']);
     $this->ws->on('close', [$this, 'onClose']);

     $this->ws->start();
   }

    /**
     *
     * 开始连接
     *
     * @param $ws
     * @param $request
     */
   public function onOpen($ws, $request) {
     var_dump($request->fd);
    // 设置一个间隔时钟定时器，与after定时器不同的是tick定时器会持续触发，直到调用Timer::clear清除
     if ($request->fd ==1) {
           swoole_timer_tick(2000, function($timer_id) {
               echo "2s timeId:{$timer_id}\n";
         });
     }
   }

    /**
     *
     * 消息
     *
     * @param $ws
     * @param $frame
     */
   public function onMessage($ws, $frame){

    echo  "service data:{$frame->data}\n";
    //只能
    swoole_timer_after(5000, function() use($ws, $frame){
       $ws->push($frame->fd, 'time after');
    });
    $ws->push($frame->fd, "service push:".date('Y-m-d H:i:s'));

  }

    /**
     *
     * 耗时任务
     *
     * @param $serv
     * @param $taskId
     * @param $wokerId
     * @param $data
     * @return string
     */
  public function onTask($serv, $taskId, $wokerId,$data){
    print_r($data);
   //耗时场景10s
    sleep(10);
    return "on task finish"; //告诉worker
  }

    /**
     *
     * 任务完成
     *
     * @param $serv
     * @param $taskId
     * @param $data
     */
  public function onFinish($serv, $taskId, $data){
      echo "taskId:{$taskId}\n";
      echo "finish-data-success:{$data}";
  }

    /**
     *
     * 关闭
     *
     * @param $ws
     * @param $fd
     */
   public function onClose($ws, $fd) {
    echo "closed {$fd}\n";
   }

}

$obj = new Ws();




  
