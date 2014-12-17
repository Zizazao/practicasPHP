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
				if($_GET['CityCode']){
					$City_Code = $_GET['CityCode'];
				} else{
					$City_Code = 1;
				}
				
				
				$query_results = mysql_query("select ID, Name, CountryCode, District, Population FROM City where ID=$City_Code",$linkID1);
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
<form action="read_city.php" method="POST">
Country: <select name="City_CountryCode">
Group1;
			$query_results2 = mysql_query("select Code, Name from Country order by Name", $linkID1);
			if(!$query_results2){
				die("consulta no valida:".mysql_error());
			}
			while ($row2= mysql_fetch_assoc($query_results2)){
				if($row2["Code"] == $form_Code){
					echo "<option value='".$row2["Code"],"' selected>",
					$row2["Name"], "</option>";
				}
				else{
				echo "<option value='".$row2["Code"],"'>",
				$row2["Name"],"</option>";
				
				}
			}
print <<<Group2
</select><br/>
<br/>
City Name: <input type="text" name="City_Name" value="$form_Name"><br/>
<br/>
City District: <input type="text" name="City_District"
value="$form_District"><br/>
<br/>
City Population: <input type="text" name="City_Pop"
value="$form_Pop"><br/>
<br/>
<input type="hidden" name="City_ID" value="$form_ID">
<input type="submit" name="Submit" value="Submit">
<input type="submit" name="Submit" value="Delete">
<input type="submit" name="Submit" value="Insert">
</form>
Group2;
				mysql_close($linkID1);
?>
</body>
</html>