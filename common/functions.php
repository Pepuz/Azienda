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
	
?>
	 
  

