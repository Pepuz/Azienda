<?php

session_start();
//mettere controlli per non finire in questa pagina

require "../common/connection.php";
$risultato = array("msg" => "", "status" => "ok", "contenuto" => "");

$email = $_SESSION['email'];

$query = "SELECT partecipazione, Data, Ora, Salariunioni, tema, id FROM partecipa, riunioni WHERE partecipante='$email' and id = riunione";
$result = $cid->query($query);

if ($result == null) {
    $risultato["status"] = "ko";
    $risultato["msg"] = "Errore nell'esecuzione dell'interrogaizone" . $cid->error;
} else {
    $riunioni = array();

    while ($row = $result->fetch_assoc()) {
        $riunioni[] = $row;
    }

    $risultato["contenuto"] = $riunioni;
}

echo json_encode($riunioni);
