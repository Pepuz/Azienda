<?php
session_start();

$hostname='localhost'; // Host name 
$username='root'; // Mysql username 
$password=''; // Mysql password 
$db='azienda'; // Database name 


 // Connect to server and select database.
$cid = new mysqli($hostname, $username, $password, $db);

// username and password sent from form 
$email = $_SESSION['email']; 
$pwd = $_POST['pwd']; 
$error = "Email o Password errata";

$query = "SELECT * FROM utenti WHERE email='$email' and password='$pwd'";
$result = $cid->query($query);

// Mysql_num_row is counting table row
$count = $result->num_rows;
$row = $result->fetch_assoc();

if($count==1){

	//session_register('pwd'); 
	$_SESSION['pwd'] = $pwd;
	
	$_SESSION['nome'] = $row['nome'];
	$_SESSION['cognome'] = $row['cognome'];
	header("location:../index.php");
} 
else 
{
	$_SESSION["error"] = $error;
    header("location: ../frontend/page-lock.php"); //send user back to the login page.
}
?>