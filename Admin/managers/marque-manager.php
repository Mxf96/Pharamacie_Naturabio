<?php
require '../../../includes/inc-db-connect.php';

function getAllBrands($dbh)
{
    $sql = "SELECT * FROM marques ORDER BY id_marque ASC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getBrandById($dbh, $id)
{
    $sql = "SELECT * FROM marques WHERE id_marque = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function insertBrand($dbh, $nom_marque)
{
    $sql = "INSERT INTO marques (nom_marque) VALUES (?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$nom_marque]);
}

function updateBrand($dbh, $id, $nom_marque)
{
    $sql = "UPDATE marques SET nom_marque = ? WHERE id_marque = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$nom_marque, $id]);
}

function deleteBrand($dbh, $id)
{
    $sql = "DELETE FROM marques WHERE id_marque = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
}
