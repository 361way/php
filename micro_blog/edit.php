<?php   
include("conn.php");  
if(!empty($_GET['id'])){  
    $id = $_GET['id'];  
    $sql = "select * from micro_blog where id = ".$_GET['id'];  
    $query = mysql_query($sql);   
    $rc = mysql_fetch_array($query);  
}  
  
if(!empty($_POST['update'])){  
    echo "更新按钮提交成功！";  
}  
?>  
  
<!DOCTYPE HTML>  
<html>  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">  
<title>编辑页面</title>  
</head>  
  
<body>  
<form action="edit.php?id=<?php echo $id;?>" method="post">  
  标题：  
  <input type="text" name="title" value="<?php echo $rc['title'];?>"/>  
  <br />  
  内容：  
  <textarea rows="5" cols="50" name="content"><?php echo $rc['content'];?></textarea>  
  <br />  
  <input type="submit" name="update" value="更新"/>  
  <br />  
</form>  
</body>  
</html>  
