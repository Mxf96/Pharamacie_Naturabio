<?php
require '../../../includes/inc-db-connect.php';

function getAllImagesProduits($dbh)
{
    $sql = "SELECT images.id_image, images.url_image, produits.nom_produit
            FROM images
            JOIN produits ON images.id_produit = produits.id_produit
            ORDER BY images.id_image ASC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getAllImagesMarques($dbh)
{
    $sql = "SELECT images.id_image, images.url_image, marques.nom_marque
            FROM images
            JOIN marques ON images.id_marque = marques.id_marque
            ORDER BY images.id_image ASC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getAllImagesCategories($dbh)
{
    $sql = "SELECT images.id_image, images.url_image, categories.nom_categorie
            FROM images
            JOIN categories ON images.id_categorie = categories.id_categorie
            ORDER BY images.id_image ASC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getImageById($dbh, $id)
{
    $sql = "SELECT * FROM images WHERE id_image = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function insertProductImage($dbh, $url_image, $id_produit)
{
    $sql = "INSERT INTO images (url_image, id_produit) VALUES (?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$url_image, $id_produit]);
}

function inserteCategoryImage($dbh, $url_image, $id_categorie)
{
    $sql = "INSERT INTO images (url_image, id_categorie) VALUES (?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$url_image, $id_categorie]);
}

function insertBrandImage($dbh, $url_image, $id_marque)
{
    $sql = "INSERT INTO images (url_image, id_marque) VALUES (?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$url_image, $id_marque]);
}

function updateProductImage($dbh, $id_image, $url_image)
{
    $sql = "UPDATE images SET url_image = ? WHERE id_image = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$url_image, $id_image]);
}

function updateCategoryImage($dbh, $id_image, $url_image)
{
    $sql = "UPDATE images SET url_image = ? WHERE id_image = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$url_image, $id_image]);
}

function updateBrandImage($dbh, $id_image, $url_image)
{
    $sql = "UPDATE images SET url_image = ? WHERE id_image = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$url_image, $id_image]);
}

function deleteImage($dbh, $id)
{
    $sql = "DELETE FROM images WHERE id_image = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
}
