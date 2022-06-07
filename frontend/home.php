<?php
$result = nextMeeting($cid, $email);
$count = $result->num_rows;
$row = $result->fetch_assoc();
?>

<div class="content-body">
	<div class="p-md-0">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
						<div class="card-body">
							<h1><?php echo 'Benvenuto,' . " " . $_SESSION['nome'] . " " . $_SESSION['cognome']; ?></h1>
						</div>
						<?php
							include 'table-content.php';
						?>
				</div>
			</div>
		</div>
	</div>
</div>
