<?php
session_start();

require "../common/connection.php";
require "../common/functions.php";

$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$email = $_POST['email'];
$data_nascita = $_POST['data'];
$ruolo = $_POST['ruolo'];
$dipartimento = $_POST['dipartimento'];
$pass = $_POST['password'];

$errors = array();

if(emailExists($cid,$email)) {
	$errors[] = "Questa email appartiene già ad un altro utente!";
}

if(count($errors) > 0){
    echo json_encode(array('status' => 'error', 'errors' => $errors));
	
} else {
	
	$utente = "INSERT INTO utenti (email, password, nome, cognome, data_nascita, ruolo, dipartimento)
			   VALUES ('$email', '$pass', '$nome', '$cognome', '$data_nascita', '$ruolo', '$dipartimento')";

	$creazione_utente = $cid->query($utente);
	
	echo json_encode(array('status' => 'success'));
	
}
?>