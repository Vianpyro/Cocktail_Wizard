<?php
/**
 * Script getCocktails
 *
 * Script de l'API qui permet de récupérer les cocktails de la galerie non filtrée.
 *
 * Type de requête : GET
 *
 * URL : /api/cocktails/tri/$tri
 *
 * @param string $tri Le type de tri des cocktails (date, like)
 *
 * @return JSON Un json contenant les informations des cocktails de la galerie non filtrée.
 *
 * @version 1.0
 *
 * @author Yani Amellal
 *
 * @see InfoAffichageCocktail.php
 *
 * @todo Ajouter la pagination
 *
 */
header('Content-Type: application/json');
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/fonctionAPIphp/InfoAffichageCocktail.php';

// Connexion à la base de données
$conn = connexionBD();

if($conn == null){
    http_response_code(500);
    echo json_encode("Erreur de connexion à la base de données.");
    exit();
}
$tri_s = mysqli_real_escape_string($conn, $tri);
//Liste d'objets Cocktail
$cocktails = [];
//Liste d'id de cocktails
$id_cocktail = [];

//Demande les id_cocktail de tous les cocktails triée par date
$requete_preparee = $conn->prepare("CALL GetCocktailGalerieNonFiltrer(?)");
$requete_preparee->bind_param('s', $tri_s);
$requete_preparee->execute();
$resultat = $requete_preparee->get_result();

$requete_preparee->close();

if($resultat->num_rows > 0){
    //Ajoute les id des cocktails à la liste
    while($row = $resultat->fetch_assoc()){
        $id_cocktail[] = $row['id_cocktail'];
    }
}
else{
    http_response_code(404);
    echo json_encode("Aucun cocktail trouvé.");
    exit();
}

foreach($id_cocktail as $id) {
    $cocktails[] = InfoAffichageCocktail($id, $conn);
}

echo json_encode($cocktails);

$conn->close();

?>
