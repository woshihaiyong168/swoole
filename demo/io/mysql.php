<?php 

class AysMysql{
    public  $dbSource = "";
    public  $config = "";

    public function __construct()
    {
        $this->dbSource= new swoole_mysql();

        $this->config = array(
            'host' => '127.0.0.1',
            'port' => 3306,
            'user' => 'root',
            'password' => 'jhy@9876',
            'database' => 'game',
            'charset' => 'utf8', //指定字符集
            'timeout' => 2,  // 可选：连接超时时间（非查询超时时间），默认为SW_MYSQL_CONNECT_TIMEOUT（1.0）
        );

    }

    public function add(){

    }

    public function execute($id, $username){
        $this->dbSource->connect($this->config,function($db, $result){
            //连接失败
             if ($result=== false){
                 var_dump($db->connect_error);
                 //todo
             }
             $sql = "select * from account_fake where id =1";
             $db->query($sql, function($db,$result) {
                 //select=>result 返回的是查询的结果内容

                 if ($result===false) {
                     //todo
                 } elseif ($result===true) { //add update delete
                     //todo
                 } else {
                    print_r($result); 
                 }
             });

        });

        return true;
}

}

$obj = new AysMysql();
$obj->execute(1, 'swoole'); 





