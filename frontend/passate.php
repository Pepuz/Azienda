<?php

if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: frontend/login.php');
}

$email = $_SESSION['email'];

$passate = passate($cid, $email);

$count = $passate->num_rows;

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
                        <h4>Riunioni Passate</h4>
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
                                     <th>Stato</th>
                                     <th></th>
                                     <th></th>
                                 </tr>
                                 </thead>
                                 <tbody>";

                                while ($row = $passate->fetch_assoc()) {
                                    $passed = date('Ymd') > date('Ymd', strtotime($row['data_riunione']));
                                    echo "<tr>
                                            <td>" . $row['tema'] . "</td>
                                            <td>" . $row['salariunioni'] . "</td>
                                            <td>" . $row['data_riunione'] . "</td>
                                            <td><span class='label label-pill label-danger'>Passata</span></td>";
                                    
                                    if ($row['organizzatore'] != $email) {
                                        if (!isset($row['partecipazione']) && $passed) {
                                            echo "<td><span class='label label-danger'>Non Accettata</span></td>
                                            <td></td>";
                                        } elseif ($row['partecipazione'] == 1) {
                                            echo "<td><span class='label label-success'>Accettata</span></td>";

                                            echo "<td>
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
                                        echo "<td></td>";
                                        echo "<td><button type='button' class='btn btn-primary' disabled>Riunione Organizzata dall'Utente</button></td>";
                                        
                                    }
                                    echo '</tr>';
                                }
                                echo '</tbody>';
                            } else {
                                echo "<tr> <td colspan='2'>Nessuna riunione passata per l'utente </td></tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
