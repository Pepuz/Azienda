<?php

if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: frontend/login.php');
}

$email = $_SESSION['email'];

$query = "SELECT partecipazione, tema, data_riunione, ora, salariunioni, id FROM partecipa JOIN riunioni 
		WHERE riunione=id AND partecipante='$email' ORDER BY data_riunione, ora";

$result = $cid->query($query);

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
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    $passed = date('Ymd') > date('Ymd', strtotime($row['data_riunione']));
                                    echo "<tr>";
                                    echo "<td>" . $row['tema'] . "</td>";
                                    echo "<td>" . $row['salariunioni'] . "</td>";
                                    echo "<td>" . $row['data_riunione'] . "</td>";
                                    echo "<td>" . $row['ora'] . "</td>";
                                    if ($passed) {
                                        echo "<td><span class=\"label label-pill label-danger\">Passata</span></td>";
                                    } else {
                                        echo "<td><span class=\"label label-pill label-success\">Programmata</span></td>";
                                    }

                                    // if ($row['partecipazione'] == 0) {
                                    //     echo '<td><span class="label label-danger">Non Accettata</span></td>';
                                    // } else
                                    if (!isset($row['partecipazione']) && !$passed) {
                                        echo '<td><button type="button" class="btn mb-1 btn-info"><a href="backend/accetta_riunioni.php?id=' . $row['id'] . '">Accetta Invito</a></button></td>';
                                        echo '<td><button type="button" class="btn mb-1 btn-danger"><a href="backend/rifiuta_riunioni.php?id=' . $row['id'] . '">Non Accettare</a></button></td>';
                                    } elseif ($row['partecipazione'] == 1) {
                                        echo '<td><button type="button" class="btn mb-1 btn-danger"><a href="backend/rifiuta_riunioni.php?id=' . $row['id'] . '">Disiscrivi</a></button></td>';
                                    } elseif ((!isset($row['partecipazione']) || $row['partecipazione'] == 0)) {
                                        echo '<td><span class="label label-danger">Non Accettata</span></td>';
                                    }
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <?php
                    if (isset($_SESSION['ruolo']) && $_SESSION['ruolo'] == 'direttore') {
                        echo '<button type="button" class="btn btn-primary">Crea Riunione</button>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>