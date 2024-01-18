<?php
require '../../../includes/inc-db-connect.php';

function getAllReductions($dbh)
{
    $sql = "SELECT reductions.*, produits.nom_produit
            FROM reductions
            INNER JOIN produits ON reductions.id_produit = produits.id_produit
            ORDER BY reductions.id_reduction ASC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getReductionById($dbh, $id)
{
    $sql = "SELECT * FROM reductions WHERE id_reduction = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function insertReduction($dbh, $date_debut, $date_fin, $pourcentage_reduction, $id_produit)
{
    $sql = "INSERT INTO reductions (date_debut, date_fin, pourcentage_reduction, id_produit) VALUES (?, ?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$date_debut, $date_fin, $pourcentage_reduction, $id_produit]);
    return $dbh->lastInsertId();
}

function updateReduction($dbh, $id, $date_debut, $date_fin, $pourcentage_reduction, $id_produit)
{
    $sql = "UPDATE reductions SET date_debut = ?, date_fin = ?, pourcentage_reduction = ?, id_produit = ? WHERE id_reduction = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$date_debut, $date_fin, $pourcentage_reduction, $id_produit, $id]);
}

function deleteReduction($dbh, $id)
{
    $sql = "DELETE FROM reductions WHERE id_reduction = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
}

function assignReductionToProduct($dbh, $id_reduction, $id_produit)
{
    $sql = "INSERT INTO assigner (id_utilisateur, id_role) VALUES (?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id_reduction, $id_produit]);
}
