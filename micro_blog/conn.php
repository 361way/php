<?php  
//连接MySql数据库服务  
$conn = @mysql_connect("localhost:3306","root","www.361way.com") or die("连接数据库服务器失败！");  
//连接ly_php_base数据库  
@mysql_select_db("test",$conn) or die("未能连接到数据库！");  
mysql_query("SET NAMES 'UTF8'");  
?>  
