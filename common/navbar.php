<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Dashboard</li>
            <hr class="my-2">
            <li class="mega-menu mega-menu-sm">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-notebook menu-icon"></i><span class="nav-text">Riunioni</span>
                </a>
                <ul aria-expanded="false">
                    <li class="active"><a href="index.php?op=riunioni">Riunioni Programmate</a></li>
                    <li class="active"><a href="index.php?op=passate">Riunioni Passate</a></li>
                <?php
                if (isset($_SESSION['ruolo']) && $_SESSION['ruolo'] == 'direttore' || (isset($_SESSION['data_autorizzazione']))) {
                    echo "<li class=\"active\"><a href=\"index.php?op=creaRiunioni\">Crea Riunione</a></li>
                        <li class=\"active\"><a href=\"index.php?op=formModifica\">Modifica Riunione</a></li>
                        <li class=\"active\"><a href=\"index.php?op=eliminaRiunioni\">Elimina Riunioni</a></li>";
                }
                ?>
				</ul>
            </li>
            <?php
			if (isset($_SESSION['ruolo']) && $_SESSION['ruolo'] == 'direttore') {
				echo "<li><a href=\"index.php?op=registrazione\" aria-expanded=\"false\"><i class=\"icon-badge menu-icon\"></i><span class=\"nav-text\">Registrazioni</span></a></li>
                    <li><a href=\"index.php?op=autorizzazioni\" aria-expanded=\"false\"><i class=\"icon-badge menu-icon\"></i><span class=\"nav-text\">Autorizzazioni</span></a></li>";
			}
			?>
            <li>
                <a href="index.php?op=statistiche" aria-expanded="false">
                    <i class="icon-badge menu-icon"></i><span class="nav-text">Statistiche</span>
                </a>
            </li>
        </ul>
    </div>
</div>
