<?php

require_once "include/head.php";
require_once "include/header.php"



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