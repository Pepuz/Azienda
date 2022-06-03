<?php
session_set_cookie_params(0);
session_start();
require "common/connection.php";
require "common/functions.php";

// If the session variable is empty, this
// means the user is yet to login
// User will be sent to 'login.php' page
// to allow the user to login
if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: frontend/login.php');
}

// Logout button will destroy the session, and
// will unset the session variables
// User will be headed to 'login.php'
// after logging out
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: frontend/login.php");
}
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<?php include "common/head.php"; ?>

<body>

    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
	
    <div id="main-wrapper">

        <?php include "common/header.php"; ?>

        <?php include "common/navbar.php"; ?>

        <?php

        if (isset($_GET["op"])) {
            include "frontend/" . $_GET["op"] . ".php";
        } else {
            include "frontend/home.php";
        }
        ?>
    </div>

<?php include "common/footer.php"; ?>
</body>

</html>
