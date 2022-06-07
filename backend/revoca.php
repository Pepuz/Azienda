<?php
session_start();

require "../common/connection.php";
require "../common/functions.php";

$autorizzato = $_POST['cancellazione'];

$sql = "UPDATE utenti SET data_autorizzazione = NULL WHERE email = '$autorizzato'";

if ($cid->query($sql) === TRUE) {
  echo json_encode(array('status' => 'success'));
} else {
	echo "Error updating record: " . $conn->error;
}

$cid->close();
?>