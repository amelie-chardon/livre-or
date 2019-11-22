<!DOCTYPE html>

<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Profil</title> <!-- Page pour accéder à son profil -->
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
<main class="profil">
<h1>Mon profil</h1>


<?php
//Démarrage de la session
session_start();

//On récupère l'identifiant de l'utilisateur connecté
foreach($_SESSION as $cle=>$valeur) 
{ 
    $id=$cle; 
}


//On vérifie que l'utilisateur est bien connecté
if ($_SESSION["$id"]==true)
{
    //Création de la connexion à a base de données
    $connexion=mysqli_connect("localhost","root","","livreor");



    //Préparation de la requête SQL
    $requete="SELECT * FROM utilisateurs WHERE login=\"$id\"" ;

    //Execution de la requête SQL
    $query=mysqli_query($connexion,$requete);

    //Récupération du résultat de la requête
    $resultat=mysqli_fetch_all($query);

    // Récupération des informations de l'utilisateur sur la bdd
    $login_bdd=$resultat[0][1];
    $password_bdd=$resultat[0][2];

    ?>

    <section class="modif_profil">
    <section class="modif_identifiant">
    <h2>Modifier mon identifiant</h2>
    <form class="formulaire" method="post" action="profil.php">
    <label for="identifiant_modif">Nouvel identifiant :</label>
    <input type="text" name="identifiant_modif" id="identifiant_modif" required>
    <label for="password">Confirmation du mot de passe :</label>
    <input type="password" name="password" id="password" minlength="5" required>
    <input type="submit" name="modif_login" id="submit" value="Envoyer">
    </form>

    <?php

    //On vérifie que le formulaire a été envoyé
    if(isset($_POST["modif_login"]))
    {
        //On récupère les données du formulaire
        $password=$_POST["password"];
        $login_modif=$_POST["identifiant_modif"];

        //On vérifie que le nouvel identifiant est différent de l'ancien
        if($login_modif==$login_bdd)
        {
            echo "<p>L'identifiant choisi est le même que le précédent. Veuillez en choisir un autre.</p>";
        }
        else
        {
            //On vérifie si l'identifiant existe déjà dans la bdd
            $i=0 ; //initilisation du compteur
            foreach($resultat as $user)
                {
                if($login_modif==$user[1]) //si l'identifiant choisi existe déjà dans la bdd 
                    {
                    $i++; //on ajoute 1 au compteur
                    }
                }
            if($i!=0) //si le compteur est différent de 0 : l'identifiant est déjà pris
            {
                echo "<p>L'identifiant choisi existe déjà. Veuillez en choisir un autre.</p>";
            }
            else if(password_verify($password, $password_bdd)==false) //si le mdp du formulaire correspond à celui de la bdd : l'utilisateur est connecté

            //else if($password_bdd!=$password) //Si l'ancien mot de passe ne correspond pas à celui de la bdd
            {
                echo "<p>Ancien mot de passe incorrect.</p>";
                var_dump($_SESSION);
            }
            else //On modifie les informations de l'utilisateur dans la bdd
            {
            //Préparation de la requête SQL pour màj les données dans la bdd
            $update="UPDATE utilisateurs SET login = \"$login_modif\" WHERE utilisateurs.login = \"$id\" ";

            //On supprime la variable de session avec l'ancien identifiant
            unset($_SESSION["$id"]);
            $_SESSION["$login_modif"]=true;
            $id=$login_modif;
            var_dump($_SESSION);

            //Execution de la requête SQL pour màj les données dans la bdd
            $query_update=mysqli_query($connexion,$update);
            $requete="SELECT * FROM utilisateurs WHERE login=\"$login_modif\" " ;
            $query=mysqli_query($connexion,$requete);

            //Récupération du résultat de la requête
            $resultat=mysqli_fetch_all($query);
            $login_bdd=$login_modif;
            echo "<p>Votre identifiant a bien été modifié.</p>";

            unset($_POST);
            }
        }
    }
    ?>

    </section>

    <section class="modif_mdp">
    <h2>Modifier mon mot de passe</h2>
    <form class="formulaire" method="post" action="profil.php">
    <label for="password">Ancien mot de passe (au moins 5 car.):</label>
    <input type="password" name="password" id="password" minlength="5" required>
    <label for="password_modif">Nouveau mot de passe (au moins 5 car.):</label>
    <input type="password" name="password_modif" id="password_modif" minlength="5">
    <input type="submit" name="modif_pwd" id="submit" value="Envoyer">
    </form>

    
    <?php
    

    //On vérifie que le formulaire a été envoyé
    if(isset($_POST["modif_pwd"]))
    { 
        //On récupère les données du formulaire
        $password=$_POST["password"];
        $password_modif=$_POST["password_modif"];

        if(password_verify($password,$password_bdd)==false)
        //if($password_bdd!=$password) //Si l'ancien mot de passe ne correspond pas à celui de la bdd
        {
            echo "<p>Ancien mot de passe incorrect.</p>";
        }
        else if(password_verify($password_modif,$password_bdd))
        //else if($password_bdd==$password_modif) //Si le nouveau mdp est identique à l'ancien
        {
            echo "<p>Le nouveau mot de passe est identique à l'ancien mot de passe. Veuillez en saisir un autre.</p>";
        }
        else //On modifie les informations de l'utilisateur dans la bdd
        {
            //Préparation de la requête SQL pour màj les données dans la bdd
            $password_modif_hach=password_hash($password_modif, PASSWORD_BCRYPT);
            $update="UPDATE utilisateurs SET password = '$password_modif_hach' WHERE utilisateurs.login = '$id' ";

            //Execution de la requête SQL pour màj les données dans la bdd
            $query_update=mysqli_query($connexion,$update);

            //Préparation de la requête SQL
            $requete="SELECT * FROM utilisateurs WHERE login=\"$id\"" ;

            //Execution de la requête SQL
            $query=mysqli_query($connexion,$requete);

            //Récupération du résultat de la requête
            $resultat=mysqli_fetch_all($query);
            $password=$password_modif;
            echo "<p>Votre mot de passe a bien été modifié.</p>";
            unset($_POST);
        }
    }
    ?>
    </section>
    </section>

    <h2>Me déconnecter / me désinscrire</h2> 
    <form class="formulaire" method="post">
    <input type="submit" name="deconnexion" id="submit" value="Déconnexion">
    <input type="submit" name="desinscription" id="submit" value="Désinscription">
    </form>

    <?php

    //On vérifie que le formulaire a été envoyé
    if(isset($_POST["deconnexion"]))
    {
        //On supprime la variable de session
        unset($_SESSION["$id"]);

        //On renvoit l'utilisateur vers la page d'accueil
        header("Location: index.php");
        exit(); 
    }

    if(isset($_POST["desinscription"]))
    {
        //On supprime les informations de l'utilisateur dans la bdd
        //Préparation de la requête SQL pour màj les données dans la bdd
        $desinscription="DELETE FROM utilisateurs WHERE utilisateurs.login = \"$id\" ";

        //Execution de la requête SQL pour màj les données dans la bdd
        $query_desinsc=mysqli_query($connexion,$desinscription);

        //On supprime la variable de session
        unset($_SESSION["$id"]);

        //On renvoit l'utilisateur vers la page d'accueil
        header("Location: index.php"); 
        exit();
    }
}

else
{
    header("Location: index.php"); //l'utilisateur est redirigé vers la page d'accueil s'il n'est pas connecté
    exit();
}

//Fermeture de la connexion
mysqli_close($connexion);

?>

</main>
</body>

</html>