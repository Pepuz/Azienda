<?php
session_start();

?>

<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Modifica email e password</title>
    <link rel="icon" type="image/png" href="../images/favicon.png">
    <link href="../css/style.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

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
<script>
$( function() {
	$('#password, #confirm_password').on('keyup', function () {
	  if ($('#password').val() == $('#confirm_password').val()) {
		$('#message').html('Corretta').css('color', 'green');
	  } else 
		$('#message').html('Non corrisponde').css('color', 'red');
	});
});

$(function () {
    $("#submit").click(function () {
        var password = $("#password").val();
        var confirmPassword = $("#confirm_password").val();
        if (password != confirmPassword) {
            alert("Le password non corrispondono!");
            return false;
        }
        return true;
    });
});
</script>
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center">
                                    <h4>Modifica password</h4>
                                </a>

                                <form method="POST" class="mt-5 mb-5 login-input" action="../backend/check_profile.php">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="password" placeholder="Nuova Password" name="new_password" required>
                                    </div>
									<div class="form-group">
										<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Conferma Password" required>
										<span id='message'></span>
									</div>
                                    <div></div>
                                    <button type="submit" class="btn login-form__btn submit w-100" style="margin-bottom: 20px;">Modifica</button>
									<?php
                                    if (isset($_SESSION["error_pass"])) {
                                        $error = $_SESSION["error_pass"];
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

</body>

</html>
