<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon bar</title>
    <link rel="stylesheet" href="../ressources/styles/main.css">
    <link rel="stylesheet" href="../ressources/styles/monbar.css">
    <link rel="stylesheet" href="../ressources/styles/carte_cocktail.css">
    <link rel="stylesheet" href="../ressources/styles/publication.css">
</head>

<body>
    <noscript class="erreur">Vous devez activer JavaScript pour charger ce site web.</noscript>

    <header id="top">
        <div class="user">
            <span id="backgroundshape"></span>
            <div class="profile-pic-container">
                <img class="profile-pic" src="../ressources/images/lionWizard.jpg" alt="Profile Picture">
            </div>
            <span class="username">@UsernameSuperWizard</span>
            <button class="button" id="bouton-deconnexion" style="display: none;">Déconnexion</button>
        </div>

        <h1>Cocktail <img src="../favicon.ico" id="w-icon">izard</h1>
        <div class="button-container">
            <a class="button" id="bouton-galerie" href="../index.html">Galerie</a>
        </div>
    </header>

    <hr>

    <main>
        <div class="separator">
            <span class="section-name">Mes ingredients</span>
            <hr class="line right" />

            <section class="ingredients">
                <div id="contenant-boite-recherche" class="dropdown">
                    <input type="text" id="boite-recherche" placeholder="Ajouter un ingredient...">
                    <div id="liste-ingredients" class="dropdown-content"></div>
                </div>
            </section>
        </div>
        <div class="boite-ingredients-selectionnes" id="selectedIngredients"></div>
        <div class="body">
            <div class="separator">
                <span class="section-name">Les classiques</span>
                <hr class="line right" />
            </div>

            <section id="cocktails-classiques" class="galerie"></section>

            <div class="separator">
                <span class="section-name">Mes favoris</span>
                <hr class="line right" />
            </div>

            <section id="cocktails-personnels" class="galerie"></section>

            <div class="separator">
                <span class="section-name">Communautaires</span>
                <hr class="line right" />
            </div>

            <section id="cocktails-communautaires" class="galerie"></section>

        </div>
    </main>

    <aside id="deux-boutons">
        <button>
            <img id="btnAbout" src="../ressources/images/info.svg" alt="Question Mark" width="24" height="24">
        </button>
        <button id="publish">
            <img id="btnPublish" src="../ressources/images/feather.svg" alt="Feather" width="24" height="24">
        </button>
    </aside>

    <footer>Cocktail Wizard &copy - 2024</footer>

    <script src="../ressources/scripts/outils.js"></script>
    <!-- <script type="module" src="../ressources/scripts/publication.js"></script> -->
    <script type="module" src="../ressources/scripts/monbar.js"></script>
</body>

</html>
