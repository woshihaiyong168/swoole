<?php
//创建内存表
$table = new swoole_table(1024);

//内存表增加一行
$table->column('id', $table::TYPE_INT,4);
$table->column('name', $table::TYPE_STRING,64);
$table->column('age', $table::TYPE_INT,3);
$table->create();

//插入
$table->set('account',['id' => 1, 'name' => 'haiyong' ,'age' => 27]);


var_dump($table->get('account'));
////另外一种方式
//$table['account1'] = [
//    'id' => 2,
//    'name' => 'xiaoxiao' ,
//    'age' => 27,
//];
////自增
//$table->incr('account1','age', 1);
////自减
//$table->decr('account','age', 1);
//var_dump($table->get('account1'));
//var_dump($table->get('account'));









