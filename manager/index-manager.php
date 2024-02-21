<?php 
require 'includes/inc-db-connect.php';

function getAllproductPictures($dbh)
{
    $sql = "SELECT images.id_image, images.url_image, produits.nom_produit
            FROM images
            JOIN produits ON images.id_produit = produits.id_produit
            ORDER BY images.id_image ASC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}