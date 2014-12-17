<?php require("security.php"); ?>
<html>
	<head>
	<meta charset= "utf-8">
		<title>Saving Changes to City</title>
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
				if($_GET){
					$City_Code = $_GET['ID'];
					$City_Name = $_GET['City_Name'];
					$City_District = $_GET['City_District'];
					$City_Pop = $_GET['City_Pop'];
					$City_CountryCode = $_GET['City_CountryCode'];
				} 

				$query= "replace into City (ID, Name, Population, District, CountryCode) values ($City_Code, $City_CountryCode, $City_Name, $City_Pop, $City_District)";
				$query_results = mysql_query($query, $linkID1);
				if(!$query_results){
					die("Consulta no valida:".mysql_error());
				}
				while($row = mysql_fetch_assoc($query_results)){
				$form_ID = $row["ID"];
				$form_Code =$row["CountryCode"];
				$form_Name = $row["Name"];
				$form_District = $row["District"];
				$form_Pop = $row ["Population"];
				}
print <<<Group1
<form action="city_edit.php?ID=$City_Code" method="GET">
Group1;
				mysql_close($linkID1);
			?>
	</body>
</html>