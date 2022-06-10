<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Registrazione</title>
    <link rel="icon" type="image/png" href="../images/favicon.png">
    <link href="../css/style.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<link href="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">

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
  $( "#data" ).datepicker({
	  format: "yyyy-mm-dd",
	  endDate: new Date('01/01/2004')
  });
  
});
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

$(function() {
        $('#registrazione').submit(function(e){
            if($('#dipartimento').val() == '0') {
                alert('Seleziona Dipartimento!');
                e.preventDefault();
            }
			if($('#ruolo').val() == '0') {
                alert('Seleziona Ruolo!');
                e.preventDefault();
            }
			
        });
		

    });
	
$(function () {
    $('#registrazione').submit(function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '../backend/check_registrazione.php',
			data: $('#registrazione').serialize(),
			success: function (data) {
				var json = $.parseJSON(data);

				if(json.status=== 'error'){
					$("#error").html(json.errors[0]);

					return false;
				}
				if(json.status==='success'){
					window.location.href = "login.php";
			
				}
			}
		});
    });
});
  
$(document).ready(function() {
	$('#nome').keyup(function() {
	  $(this).val($(this).val().substr(0, 1).toUpperCase() + $(this).val().substr(1).toLowerCase());
	});
	
	$('#cognome').keyup(function() {
	  $(this).val($(this).val().substr(0, 1).toUpperCase() + $(this).val().substr(1).toLowerCase());
	});
});

</script>

<div class="content-body">
	<div class="row page-titles mx-0">
	<div class="alert alert-success" id="successo" style="display:none;"></div>
		<div class="col-lg-12">   
			<div class="login-form-bg h-100">
				<div class="container h-100">
					<div class="row justify-content-center h-100">
						<div class="col-xl-6">
							<div class="form-input-content">
								<div class="card login-form mb-0">
									<div class="card-body pt-5">
										
											<h4>Registra utente</h4>
				
										<form autocomplete="off" class="mt-5 mb-5 login-input" id="registrazione">
											<div class="form-group">
												<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
											</div>
											<div class="form-group">
												<input type="text" class="form-control" id="cognome" name="cognome" placeholder="Cognome" required>
											</div>
											<div class="form-group">
												<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
											</div>
											<div class="form-group">
												<input type="text" id="data" name="data" class="form-control" placeholder="Data di nascita" required>
											</div>
											<div class="form-group">
												<select class="form-control" name="ruolo" id="ruolo" required>
                                                    <option selected="selected" value="0">Seleziona Ruolo...</option>
													<option value="impiegato semplice">Impiegato</option>
													<option value="funzionario">Funzionario</option>
													<option value="caposettore">Caposettore</option>
                                                </select>
											</div>
											<div class="form-group">
												<select class="form-control" name="dipartimento" id="dipartimento" required>
                                                    <option selected="selected" value="0">Seleziona Dipartimento...</option>
													<option value="crescita e sviluppo">Crescita e Sviluppo</option>
													<option value="informatica">Informatica</option>
													<option value="risorse umane">Risorse Umane</option>
                                                </select>
											</div>
											<div class="form-group">
												<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
											</div>
											<div class="form-group">
												<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Conferma Password" required>
												<span id='message'></span>
											</div>
											<button type="submit" id="submit" class="btn login-form__btn submit w-100">Registra utente</button>
											<span id="error" style='color:red;'></span>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="../plugins/common/common.min.js"></script>
<script src="../js/custom.min.js"></script>
<script src="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

</body>

</html>




