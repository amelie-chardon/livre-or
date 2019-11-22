<?php

//Démarrage de la session
session_start();

//Création de la connexion à a base de données
$connexion=mysqli_connect("localhost","root","","livreor");

//Préparation de la requête SQL
$requete="SELECT * FROM commentaires INNER JOIN utilisateurs ON utilisateurs.id=commentaires.id_utilisateur ORDER BY commentaires.id DESC";

//Execution de la requête SQL
$query=mysqli_query($connexion,$requete);

?>

<!DOCTYPE html>

<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Accueil</title> <!-- Page livre d'or -->
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
<main class="livre-or">
<h1>Livre d'or</h1>
<section class="livre">
    <?php

while ($message = (mysqli_fetch_assoc($query)))
{
    $date = implode('/', array_reverse(explode('-', $message["date"]))); //Permet de transformer la date du format "année-mois-jour" au format "jour/mois/année"
    echo "<p class=\"titre_commentaire\">Posté le ".$date." par ".$message["login"]."</p>";
    echo "<p class=\"texte_commentaire\">".$message["commentaire"]."</p> ";
}

    ?>
</section>

<?php
if($_SESSION==NULL)
{
    echo "<p>Veuillez vous <a href=\"inscription.php\">inscrire</a> ou vous <a href=\"connexion.php\">connecter</a> afin de laisser votre message.</p>";
}
else
{
    include "commentaire.php";
}

?>

</main>
</body>

</html>


