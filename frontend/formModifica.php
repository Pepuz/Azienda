<?php
$email = $_SESSION['email'];
$riunioni = riunioniCreate($cid,$email);
?>
<script>
$(document).ready(function(){
	$('#riunione').change(function(){
		$('#riunione option[value!='+$(this).val()+']').hide();
		var url = 'backend/carica_dettagli.php?id=' + $(this).val();
		$('#details').load(url);
	});
	
	
});

$(function() {
    $('#modulo').submit(function(e){
        if($('#riunione').val() == '0') {
            alert('Seleziona Riunione da modificare!');
            e.preventDefault();
        }
    });
		
});

$(function () {
    $('#modulo').submit(function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'backend/check_modifica.php?id=' +$('#riunione').val(),
			data: $('#modulo').serialize(),
			success: function (data) {
				var json = $.parseJSON(data);

				if(json.status=== 'error'){
					$("#errore_1").html(json.errors[0]);
					$("#errore_2").html(json.errors[1]);
					$("#errore_3").html(json.errors[2]);
					
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
            $('#successo').html("Riunione modificata correttamente"); 
			$("#successo").show();
			$('#successo').delay(3000).fadeOut('slow');
        }
    } 
);


</script>
<div class="content-body">
	<div class="row page-titles mx-0">
	<div class="alert alert-success" id="successo" style="display:none;"></div>
		<div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" style="margin-bottom:30px;">Modifica Riunione</h4>
                    <div class="basic-form">
                        <form autocomplete="off" id="modulo" action="backend/check_modifica.php" method="POST">
                            <div class="form-row align-items-center" style="margin-top: 20px;">
                                <div class="col-auto my-1">
                                    <label class="mr-sm-2">Riunione</label>
                                    <select class="custom-select mr-sm-2" name="riunione" id="riunione" required>
                                        <option selected="selected" value="0" hidden>Seleziona Riunione...</option>
                                            <?php 
											echo $riunioni;											
											?>
                                    </select>
                                </div>
							</div>
							<div id="details"></div>
							<span id="errore_1" style='color:red;'></span></br>
							<span id="errore_2" style='color:red;'></span></br>
							<span id="errore_3" style='color:red;'></span>
								<div class="form-group row" style="margin-top:30px;">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary" id="modifica">Modifica Riunione</button>
                                    </div>
                                </div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
							