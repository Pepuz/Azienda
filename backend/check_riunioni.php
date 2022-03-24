<?php

session_start();
//mettere controlli per non finire in questa pagina

require "../common/connection.php";
$risultato = array("msg" => "", "status" => "ok", "contenuto" => "");

$email = $_SESSION['email'];

//$query = "SELECT partecipazione, data_riunione, ora, salariunioni, tema, id 
//FROM partecipa JOIN riunioni 
//WHERE partecipante='$email' and id = riunione and CURDATE() <= data_riunione and partecipazione = null
//ORDER BY data_riunione, ora";

$query = "SELECT partecipazione, data_riunione, ora, salariunioni, tema, id 
FROM partecipa JOIN riunioni 
WHERE partecipante='$email' and riunione = id and CURDATE() < data_riunione or (data_riunione = CURDATE()) and partecipazione = NULL
ORDER BY data_riunione, ora";

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
