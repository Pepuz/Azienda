<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Dashboard</li>
            <hr class="my-2">
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-notebook menu-icon"></i><span class="nav-text">Riunioni</span>
                </a>
                <ul aria-expanded="false">
                    <li class="active"><a class="active" href="index.php?op=riunioni">Lista Riunioni</a></li>
                </ul>
                <?php
                if $_SESSION['ruolo']=="direttore" || $_SESSION['autorizzato']!=NULL {
                    echo "<ul aria-expanded=\"false\"><li class=\"active\"><a class=\"active\" href=\"index.php?op=riunioni\">Crea Riunione</a></li></ul>";
                }
                ?>
            </li>
            <li>
                <a href="index.php" aria-expanded="false">
                    <i class="icon-envelope menu-icon"></i><span class="nav-text">Inviti</span>
                </a>
            </li>
            <?php
            if $_SESSION['ruolo']=="direttore" {
                echo "<li><a href=\"index.php\" aria-expanded=\"false\"><i class=\"icon-envelope menu-icon\"></i><span class=\"nav-text\">Autorizza</span></a></li>";
            }
            ?>
            <li>
                <a href="index.php" aria-expanded="false">
                    <i class="icon-badge menu-icon"></i><span class="nav-text">Sale Riunioni</span>
                </a>
            </li>
        </ul>
    </div>
</div>
