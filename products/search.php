<?php
require 'image-manager.php'; // Assurez-vous que le chemin d'accès est correct
require '../includes/inc-db-connect.php'; // Assurez-vous que le chemin d'accès est correct

if(isset($_POST['query'])) {
    $query = "%" . $_POST['query'] . "%";
    $stmt = $dbh->prepare("SELECT nom_produit FROM produits WHERE nom_produit LIKE ?");
    $stmt->execute([$query]);
    $results = $stmt->fetchAll();
    if(!empty($results)) {
        foreach($results as $row) {
            echo '<li>'.$row['nom_produit'].'</li>';
        }
    } else {
        echo '<li>Aucun produit trouvé</li>';
    }
}
?>
