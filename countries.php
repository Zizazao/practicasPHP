<?php require("security.php"); ?>
<html>
	<head>
		<title>Countries of the world</title>
	</head>
	<body>
			<?php

			require("connection_info.php");
			include("Navigation.php");
				/* Conectando a base de datos */
				$linkID1 = mysql_connect($dbhost,$dbuser,$dbpass);
				if (!$linkID1){
				die ("No hay conexion:" . mysql_error());
				}
				if(mysql_select_db($dbdb, $linkID1)){
					echo "Base de datos $dbdb seleccionada<br>";
				}
				else{
					echo "error al seleccionar la base de datos";
				}
				if($_GET['Country_Code']){
					$Country_Code = $_GET['Country_Code'];
				} else{
					$Country_Code = 1;
				}
				$query= "SELECT Code, Name FROM world.Country ";
				$query_results = mysql_query($query, $linkID1);
				if(!$query_results){
					die("Consulta no valida:".mysql_error());
				}
				while($row = mysql_fetch_assoc($query_results)) {
					echo "<a href='country.php?Code=",$row["Code"],"'>",
					$row["Code"],"</a> - ",$row["Name"],"<br/>\n";
				}
				mysql_close($linkID1);
			?>
	</body>
</html>