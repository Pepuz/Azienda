<?php
session_start();

if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: frontend/login.php');
}
?>

<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Meetup Planner</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="../css/style.css" rel="stylesheet">

</head>

<body class="h-100">
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->




    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center">
                                    <h4>Login</h4>
                                </a>
                                <form class="mt-5 mb-3 login-input" action="../backend/unlock.php" method="POST">
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password" name="pwd" required>
                                    </div>
                                    <button class="btn login-form__btn submit w-100" type="submit">Unlock</button>
                                    <?php
                                    if (isset($_SESSION["error"])) {
                                        $error = $_SESSION["error"];
                                        echo "<span style='color:red;'>$error</span>";
                                    }
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>




    <!--**********************************
        Scripts
    ***********************************-->
    <!-- <script src="../plugins/common/common.min.js"></script> -->
    <script src="../js/custom.min.js"></script>

</body>

</html>

<?php
unset($_SESSION["error"]);
?>
