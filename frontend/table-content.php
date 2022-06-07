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
							echo "<thead>
							<tr>
								<th>Tema</th>
								<th>Sala</th>
								<th>Data</th>
								<th>Inizio</th>
								<th>Fine</th>
							</tr>
							</thead>
								<tbody>
									<tr>
                                						<td>" . $row['tema'] . "</td>
                                    						<td>" . $row['salariunioni'] . "</td>
                                    						<td>" . $row['data_riunione'] . "</td>
                                    						<td>" . $row['ora'] . "</td>
										<td>" . $row['durata'] . "</td>
                            						</tr>
                        					</tbody>";
						} else {
							echo "<tr> <td colspan='2'> Nessuna riunione programmata per l'utente </td></tr>";
						}
					?>
                    </table>
                </div>
            </div>
        </div>
    </div>
