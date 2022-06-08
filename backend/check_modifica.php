<?php
session_start();

require "../common/connection.php";
require "../common/functions.php";

$id = $_GET['id'];
$dipartimento = $_POST['dipartimento'];
$sala = $_POST['sala'];
$data = $_POST['data'];
$oraInizio = $_POST['startTime'];
$oraFine = $_POST['endTime'];
$partecipanti_new = $_POST['partecipanti'];
$email = $_SESSION['email'];

$errors = array();

if(isOccupied($cid,$oraInizio,$oraFine,$sala,$data,$id)){
	$errors[] = "La sala è già occupata in questo orario!";
}

if((count($partecipanti_new)+1)>capienzaSala($cid,$sala)) {
	$errors[] = "Il numero di partecipanti supera la capienza massima della sala!";
}

if(count($errors) > 0){
    echo json_encode(array('status' => 'error', 'errors' => $errors));
	
} else {
	
	$modifica = "UPDATE riunioni 
				SET dipartimento = '$dipartimento', salariunioni = '$sala', data_riunione = '$data', ora = '$oraInizio', durata = '$oraFine'
				WHERE id = '$id'";
				
	$modificaRiunione = $cid->query($modifica);
	
	$partecipanti = listaPartecipanti($cid,$id,$email);
	
	foreach($partecipanti_new as $partecipante){
		
		if(in_array($partecipante, $partecipanti)){
			continue;
		} else {
			$partecipa = "INSERT INTO partecipa (partecipante, riunione, partecipazione)
						VALUES ('$partecipante', '$id', NULL)";
			
			$addPar = $cid->query($partecipa);
		}
	}
	
	echo json_encode(array('status' => 'success'));
	
}
?>