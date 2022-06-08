<?php
session_start();

require "../common/connection.php";
require "../common/functions.php";

$id = $_GET['id'];
$email = $_SESSION['email'];
$dettagli = dettagliRiunione($cid,$id)[0];
$dipartimenti = listaDipartimenti($cid);
$partecipanti = listaPartecipanti($cid,$id,$email);
$impiegati = listaImpiegati($cid,$email);
$funzionari = listaFunzionari($cid,$email);
$capisettore = listaCapisettore($cid,$email);
$direttori = listaDirettori($cid,$email);

echo   '<div class="form-row align-items-center" style="margin-top: 20px;">
		<div class="col-auto my-1">
			<label class="mr-sm-2">Dipartimento</label>
			<select class="custom-select mr-sm-2" name="dipartimento" id="dipartimento" onchange="listaSale(this.value)" required>';

				while($row = $dipartimenti->fetch_assoc())
				{
					$selected = ($row['nome'] == $dettagli['dipartimento']) ? 'selected="selected"' :'';
					echo "<option $selected value='".$row['nome']."'>".$row['nome']."</option>";
					
				}												
					
		echo	'</select>
				</div>
			</div>
		<div class="form-row align-items-center" style="margin-top: 20px;">
			<div class="col-auto my-1">
				<label class="mr-sm-2">Sala Riunione</label>
				<select class="custom-select mr-sm-2" name="sala" id="sala" required>
					<option selected="selected" value="'.$dettagli['salariunioni'].'">' . $dettagli['salariunioni'] . '</option>
				</select>
			</div>
		</div>
		<div class="form-row align-items-center" style="margin-top: 20px;">
			<div class="col-auto my-1">
			<label class="mr-sm-2" style="margin-bottom: 8px;">Partecipanti</label></br>
				<select name="partecipanti[]" id="partecipanti"  multiple="multiple" placeholder="Seleziona Partecipanti" required>
					<optgroup label="Impiegati">';
						echo $impiegati;								
				echo '</optgroup>
					 <optgroup label="Funzionari">';
						echo $funzionari;											
				echo '</optgroup>
					 <optgroup label="Capisettore">';
						echo $capisettore;											
				echo '</optgroup>
					 <optgroup label="Direttori">';
						echo $direttori;										
			echo	'</optgroup>
				</select>
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
		</div>';
?>
<script src="js/callSale.js" type="text/javascript"></script>
<script>
var data = <?php echo json_encode($dettagli['data_riunione']); ?>;

var startTime = <?php echo json_encode($dettagli['ora']); ?>;
var endTime = <?php echo json_encode($dettagli['durata']); ?>;

var values = <?php echo json_encode($partecipanti); ?>;

const partecipanti = [];

for(var i=0; i<values.length; i++){
	partecipanti.push(values[i]);
}
	
$(document).ready(function(){
	$('#partecipanti').multipleSelect({
	
	});
	
	$('#partecipanti').multipleSelect('setSelects', partecipanti);
	
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
			scrollbar: true,
			defaultTime: startTime
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
	  scrollbar: true,
	  defaultTime: endTime
	});
	
});

$( function() {
  $( "#data" ).datepicker({
	  format: "yyyy-mm-dd",
	  startDate: '+1d',
  });
  $("#data").datepicker('setDate', new Date(data)); 
  
});
</script>