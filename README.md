Le site ecoride est crée en php, il y a du css et un peux de js et aussi du html

Partir d'une base de donnée mysql :
La BDD se nomme ecoride elle a une table users (id,nom,prenom,email,password,photo_profil)
                               une table avis (id_avis,commentaire,etoile,et une clé étrangère id en relation avec users)
                               une table annonce (id_annonce,departement,depart,arrive,vehicule,place,tarif descriptionet et une clé étangère id en relation avec users)

pour le php faire des classes pour :
1: la database: creation de la class pour la connection a la BDD
création d'attribut static et private pour limiter l'utilisation
Des commentaire sont disponible avec le code
2: Users création de la class pour des méthode de requetes SQL et de connection 
3: Avis pareil que users et annonce aussi

mise en place des différante pages et dossiers pour une meilleure fluiditée

un service administration est en place aussi pour supprimer les utilisateurs et ou annonces et ou commentaires

un envoie d'email pour une réinitialisation du password aurait été possible mais avec phpmailer c'est asser long et cela ne fonction pas toujours

                            