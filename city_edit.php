<?php require("security.php"); ?>
<html>
	<head>
	<meta charset= "utf-8">
		<title>Cities of the World</title>
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
					$City_Name = $_GET['Name'];
					$City_District = $_GET['District'];
					$City_Pop = $_GET['Population'];
					$City_CountryCode = $_GET['CountryCode'];
				} 

				$query= "SELECT ID,CountryCode, Name, Population, District FROM world.City where ID= $City_Code";
				$query_results = mysql_query($query, $linkID1);
				if(!$query_results){
					die("Consulta no valida:".mysql_error());
				}
				while($row = mysql_fetch_assoc($query_results)){
					$form_ID = $row["ID"];
					$form_Name = $row["Name"];
					$form_Pop = $row ["Population"];
					$form_District = $row["District"];
					echo $row["ID"], " - ", $row["Name"],"<br>";
				}
				mysql_free_result($query_results);
				
print <<<Group1
<form action="city_save.php" method="GET">
<h1>Name of the City</h1>
City Name: <input type="text" name="City_Name" value="$form_Name"><br/>
<br/>
City Population: <input type="text" name="City_Pop"
value="$form_Pop"><br/>
<br/>
City District: <input type="text" name="City_District"
value="$form_District"><br/>
<br/>
<input type="reset", name="reset,"/>
<input type="submit" name="submit" value="Send Info"/>	
<input type="hidden" name="City_Code" value="$form_ID">
Group1;
			mysql_close($linkID1);
			?>
	</body>
</html>