<?php
require 'includes/inc-db-connect.php';

function getAllUsers($dbh)
{
    $sql = "SELECT Utilisateurs.*, Roles.libelle_role 
            FROM Utilisateurs
            LEFT JOIN assigner ON Utilisateurs.id_utilisateur = assigner.id_utilisateur
            LEFT JOIN Roles ON assigner.id_role = Roles.id_role
            ORDER BY Utilisateurs.id_utilisateur ASC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getUserById($dbh, $id)
{
    $sql = "SELECT Utilisateurs.*, assigner.id_role, Roles.libelle_role 
            FROM Utilisateurs
            LEFT JOIN assigner ON Utilisateurs.id_utilisateur = assigner.id_utilisateur
            LEFT JOIN Roles ON assigner.id_role = Roles.id_role
            WHERE Utilisateurs.id_utilisateur = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}