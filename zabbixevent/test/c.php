<?php require ('sidebar.php'); ?>
<table class="table table-bordered table-hover">
<?php
$q=$_GET["q"];
$mysqli = new mysqli('192.168.137.173','eventreport','Eventreport123$','eventreport');

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
$mysqli->query("SET NAMES 'utf8'");

function CountQuery($string,$mysqli)
{
    $sql="select DISTINCT reportip,count(reportip) count from report 
        where alarmtime > DATE_SUB(CURDATE(), INTERVAL 1 WEEK) 
        and alarmstat=0  and alarmname like '%{$string}%' group 
	by reportip order by count desc";
    //echo $sql;
    $q=$mysqli->query($sql);
    while($row=$q->fetch_assoc()) {
        echo "<tr><td>".$row["reportip"]."</td><td>".$row["count"]."</td></tr>\n";
        //return "<tr><td>".$row["reportip"]."</td><td>".$row["count"]."</td></tr>\n";
    }
    $q->close();
    $mysqli->close();
}
//CountQuery($str,$mysqli);
CountQuery($q,$mysqli);
?>
</table>
<?php require ('footer.php'); ?>
