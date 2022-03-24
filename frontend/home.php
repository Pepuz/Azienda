<?php
$result=nextMeeting($cid,$email);
	
$count = $result->num_rows;
$row = $result->fetch_assoc();
?>

<div class="content-body">
	<div class="p-md-0">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h1><?php echo 'Benvenuto,' . " " . $_SESSION['nome'] . " " . $_SESSION['cognome']; ?></h1>
						</div>
						<?php
						if ($count > 0) {
							include 'table-content.php';
						} else {
							echo '<p>Nessuna riunione trovata per l\'utente</p>';
							//TODO formattare per renderlo decente
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
