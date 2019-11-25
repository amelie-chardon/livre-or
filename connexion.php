<!DOCTYPE html>

<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Se connecter</title> <!-- Page pour se connecter au site -->
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
<main class="connexion">
<section class="section_gauche">
</section>
<section class="section_droite">
<h1>Se connecter</h1>
<p>(Les champs suivis d'une * sont obligatoires)</p>
        <form class="formulaire" method="post">
        <label for="login">Identifiant* :</label>
        <input type="text" name="login" id="login" required>
        <label for="password">Mot de passe* :</label>
        <input type="password" name="password" id="password" minlength="5" required>
        <input type="submit" name="submit" id="submit" value="Envoyer">
        </form>

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

//Fermeture de la connexion
mysqli_close($connexion);



//On vérifie si le formulaire a déjà été envoyé
if(!isset($_POST["submit"]))
{
}
else
{
    //Récupération des données du formulaire de connexion
    $login=$_POST["login"];
    $password=$_POST["password"];

    //On vérifie si l'utilisateur existe dans la bdd
    $i=0 ; //initilisation du compteur
    foreach($resultat as $user)
    {
        if($login==$user[1]) //si l'identifiant existe déjà dans la bdd
        {
            $i++; //on ajoute 1 au compteur
            $password_verif=$user[2]; //on créé une variable contenant le mdp correspondant à l'identifiant
        }
    }
    if($i==1) //si le compteur est égal à 1 : le compte a déjà été créé
    {
        if(password_verify($password, $password_verif)) //si le mdp du formulaire correspond à celui de la bdd : l'utilisateur est connecté
        {
            $_SESSION["$login"]=true; //On crée une session pour l'utilisateur
            header("Location: profil.php"); //On dirige l'utilisateur vers sa page de profil
            exit();
        }
        else //le mdp est incorrect
        {
            ?><p>Le mot de passe est incorrect.</p><?php
        }
    }
    else //l'identifiant n'existe pas dans la bdd
    {
        ?><p>Cet identifiant n'existe pas. Veuillez vous <a href="inscription.php">inscrire</a>.</p><?php
    }
}

?>

</section>

</main>
</body>
</html>
