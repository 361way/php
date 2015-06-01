<?php   
include("conn.php");  
  
if(!empty($_GET['id'])){  
    $sql = "SELECT * FROM micro_blog WHERE id = ".$_GET['id'];  
    $rc = mysql_fetch_array(mysql_query($sql));  
    mysql_query("UPDATE micro_blog SET hits = hits + 1 WHERE id = ".$_GET['id']);  
} else {  
    echo "参数引入失败！";  
}  
?>  
  
<!DOCTYPE HTML>  
<html>  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">  
<title><?php echo $rc['title'];?>|我的微博客</title>  
</head>  
  
<body>  
<a href="default.php">返回主页面</a>  
<hr color="#00FFFF" size="5px"/>  
<h2><?php echo $rc['title'];?>  
  <hr color="#006699" size="3px">  
</h2>  
<li><?php echo "日期：".$rc['date']."|浏览次数：".$rc['hits'];?></li>  
<p><?php echo $rc['content'];?></p>  
</body>  
</html>  
