<?php
	session_start();
		if($_POST["req_access"]=="yes") {
			if ($_POST["username"]=="Student" AND $_POST["password"]=="test") {
			$_SESSION["Authorized"]="Yes";
	} else {
		echo "<p>Incorrect Username and/or Password, please try again</p>";
		$_SESSION["Authorized"]="No";
	}
	}
	if($_SESSION["Authorized"]=="Yes") {
	echo "<p>Access Granted</p>";
	}else {
	$requested_URL = $_SERVER["REQUEST_URI"];
	print <<<GROUP1
	<form action="$requested_URL" method="POST">
	<p>Username: <input type="text" name="username"></p>
	<p>Password: <input type="password" name="password"></p>
	<input type="hidden" name="req_access" value="yes">
	<p><input type="submit" value="Login"></p>
	</form>
GROUP1;
	exit;
	}
?>