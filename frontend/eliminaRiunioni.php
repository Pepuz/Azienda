<?php
if (isset($_SESSION['ruolo']) && $_SESSION['ruolo'] != 'direttore' && (!isset($_SESSION['data_autorizzazione']))) {
	redirect("frontend/page-error.html");
}

$email = $_SESSION['email'];

$query = "SELECT * FROM riunioni 
		  WHERE organizzatore='$email'
		  AND data_riunione > CURDATE()
          OR (data_riunione = CURDATE() AND ora > TIME(NOW()))
		  ORDER BY data_riunione, ora";

$result = $cid->query($query);
$count = $result->num_rows;
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
									echo "<thead>";
									echo "<tr>";
										echo "<th>Tema</th>";
										echo "<th>Sala</th>";
										echo "<th>Data</th>";
										echo "<th>Inizio</th>";
										echo "<th>Fine</th>";
									echo "</tr>";
									echo "</thead>";
									echo "<tbody>";
									while ($row = $result->fetch_assoc()) {
										$passed = date('Ymd') > date('Ymd', strtotime($row['data_riunione']));
										if (!$passed) {
										echo "<tr>";
										echo "<td>" . $row['tema'] . "</td>";
										echo "<td>" . $row['salariunioni'] . "</td>";
										echo "<td>" . $row['data_riunione'] . "</td>";
										echo "<td>" . $row['ora'] . "</td>";
										echo "<td>" . $row['durata'] . "</td>";
										echo '<td></td>';
										echo "<td><a onclick='javascript:confirmationDelete($(this));return false;' href='backend/elimina_riunione.php?id=" . $row['id'] . " ' ><button id='elimina' type='button' class='btn mb-1 btn-danger'>Elimina</button></a></td>";
										echo "</tr>";
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

					