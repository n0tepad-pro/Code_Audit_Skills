<html xmlns="http://www.w3.org/1999/xhtml"><!--This file has been created with toxhtml.xsl-->
<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
</head>
<body>
<?php
$flag = 'flag{test_12345_678}';

if (isset($_GET['name']) and isset($_GET['password'])) {
	var_dump($_GET['name']);
	var_dump($_GET['password']);
    if ($_GET['name'] == $_GET['password'])
        echo '<p>Your password can not be your name!</p>';
    else if (sha1($_GET['name']) === sha1($_GET['password'])){
    	var_dump(sha1($_GET['name']));
	    var_dump(sha1($_GET['password']));
        die('Flag: '.$flag);
    }else{
        echo '<p>Invalid password.</p>';
    }
}
else{
	echo '<p>Login first!</p>';
}

?>
</body>
<a href="index.txt">Source code</a>
</html>