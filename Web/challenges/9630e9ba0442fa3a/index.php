<?php
	$flag = 'flag{VulN_This_is_A_flag}';
	if (isset($_GET['username']) and isset($_GET['password']))
	{
		if ($_GET['username'] == $_GET['password']){
			echo '<p>You password can not be your username !</p>';
		}
		else if (sha1($_GET['username']) === sha1($_GET['password'])){
			die('Flag:'.$flag);
		}
		else{
			echo '<p>Invalid password</p>';
		}
	}
	else{
		echo '<p>Login first</p>';
		echo '<br/>';
		echo '<!--1. $name == $password-->';
		echo '<br/>';
		echo '<!--2. sha1($name) === sha($password)-->';
		echo '<br/>';
		echo '<!--3. die $flag-->';
		echo '<br/>';
		echo '<!-- fight ! -->';
		echo '<br/>';
	}

?>

