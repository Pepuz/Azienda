<?php


function isUser($cid, $email, $pwd)
{
  $query = "SELECT * FROM utenti WHERE email='$email' and password='$pwd'";
  $result = $cid->query($query);

  return $result;
}

function nextMeeting($cid, $email)
{
  $query = "SELECT * FROM partecipa JOIN riunioni 
            WHERE riunione=id AND partecipante= '$email'
            AND data_riunione > CURDATE()
            OR (data_riunione = CURDATE() AND ora > TIME(NOW()))
            ORDER BY data_riunione ASC, ora ASC 
            LIMIT 1";

  $result = $cid->query($query);

  return $result;
}

function listMeetings($cid, $email)
{
  $query = "SELECT id, tema, data_riunione, ora, salariunioni FROM partecipa JOIN riunioni 
		        WHERE riunione=id AND partecipante= '$email'";

  $result = $cid->query($query);

  return $result;
}

function listaDipartimenti($cid)
{
  $query = "SELECT * FROM dipartimenti";

  $result = $cid->query($query);

  return $result;
}

function listaImpiegati($cid, $email)
{
  $query = "SELECT * FROM utenti WHERE ruolo = 'impiegato semplice'
			  AND email <> '$email'";

  $result = $cid->query($query);

  return $result;
}

function listaFunzionari($cid, $email)
{
  $query = "SELECT * FROM utenti WHERE ruolo = 'funzionario'
			  AND email <> '$email'";

  $result = $cid->query($query);

  return $result;
}

function listaCapisettore($cid, $email)
{
  $query = "SELECT * FROM utenti WHERE ruolo = 'caposettore'
		      AND email <> '$email'";

  $result = $cid->query($query);

  return $result;
}

function listaDirettori($cid, $email)
{
  $query = "SELECT * FROM utenti WHERE ruolo = 'direttore'
		      AND email <> '$email'";

  $result = $cid->query($query);

  return $result;
}

function isOccupied($cid, $startTime, $endTime, $sala, $data)
{
  $query =  " SELECT * FROM riunioni
				WHERE
					(
						ora BETWEEN '$startTime' AND '$endTime' OR
						durata BETWEEN '$startTime' AND '$endTime' OR
						'$startTime' BETWEEN ora AND durata OR
						'$endTime' BETWEEN ora AND durata
					) 
				AND data_riunione = '$data' AND salariunioni = '$sala'";

  $result = $cid->query($query);

  $count = $result->num_rows;

  if ($count != 0) {
    return true;
  } else {
    return false;
  }
}

function capienzaSala($cid, $sala)
{
  $query = "SELECT capienza FROM sale_riunioni WHERE nome = '$sala'";

  $result = $cid->query($query);

  while ($row = $result->fetch_assoc()) {

    return $row['capienza'];
  }
}

function newId($cid)
{
  $query = "SELECT id FROM riunioni WHERE id=(SELECT max(id) FROM riunioni)";

  $result = $cid->query($query);

  while ($row = $result->fetch_assoc()) {

    return ++$row['id'];
  }
}

function redirect($url)
{
  if (!headers_sent()) {
    header('Location: ' . $url);
    exit;
  } else {
    echo '<script type="text/javascript">';
    echo 'window.location.href="' . $url . '";';
    echo '</script>';
    echo '<noscript>';
    echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
    echo '</noscript>';
    exit;
  }
}

function notAuth($cid)
{
  $query = "SELECT * FROM utenti WHERE data_autorizzazione IS NULL AND ruolo <> 'direttore'";

  $result = $cid->query($query);

  return $result;
}

function creaDirettore($cid)
{
  $query = "SELECT * FROM riunioni, utenti
  WHERE organizzatore = email AND ruolo = 'direttore'";

  $result = $cid->query($query);

  $count = $result->num_rows;

  return $count;
}

function creaAutorizzato($cid)
{
  $query = "SELECT * FROM riunioni, utenti
  WHERE organizzatore = email AND data_autorizzazione is not NULL";

  $result = $cid->query($query);

  $count = $result->num_rows;

  return $count;
}

function trovaAutorizzati($cid) {
  $query = "SELECT DISTINCT email, ruolo, dipartimento FROM utenti
  WHERE data_autorizzazione is not NULL";

  $result = $cid->query($query);

  return $result;
}
