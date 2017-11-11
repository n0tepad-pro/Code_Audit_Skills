<html xmlns="http://www.w3.org/1999/xhtml"><!--This file has been created with toxhtml.xsl-->
<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
</head>
<body>
<?php

$filename = 'flag08395e0fda9cae71.txt';
$flag = 'flag08395e0fda9cae71.txt';

extract($_GET);
// extract($_GET, EXTR_PREFIX_SAME, "escape");

if (isset($attempt)){
	$combination = trim(file_get_contents($filename));
	if ($attempt===$combination){
		echo "<p>How did you know the secret combinnation was" . "$combinnation !?</p>";
		$next = file_get_contents($flag);
		echo $next;
	}else {
		echo "Incorrect! The secret combiantion is not $attempt";
	}
}

?>
</body>
<a href="index.txt">Source code</a>
</html>