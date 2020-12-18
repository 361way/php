<?php
$q=$_GET["q"];
$t=$_GET["t"];
$mysqli = new mysqli('192.168.137.173','report','Report123$','report');

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
$mysqli->query("SET NAMES 'utf8'");

$gvalue = array(
        'load'=>array('title'=>'CPU load average事件统计','sqlquery'=>'CPU核心数','notice'=>'load average告警次数统计,如果CPU多次load average告警，请考虑扩容、优化或屏蔽告警!'),
        'context'=>array('title'=>'CPU上下文事件统计','sqlquery'=>'CPU上下文','notice'=>'CPU上下文告警统计，多次出现此告警，说明业务在线程间来回任务切换，需考虑优化应用程序！'),
        'idle'=>array('title'=>'CPU idle事件统计','sqlquery'=>'idel不足','notice'=>'CPU idle统计，如果多此idle告警，说明CPU严重不足，需考虑扩容！'),
        'iowait'=>array('title'=>'CPU iowait事件统计','sqlquery'=>'CPU iowait','notice'=>'CPU iowait统计，如果长时间告警，请到平台上查看disk周期使用情况，确认IOPS是否够用！')); 



//CountQuery($str,$mysqli);
$qstr = array("load", "context", "idle", "iowait");
$qdata = array("WEEK","DAY","MONTH","YEAR");



//in_array有性能问题，可以精确匹配类型用 in_array($q, $qstr,true) 或者换为isset函数检测
//if (in_array($q, $qstr))
if (in_array($q, $qstr ,true) && in_array($t, $qdata ,true))
    {
    $title = $gvalue[$q]['title'];
    $notice = $gvalue[$q]['notice'];
    $sqlquery = $gvalue[$q]['sqlquery'];

    $file = file_get_contents('templets/sidebar.html'); //参考 http://blog.csdn.net/zxlstudio/article/details/25741733
    $file = str_replace(array('{title}'),array($title), $file);
    echo $file;

    $file = file_get_contents('templets/cpu.html');
    $file = str_replace(array('{period}','{notice}'),array($t,$notice), $file);
    echo $file;


    CountQuery($t,$sqlquery,$mysqli);
    }else
    {
    echo "你查询的字段不允许或不存在";
    }


function CountQuery($qtime,$string,$mysqli)
{
    $sql="select DISTINCT host,count(host) count from newevent 
        where time > DATE_SUB(CURDATE(), INTERVAL 1 {$qtime}) 
        and value=0  and description like '%{$string}%' group 
        by host order by count desc";
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
        echo "<tr><td>".$row["host"]."</td><td>".$row["count"]."</td></tr>\n";
        //return "<tr><td>".$row["reportip"]."</td><td>".$row["count"]."</td></tr>\n";
    }
    $q->close();
    $mysqli->close();
}

?>
  </tbody> 
</table>
</center>
<?php require ('footer.php'); ?>
