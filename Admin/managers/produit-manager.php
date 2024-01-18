<?php
require '../../../includes/inc-db-connect.php';

function getAllProducts($dbh)
{
    $sql = "SELECT produits.*, categories.nom_categorie, marques.nom_marque
        FROM produits 
        LEFT JOIN categories ON produits.id_categorie = categories.id_categorie
        LEFT JOIN marques ON produits.id_marque = marques.id_marque
        ORDER BY produits.id_produit ASC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getProductById($dbh, $id)
{
    $sql = "SELECT * FROM produits WHERE id_produit = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function insertProduct($dbh, $nom_produit, $description_produit, $prix_produit, $quantite_produit, $id_categorie, $id_marque)
{
    $sql = "INSERT INTO produits (nom_produit, description_produit, prix_produit, quantite_produit, id_categorie, id_marque) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$nom_produit, $description_produit, $prix_produit, $quantite_produit, $id_categorie, $id_marque]);
}

function updateProduct($dbh, $id, $nom_produit, $description_produit, $prix_produit, $quantite_produit, $id_categorie, $id_marque)
{
    $sql = "UPDATE produits SET nom_produit = ?, description_produit = ?, quantite_produit = ?, prix_produit = ?, id_categorie = ?, id_marque = ? WHERE id_produit = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$nom_produit, $description_produit, $quantite_produit, $prix_produit, $id_categorie, $id_marque, $id]);
}

function deleteProduct($dbh, $id)
{
    $sql = "DELETE FROM produits WHERE id_produit = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
}
