<?php
ob_start();
require_once "Users.php";

?>
<header>
    <div class="header">
        <nav>
            <div id="logo">{EcoRide}</div>
                <ul class="nav-link">
                    <li><a href="index.php">Accueil</a></li>
                    <?php if(!isset($_SESSION['id'])){
                    echo'<li><a href="inscription.php">Inscription</a></li>';
                    echo'<li><a href="connexion.php">Se connecter</a></li>';
                    
                    }else{
                    echo '<li><a href="reprofil.php">Changer le profil</a></li>';
                    echo '<li><a href="les_annonces.php">Les annonces</a></li>';
                    echo '<li><a href="les_profils.php">Les profils</a></li>';
                    echo '<li><button class="deconnect"><a href="deconnexion.php">OFF</a></button></li>';
                    } ?>
                    
                </ul>
        </nav>
    </div>
</header>
<body class="container">
