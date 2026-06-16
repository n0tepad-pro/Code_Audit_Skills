<html xmlns="http://www.w3.org/1999/xhtml"><!--This file has been created with toxhtml.xsl-->
<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
</head>
<body>
<?php
function GetIP(){
	if(!empty($_SERVER["HTTP_CLIENT_IP"]))
		$cip = $_SERVER["HTTP_CLIENT_IP"];
	else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
		$cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	else if(!empty($_SERVER["REMOTE_ADDR"]))
		$cip = $_SERVER["REMOTE_ADDR"];
	else
		$cip = "0.0.0.0";
	return $cip;
}

$GetIPs = GetIP();

if ($GetIPs=="1.1.1.1"){
	echo "Great! Key is flag{getIP_iS_TruE}";
}
else{
	echo "错误！你的IP不在访问列表之内！";
}

?>
</body>
<a href="index.txt">Source code</a>
</html>