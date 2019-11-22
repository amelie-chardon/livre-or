<!DOCTYPE html>

<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Accueil</title> <!-- Page d'accueil -->
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
<main class="accueil">
<h1 class="titre_accueil">Bienvenue sur le livre d'or du mariage d' Alice et Antoine</h1>
<p>Veuillez vous <a href="inscription.php">inscrire</a> ou vous <a href="connexion.php">connecter</a> afin de laisser votre message.</p>
</main>
</body>

</html>

<?php

unset($_SESSION);

?>

