<?php
if (isset($_SESSION['ruolo']) && $_SESSION['ruolo'] != 'direttore' && (!isset($_SESSION['data_autorizzazione']))) {
	redirect("frontend/page-error.html");
}

$email = $_SESSION['email'];
$dipartimenti = listaDipartimenti($cid,$email);
$impiegati = listaImpiegati($cid,$email);
$funzionari = listaFunzionari($cid,$email);
$capisettore = listaCapisettore($cid,$email);
$direttori = listaDirettori($cid,$email);

?>
<script type="text/javascript">
$( function() {
  $( "#data" ).datepicker({
	  format: "yyyy-mm-dd",
	  startDate: new Date()
  });
  
});

$( function() {
	$( "#startTime" ).timepicker({
			timeFormat: 'HH:mm',
			interval: 30,
			minTime: '8',
			maxTime: '19',
			startTime: '8',
			dynamic: false,
			dropdown: true,
			scrollbar: true
	});
	
	$('#startTime')
	  .timepicker('option', 'change', function(time) {
		var later = new Date(time.getTime() + (30 * 60 * 1000));
		$('#endTime').timepicker('option', 'minTime', later);
		$('#endTime').timepicker('setTime', later);
	  });

	$('#endTime').timepicker({
	  timeFormat: 'HH:mm',
	  interval: 30,
	  maxTime: '19',
	  startTime: '8',
	  dynamic: false,
	  dropdown: true,
	  scrollbar: true
	});
	
});

$(document).ready(function(){
	$('#partecipanti').multipleSelect({
	
	});
	

	
}); 

$(function() {
        $('#modulo').submit(function(e){
            if($('#dipartimento').val() == '0') {
                alert('Seleziona Dipartimento!');
                e.preventDefault();
            }
			if($('#sala').val() == '0') {
                alert('Seleziona Sala Riunioni!');
                e.preventDefault();
            }
			
        });
		

    });
	

$(function () {
    $('#modulo').submit(function (e) {
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: 'backend/check_creazione.php',
        data: $('#modulo').serialize(),
        success: function (data) {
			var json = $.parseJSON(data);

			if(json.status=== 'error'){
				$("#errore_1").html(json.errors[0]);
				$("#errore_2").html(json.errors[1]);

				return false;
			}
			if(json.status==='success'){
				sessionStorage.setItem('reload',true);
				window.location.reload();
			
			}
		}
      });
    });
  });

$( function () {
        if (sessionStorage.getItem('reload') != "false") {
            $('#successo').html("Riunione creata correttamente"); 
			$("#successo").show();
			$('#successo').delay(5000).fadeOut('slow');
            sessionStorage.setItem('reload', false);
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
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="margin-bottom:30px;">Crea Riunione</h4>
                                <div class="basic-form">
                                    <form autocomplete="off" id="modulo" action="backend/check_creazione.php" method="POST">
                                        <div class="form-row align-items-center" style="margin-top: 20px;">
                                            <div class="col-auto my-1">
                                                <label class="mr-sm-2">Dipartimento</label>
                                                <select class="custom-select mr-sm-2" name="dipartimento" id="dipartimento" onchange="listaSale(this.value)" required>
                                                    <option selected="selected" value="0">Seleziona Dipartimento...</option>
                                                    <?php 
													while($row = $dipartimenti->fetch_assoc())
													{
														echo "<option value=\"".$row['nome']."\">".$row['nome']."</option>";
													}												
													?>
                                                </select>
                                            </div>
                                        </div>
										<div class="form-row align-items-center" style="margin-top: 20px;">
                                            <div class="col-auto my-1">
                                                <label class="mr-sm-2">Sala Riunione</label>
                                                <select class="custom-select mr-sm-2" name="sala" id="sala" required>
                                                    <option selected="selected" value="0">Seleziona Sala...</option>
                                                </select>
												<label class="mr-sm-2" style="" id="capienza"></label>
                                            </div>
                                        </div>
										<div class="form-row align-items-center" style="margin-top: 20px;">
                                            <div class="col-auto my-1">
                                                <label class="mr-sm-2">Tema</label>
                                                <input class="form-control input-flat" type="text" name="tema" id="tema" placeholder="Inserisci Tema Riunione..." required>
                                            </div>
                                        </div>
										<div class="form-row align-items-center" style="margin-top: 20px;">
                                            <div class="col-auto my-1">
											<label class="mr-sm-2">Data</label>
                                                <input class="form-control" type="text" id="data" name="data" placeholder="yyyy-mm-dd" required> 
                                            </div>
                                        </div>
										
										<div class="row form-material" style="margin-top: 20px;">
											<div class="col-md-4" style="float:left">
												<label for="start" class="mr-sm-2">Ora Inizio</br>
												<input class="form-control" type="text" id="startTime" name="startTime" placeholder="HH:mm" style="margin-top: 7.5px;" required> 
												</label>
											</div>
											<div class="col-md-4">
												<label for="end" class="mr-sm-2">Ora Fine</br>
												<input class="form-control" type="text" id="endTime" name="endTime" placeholder="HH:mm" style="margin-top: 7.5px;" required>
												</label>
											</div>
										</div>
										<div class="form-row align-items-center" style="margin-top: 20px;">
                                            <div class="col-auto my-1">
                                            <label class="mr-sm-2" style="margin-bottom: 8px;">Partecipanti</label></br>
                                                <select name="partecipanti[]" id="partecipanti"  multiple="multiple" placeholder="Seleziona Partecipanti" required>
													<optgroup label="Impiegati">
														<?php 
														while($row = $impiegati->fetch_assoc())
														{
															echo "<option value=\"".$row['email']."\">".$row['email']."</option>";
														}												
														?>
													</optgroup>
													<optgroup label="Funzionari">
														<?php 
														while($row = $funzionari->fetch_assoc())
														{
															echo "<option value=\"".$row['email']."\">".$row['email']."</option>";
														}												
														?>
													</optgroup>
													<optgroup label="Capisettore">
														<?php 
														while($row = $capisettore->fetch_assoc())
														{
															echo "<option value=\"".$row['email']."\">".$row['email']."</option>";
														}												
														?>
													</optgroup>
													<optgroup label="Direttori">
														<?php 
														while($row = $direttori->fetch_assoc())
														{
															echo "<option value=\"".$row['email']."\">".$row['email']."</option>";
														}												
														?>
													</optgroup>
                                                </select>
											</div>
                                        </div>
										<span id="errore_1" style='color:red;'></span></br>
										<span id="errore_2" style='color:red;'></span>
										<div class="form-group row" style="margin-top:30px;">
                                            <div class="col-lg-8 ml-auto">
                                                <button type="submit" class="btn btn-primary" id="crea">Crea Riunione</button>
                                            </div>
                                        </div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
