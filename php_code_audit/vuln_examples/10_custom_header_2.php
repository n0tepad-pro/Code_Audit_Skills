<html xmlns="http://www.w3.org/1999/xhtml"><!--This file has been created with toxhtml.xsl-->
<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
</head>
<body>
<?php

$flag = 'flag{header_is_true}';
// echo $_SERVER["HTTP_USER_AGENT"];
// echo strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 8.0");
// echo strpos("MSIE 8.0","MSIE 8.0");
if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 8.0")){
	$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4);
	if (preg_match("/zh-c/i", $lang))  {
		echo $flag;
	}else{
		echo "NO LANGUAGE";
	}
}else{
    echo "ERROR, must be Internet Explorer 8.0";  
}

?>
</body>
<a href="index.txt">Source code</a>
</html>