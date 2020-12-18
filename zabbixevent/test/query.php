<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>zabbix未处理理事件</title>
<style>
table {
    border-collapse: collapse;
    width: 70%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #4CAF50;
    color: white;
}
</style>
</head>


<body>
<center>
<h2>zabbix磁盘未清理主机</h2>
<table>
<div style="overflow-x:auto;">
<tr><th>主机名</th><th>触发器id</th><th>告警内容</th><th>是否恢复</th><th>告警时间</th></body></tr>
<?php
$link=mysql_connect('192.168.137.173','report','Report123$')or die("数据库连接失败");
//连接数据库
mysql_select_db('report',$link);//选择数据库
mysql_query("set names utf8");//设置编码格式

//$q="select reportip,alarmname,alarmlevel,alarmstat,alarmtime from report where alarmstat=1
//and  alarmid not in (select alarmid from report where alarmstat=0)
//and  alarmname like '%磁盘%'";//设置查询指令

$q="select host,triggerid,description,value,time from newevent 
where description like '%磁盘%' and value=1 
and eventid in (select max(eventid) from newevent  group by triggerid )";

// https://dev.mysql.com/doc/apis-php/en/apis-php-function.mysql-fetch-assoc.html

$result=mysql_query($q);//执行查询

if (!$result) {
    echo "Could not successfully run query ($q) from DB: " . mysql_error();
    exit;
}

if (mysql_num_rows($result) == 0) {
    echo "No rows found, nothing to print so am exiting";
    exit;
}

while($row=mysql_fetch_assoc($result))//将result结果集中查询结果取出一条
{
 echo"<tr><td>".$row["host"]."</td><td>".$row["triggerid"]."</td><td>".$row["description"]."</td><td>".$row["value"]."</td><td>".$row["time"]."</td></tr>\n";
  
  }
?>
</table>
</div>
<center>
</body>
<br/>
<br/>
<!-- div>注：告警级别5代表严重，2为警告；是否恢复，值为1，代表未恢复！</div -->
<div>注：是否恢复项，值为1，代表未恢复！</div>
<div id="copyright"> 版权所有 &copy; 2015-2017 咪咕阅读ITO</div>
</html>

