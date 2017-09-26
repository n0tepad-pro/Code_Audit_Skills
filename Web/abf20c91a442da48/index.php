<?php
	header("Content-Type: text/html;charset=utf-8"); 
    $page=$_GET['page'];  
    echo '<!--请通过page参数找到Y29uZmln.php中的flag-->';
    if (isset($page))  
        include("$page");  
    else  
        include("index.php")  
?>

