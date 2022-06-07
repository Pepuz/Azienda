<?php

function isUser($cid,$email,$pwd)
{
  $query = "SELECT * FROM utenti WHERE email='$email' and password='$pwd'";
  $result = $cid->query($query);
  
  return $result;
}

function nextMeeting($cid,$email)
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

function listMeetings($cid,$email)
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

function listaImpiegati($cid,$email)
{
	$query = "SELECT * FROM utenti WHERE ruolo = 'impiegato semplice'
			  AND email <> '$email'";
	
	$result = $cid->query($query);
	
	$impiegati = '';
	
	while($row = $result->fetch_assoc())
	{
		$impiegati .= "<option value=\"".$row['email']."\">".$row['email']."</option>";
	}
	
	return $impiegati;
}

function listaFunzionari($cid,$email)
{
	$query = "SELECT * FROM utenti WHERE ruolo = 'funzionario'
			  AND email <> '$email'";
	
	$result = $cid->query($query);
	
	$funzionari = '';
	
	while($row = $result->fetch_assoc())
	{
		$funzionari .= "<option value=\"".$row['email']."\">".$row['email']."</option>";
	}
	
	return $funzionari;
}

function listaCapisettore($cid,$email)
{
	$query = "SELECT * FROM utenti WHERE ruolo = 'caposettore'
		      AND email <> '$email'";
	
	$result = $cid->query($query);
	
	$capisettore = '';
	
	while($row = $result->fetch_assoc())
	{
		$capisettore .= "<option value=\"".$row['email']."\">".$row['email']."</option>";
	}
	
	return $capisettore;
}

function listaDirettori($cid,$email)
{
	$query = "SELECT * FROM utenti WHERE ruolo = 'direttore'
		      AND email <> '$email'";
	
	$result = $cid->query($query);
	
	$direttori = '';
	
	while($row = $result->fetch_assoc())
	{
		$direttori .= "<option value=\"".$row['email']."\">".$row['email']."</option>";
	}
	
	return $direttori;
}

function isOccupied($cid,$startTime,$endTime,$sala,$data)
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
	
	if($count!=0){
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
    if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}

function notAuth($cid)
{
	$query = "SELECT * FROM utenti WHERE data_autorizzazione IS NULL AND ruolo <> 'direttore'";
	
	$result = $cid->query($query);
	
	return $result;

}

function autorizzati($cid)
{
	$query = "SELECT * FROM utenti WHERE data_autorizzazione IS NOT NULL AND ruolo <> 'direttore'";
	
	$result = $cid->query($query);
	
	return $result;
}

function emailExists($cid,$email)
{
	$query = "SELECT email FROM utenti WHERE email = '$email'";
	
	$result = $cid->query($query);
	
	$count = $result->num_rows;
	
	if($count!=0){
		return true;
		
	} else {
		return false;
	}
	
}

function listaPartecipanti($cid,$id,$email)
{
	$query = "SELECT * FROM partecipa WHERE riunione = '$id' AND partecipante <> '$email'";
	
	$result = $cid->query($query);
	
	$partecipanti=array();
	
	while ($row = $result->fetch_assoc()) {
		
		$partecipanti[]=$row['partecipante'];
		
	}
	
	return $partecipanti;
}

function riunioniCreate($cid,$email)
{
	$query = "SELECT * FROM riunioni WHERE organizzatore = '$email'
				AND data_riunione > CURDATE()
				OR (data_riunione = CURDATE() AND ora > TIME(NOW()))
				ORDER BY data_riunione ASC, ora ASC";
	
	$result = $cid->query($query);
	
	$riunioni = '';
	
	while($row = $result->fetch_assoc())
	{
		$riunioni .= "<option value=\"".$row['id']."\">".$row['id'].", " . $row['tema'] ."</option>";
	}
	
	return $riunioni;
}

function dettagliRiunione($cid,$id)
{
	$query = "SELECT * FROM riunioni WHERE id = '$id'";
	
	$result = $cid->query($query);
	
	$dettagli = array();
	
	while($row = $result->fetch_assoc())
	{
	}

}
?>
	 
  

