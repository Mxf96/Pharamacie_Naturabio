<?php
require '../../../includes/inc-db-connect.php';

function getAllCategories($dbh)
{
    $sql = "SELECT * FROM categories ORDER BY id_categorie ASC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getCategoryById($dbh, $id)
{
    $sql = "SELECT * FROM categories WHERE id_categorie = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function insertCategory($dbh, $nom_categorie, $description_categorie)
{
    $sql = "INSERT INTO categories (nom_categorie, description_categorie) VALUES (?,?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$nom_categorie, $description_categorie]);
    return $dbh->lastInsertId();
}

function updateCategory($dbh, $id, $nom_categorie, $description_categorie)
{
    $sql = "UPDATE categories SET nom_categorie = ?, description_categorie = ? WHERE id_categorie = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$nom_categorie, $description_categorie, $id]);
}

function deleteCategory($dbh, $id)
{
    $sql = "DELETE FROM categories WHERE id_categorie = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
}
