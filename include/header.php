<?php


?>
<header>
    <div class="header">
        <nav>
            <div id="logo">{EcoRide}</div>
                <ul class="nav-link">
                    <li><a href="index.php">Accueil</a></li>
                    <?php if(!isset($_SESSION['id_user'])){
                    echo'<li><a href="inscription.php">Inscription</a></li>';
                    echo'<li><a href="connexion.php">Se connecter</a></li>';
                    }else{
                    echo '<li><a href="reprofil.php">Changer le profil</a></li>';
                    echo '<li><a href="parcours.php">Parcours</a></li>';
                    echo '<li><a href="deconnexion.php">A-propos</a></li>';
                    } ?>
                    <li><a href="apropos.php">A-propos</a></li>
                </ul>
        </nav>
    </div>
</header>
<body class="container">
    <?php session_start(); ?>