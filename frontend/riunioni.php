<?php

if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: frontend/login.php');
}

$email = $_SESSION['email'];

$result = Meetings($cid,$email);


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
                            <thead>
                                <tr>
                                    <th>Tema</th>
                                    <th>Sala</th>
                                    <th>Data</th>
                                    <th>Orario</th>
                                    <th>Stato</th>
                                    <th>Annulla Iscrizione</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) {
				   
                                    echo "<tr>";
                                    echo "<td>" . $row['tema'] . "</td>";
                                    echo "<td>" . $row['Salariunioni'] . "</td>";
                                    echo "<td>" . $row['Data'] . "</td>";
                                    echo "<td>" . $row['Ora'] . "</td>";
                                    echo "<td><span class=\"label label-pill label-success\">Programmata</span></td>";
                                    echo "<td><button type=\"button\" class=\"btn mb-1 btn-danger\">Disiscrivi</button></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
		if (isset($_SESSION['ruolo']) && $_SESSION['ruolo'] == 'direttore') || $_SESSION['autorizzato']!=NULL {
			echo "<div class='card-footer'><button type='button' class='btn btn-primary'>Crea Riunione</button></div>";		
                }
                ?>
            </div>
        </div>
    </div>
</div>
