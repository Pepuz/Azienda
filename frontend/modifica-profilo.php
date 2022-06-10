<?php
if (isset($_SESSION['ruolo']) && $_SESSION['ruolo'] != 'direttore') {
	redirect("frontend/page-error.html");
}

?>

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
	
$(function () {
    $('#registrazione').submit(function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'backend/check_registrazione.php',
			data: $('#registrazione').serialize(),
			success: function (data) {
				var json = $.parseJSON(data);

				if(json.status=== 'error'){
					$("#error").html(json.errors[0]);

					return false;
				}
				if(json.status==='success'){
					localStorage.setItem('alert',true);
					window.location.reload();
			
				}
			}
		});
    });
});

$( function () {
		if(localStorage.getItem("alert")){
			localStorage.removeItem("alert");
            $('#successo').html("Dati modificati correttamente"); 
			$("#successo").show();
			$('#successo').delay(3000).fadeOut('slow');
        }
    } 
);  

$(document).ready(function(){
    $(window).scrollTop(0);
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
										
											<h4>Modifica profilo</h4>
				
										<form autocomplete="off" class="mt-5 mb-5 login-input" id="registrazione">
                                        
											
											<div class="form-group">
												<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
											</div>
											
											
											
											<div class="form-group">
												<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
											</div>
											<div class="form-group">
												<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Conferma Password" required>
												<span id='message'></span>
											</div>
											<button type="submit" id="submit" class="btn login-form__btn submit w-100">Conferma modifiche</button>
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






