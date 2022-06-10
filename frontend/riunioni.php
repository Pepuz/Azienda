<?php

if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: frontend/login.php');
}

$email = $_SESSION['email'];

$riunioni = riunioni($cid, $email);

$count = $riunioni->num_rows;

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
                        <h4>Riunioni Programmate</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <?php
                            if ($count > 0) {
                                echo "<thead>
                                 <tr>
                                     <th>Tema</th>
                                     <th>Sala</th>
                                     <th>Data</th>
                                     <th>Inizio</th>
                                     <th>Fine</th>
                                     <th>Stato</th>
                                     <th></th>
                                     <th></th>
                                 </tr>
                                 </thead>
                                 <tbody>";

                                while ($row = $riunioni->fetch_assoc()) {
                                    echo "<tr>
                                            <td>" . $row['tema'] . "</td>
                                            <td>" . $row['salariunioni'] . "</td>
                                            <td>" . $row['data_riunione'] . "</td>
                                            <td>" . $row['ora'] . "</td>
                                            <td>" . $row['durata'] . "</td>
                                            <td><span class='label label-pill label-success'>Programmata</span></td>";

                                    if ($row['organizzatore'] != $email) {
                                        if (!isset($row['partecipazione'])) {
                                            echo '<td><a href="backend/accetta_riunioni.php?id=' . $row['id'] . '"><button type="button" class="btn mb-1 btn-info">Accetta Invito</button></a></td>';

                                            echo "<td>    
                                                    <button type='button' class='btn mb-1 btn-danger' data-toggle='modal' data-target='#exampleModalCenter'>Non Accettare</button>
                                                    <div class='modal fade' id='exampleModalCenter' style='display: none;' aria-hidden='true'>
                                                    <div class='modal-dialog modal-dialog-centered' role='document'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <h5 class='modal-title'>Inserire motivazione</h5>
                                                                <button type='button' class='close' data-dismiss='modal'><span>x</span></button>
                                                            </div>
                                                            <div class='modal-body'>
                                                                <div class='basic-dropdown'>
                                                                    <div class='dropdown'> 
                                                                        <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                                                            Motivazione
                                                                        </button>
                                                                        <div class='dropdown-menu' x-placement='bottom-start' style='position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);'>
                                                                            <a class='dropdown-item' href='backend/rifiuta_riunioni.php?id=" . $row['id'] . "&motivazione=salute'>Salute</a>
                                                                            <a class='dropdown-item' href='backend/rifiuta_riunioni.php?id=" . $row['id'] . "&motivazione=indisposizione'>Indisposizione</a>
                                                                            <a class='dropdown-item' href='backend/rifiuta_riunioni.php?id=" . $row['id'] . "&motivazione=familiari'>Familiari</a>
                                                                            <a class='dropdown-item' href='backend/rifiuta_riunioni.php?id=" . $row['id'] . "&motivazione=altro'>Altro...</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </td>";
                                        } elseif ($row['partecipazione'] == 1) {
                                            echo "<td><span class='label label-success'>Accettata</span></td>";

                                            echo "<td>    
                                                    <button type='button' class='btn mb-1 btn-danger' data-toggle='modal' data-target='#exampleModalCenter'>Disiscrivi</button>
                                                    <div class='modal fade' id='exampleModalCenter' style='display: none;' aria-hidden='true'>
                                                    <div class='modal-dialog modal-dialog-centered' role='document'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <h5 class='modal-title'>Inserire motivazione</h5>
                                                                <button type='button' class='close' data-dismiss='modal'><span>x</span></button>
                                                            </div>
                                                            <div class='modal-body'>
                                                                <div class='basic-dropdown'>
                                                                    <div class='dropdown'> 
                                                                        <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                                                            Motivazione
                                                                        </button>
                                                                        <div class='dropdown-menu' x-placement='bottom-start' style='position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);'>
                                                                            <a class='dropdown-item' href='backend/rifiuta_riunioni.php?id=" . $row['id'] . "&motivazione=salute'>Salute</a>
                                                                            <a class='dropdown-item' href='backend/rifiuta_riunioni.php?id=" . $row['id'] . "&motivazione=indisposizione'>Indisposizione</a>
                                                                            <a class='dropdown-item' href='backend/rifiuta_riunioni.php?id=" . $row['id'] . "&motivazione=familiari'>Familiari</a>
                                                                            <a class='dropdown-item' href='backend/rifiuta_riunioni.php?id=" . $row['id'] . "&motivazione=altro'>Altro...</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </td>";
                                        } elseif ($row['partecipazione'] == 0) {
                                            echo "<td><span class='label label-danger'>Non Accettata</span></td>
                                                    <td>
                                                    <div class='basic-dropdown'>
                                                        <div class='dropdown'>
                                                            <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                                                Motivazione
                                                            </button>
                                                            <div class='dropdown-menu' x-placement='bottom-start' style='position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);'>
                                                                <a class='dropdown-item' href='#'>" . $row['motivazione'] . "</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </td>";
                                        }
                                    } else {
                                    
                                            echo "<td><a href='index.php?op=eliminaRiunioni'><button type='button' class='btn mb-1 btn-danger'>Elimina</button></a></td>
                                            <td><a href='index.php?op=formModifica'><button type='button' class='btn btn-primary'>Modifica</button></a></td>";
                                        
                                    }
                                    echo '</tr>';
                                }
                                echo '</tbody>';
                            } else {
                                echo "<tr> <td colspan='2'>Nessuna riunione programmata per l'utente </td></tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>

                <?php
                if (isset($_SESSION['ruolo']) && $_SESSION['ruolo'] == 'direttore') {
                    echo '<div class="card-footer">';
                    echo '<button type="button" class="btn btn-primary">Crea Riunione</button>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
