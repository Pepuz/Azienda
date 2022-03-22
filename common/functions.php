<?php

function isUser($cid,$email,$pwd)
{
  $query = "SELECT * FROM utenti WHERE email='$email' and password='$pwd'";
  $result = $cid->query($query);
  
  return $result;
}
  

