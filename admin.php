<?php
require_once "Admin.php";
require_once "db/Database.php";
require_once "include/head.php";
require_once "include/header.php";
//require "db/Database.php"; ?>


<?php
if(!in_array($_SESSION['role'], [1, 2])){
    header('Location: connexion.php');
    exit;
}
    //$bdd = new PDO("mysql:host=localhost;dbname=menbres;charset=utf8", "root", "");
    //session_start();
    if(isset($_SESSION['id'])){

    $admin = new Admin();
    $admin->getUserAdmin();

?>
    <div id="login">
        <h1 class="text-center text-white pt-5">Page admin de <?= $req_user['nom'] ?> </h1>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6" style="color:darkred">
                    <div id="login-box" class="col-md-12" style="background-color:burlywood;">

                <table style="margin: 15px; font-size: 1rem">
                    <tr>
                        <td>Nom d'utilisateur: </td><td><?=$_SESSION['nom'] ?></td>
                    </tr> 
                    <tr>
                        <td>Prenom d'utilisateur: </td><td><?=$_SESSION['prenom'] ?></td>
                    </tr>                      
                    <tr>
                        <td>Adresse email:  </td><td><?=$_SESSION['email'] ?></td>
                    </tr>
                    <tr>
                        <td>Role:  </td><td><?= $role ?></td>
                    </tr>
                    <tr>
                        <td><a href="profil.php">Modifier mon profil : </a>  </td>
                    </tr>

                </table>

                <a href="niveau_admin.php" style="margin:10px">Supprimer ou modifier le role d'un membres</a>
                </br>
                <a href="admin_article.php" style="margin: 10px;">Supprimer des articles</a>
                </br>

<?php

    }
?>


                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "include/footer.php";?>

                 