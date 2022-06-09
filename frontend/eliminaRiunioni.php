<?php
$email = $_SESSION['email'];

$usage = 0;
$riunioni = riunioniCreate($cid,$email,$usage);

$count = $riunioni->num_rows;
?>

<script>
function confirmationDelete(anchor)
{
   var conf = confirm('Sei sicuro di voler eliminare la riunione?');
   if(conf)
      window.location=anchor.attr("href");
}

</script>
<div class="content-body">
	<div class="row page-titles mx-0">
		<div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title" style="margin-bottom:30px;">
                        <h4>Riunioni attive create</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                                <?php
								if($count>0){
									echo "<thead>
										<tr>
											<th>Tema</th>
											<th>Sala</th>
											<th>Data</th>
											<th>Inizio</th>
											<th>Fine</th>
										</tr>
										</thead>
										<tbody>";
									while ($row = $riunioni->fetch_assoc()) {
										$passed = date('Ymd') > date('Ymd', strtotime($row['data_riunione']));
										if (!$passed) {
										echo "<tr>
											<td>" . $row['tema'] . "</td>
											<td>" . $row['salariunioni'] . "</td>
											<td>" . $row['data_riunione'] . "</td>
											<td>" . $row['ora'] . "</td>
											<td>" . $row['durata'] . "</td>
											<td></td>
											<td><a onclick='javascript:confirmationDelete($(this));return false;' href='backend/elimina_riunione.php?id=" . $row['id'] . " ' ><button id='elimina' type='button' class='btn mb-1 btn-danger'>Elimina</button></a></td>
											</tr>";
										}
									}
									echo "</tbody>";
								} else {
									echo "<tr><td colspan='2'> Nessuna riunione attiva creata dall'utente </td></tr>";
								}
								?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

					
