<?php
	require("connection_info.php");
	session_start();
		
		if (isset ($_POST["req_access"])) {
			if($_POST["req_access"]=="Yes"){
			$linkID1 = mysql_connect($dbhost,$dbuser,$dbpass);
			if (!$linkID1){
				die ("No hay conexion:" . mysql_error());
			}
				if(mysql_select_db($dbdb, $linkID1)){
				}
				else{
					echo "error al seleccionar la base de datos";
				}
			$user = $_POST["username"];
			$psswd = $_POST["password"];
			$query = mysql_query("SELECT customerEmail FROM customers WHERE customerEmail ='$user' AND passwd = SHA('$psswd');");
			$row = mysql_fetch_assoc($query);
		if ($row["customerEmail"]=="$user"){
			$_SESSION["Authorized"]="Yes";
		} else{
			echo "<p>Incorrect Username and/or Password, please try again</p>";
			$_SESSION["Authorized"]="No";
			}
			}
		}
		else {
			echo "<p>Incorrect Username and/or Password, please try again</p>";
			$_SESSION["Authorized"]="No";
			$_POST["req_access"]="No";
		}
		
		
				
		
		if($_SESSION[" "]=="Yes") {
			echo "<p>Access Granted</p>";
			echo '<a href="close.php">Log Out</a>';
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
	mysql_close($linkID1);
?>