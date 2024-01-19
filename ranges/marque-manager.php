<?php
// Inclusion du fichier de connexion à la base de données
require '../includes/inc-db-connect.php';

function getAllImagesBrands($dbh) {
    $sql = "SELECT images.id_image, images.url_image, marques.nom_marque, marques.id_marque
            FROM images
            JOIN marques ON images.id_marque = marques.id_marque
            ORDER BY images.id_image ASC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}


function getBrandById($dbh, $id) {
    $sql = "SELECT marques.id_marque, images.id_image, images.url_image, marques.nom_marque
            FROM images
            JOIN marques ON images.id_marque = marques.id_marque
            WHERE marques.id_marque = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
}

function getAllProductsFromBrand($dbh, $id) {
    try {
        $stmt = $dbh->prepare("SELECT produits.*, images.url_image
                               FROM produits
                               LEFT JOIN images ON produits.id_produit = images.id_produit
                               WHERE produits.id_marque = :id_marque");
        $stmt->bindParam(':id_marque', $id);
        $stmt->execute();

        // Récupérez tous les produits et renvoyez-les sous forme de tableau
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
        return [];
    }
}

?>