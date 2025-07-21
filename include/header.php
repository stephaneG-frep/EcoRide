<?php
ob_start();
require_once "Users.php";
//require_once "Admin.php";
?>


<header>   
        <nav>
                <ul class="nav-link">
                    <li><a href="index.php">Accueil</a></li>
                    <?php 
                    if(!isset($_SESSION['id'])){   
                    ?>                
                    <li><a href="inscription.php">Inscription</a></li>
                    <li><a href="connexion.php">Se connecter</a></li>
                     
                     <?php             
                    }else{
                    ?>
                    <li><a href="reprofil.php">Changer le profil</a></li>
                    <li><a href="les_annonces.php">Annonces</a></li>
                    <li><a href="les_profils.php">Profils</a></li>
                    <li><a href="les_commentaires.php">Commentaires</a></li>
                    <li><a href="recherche.php">Recherche</a></li>
                    <li><button class="deconnect"><a href="deconnexion.php">OFF</a></button></li>
                        
                <?php
                    }
                    ?>
                    
                </ul>
        </nav>
    </div>
</header>
<body class="container">
