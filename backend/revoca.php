<?php
session_start();

require "../common/connection.php";
require "../common/functions.php";

$email = $_SESSION['email'];
$autorizzato = $_POST['cancellazione'];

$sql = "UPDATE utenti SET data_autorizzazione = NULL WHERE email = '$autorizzato'";

$direttore="UPDATE utenti SET direttore = NULL WHERE email = '$autorizzato'";

if (($cid->query($sql) === TRUE) && ($cid->query($direttore)===TRUE)) {
  echo json_encode(array('status' => 'success'));
} else {
	echo "Error updating record: " . $conn->error;
}

$cid->close();
?>