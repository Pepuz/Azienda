<?php
session_start();

require "../common/connection.php";
require "../common/functions.php";

$email = $_SESSION['email'];
$check_email = $_POST['email'];
$pwd = $_POST['new_password'];
$error = "Email non corrisponde all'utente attualmente connesso";

if($email == $check_email) {
	$query = "UPDATE utenti SET password = '$pwd' WHERE email = '$email'";
	$update_pass = $cid->query($query);
	session_destroy();
	redirect("../frontend/login.php");
	
} else {
	$_SESSION['error_pass'] = $error;
	redirect("../frontend/modifica-profilo.php");
}
?>