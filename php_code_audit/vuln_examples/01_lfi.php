<?php
    header("Content-Type: text/html;charset=utf-8"); 
    $page=$_GET['page'];
    if (isset($_GET['page'])){
        include("$page");
    } 
    else{
        echo 'page!!!!'; 
    } 


?>