<?php

$title = "磁盘使用率告警统计";

$file = file_get_contents('templets/sidebar.html');
$file = str_replace(array('{title}'),array($title), $file);
echo $file;
?>
<div id="page-wrapper">
<div class="row">
<center>
<h3>zabbix磁盘未清理主机</h3>
<hr>
<p class="bg-danger">注:是否恢复值为1，代表未恢复！</p>
<table class="table table-bordered table-hover" style="table-layout:automatic;width:1100px">
<thead>
   <tr><th>主机名</th><th>告警内容</th><th>告警级别</th><th>是否恢复</th><th>告警时间</th></body></tr>
</thead>
<tbody>
<?php
$link=mysql_connect('10.211.137.173','report','Report123$')or die("数据库连接失败");
//连接数据库
mysql_select_db('report',$link);//选择数据库
mysql_query("set names utf8");//设置编码格式

$q="select host,triggerid,description,value,time from newevent 
where description like '%磁盘%' and value=1 
and eventid in (select max(eventid) from newevent  group by triggerid )";

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
  </tbody>
</table>
</div>
</center>
<?php require ('footer.php'); ?>
