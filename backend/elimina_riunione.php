<?php
session_start();

require "../common/connection.php";
require "../common/functions.php";

$riunione = $_GET['id'];

$email = $_SESSION['email'];

$sql = "DELETE FROM riunioni WHERE id='$riunione'";

$result = $cid->query($sql);

redirect("../index.php?op=modificaRiunioni");
?>