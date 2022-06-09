<?php

if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: frontend/login.php');
}

$email = $_SESSION['email'];

$sale = saleriunioni($cid);
$riunionidir = creaDirettore($cid);
$riunioniaut = creaAutorizzato($cid);
$autorizzati = autorizzati($cid);

?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Sale Riunioni</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Sala Riunioni</th>
                                        <th>Riunione</th>
                                        <th>Tema</th>
                                        <th>Data</th>
                                        <th>Ora Inizio</th>
                                        <th>Ora Fine</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($row = $sale->fetch_assoc()) {
                                        echo "<tr>
                                    <td>" . $row['salariunioni'] . "</td>
                                    <td>" . $row['id'] . "</td>
                                    <td>" . $row['tema'] . "</td>
                                    <td>" . $row['data_riunione'] . "</td>
                                    <td>" . $row['ora'] . "</td>
                                    <td>" . $row['durata'] . "</td>
                                    </tr>";
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sala Riunioni</th>
                                        <th>Riunione</th>
                                        <th>Tema</th>
                                        <th>Data</th>
                                        <th>Ora Inizio</th>
                                        <th>Ora Fine</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <tbody>
                                    <?php
                                    while ($row = $direttori->fetch_assoc()) {
                                        $numautorizzati = numAutorizzati($cid, $row['email']);

                                        echo "<tr>
                                            <td>" . $row['cognome'] . " " . $row['nome'] . "</td>
                                            <td>" . $numautorizzati . "</td>
                                        </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Utente Autorizzato</th>
                                        <th>Ruolo</th>
                                        <th>Dipartimento</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($row = $autorizzati->fetch_assoc()) {
                                        echo "<tr>
                                    <td>" . $row['email'] . "</td>
                                    <td>" . $row['ruolo'] . "</td>
                                    <td>" . $row['dipartimento'] . "</td>
                                    </tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Riunioni Create da Direttori</th>
                                        <th>Riunioni Create da Utenti Autorizzati</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td><?php echo $riunionidir ?></td>
                                    <td><?php echo $riunioniaut ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
