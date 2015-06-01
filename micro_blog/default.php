<?php  
include("conn.php");  
//搜索关键字的管理  
if(!empty($_GET['keys'])){  
    $keys = "WHERE title like '%".$_GET['keys']."%'";  
} else {  
    $keys = "";  
}  
$sql = "SELECT * FROM micro_blog ".$keys." ORDER BY id DESC LIMIT 10";  
$query = mysql_query($sql);  
$rs = mysql_fetch_array($query);  
?>  
<html>  
<head>  
<title>我的微博客主页</title>  
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>  
</head>  
<body>  
<a href="add.php">添加内容</a>  
<form action="" method="get">  
  <input type="text" name="keys"/>  
  <input type="submit" name="submit" value="内容搜索"/>  
</form>  
<hr color="#FF9900" size="3" />  
<?php  
if(!$rs){  
    echo "没有相关内容！";  
}  
//没有实现分页导航功能  
while($rs){  
?>  
<h2>标题：<?php echo $rs['title'];?>|<a href="edit.php?id=<?php echo $rs['id'];?>">编辑</a>|<a href="delete.php?id=<?php echo $rs['id'];?>">删除</a></h2>  
<li>日期：<?php echo $rs['date'];?></li>  
<p>内容<?php echo iconv_substr($rs['content'],0,50,"UTF-8");?>...... <a href="view.php?id=<?php echo $rs['id'];?>">|查看详细内容|</a></p>  
<hr color="#0033FF" size="5" />  
<?php  
    $rs = mysql_fetch_array($query);  
}  
?>  
</body>  
</html>  
