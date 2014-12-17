<?php require("security.php"); ?>
<html>
	<head>
	<meta charset= "utf-8">
		<title>Cities of the World</title>
		</head>
		<body>
			<?php
				// cometario para git!!!!!
				require("connection_info.php");
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
				if ($_POST){
					$City_CountryCode = $_POST["City_CountryCode"];
					$City_Name = $_POST["City_Name"];
					$City_District = $_POST["City_District"];
					$City_Pop = $_POST["City_Pop"];
					$City_ID = $_POST["City_ID"];
				}
				else{
					echo"Esta pagina no ha sido llamada correctamente.";
					die("consulta no valida:".mysql_error());
				}
				
				if($_POST["Submit"]=="Update"){
				$SQLejecutar = "UPDATE City SET CountryCode='$City_CountryCode',
				name='$City_Name', District='$City_District',
				Population=$City_Pop WHERE ID=$City_ID";
				$userText ="Update successfull";
				}
				
				else if($_POST["Submit"]=="Delete"){
					$SQLejecutar = "delete from city where ID=$City_ID";
					if($City_ID !=1){
					$City_ID =$City_ID-1;
					}
					else{
					$City_ID = $City_ID+1;
					}
					$userText ="Delete successfull";
				}
				else if ($_POST["Submit"]=="Insert"){
					$SQLejecutar = "INSERT INTO city(CountryCode, Name, District, Population)
										VALUES ('$City_CountryCode', '$City_Name', '$City_District',
										'$City_Pop')";
					$userText ="Insert successfull";
				
				
					$ejecutarQuery = mysql_query($SQLejecutar, $linkID1);
					if(!$ejecutarQuery){
					die("consulta no valida:".mysql_error());
					}
				}
				if($_POST["Submit"]=="Insert"){
					$City_ID = mysql_insert_id($linkID1);
				}
				
				
print <<<Group1
<h2>$userText</h2>
<p><a href="city_form.php?CityCode=$City_ID">Return to City Form</a></p>
Group1;
				
				mysql_close($linkID1);
?>