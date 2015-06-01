<?php  
//引入连接数据库文件  
include("conn.php");  
  
if(!empty($_POST['submit'])){  
    $title = $_POST['title'];  
    $content = $_POST['content'];  
    $sql = "INSERT INTO micro_blog VALUES(NUll,'$title','$content',now(),0)";  
    mysql_query($sql);  
}  
?>  
<!DOCTYPE HTML>  
<html>  
<head>  
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>  
<title>发布微博页面</title>  
</head>  
<body>  
<a href="default.php">查看内容</a>  
<hr color="#0033CC" size="3px"/>  
<form action="add.php" method="post">  
  标题：  
  <input type="text" name="title"/>  
  <br />  
  内容：  
  <textarea rows="5" cols="50" name="content"></textarea>  
  <br />  
  <input type="submit" name="submit" value="提交"/>  
  <br />  
</form>  
</body>  
</html>  
