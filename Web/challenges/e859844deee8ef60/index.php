<html xmlns="http://www.w3.org/1999/xhtml"><!--This file has been created with toxhtml.xsl-->
<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
</head>
<body>
<?php
$key = 'MTUzNDQwMTI4MQ==';
$flag = 'flag{header_is_true}';
$pass_key = $_POST['key'];
if($pass_key){
	if($pass_key!==$key){
		header('Content-Row: MTUzNDQwMTI4MQ==');
	}else{
		echo $flag;
	}
}else{
	echo 'False';
}

?>
</body>
<a href="index.txt">Source code</a>
</html>