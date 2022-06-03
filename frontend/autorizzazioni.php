<?php
if (isset($_SESSION['ruolo']) && $_SESSION['ruolo'] != 'direttore') {
	redirect("frontend/page-error.html");
}

$nonAutorizzati = notAuth($cid);
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
    $('#modulo').submit(function (e) {
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: 'backend/autorizza.php',
        data: $('#modulo').serialize(),
        success: function (data) {
			var json = $.parseJSON(data);
			if(json.status==='success'){
				$("#modulo")[0].reset();
				$('#successo').html("Utente autorizzato correttamente"); 
				$("#successo").show();
				$('#successo').delay(5000).fadeOut('slow');
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
                        <form id="modulo" action="backend/autorizza.php" method="POST">
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
</div>


