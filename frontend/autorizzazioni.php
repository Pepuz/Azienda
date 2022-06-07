<?php
if (isset($_SESSION['ruolo']) && $_SESSION['ruolo'] != 'direttore') {
	redirect("frontend/page-error.html");
}

$nonAutorizzati = notAuth($cid);
$autorizzati = autorizzati($cid);
?>

<script>
$(function() {
        $('#modulo').submit(function(e){
            if($('#autorizzazione').val() == '0') {
                alert('Seleziona Utente da autorizzare!');
                e.preventDefault();
            }
        });
		

    });


$(function () {
    $('#modulo1').submit(function (e) {
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: 'backend/autorizza.php',
        data: $('#modulo1').serialize(),
        success: function (data) {
			var json = $.parseJSON(data);
			if(json.status==='success'){
				$("#modulo1")[0].reset();
				$('#successo').html("Utente autorizzato correttamente"); 
				$("#successo").show();
				$('#successo').delay(5000).fadeOut('slow');
			}
		}
      });
    });
  });
  
$(function () {
    $('#modulo2').submit(function (e) {
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: 'backend/revoca.php',
        data: $('#modulo2').serialize(),
        success: function (data) {
			var json = $.parseJSON(data);
			if(json.status==='success'){
				$("#modulo2")[0].reset();
				$('#revocato').html("Autorizzazione revocata correttamente"); 
				$("#revocato").show();
				$('#revocato').delay(5000).fadeOut('slow');
			}
		}
      });
    });
  });
</script>

<div class="content-body">
	<div class="row page-titles mx-0">
	<div class="alert alert-success" id="successo" style="display:none;"></div>
		<div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Autorizzazioni</h4>
                    </div>
					<div class="basic-form" style="margin-top:40px;">
                        <form id="modulo1" action="backend/autorizza.php" method="POST">
                            <div class="form-row align-items-center" style="margin-top: 20px;">
                                <div class="col-auto my-auto">
                                    <select class="custom-select mr-sm-2" name="autorizzazione" id="autorizzazione" required>
                                        <option selected="selected" value="0">Seleziona Dipendente da autorizzare...</option>
                                        <?php 
										while($row = $nonAutorizzati->fetch_assoc())
										{
											echo "<option value=\"".$row['email']."\">".$row['email']."</option>";
										}												
										?>
                                    </select>
                                 </div>
								 <button type="submit" class="btn btn-primary" id="autorizza" style="margin-left:30px;">Autorizza</button>
                            </div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row page-titles mx-0">
	<div class="alert alert-success" id="revocato" style="display:none;"></div>
		<div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Revoca Autorizzazione</h4>
                    </div>
					<div class="basic-form" style="margin-top:40px;">
                        <form id="modulo2" action="backend/revoca.php" method="POST">
                            <div class="form-row align-items-center" style="margin-top: 20px;">
                                <div class="col-auto my-auto">
                                    <select class="custom-select mr-sm-2" name="cancellazione" id="cancellazione" required>
                                        <option selected="selected" value="0">Seleziona Dipendente...</option>
                                        <?php 
										while($row = $autorizzati->fetch_assoc())
										{
											echo "<option value=\"".$row['email']."\">".$row['email']."</option>";
										}												
										?>
                                    </select>
                                 </div>
								 <button type="submit" class='btn mb-1 btn-danger' id="cancella" style="margin-left:30px;">Elimina</button>
                            </div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



