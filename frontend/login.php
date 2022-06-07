<?php
session_start();

?>

<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login</title>
    <link rel="icon" type="image/png" href="../images/favicon.png">
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

                                <form method="POST" class="mt-5 mb-5 login-input" action="../backend/check_login.php">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email" name="email" value="<?php if (isset($_COOKIE["email"])) {
                                                                                                                                echo $_COOKIE["email"];
                                                                                                                            } ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password" name="pwd">
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="remember">
                                        <label class="form-check-label" style="margin-bottom: 40px;">Remember me</label>
                                    </div>
									
                                    <button type="submit" class="btn login-form__btn submit w-100" style="margin-bottom: 20px;">Accedi</button>
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




    <!--**********************************
        Scripts
    ***********************************-->
    <script src="../plugins/common/common.min.js"></script>
    <script src="../js/custom.min.js"></script>
	<script src="../js/settings.js"></script>
    <script src="../js/gleek.js"></script>
    <script src="../js/styleSwitcher.js"></script>

</body>

</html>

<?php
unset($_SESSION["error"]);
?>
