<html xmlns="http://www.w3.org/1999/xhtml"><!--This file has been created with toxhtml.xsl-->
<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
</head>
<body>
<?php

$key = 'a1zLbgQsCESEIqRLwuQAyMwLyq2L5VwBxqGA3RQAyumZ0tmMvSGM2ZwB4tws';
$e = '';
$_a = '';

function function_encode($str){
	$a = strrev($str);  //strrev:反转字符串。
	for($b=0;$b<strlen($a);$b++){
		$c = substr($a, $b, 1);  //substr():返回字符串的一部分。
		$d = ord($c)+1;  //ord() 函数返回字符串的首个字符的 ASCII 值。
		$c = chr($d);  //返回指定的字符
		$e = $e.$c;
	}
	return str_rot13(strrev(base64_encode($e)));  //str_rot13() 函数对字符串执行 ROT13 编码。
}

function function_decode($str){
	$_e = base64_decode(strrev(str_rot13($str)));
	for($_b=0;$_b<strlen($_e);$_b++){
		$_c = substr($_e, $_b, 1);
	    $_d = ord($_c)-1;
	    $_c = chr($_d);
	    $_a = $_a.$_c;	
	}
	return strrev($_a);
}
echo '加密后的字符串：a1zLbgQsCESEIqRLwuQAyMwLyq2L5VwBxqGA3RQAyumZ0tmMvSGM2ZwB4tws';
echo '解密后的字符串：';
echo function_decode($key);
?>
</body>
<a href="index.txt">Source code</a>
</html>