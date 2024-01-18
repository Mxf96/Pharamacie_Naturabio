<?php
require '../../../includes/inc-db-connect.php';

function getAllReviews($dbh)
{
    $sql = "SELECT * FROM avis";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getReviewById($dbh, $id)
{
    $sql = "SELECT * FROM avis WHERE id_avis = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function insertReview($dbh, $contenue_avis, $id_produit, $id_utilisateur)
{
    $sql = "INSERT INTO avis (contenue_avis, id_produit, id_utilisateur) VALUES (?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$contenue_avis, $id_produit, $id_utilisateur]);
}

function updateReview($dbh, $id, $contenue_avis, $id_produit, $id_utilisateur)
{
    $sql = "UPDATE avis SET contenue_avis = ?, id_produit = ?, id_utilisateur = ? WHERE id_avis = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$contenue_avis, $id_produit, $id_utilisateur, $id]);
}

function deleteReview($dbh, $id)
{
    $sql = "DELETE FROM avis WHERE id_avis = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
}
