<?php
$q=$_GET["q"];
$mysqli = new mysqli('10.211.137.173','report','Report123$','report');

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
$mysqli->query("SET NAMES 'utf8'");

$gvalue = array(
        'df'=>array('title'=>'磁盘空间告警主机','sqlquery'=>'磁盘','notice'=>'如果单台主机出现var、user、home等所有挂载点全部告警，可能zabbix_agent异常或与server通信异常！'),
        'inode'=>array('title'=>'inode告警主机','sqlquery'=>'inode','notice'=>'当单台主机多个挂载点inode都告警的情况下，很可能是agent异常或与server通信异常！'));



//CountQuery($str,$mysqli);
$qstr = array('df', 'inode');

//in_array有性能问题，可以精确匹配类型用 in_array($q, $qstr,true) 或者换为isset函数检测
//if (in_array($q, $qstr))
if (in_array($q, $qstr ,true))
    {
    $title = $gvalue[$q]['title'];
    $notice = $gvalue[$q]['notice'];
    $sqlquery = $gvalue[$q]['sqlquery'];

    $file = file_get_contents('templets/sidebar.html'); //参考 http://blog.csdn.net/zxlstudio/article/details/25741733
    $file = str_replace(array('{title}'),array($title), $file);
    echo $file;

    $file = file_get_contents('templets/disk.html');
    $file = str_replace(array('{notice}'),array($notice), $file);
    echo $file;


    CountQuery($sqlquery,$mysqli);
    }else
    {
    echo "你查询的字段不允许或不存在";
    }


function CountQuery($string,$mysqli)
{
    $sql="select host,triggerid,description,value,time from newevent 
where description like '%{$string}%' and value=1 
and eventid in (select max(eventid) from newevent  group by triggerid)";
    //echo $sql;
    $q=$mysqli->query($sql);
    if (!$q) {
	    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
	    exit;
    }

//   if (mysql_num_rows($q) == 0) {
//	    echo "No rows found, nothing to print so am exiting";
//	    exit;
//    }
    while($row=$q->fetch_assoc()) {
	echo"<tr><td>".$row["host"]."</td><td>".$row["triggerid"]."</td><td>".$row["description"]."</td><td>".$row["value"]."</td><td>".$row["time"]."</td></tr>\n";
    }
    $q->close();
    $mysqli->close();
}

?>
  </tbody> 
</table>
</center>
<?php require ('footer.php'); ?>
