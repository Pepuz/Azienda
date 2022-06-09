<?php

session_start();

require "../common/connection.php";
require "../common/functions.php";

// username and password sent from form 
$email = $_POST['email']; 
$pwd = $_POST['pwd']; 
$error = "Email o Password errata";

$result = isUser($cid,$email,$pwd);

// num_rows is counting table rows
$count = $result->num_rows;
// fetch_assoc creates an array with the values of the row
$row = $result->fetch_assoc();

if($count==1){

	//session_register('email');
	$_SESSION['email'] = $email;
	//session_register('pwd'); 
	$_SESSION['pwd'] = $pwd;   
	if($_POST["remember"]=='1' || $_POST["remember"]=='on')
    {
        $hour = time() + 3600 * 24 * 30;
        setcookie('email', $email, $hour);
    }

	$_SESSION['ruolo'] = $row['ruolo'];
	$_SESSION['nome'] = $row['nome'];
	$_SESSION['cognome'] = $row['cognome'];
	$_SESSION['data_autorizzazione'] = $row['data_autorizzazione'];
	header("location:../index.php");
} 
else 
{
	$_SESSION["error"] = $error;
    header("location:../frontend/login.php"); //send user back to the login page.
	exit();
}
?>
