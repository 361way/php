<?php
$q=$_GET["q"];
$t=$_GET["t"];
echo $q;
echo $t;
$gvalue = array(
	'first'=>array('title'=>'1111','date'=>'2222'),
	'second'=>array('title'=>'1111','date'=>'2222'),
	'third'=>array('title'=>'2222','date'=>'3333')); 
echo "</br>";
echo $gvalue[$q]['title'];

?>

<div class="row">
 <ul class="nav nav-pills ">
   <li role="presentation" class="active"><a href=<?php echo cpu.php?q="${q}"&t="${t}" ?>>CPU load</a></li>
   <li role="presentation"><a href="cpu.php?q=CPU%E4%B8%8A%E4%B8%8B%E6%96%87&t=WEEK">CPU上下文</a></li>
   <li role="presentation"><a href="cpu.php?q=idel%E4%B8%8D%E8%B6%B3&t=WEEK">idle不足</a></li>
   <li role="presentation"><a href="cpu.php?q=CPU%20iowait&t=WEEK">IOWait</a></li>
 </ul>
</div>
