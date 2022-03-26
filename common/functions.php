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
            AND Data > CURDATE()
            OR (Data = CURDATE() AND Ora > TIME(NOW()))
            ORDER BY Data ASC, Ora ASC 
            LIMIT 1";
  
  $result = $cid->query($query);
  
  return $result;
}

function listMeetings($cid,$email)
{
  $query = "SELECT id, tema, Data, Ora, Salariunioni FROM partecipa JOIN riunioni 
		        WHERE riunione=id AND partecipante= '$email'";

  $result = $cid->query($query);
  
  return $result;
}

function activeMeetings($cid,$email)
{
	$query = "SELECT id FROM partecipa JOIN riunioni 
           	  WHERE riunione=id AND partecipante= '$email'
            	  AND Data > CURDATE()
            	  OR (Data = CURDATE() AND Ora > TIME(NOW()))";
	
	$result = $cid->query($query);
	
	$active_meetings =array();
	while($row = $result->fetch_assoc())
	{
	 $active_meetings[] = $result;
	}
	      
	return $active_meetings;
}

?>
	 
  

