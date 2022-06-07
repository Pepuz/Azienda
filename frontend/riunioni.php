<?php

if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: frontend/login.php');
}

$email = $_SESSION['email'];

$query = "SELECT partecipazione, tema, data_riunione, ora, durata, salariunioni, id, organizzatore FROM partecipa JOIN riunioni 
		WHERE riunione=id AND partecipante='$email' ORDER BY data_riunione, ora";

$result = $cid->query($query);
$count = $result->num_rows;

?>

<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="raw page-titles mx-0">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Lista Riunioni</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
						<?php
							if($count>0) {
								echo "<thead>";
									echo "<tr>";
										echo "<th>Tema</th>";
										echo "<th>Sala</th>";
										echo "<th>Data</th>";
										echo "<th>Inizio</th>";
										echo "<th>Fine</th>";
										echo "<th>Stato</th>";
										echo "<th></th>";
										echo "<th></th>";
									echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
                                
                                while ($row = $result->fetch_assoc()) {
                                    $passed = date('Ymd') > date('Ymd', strtotime($row['data_riunione']));
                                    echo "<tr>";
                                    echo "<td>" . $row['tema'] . "</td>";
                                    echo "<td>" . $row['salariunioni'] . "</td>";
                                    echo "<td>" . $row['data_riunione'] . "</td>";
                                    echo "<td>" . $row['ora'] . "</td>";
									echo "<td>" . $row['durata'] . "</td>";
                                    if ($passed) {
                                        echo "<td><span class='label label-pill label-danger'>Passata</span></td>";
                                    } else {
                                        echo "<td><span class='label label-pill label-success'>Programmata</span></td>";
                                    }
									if ($row['organizzatore']!=$email) {
										if (!isset($row['partecipazione']) && !$passed) {
											echo '<td><a href="backend/accetta_riunioni.php?id=' . $row['id'] . '"><button type="button" class="btn mb-1 btn-info">Accetta Invito</button></a></td>';
											echo '<td><a href="backend/rifiuta_riunioni.php?id=' . $row['id'] . '"><button type="button" class="btn mb-1 btn-danger">Non Accettare</button></a></td>';
										} elseif ($row['partecipazione'] == 1) {
											echo '<td><a href="backend/rifiuta_riunioni.php?id=' . $row['id'] . '"><button type="button" class="btn mb-1 btn-danger">Disiscrivi</button></a></td>';
											echo "<td></td>";
										} elseif ((!isset($row['partecipazione']) || $row['partecipazione'] == 0)) {
											echo '<td><span class="label label-danger">Non Accettata</span></td>';
											echo '<td><button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Motivazione</button></td>';
											echo '<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);"><a class="dropdown-item" href="#">Link 1</a> <a class="dropdown-item" href="#">Link 2</a> <a class="dropdown-item" href="#">Link 3</a></div>';
										}
									} else {
										if (!$passed) {
											echo "<td></td>";
											echo '<td><a href="index.php?op=formModifica"><button type="button" class="btn btn-primary">Modifica</button></a></td>';
										} else {
											echo "<td></td>";
											echo "<td><button type='button' class='btn btn-primary' disabled>Modifica</button></td>";
										}
									}
                                    echo "</tr>";
                                }
								echo "</tbody>";
								
							} else {
								echo "<tr> <td colspan='2'> Nessuna riunione programmata per l'utente </td></tr>";
							}
                            
						?>
                        </table>
                    </div>
                </div>
                    <?php
                    if (isset($_SESSION['ruolo']) && $_SESSION['ruolo'] == 'direttore' || (isset($_SESSION['data_autorizzazione']))) {
						echo "<div class='card-footer'>";
							echo '<a href=index.php?op=creaRiunioni><button type="button" class="btn btn-primary">Crea Riunione</button></a>';
						echo "</div";
                    }
                    ?>
            </div>
        </div>
    </div>
</div>
