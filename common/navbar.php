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
                    <li class="active"><a href="index.php?op=riunioni">Lista Riunioni</a></li>
                
                <?php
                if (isset($_SESSION['ruolo']) && $_SESSION['ruolo'] == 'direttore' || (isset($_SESSION['data_autorizzazione']))) {
                    echo "<li class=\"active\"><a href=\"index.php?op=creaRiunioni\">Crea Riunione</a></li>";
                }
                ?>
				<?php
                if (isset($_SESSION['ruolo']) && $_SESSION['ruolo'] == 'direttore' || (isset($_SESSION['data_autorizzazione']))) {
                    echo "<li class=\"active\"><a href=\"index.php?op=modificaRiunioni\">Modifica Riunioni</a></li>";
                }
                ?>
				</ul>
            </li>
            <li>
                <a href="index.php?op=inviti" aria-expanded="false">
                    <i class="icon-envelope menu-icon"></i><span class="nav-text">Inviti</span>
                </a>
            </li>
            <?php
			if (isset($_SESSION['ruolo']) && $_SESSION['ruolo'] == 'direttore') {
				echo "<li><a href=\"index.php?op=autorizzazioni\" aria-expanded=\"false\"><i class=\"icon-badge menu-icon\"></i><span class=\"nav-text\">Autorizzazioni</span></a></li>";
			}
			?>
            <li>
                <a href="index.php?op=saleRiunioni" aria-expanded="false">
                    <i class="icon-badge menu-icon"></i><span class="nav-text">Sale Riunioni</span>
                </a>
            </li>
        </ul>
    </div>
</div>
