<?php
ob_start();
require_once "Users.php";
require_once "Admin.php";

?>
<header>
    <div class="header">
        <nav>
            <div id="logo">{EcoRide}</div>
                <ul class="nav-link">
                    <li><a href="index.php">Accueil</a></li>
                    <?php 
                    if(!isset($_SESSION['id'])){   
                    ?>                
                    <li><a href="inscription.php">Inscription</a></li>
                    <li><a href="connexion.php">Se connecter</a></li>
                     
                           <?php
                           if(in_array($_SESSION['id'],["admin"])){
                            ?>
                            <li><button class="admin_connect"><a href="admin.php">admin</a></button></li>
                            <?php
                           }
                           ?>
                     <?php               
                    }else{
                    ?>
                    <li><a href="reprofil.php">Changer le profil</a></li>
                    <li><a href="les_annonces.php">Les annonces</a></li>
                    <li><a href="les_profils.php">Les profils</a></li>
                    <li><a href="les_commentaires.php">Les commentaires</a></li>
                    <li><button class="deconnect"><a href="deconnexion.php">OFF</a></button></li>
                    <li><a href="les_admin.php">les admin</a></li>
                    <!--<li><button class="admin_connect"><a href="admin.php">admin</a></button></li>-->
                        
                <?php
                    }
                    ?>
                    
                </ul>
        </nav>
    </div>
</header>
<body class="container">
