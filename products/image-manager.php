<?php
// Inclusion du fichier de connexion à la base de données
require '../includes/inc-db-connect.php';

function getAllImagesProduct($dbh) {
    $sql = "SELECT produits.id_produit, images.id_image, images.url_image, produits.nom_produit, produits.prix_produit, produits.description_produit, categories.nom_categorie, marques.nom_marque
            FROM images
            JOIN produits ON images.id_produit = produits.id_produit
            JOIN categories ON produits.id_categorie = categories.id_categorie
            JOIN marques ON produits.id_marque = marques.id_marque
            ORDER BY images.id_image ASC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getProductById($dbh, $id) {
    $sql = "SELECT produits.id_produit, images.id_image, images.url_image, produits.nom_produit, produits.prix_produit, produits.description_produit, produits.quantite_produit, categories.nom_categorie, marques.nom_marque
            FROM images
            JOIN produits ON images.id_produit = produits.id_produit
            JOIN categories ON produits.id_categorie = categories.id_categorie
            JOIN marques ON produits.id_marque = marques.id_marque
            WHERE produits.id_produit = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
}
