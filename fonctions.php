<?php

//fonction pour nettoyer et sécuriser un minimume le datas du formulaire
function check($data){
    $data = trim($data);
    $data = strip_tags($data);
    $data = stripcslashes($data);
    return $data;

}






?>