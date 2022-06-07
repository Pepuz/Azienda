<?php
session_start();

require "../common/connection.php";
require "../common/functions.php";

$id = $_GET['id'];
$dettagli = dettagliRiunione($cid,$id)[0];
$dipartimenti = listaDipartimenti($cid);
print_r($dettagli);

echo   '<div class="form-row align-items-center" style="margin-top: 20px;">';
	echo	'<div class="col-auto my-1">';
		echo	'<label class="mr-sm-2">Dipartimento</label>';
		echo  	'<select class="custom-select mr-sm-2" name="dipartimento" id="dipartimento" onchange="listaSale(this.value)" required>';
			echo	'<option selected="selected" value="">' . $row['dipartimento'] . '</option>';
					
				while($row = $dipartimenti->fetch_assoc())
				{
					if($row['nome']==
					echo "<option value=\"".$row['nome']."\">".$row['nome']."</option>";
				}												
					
			echo	'</select>';
		echo	'</div>';
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
			<label class="mr-sm-2" style="margin-bottom: 8px;">Partecipanti</label></br>
				<select name="partecipanti[]" id="partecipanti"  multiple="multiple" placeholder="Seleziona Partecipanti" required>
					<optgroup label="Impiegati">
						<?php 
						echo $impiegati;								
						?>
					</optgroup>
					<optgroup label="Funzionari">
						<?php 
						echo $funzionari;												
						?>
					</optgroup>
					<optgroup label="Capisettore">
						<?php 
						echo $capisettore;												
						?>
					</optgroup>
					<optgroup label="Direttori">
						<?php 
						echo $direttori;												
						?>
					</optgroup>
				</select>
			</div>
		</div>';
?>