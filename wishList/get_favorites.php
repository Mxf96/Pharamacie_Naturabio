<?php
session_start();

if (isset($_SESSION['id_utilisateur'])) {
    require '../includes/inc-db-connect.php';

    $id_utilisateur = $_SESSION['id_utilisateur'];

    $stmt = $dbh->prepare("SELECT produits.nom_produit FROM produits 
                           JOIN inclure ON produits.id_produit = inclure.id_produit 
                           JOIN liste_souhaits ON inclure.id_liste = liste_souhaits.id_liste 
                           WHERE liste_souhaits.id_utilisateur = :id_utilisateur");
    $stmt->bindParam(':id_utilisateur', $id_utilisateur);
    $stmt->execute();
    $favoris = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

    echo '<h1 class="h1">Mes favoris</h1>';

    foreach($favoris as $item) {
        echo "<div class='favorisItem'><p>$item</p> <button>Supprimer</button></div>";
    }
}
?>
