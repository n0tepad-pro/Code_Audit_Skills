    <?php  
    
    $user = $_GET["user"];  
    $file = $_GET["file"];  
    $pass = $_GET["pass"];  
      
/*
	isset函数是检测变量是否设置。 
	若变量不存在则返回 FALSE
	若变量存在且其值为NULL，也返回 FALSE
	若变量存在且值不为NULL，则返回 TURE 

	file_get_contents — 将整个文件读入一个字符串

    preg_match — 执行匹配正则表达式
*/
    if(isset($user)&&(file_get_contents($user,'r')==="the user is admin")){  
        echo "hello admin!<br>";  
        if(preg_match("/f1aG/",$file)){  
            exit();  
        }else{  
            include($file); //class.php  
            $pass = unserialize($pass);  
            echo $pass;  
        }  
    }else{  
        echo "you are not admin ! ";  
    }  
      
?>  
      
<!--  
$user = $_GET["user"];  
$file = $_GET["file"];  
$pass = $_GET["pass"];  
  
if(isset($user)&&(file_get_contents($user,'r')==="the user is admin")){  
    echo "hello admin!<br>";  
    include($file); //class.php  
}else{  
    echo "you are not admin ! ";  
}  
 -->  


