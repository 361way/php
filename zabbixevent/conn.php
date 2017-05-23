<?php
/*
$link=mysql_connect('10.211.137.173','report','Report123$')or die("数据库连接失败");
//连接数据库
mysql_select_db('report',$link);//选择数据库
mysql_query("set names utf8");//设置编码格式
*/

$mysqli = new mysqli('10.211.137.173','report','Report123$','report');

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
$mysqli->query("SET NAMES 'utf8'");
?>
