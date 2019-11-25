
<?php

//Démarrage de la session
session_start();

//Création de la connexion à a base de données
$connexion=mysqli_connect("localhost","root","","livreor");

//Préparation de la requête SQL
$requete="SELECT * FROM utilisateurs" ;

//Execution de la requête SQL
$query=mysqli_query($connexion,$requete);

//Récupération du résultat de la requête
$resultat=mysqli_fetch_all($query);

//On vérifie si le formulaire a déjà été envoyé
if(!isset($_POST["submit"]))
{
}
else //if(isset($_POST["id"]))
{
    //Récupération des données du formulaire d'inscription
    $login=$_POST["login"];
    $password=$_POST["password"];
    $password_confirm=$_POST["password_confirm"];

    //On vérifie si l'identifiant existe déjà dans la bdd
    $i=0 ; //initilisation du compteur
    foreach($resultat as $user)
    {
        if($id==$user[1]) //si l'identifiant existe déjà dans la bdd
        {
            $i++; //on ajoute 1 au compteur
        }
    }
    if($i!=0) //si le compteur est différent de 0 : l'identifiant est déjà pris
    {
        ?><p>L'identifiant choisi existe déjà. Veuillez en choisir un autre.</p><?php
    }

    //On vérifie si le mdp et la confirmation sont identiques
    else if($password!=$password_confirm)
    {
        ?><p>Les deux mots de passe sont différents.</p><?php
    }
    //Si les deux conditions précédents sont fausses, 
    //on peut ajouter les données du formulaire dans la bdd
    else
    {
        $password_hach=password_hash($password, PASSWORD_BCRYPT);
        $requete_inscr="INSERT INTO utilisateurs (id,login,password) VALUES (NULL,\"$login\",\"$password_hach\");";
        //Execution de la requête SQL
        $query_inscr=mysqli_query($connexion,$requete_inscr);
        header("Location: connexion.php");
        exit();
    }
}

//Fermeture de la connexion
mysqli_close($connexion);

?>

<!DOCTYPE html>

<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>S'inscrire</title> <!-- Page pour s'inscrire au site -->
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Parisienne&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="connexion.php">Se connecter</a></li>
            <li><a href="inscription.php">S'inscrire</a></li>
            <li><a href="profil.php">Mon profil</a></li>
            <li><a href="livre-or.php">Livre d'or</a></li>
        </ul>
	</nav>
</header>
<main class="inscription">
<section class="section_gauche">
</section>
<section class="section_droite">
<h1>S'inscrire</h1>
<p>(Les champs suivis d'une * sont obligatoires)</p>
        <form class="formulaire" method="post">
        <label for="login">Identifiant* :</label>
        <input type="text" name="login" id="login" required>
        <label for="password">Mot de passe* (au moins 5 car.):</label>
        <input type="password" name="password" id="password" minlength="5" required>
        <label for="password_confirm">Confirmation du mot de passe* :</label>
        <input type="password" name="password_confirm" id="password_confirm" minlength="5" required>
        <input type="submit" name="submit" id="submit" value="Envoyer">
        </form>
</section>
</main>
</body>

</html>

