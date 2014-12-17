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
				if($_GET['ID']){
					$City_Code = $_GET['ID'];
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
<form action="country.php?Code=$City_Code" method="POST">
<h1>Name of the City</h1>
<p>Population: $form_Pop</p>
<p>District: $form_District to</p>
<p><a href="http://en.wikipedia.org/wiki/Name_of_City"</p>(this link will open up a Wikipedia web page)</p>
Group1;
			$query_results2 = mysql_query("select ID, CountryCode, Name, Population, District from Country where ID= $City_Code", $linkID1);
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
				mysql_close($linkID1);
			?>
		</body>
</html>