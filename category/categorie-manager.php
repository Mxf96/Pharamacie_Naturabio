<?php
// Inclusion du fichier de connexion à la base de données
require '../includes/inc-db-connect.php';

function getAllImagesCategories($dbh) {
    $sql = "SELECT images.id_image, images.url_image, categories.nom_categorie, categories.id_categorie
            FROM images
            JOIN categories ON images.id_categorie = categories.id_categorie
            ORDER BY images.id_image ASC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}


function getCategoriesById($dbh, $id) {
    $sql = "SELECT categories.id_categorie, images.id_image, images.url_image, categories.nom_categorie
            FROM images
            JOIN categories ON images.id_categorie = categories.id_categorie
            WHERE categories.id_categorie = :id_categorie";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':id_categorie', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
}

function getAllProductsFromCategory($dbh, $id) {
    try {
        $stmt = $dbh->prepare("SELECT produits.*, images.url_image 
                               FROM produits 
                               LEFT JOIN images ON produits.id_produit = images.id_produit
                               WHERE produits.id_categorie = :id_categorie");
        $stmt->bindParam(':id_categorie', $id);
        $stmt->execute();

        // Récupérez tous les produits et renvoyez-les sous forme de tableau
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
        return [];
    }
}

?>