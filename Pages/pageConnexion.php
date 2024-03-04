<?php
    require("../ressources/api/connexion.php");
    session_start();
    // Accumulateur d'erreurs
    $erreurs = array();
    $messageErreur = "";

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {

        // Valider le nom d'utilisateur
        if(empty($_POST['nom'])) {
            $erreurs[] = "Le nom d'utilisateur entré est invalide!<br>";
        }

        // Valider le mot de passe
        if(empty($_POST['mdp'])) {
            $erreurs[] = "Le mot de passe entré est invalide!<br>";
        }

        // Si aucune erreur, etablir la connexion
        if (count($erreurs) == 0) {
            //  Etablir la connexion avec la base de donnée
            $conn = connexion("cocktailwizbd.mysql.database.azure.com","cocktail","Cw-yplmv");

            $nom = mysqli_real_escape_string($conn, trim($_POST['nom']));
            $mdp = mysqli_real_escape_string($conn, trim($_POST['mdp']));
            if($conn == null)
            die("Erreur");

            //  Rechercher le mot de passe dans la base de donnée
            $requete_preparee = $conn->prepare("SELECT mdp FROM utilisateur WHERE nom = ?");
            //  Lié le mot de passe (String) à l'identifiant
            $requete_preparee->bind_param("s", $nom);
            $requete_preparee->execute();
            $resultat = $requete_preparee->get_result();
            $util = $resultat->fetch_assoc();
            if($resultat->$nb_ranger>0 ){
            $mdp_encrypter = $util['mdp'];
            }
            $requete_preparee->close();

            if ($resultat->nb_ranger>0 && password_verify($mdp,$mdp_encrypter)) {
                $_SESSION['nom'] = $nom;
                //  Rediriger l'utilisateur vers la page de galerie
                header("Location: galerie.php");
            } else {
                $messageErreur = "Nom d'utilisateur ou mot de passe incorrect.";
            }
        }
        if(count($erreurs)>0){
            foreach ($erreurs as $erreur) {
                echo "<p style='color:red'>" . $erreur . "</p><br>";
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>

    <!-- Mettre dans les fichiers CSS appropriee -->
    <style>
        html{
            background-color: #232946;
        }
        #connexion{
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }
        #logoCW{
            border-radius: 50px 0px 0px 50px;
            width: 36.25rem;
            height: 36.25rem;
            margin-top: 5%;
        }
        #form-connexion{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 5%;
            background-color: #B8C1EC;
            border-radius: 0px 50px 50px 0px;
            width: 31.25rem;
            height: 36.25rem;
        }
        #form-connexion > h1{
        font-family: 'merriweather', 'serif';
        }
        #form-connexion > input{
            margin-top: 0.625rem;
            margin-bottom: 0.625rem;
            padding: 0.625rem;
            border: none;
            border-radius: 1.875rem;
            width: 18.75rem;
        }
        #form-connexion > button{
            margin-top: 0.625rem;
            padding: 0.9375rem;
            font-size: 1.25rem;
            background-color: #EEBBC3;
            color: black;
            border: none;
            border-radius: 1.875rem;
            width: 13.75rem;
            }
    </style>
</head>
<body>

<div id="connexion">
<!-- Mettre le chemin appropriee une fois que l'organisation des fichiers soient etabli -->
    <img src="../images/LogoCW.png" id="logoCW" alt="Logo Cocktail Wizard">
    <form id="form-connexion" action="post">
        <h1>COCKTAIL WIZARD</h1>
        <label for="nom">Nom d'utilisateur</label>
        <input type="text" name="nom" placeholder="Entrer votre nom d'utilisateur" required>
        <label for="mdp">Mot de Passe</label>
        <input type="password" name="mdp" placeholder="Entrer votre mot de passe" required>
        <button type="submit">Connexion</button>

        <p>Vous n'êtes pas encore membre?</p>
        <a href="./pageInscription.php">Créer un compte</a>
        <?php if (!empty($messageErreur)) { ?>
        <p style="color:red"><?php echo $messageErreur; ?></p>
        <?php } ?>
    </form>
</div>
</body>
</html>
