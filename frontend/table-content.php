    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h4>Prossima Riunione</h4>
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
							echo "<tr>";
                                echo "<td>" . $row['tema'] . "</td>"
                                    . "<td>" . $row['salariunioni'] . "</td>"
                                    . "<td>" . $row['data_riunione'] . "</td>"
                                    . "<td>" . $row['ora'] . "</td>"
									. "<td>" . $row['durata'] . "</td>";
                            echo "</tr>";
                        echo "</tbody>";
						} else {
							echo "<tr> <td colspan='2'> Nessuna riunione programmata per l'utente </td></tr>";
						}
					?>
                    </table>
                </div>
            </div>
        </div>
    </div>
