<?php require("security.php"); ?>
<html>
	<head>
	<meta charset="utf-8">
		<title>MySQL and PHP</title>
		
		</head>
		<body>
		<h1>Cities of the world</h1>
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
				if($_GET['ID']){
					$City_Code = $_GET['ID'];
				} else{
					$City_Code = 1;
				}
				$query_results = mysql_query("select ID, Name FROM City",$linkID1);
				if(!$query_results){
					die("Consulta no valida:".mysql_error());
				}
				while($row = mysql_fetch_assoc($query_results)){
					$form_ID = $row["ID"];
					$form_Name = $row["Name"];
					echo $row["ID"], " - ", $row["Name"],"<br>";
				}
				mysql_free_result($query_results);
print <<<Group1
<form action="cities.php?Code=$City_Code" method="POST">
<h1>Name of the City</h1>
<p>ID:   - $form_ID</p><p>Name:  - $form_Name</p>
Group1;
			
				mysql_close($linkID1);
?>				
