<?php

session_start();

require "../common/connection.php";

$riunione = $_GET['id'];
$motivazione =  $_GET['motivazione'];
$email = $_SESSION['email'];

$query = "UPDATE partecipa SET partecipazione=0, motivazione = '$motivazione' WHERE riunione='$riunione' and partecipante='$email'";

$result = $cid->query($query);

header("location:../index.php?op=riunioni");
