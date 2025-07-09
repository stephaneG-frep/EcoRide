<?php

require_once "include/head.php";
require_once "include/header.php";

if(isset($_POST['connexion'])){
    //récuperer les données du formulaire dans des variables
    $email = $_POST['email'];
    $password = $_POST['password'];
    //instancier la class user
    $user = new Users();
    //appel a la méthode login(class Users)
    $userId = $user->login($email,$password);
    if($userId){
        $_SESSION['id_user'] = $userId;
        header('location: index.php');
        exit();
    }else{
        $message = "Email ou mot-de-passe invalide";
    }
}

?>
<div class="inscrip">
    <h2 class="h2">Connexion</h2>
    <?php if(isset($message)) echo "<div class='erreurs'>".$message."</div>"; ?>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            Email :
            <input type="email" name="email" >
            <br>
            Mot de passe :
            <input type="password" name="password">
            <br>
            Connexion :
            <input type="submit" name="connexion" value="connexion">
        </form>
</div>



<?php require_once "include/footer.php";  ?>