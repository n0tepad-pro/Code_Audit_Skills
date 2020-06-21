<?php

header('Content-Type: text/html; charset=utf-8');
$WhiteList = array('rar','jpg','png','bmp','gif','jpg','doc');
if (isset($_POST["submit"])){
    $name = $_FILES['file']['name']; //接收文件名
    $extension = substr(strrchr($name,"."),1);//得到扩展名
    $boo = false;
    foreach ($WhiteList as $key=>$value){
        if ($value==$extension){//迭代判断是否有命中
            $boo=true;
        }
    }
    if($boo){//如果有命中，则开始文件上传操作
        $size=$_FILES['file']['size'];//接收文件大小
        $tmp=$_FILES['file']['tmp_name'];//临时路径
        move_uploaded_file($tmp,$name);//移动临时文件到当前文件目录
        echo "文件上传成功！<br/> path:".$name;
    }else {
        echo "文件不合法！！";
    }
    
}
?>
    
<html>
    <head>
        <meta http-equiv="Content-Language" content="zh-cn">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>文件上传</title>
    </head>
    <body>
        <form method="POST" action="10.php" enctype="multipart/form-data">
        文件上传：<input type="file" name="file" size="42"> <input type="submit" value="提交" name="submit">
        </form>
    </body>
</html>

