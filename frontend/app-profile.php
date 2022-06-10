<?php

if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: login.php');
}

$email = $_SESSION['email'];

$query = "SELECT * FROM utenti
		WHERE email= '$email'";

$result = $cid->query($query);
$row = $result->fetch_assoc();

?>

<!--**********************************
            Content body start
        ***********************************-->

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center mb-4">
                            <img class="mr-3" src="images/user.png" width="80" height="80" alt="">
                            <div class="media-body">
                                <h3 class="mb-0"><?php echo $_SESSION['nome'] . " " . $_SESSION['cognome']; ?></h3>
                            </div>
                        </div>
                        <ul class="card-profile__info">
                            <li class="mb-1"></li>
                            <li><strong class="text-dark mr-4">Email</strong> <span><?php echo $email; ?></span></li>
                            <li><strong class="text-dark mr-4">Data di nascita</strong></br><span><?php echo $row['data_nascita']; ?></span></li>
                            <li><strong class="text-dark mr-4">Nome</strong> <span><?php echo $row['nome']; ?></span></li>
                            <li><strong class="text-dark mr-4">Cognome</strong> <span><?php echo $row['cognome']; ?></span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Informazioni</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered verticle-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">Ruolo</th>
                                        <th scope="col">Data inizio</th>
                                        <th scope="col">Anni servizio</th>
                                        <th scope="col">Dipartimento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td><?php echo $row['ruolo']; ?></td>
                                    <td><?php echo $row['data_inizio']; ?></td>
                                    <td><?php echo $row['anni_servizio']; ?></td>
                                    <td><?php echo $row['dipartimento']; ?></td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Opzioni</h4>
                        <div class="table-responsive">
                        <a href='index.php?op=modifica-profilo'><button type='button' class='btn btn-primary'>Modifica</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--**********************************
            Content body end
        ***********************************-->


<!--**********************************
            Footer start
        ***********************************-->

<?php include "common/footer.php"; ?>

<!--**********************************
            Footer end
        ***********************************-->

</div>



</body>

</html>
