<?php

error_reporting(-1);
ini_set("display_errors", 1);

//require_once "session/SessionManager.php";
require_once "Users.php";
require_once "Admin.php";
require_once "db/config.php";
require_once "include/head.php";
require_once "include/header.php";

if($_SESSION['id']){
    $id = $_SESSION['id'];
   
    //$id_annonce = $_SESSION['id_annonce'];
    $new_user = new Users();
    $user = $new_user->getUserById($id);

    $admin = new Admin();
    $admins = $admin->getAdminByIdUsers($id);

   
    //$id = $id['id'];
    $nom = $user['nom'];
    $prenom = $user['prenom'];
    $email = $user['email'];
    $image = $user['photo_profil']; 
    $admin = array(
        $role = "utilisateur",
        $role = "admin",
        $role = "moderateur",
    );
    switch($admin['role']){
        case 'utilisateur':
            $role = 'utilisateur';
    break;
        case 'admin':
            $role = 'admin';
    break;
        case 'moderateur':
            $role = 'moderateur';
    break;
       
    }

    ?>
    <title>Profil de <?= $user['nom'] ?></title>

    </div>

        <div id="login">
            <h1 class="">Page admin de <?= $user['nom'] ?> </h1>
            <div class="container">
               
                <div id="" class="">
                    <div id="" class="">
                        <div id="" class="">

                    <table style="margin: 15px; font-size: 1rem">
                        <tr>
                            <td>Nom d'utilisateur: </td><td><?=$user['nom'] ?></td>
                        </tr>                    
                        <tr>
                            <td>Adresse email:  </td><td><?=$user['email'] ?></td>
                        </tr>
                        <tr>
                            <td>Role:  </td><td><?= $admin['role'] ?></td>
                        </tr>
                        <tr>
                            <td><a href="reprofil.php">Modifier mon profil : </a>  </td>
                        </tr>

                    </table>

                    <a href="niveau_admin.php" style="margin:10px">Supprimer ou modifier le role d'un membres</a>
                    </br>
                    <a href="les_annonces.php" style="margin: 10px;">Supprimer des annonces</a>
                    </br>

<?php
}   
?>
                </div>
            </div>
        </div>
    </div>
</div>



<?php require_once "include/footer.php";  ?>