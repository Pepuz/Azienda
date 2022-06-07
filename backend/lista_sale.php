<?php

require "../common/connection.php";

$dep = $_GET["q"];

$query = "SELECT * FROM sale_riunioni WHERE dipartimento = '$dep'";
	
$result = $cid->query($query);
	
while($row = $result->fetch_assoc())
{
	echo "<option value=\"".$row['nome']."\">" . $row['nome'] . ", " . 'Capienza : ' . $row['capienza'] ."</option>";
}

?>