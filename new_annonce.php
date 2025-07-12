<?php
//ouvrir la session
session_start();
require_once "Users.php";

require_once "include/head.php";
require_once "include/header.php";
require_once "fonction/check.php";


if(isset($_POST['nouvelle_annonce'])){

    $departement = htmlspecialchars(check($_POST['departement']));
    $vehicule = htmlspecialchars(check($_POST['vehicule']));
    $place = htmlspecialchars(check($_POST['place']));
    $tarif = htmlspecialchars(check($_POST['tarif']));
    $description = htmlspecialchars(check($_POST['description']));

    if(empty($_POST['departement'])){
        $message = "Choisir un departement";
    }elseif(empty($_POST['vehicule'])){
        $message = "Choisir un vehicule";
    }elseif(empty($_POST['tarif']) || !ctype_digit($_POST['tarif'])){
        $message = "Choisir des chiffres";
    }elseif(empty($_POST['description'])){
        $message = "Ecrir une petite description";
    }else{

        $departement = $_POST['departement'];
        $vehicule = $_POST['vehicule'];
        $place = $_POST['place'];
        $tarif = $_POST['tarif'];
        $description = ['description'];

        $annonce = new Annonce();
        $result = $annonce->newAnnonce($departement,$vehicule,$place
                                ,$tarif,$description);

        if($result){
            header("location:index.php");
            exit();
        }else{
            $message = "Erreur lors du dépot de l'annonce";
        }


    }


}


?>
<div class="inscrip">

<h2 class="h2">Nouvelle annonce</h2>

<?php if(isset($message)) echo "<div class='erreurs'>".$message."</div>"; ?>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
    
    Votre département :<br> 
    <select name="departement" id="pet-select">
        <option  value="">--Choisir votre département--</option>
        <option name="departement" value="Ain">01:Ain</option>
        <option name="departement" value="Aisne">02:Aisne</option>
        <option name="departement" value="Aisne">03:Aisne</option>
        <option name="departement" value="Allier">04:Allier</option>
        <option name="departement" value="Alpes de Haute-Provence">05:Alpes de Haute-Provence</option>
        <option name="departement" value="Hautes-Alpes ">06:Hautes-Alpes </option>
        <option name="departement" value="Ardêche">07:Ardêche</option>
        <option name="departement" value="Ardennes">08:Ardennes</option>
        <option name="departement" value="Ariège">09:Ariège</option>
        <option name="departement" value="Aube">10:Aube</option>
        <option name="departement" value="Aude">11:Aude</option>
        <option name="departement" value="Aveyron">12:Aveyron</option>
        <option name="departement" value="Bouches-du-Rhône ">13:Bouches-du-Rhône </option>
        <option name="departement" value="Calvados">14:Calvados</option>
        <option name="departement" value="Cantal">15:Cantal</option>
        <option name="departement" value="Charente">16:Charente</option>
        <option name="departement" value="Charente-Maritime ">17:Charente-Maritime </option>
        <option name="departement" value="Cher">18:Cher</option>
        <option name="departement" value="Corrèze">19:Corrèze</option>
        <option name="departement" value="Corse-du-sud">2A:Corse-du-sud</option>
        <option name="departement" value="Haute-corse">2B:Haute-corse</option>
        <option name="departement" value="Côte-d'Or ">21:Côte-d'Or </option>
        <option name="departement" value="Côtes d'Armor ">22Côtes d'Armor </option>
        <option name="departement" value="Creuse">23:Creuse</option>
        <option name="departement" value="Dordogne">24:Dordogne</option>
        <option name="departement" value="Doubs">26:Doubs</option>
        <option name="departement" value="Drome">26:Drome</option>
        <option name="departement" value="Eure">27:Eure</option>
        <option name="departement" value="Eure-et-Loir ">28:Eure-et-Loir </option>
        <option name="departement" value="Finistère">29:Finistère</option>
        <option name="departement" value="Gard">30:Gard</option>
        <option name="departement" value="Haute-Garonne ">31:Haute-Garonne </option>
        <option name="departement" value="Gers">32:Gers</option>
        <option name="departement" value="Gironde">33:Gironde</option>
        <option name="departement" value="Hérault">34:Hérault</option>
        <option name="departement" value="Îlle-et-Vilaine ">35:Îlle-et-Vilaine </option>
        <option name="departement" value="Indre">36:Indre</option>
        <option name="departement" value="Indre-et-Loire ">37:Indre-et-Loire </option>
        <option name="departement" value="Isère">38:Isère</option>
        <option name="departement" value="Jura">39:Jura</option>
        <option name="departement" value="Landes">40:Landes</option>
        <option name="departement" value="Loir-et-cher">41:Loir-et-cher</option>
        <option name="departement" value="Loire">42:Loire</option>
        <option name="departement" value="Haute-Loire">43:Haute-Loire</option>
        <option name="departement" value="Loire-Atlantique ">44:Loire-Atlantique </option>
        <option name="departement" value="Loiret">45:Loiret</option>
        <option name="departement" value="Lot">46:Lot</option>
        <option name="departement" value="Lot-et-Garonne ">47:Lot-et-Garonne </option>
        <option name="departement" value="Lozère">48:Lozère</option>
        <option name="departement" value="Maine-et-Loire ">49:Maine-et-Loire </option>
        <option name="departement" value="Manche">50:Manche</option>
        <option name="departement" value="Marne">51:Marne</option>
        <option name="departement" value="Haute-Marne">52:Haute-Marne</option>
        <option name="departement" value="Mayenne">53:Mayenne</option>
        <option name="departement" value="Meurthe-et-Moselle ">54:Meurthe-et-Moselle </option>
        <option name="departement" value="Meuse">55:Meuse</option>
        <option name="departement" value="Morbihan">56:Morbihan</option>
        <option name="departement" value="Moselle">57:Moselle</option>
        <option name="departement" value="Nièvre">58:Nièvre</option>
        <option name="departement" value="Nord">59:Nord</option>
        <option name="departement" value="Oise">60:Oise</option>
        <option name="departement" value="Orne">61:Orne</option>
        <option name="departement" value="Pas-de-Calais ">62:Pas-de-Calais </option>
        <option name="departement" value="Puy-de-Dôme ">63:Puy-de-Dôme </option>
        <option name="departement" value="Pyrénées-Atlantiques ">64:Pyrénées-Atlantiques </option>
        <option name="departement" value="Hautes-Pyrénées ">65:Hautes-Pyrénées </option>
        <option name="departement" value="Pyrénées-Orientales ">66:Pyrénées-Orientales </option>
        <option name="departement" value="Bas-Rhin ">67:Bas-Rhin </option>
        <option name="departement" value="Haut-Rhin ">68:Haut-Rhin </option>
        <option name="departement" value="Rhône">69:Rhône</option>
        <option name="departement" value="Haute-Saône ">70:Haute-Saône </option>
        <option name="departement" value="Saône-et-Loire ">71:Saône-et-Loire </option>
        <option name="departement" value="Sarthe">72:Sarthe</option>
        <option name="departement" value="Savoie">73:Savoie</option>
        <option name="departement" value="Haute-Savoie ">74:Haute-Savoie </option>
        <option name="departement" value="Paris">75:Paris</option>
        <option name="departement" value="Seine-Maritime ">76:Seine-Maritime </option>
        <option name="departement" value="Seine-et-Marne ">77:Seine-et-Marne </option>
        <option name="departement" value="Yvelines">78:Yvelines</option>
        <option name="departement" value="Deux-Sèvres ">79:Deux-Sèvres </option>
        <option name="departement" value="Somme">80:Somme</option>
        <option name="departement" value="Tarn">81:Tarn</option>
        <option name="departement" value="Tarn-et-Garonne ">82:Tarn-et-Garonne </option>
        <option name="departement" value="Var">83:Var</option>
        <option name="departement" value="Vaucluse">84:Vaucluse</option>
        <option name="departement" value="Vendée">85:Vendée</option>
        <option name="departement" value="Vienne">86:Vienne</option>
        <option name="departement" value="Haute-Vienne">87:Haute-Vienne</option>
        <option name="departement" value="Vosges">88:Vosges</option>
        <option name="departement" value="Yonne">89:Yonne</option>
        <option name="departement" value="Territoire-de-Belfort ">90:Territoire-de-Belfort </option>
        <option name="departement" value="Essonne">91:Essonne</option>
        <option name="departement" value="Hauts-de-Seine ">92:Hauts-de-Seine </option>
        <option name="departement" value="Seine-Saint-Denis ">93:Seine-Saint-Denis </option>
        <option name="departement" value="Val-de-Marne ">94:Val-de-Marne </option>
        <option name="departement" value="Val-D'Oise">95:Val-D'Oise</option>           
    </select>
    <br>
    <br>
 <!--   Votre département : 
    <input type="text" name="departement" placeholder="votre département">
    <br>-->
    Quelle est votre véhicule : <br>
    <select name="vehicule" id="pet-select">
        <option  value="">--Quel est voter véhicule--</option>
        <option name="vehicule" value="Voiture">01:Voiture</option>
        <option name="vehicule" value="Moto">02:Moto</option>
        <option name="vehicule" value="SUV">03:SUV</option>
        <option name="vehicule" value="Camionette">04:Camionette</option>
        <option name="vehicule" value="Camion">05:Camion</option>
        <option name="vehicule" value="Camping-car">06:Camping-car</option>
        <option name="vehicule" value="Mini-Bus">07:Mini-Bus</option>
    </select>
    <br>
    Nombre de places : 
    <input type="int" name="place" placeholder="nombre de place">
    <br>
    Tarif participation :
    <input type="int" name="tarif" placeholder="paricipation">
    <br>
    Petite déscription :
    <br>
    <textarea name="description" cols="40px" rows="10px" placeholder="petite description"></textarea>       
    <br>
    
    Inscription : <input type="submit" name="nouvelle_annonce"
                   value="Créer une annonce" class="btn btn-primary" >
    <br>

</form>
</div>







<?php require_once "include/footer.php"; ?>