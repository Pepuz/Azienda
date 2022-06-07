<?php
session_start();

require "../common/connection.php";
require "../common/functions.php";

$dipartimento = $_POST['dipartimento'];
$sala = $_POST['sala'];
$tema = $_POST['tema'];
$data = $_POST['data'];
$oraInizio = $_POST['startTime'];
$oraFine = $_POST['endTime'];
$partecipanti = $_POST['partecipanti'];
$email = $_SESSION['email'];

$errors = array();

if(isOccupied($cid,$oraInizio,$oraFine,$sala,$data)){
	$errors[] = "La sala è già occupata in questo orario!";
}

if((count($partecipanti)+1)>capienzaSala($cid,$sala)) {
	$errors[] = "Il numero di partecipanti supera la capienza massima della sala!";
}

if(count($errors) > 0){
    echo json_encode(array('status' => 'error', 'errors' => $errors));
	
} else {
	
	$id = newId($cid);
	
	$riunione = "INSERT INTO riunioni (id, organizzatore, data_riunione, ora, salariunioni, dipartimento, tema, durata)
				VALUES ('$id', '$email', '$data', '$oraInizio', '$sala', '$dipartimento', '$tema', '$oraFine')";
		
	$creaRiunione = $cid->query($riunione);
	
	$organizzatore = "INSERT INTO partecipa (partecipante, riunione, partecipazione)
					VALUES ('$email', '$id', '1')";
			
	$addOrg = $cid->query($organizzatore);
	
	foreach($partecipanti as $partecipante){
		
		$partecipa = "INSERT INTO partecipa (partecipante, riunione, partecipazione)
					  VALUES ('$partecipante', '$id', NULL)";
			
		$addPar = $cid->query($partecipa);	
	}
	
	echo json_encode(array('status' => 'success'));
	
}
?>